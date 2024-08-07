<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Auth;

use \App\Models\Restaurant;
use \App\Models\Category;
use \App\Models\User;
use \App\Models\Product;
use \App\Models\Design;
use App\Models\Suggestion;
use \App\Models\ViewStatistic;

use Illuminate\Support\Str;

use Carbon\Carbon;

use PDO;

use Barryvdh\DomPDF\Facade\Pdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Exception;


/* QR CODE */
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Cache;

class BaseController extends Controller
{

    public function logRestaurant($restaurant_slug)
    {

        $restaurant = Restaurant::findOrFail($restaurant_slug);

        $user = $restaurant->users->where('role', 0)->first();

        if ($user) {
            Cache::flush();
            Auth::logout();
            Auth::login($user);
            return redirect()->route('home');
        }

        return redirect()->route('welcome');
    }

    public function RestaurantHome($id)
    {

        $restaurant = Restaurant::findOrFail($id);

        $user = $restaurant->users->where('restaurant_id', $id)->first();

        if ($user) {
            Auth::logout();
            Auth::login($user);
        }

        return redirect()->route('restau', $user->restaurant_id);
    }

    public function logout()
    {
        Auth::logout();
        session_start();
        session_unset();
        session_destroy();
        return redirect('https://monmenu.io');
    }


    public function vitrine()
    {
        $restaurants = Restaurant::all();
        return view('vitrine', compact('restaurants'));
    }


    public function adminDashboard()
    {
        $restaurants = Restaurant::all();
        $users = User::all();

        return view('layouts/admin', compact(
            'restaurants',
            'users',
        ));
    }


    public function single($id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $mainCategories = Category::where('is_main', 1)
            ->where('restaurant_id', $id)
            ->get();

        $defaultCategory = $mainCategories->count() ? $mainCategories[0] : null;

        if (!$defaultCategory) {
            // peux etre une vue dédiée ??
        }

        $currentCategoryId = $id ? $id : $defaultCategory->id;

        $currentCategory = Category::where('active', 1)->where('id', $currentCategoryId)->first();


        if ($currentCategory === null) {
            $currentCategory = Category::where('restaurant_id', $id)->first();
        }


        if ($currentCategory && $currentCategory->childs) {

            $categories = [];

            foreach ($currentCategory->childs as $key) {
                $categories[$key] = Category::find($key);
            }

            $currentCategory->load('products');
            $products =  $currentCategory->products()->get();

            return view('single-restaurant', compact(
                'mainCategories',
                'categories',
                'currentCategory',
                'products',
                'restaurant',
            ));
        } else {






            $currentCategory->load('products');
            $products =  $currentCategory->products()->get();

            if ($products === null) {
                return view('no-product', compact('restaurant'));
            }




            return view('single-restaurant', compact(
                'mainCategories',
                'currentCategory',
                'products',
                'restaurant',

            ));
        }
    }

    // public function chooseRestaurant()
    // {
    //     $user = Auth::user();
    //     $restaurants = Restaurant::where('admin_id', $user->id)->get();

    //     return view('dashboard/choose', compact(
    //         'restaurants',
    //         'user'
    //     ));
    // }

    public function dashboardRestau(Request $request)
    {
        Cache::flush();
        if (!Auth::User()) {
            return redirect()->route('vitrine');
        }

        // if (Auth::User()->role === 'ROLE_USER') {



        //     $wp_user_id = Auth::User()->wp_user_id;

        //     try {
        //         $conn = new \PDO("mysql:host=monmennshop.mysql.db;dbname=monmennshop", "monmennshop", "X6x59jmB");
        //         $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        //         $query = "SELECT p.* FROM wp_posts p
        //     INNER JOIN wp_postmeta pm ON p.id = pm.post_id
        //     WHERE p.post_type = 'shop_subscription'
        //     AND pm.meta_key = '_customer_user'
        //     AND pm.meta_value = $wp_user_id";

        //         $result = $conn->query($query);
        //         $redirection = $result->fetch(\PDO::FETCH_ASSOC);

        //         $conn->query($query);
        //     } catch (\PDOException $e) {
        //         echo "Connection failed: " . $e->getMessage();
        //     }

        //     if (!$redirection) {
        //         echo 'Votre abonnement est actuellement inactif. Veuillez vérifier que vous avez bien soucrit à l\'abonnement, si c\'est le cas contactez nous pour résoudre le problème !<br>';

        //         echo "<a href='https://monmenu.io/api?autolog=" . Auth::User()->wp_token . "'>Activer mon abonnement </a><br>";

        //         die();
        //     }

        //     if ($redirection['post_status'] !== 'wc-active') {

        //         // echo "<pre>";
        //         // print_r($redirection);
        //         // echo "</pre>";

        //         echo 'Votre abonnement est actuellement inactif. Veuillez vérifier que vous avez bien soucrit à l\'abonnement, si c\'est le cas contactez nous pour résoudre le problème !<br>';

        //         echo "<a href='https://monmenu.io/mon-compte/view-subscription/" . $redirection['ID'] . "/'>Renouveler mon abonnement </a><br>";

        //         die();
        //     }
        // }
        if (Auth::User() === null) {
            return redirect()->route('login');
        }

        if (Auth::User()->role === "ROLE_ADMIN") {
            if ($request->get('restau_id') !== null) {
                $id_restau = $request->get('restau_id');
                session(['restau_id' => $id_restau]);
                $id = $id_restau;
            }
        }

        if (Auth::User()->role === "ROLE_USER" || Auth::User()->role === "ROLE_SUBAD") {

            if (session('restau_id')) {

                if ($request->get('restau_id')) {
                    $id_restau = $request->get('restau_id');
                    session(['restau_id' => $id_restau]);
                }

                $id = session('restau_id');
            } else {
                $idRestau = Auth::User()->restaurant_id;
                session(['restau_id' => $idRestau]);
            }

            if (Auth::User()->role === "ROLE_SUBAD" && Auth::User()->first_login) {
                return redirect()->route('first-login');
            }

            $id = Auth::User()->restaurant_id;
        }

        $id = session('restau_id');

        $restaurant = Restaurant::findOrFail($id);

        $design = Design::where('restaurant_id', $id)->first();




        $mainCategories = Category::where('restaurant_id', $id)->get();

        $categoryIds = $mainCategories->pluck('id')->toArray();

        $products = Product::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('categories.id', $categoryIds);
        })->orWhereDoesntHave('categories')->get()->load('categories');

        $currentCategory = Category::where('active', 1)
            ->where('restaurant_id', $id)
            ->first();

        $slug = Str::slug($restaurant->name);
        $url = 'https://www.monmenu.io/menus/' . $slug . '/' . $restaurant->id;


        // Configuration du rendu du code QR en format SVG
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);
        $qrCode = $writer->writeString($url);

        $pdfFileName = 'QrCode-' . $slug . '.pdf';

        // var_dump($qrCode);
        // die();

        $pdf = '';

        //  $pdf = Pdf::loadHTML('<img src="data:image/svg+xml;base64,' . base64_encode($qrCode) . '" ...>');

        if (isset($_GET['download'])) {
            // Télécharger le PDF généré
            return $pdf->download($pdfFileName);
        }

        $qrCodeWifi = null;

        if ($design) {
            $wifiSsid = $design->wifiSsid;
            $wifiPassword = $design->wifiPassword;
            $wifiEncryption = $design->wifiEncryption;
        } else {
            $wifiSsid = '';
            $wifiPassword = '';
            $wifiEncryption = '';
        }


        // if ($design->wifiSsid) {


        //     $rendererwifi = new ImageRenderer(
        //         new RendererStyle(400),
        //         new SvgImageBackEnd()
        //     );

        //     $writerwifi = new Writer($rendererwifi);

        //     $wifiData = "WIFI:S:$wifiSsid;T:$wifiEncryption;P:$wifiPassword;;";

        //     $qrCodeWifi = $writerwifi->writeString($wifiData);
        // }

        $filter = $request->input('filter');

        $endDate = Carbon::today();
        $startDate = $endDate->copy()->subDays($filter - 1);

        $viewStats = ViewStatistic::where('restaurant_id', $id)
            ->whereDate('viewed_at', '>=', $startDate)
            ->whereDate('viewed_at', '<=', $endDate)
            ->orderBy('viewed_at')
            ->get();

        $nbr_view = 0;


        foreach ($viewStats as $viewStat) {
            $nbr_view = $nbr_view + $viewStat->views;
        }




        $viewStatsHier = ViewStatistic::where('restaurant_id', $id)
            ->whereDate('viewed_at', '=', $endDate->copy()->subDays(1))
            ->orderBy('viewed_at')
            ->get();

        $viewavanthier = ViewStatistic::where('restaurant_id', $id)
            ->whereDate('viewed_at', '>=', $endDate->copy()->subDays(2))
            ->whereDate('viewed_at', '<=', $endDate->copy()->subDays(1))
            ->orderBy('viewed_at')
            ->get();

        $viewilyatoisj = ViewStatistic::where('restaurant_id', $id)
            ->whereDate('viewed_at', '>=', $endDate->copy()->subDays(3))
            ->whereDate('viewed_at', '<=', $endDate->copy()->subDays(2))
            ->orderBy('viewed_at')
            ->get();

        $viewilyaquatrej = ViewStatistic::where('restaurant_id', $id)
            ->whereDate('viewed_at', '>=', $endDate->copy()->subDays(4))
            ->whereDate('viewed_at', '<=', $endDate->copy()->subDays(3))
            ->orderBy('viewed_at')
            ->get();

        $viewilyacinqj = ViewStatistic::where('restaurant_id', $id)
            ->whereDate('viewed_at', '>=', $endDate->copy()->subDays(5))
            ->whereDate('viewed_at', '<=', $endDate->copy()->subDays(4))
            ->orderBy('viewed_at')
            ->get();

        $viewilyasixj = ViewStatistic::where('restaurant_id', $id)
            ->whereDate('viewed_at', '>=', $endDate->copy()->subDays(6))
            ->whereDate('viewed_at', '<=', $endDate->copy()->subDays(5))
            ->orderBy('viewed_at')
            ->get();

        $ilyaseptj = ViewStatistic::where('restaurant_id', $id)
            ->whereDate('viewed_at', '>=', $endDate->copy()->subDays(7))
            ->whereDate('viewed_at', '<=', $endDate->copy()->subDays(8))
            ->orderBy('viewed_at')
            ->get();

        $viewStatsHier = $viewStatsHier->count() > 0 ? $viewStatsHier : collect([['views' => 0]]);
        $viewavanthier = $viewavanthier->count() > 0 ? $viewavanthier : collect([['views' => 0]]);
        $viewilyatoisj = $viewilyatoisj->count() > 0 ? $viewilyatoisj : collect([['views' => 0]]);
        $viewilyaquatrej = $viewilyaquatrej->count() > 0 ? $viewilyaquatrej : collect([['views' => 0]]);
        $viewilyacinqj = $viewilyacinqj->count() > 0 ? $viewilyacinqj : collect([['views' => 0]]);
        $viewilyasixj = $viewilyasixj->count() > 0 ? $viewilyasixj : collect([['views' => 0]]);
        $ilyaseptj = $ilyaseptj->count() > 0 ? $ilyaseptj : collect([['views' => 0]]);

        $user = Auth::user();
        $restaurants = Restaurant::where('admin_id', $user->id)->get();

        $directory = scandir('categories-icons', SCANDIR_SORT_DESCENDING);

        $categoriesIcons = array_slice($directory, 0, -2);

        $admins = User::where('restaurant_id', $restaurant->id)->get();

        if ($admins) {
            $adminsList = $admins;
        } else {
            $adminsList = [];
        }

        return view('dashboard/dashboard', compact(
            'mainCategories',
            'products',
            'restaurant',
            'restaurants',
            'currentCategory',
            'design',
            'qrCode',
            'qrCodeWifi',
            'viewStats',
            'nbr_view',
            'viewStatsHier',
            'viewavanthier',
            'viewilyatoisj',
            'viewilyaquatrej',
            'viewilyacinqj',
            'viewilyasixj',
            'ilyaseptj',
            'wifiSsid',
            'wifiPassword',
            'wifiEncryption',
            'categoriesIcons',
            'adminsList'
        ));
    }

    public function adminPanel()
    {
        $restaurants = Restaurant::all();
        $suggestions = Suggestion::all();

        return view('dashboard/admin-panel', compact(
            'restaurants',
            'suggestions'
        ));
    }

    public function crownMail()
    {
        $role = 'ROLE_USER';
        $users = User::where('role', $role)->get();

        foreach ($users as $user) {
            $userEmail = $user->email;

            $id = $user->restaurant_id;

            $restaurant = Restaurant::find($id);
            $restaurantSeen = $restaurant->seen;

            $categoriesMostSeen = Category::where('restaurant_id', $id)
                ->orderBy('seen', 'DESC')
                ->limit(5)
                ->get();
            foreach ($categoriesMostSeen as $category) {
                $catName = $category->name;
                $catSeen = $category->seen;

                $products = $category->products()
                    ->orderBy('seen', 'DESC')
                    ->take(3)
                    ->get();

                foreach ($products as $product) {
                    $prodName = $product->name;
                    $prodSeen = $product->seen;
                }
            }

            $mail = new PHPMailer();

            try {
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->Username = "cliondor@gmail.com";
                $mail->Password = "pelorlrhapedelqd";
                $mail->SetFrom("cliondor@gmail.com", "MonMenu.io");
                $mail->Subject = "Vos statistiques de votre Menu - MonMenu.io";
                $htmlContent = "
                <a href='https://monmenu.io' style='display:block;margin:auto;'>
                    <img src='https://monmenu.io/menus/img/vitrine/logo.png' alt='Logo MonMenu.io' width='100px' height='64px'>
                </a>
                <h1>Bonjour " .  $user->name . "</h1>
                <h3>Voici les statistiques de votre établissement <strong>$restaurant->name</strong></h3>
                <h4>Nombre de vue de votre restaurant : $restaurantSeen vues</h4>
                <p>Pour accéder à <a href='https://monmenu.io/menus/login'>MonMenu.io</a>, cliquez sur le lien.</p>
                <br>
                <h3>Voici vos catégories les plus vues avec leurs produits les plus populaires</h3>
                <br>
                <table>
                    <tr>
                        <th align='left'>Nom de la catégorie</th>
                        <th align='right'>Nombre de vues</th>
                    </tr>";
                foreach ($categoriesMostSeen as $category) {
                    $catName = $category->name;
                    $catSeen = $category->seen;
                    $htmlContent .= "
                    <tr>
                        <td><strong style='font-size: 18px;'>" . $catName . "</strong></td>
                        <td align='right'>" . $catSeen . "</td>
                    </tr>";

                    $htmlContent .= "
                        <tr>
                            <th align='left'>Les produits les plus vu de la catégorie</th>
                        </tr>";

                    $products = $category->products()
                        ->orderBy('seen', 'DESC')
                        ->take(3)
                        ->get();


                    if (count($products) > 0) {
                        foreach ($products as $product) {
                            $prodName = $product->name;
                            $prodSeen = $product->seen;
                            $htmlContent .= "
                            <tr>
                                <td>" . $prodName . "</td>
                                <td align='right'>" . $prodSeen . "</td>
                            </tr>";
                        }
                    } else {
                        $subCats = Category::where('parent_id', $category->id)
                            ->orderBy('seen', 'desc')
                            ->limit(3)
                            ->get();

                        foreach ($subCats as $subcat) {
                            $products_sub = $subcat->products()
                                ->orderBy('seen', 'DESC')
                                ->take(3)
                                ->get();
                            $htmlContent .= "
                                <tr>
                                <td><strong>" . $subcat->name . "</strong></td>
                                <td align='right'></td>
                                </tr>";
                            foreach ($products_sub as $product) {
                                $prodName = $product->name;
                                $prodSeen = $product->seen;
                                $htmlContent .= "
                                <tr>
                                <td>" . $prodName . "</td>
                                <td align='right'>" . $prodSeen . "</td>
                                </tr>";
                            }
                        }
                    }
                }

                $htmlContent .= "</table>
                <br>
                <p>A bientôt sur MonMenu.io !</p>
                <br>";
                $mail->isHTML(true);
                $mail->Body = $htmlContent;
                $mail->AddAddress('mehdi.raposo77@gmail.com');

                $mail->send();
            } catch (Exception $e) {
                return "Erreur lors de l'envoi de l'e-mail : " . $e;
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOpinionRequest;
use App\Models\Category;
use App\Models\Opinion;
use App\Models\Product;
use \App\Models\Restaurant;
use App\Models\User;
use App\Models\Design;
use App\Models\Suggestion;
use \App\Models\ViewStatistic;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

use \Auth;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\File;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class RestaurantController extends Controller
{
    public function getRestaurantId()
    {
        // $restaurant_id = session('restau_id');
        // dd($restaurant_id);
    }



    public function showinfos($id)
    {

        // $restaurant_id = session('restau_id');
        $restaurant = Restaurant::where('id', $id)->first();
        dd($restaurant);
    }



    public function update(Request $request, $id)
    {



        $restaurant_id = session('restau_id');

        $restau_id = session('restau_id');
        $restaurant = Restaurant::where('id', $restau_id)->first();

        $design = Design::where('restaurant_id', $restau_id)->first();

        $restaurant->name                = $request->name;
        $restaurant->mobile              = $request->mobile;
        $restaurant->line                = $request->line;
        $restaurant->address             = $request->address;
        $restaurant->lat                 = $request->lat;
        $restaurant->lon                 = $request->lon;
        $restaurant->content             = $request->content;
        $restaurant->facebook            = $request->facebook;
        $restaurant->instagram           = $request->instagram;
        $restaurant->website             = $request->website;
        $restaurant->tripadvisor         = $request->tripadvisor;
        $restaurant->tiktok              = $request->tiktok;
        $restaurant->google_review_link  = $request->google_review_link;
        $restaurant->lundi               = $request->lundi;
        $restaurant->mardi               = $request->mardi;
        $restaurant->mercredi            = $request->mercredi;
        $restaurant->jeudi               = $request->jeudi;
        $restaurant->vendredi            = $request->vendredi;
        $restaurant->samedi              = $request->samedi;
        $restaurant->dimanche            = $request->dimanche;
        $restaurant->event_name          = $request->event_name;
        $restaurant->event_content       = $request->event_content;
        if ($request->cart === 'on') {
            $restaurant->cart                = 1;
        } else {
            $restaurant->cart                = 0;
        }
        $restaurant->cart_instructions   = $request->cart_instructions;

        if ($request->wifiSsid && $request->wifiPassword && $request->wifiEncryption) {


            // dd($design);

            $design->wifiSsid = $request->wifiSsid;
            $design->wifiPassword = $request->wifiPassword;
            $design->wifiEncryption = $request->wifiEncryptio;


            $design->save();
        }



        $restaurant->save();


        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image s'il en existe une
            if ($restaurant->logo) {
                $oldImagePath = 'images/' . $restaurant->id . '/' . $restaurant->logo;

                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = session('restau_id') . '-logo-' . $restaurant->id . '.png';

            // Redimensionner l'image
            $img = Image::make($image);
            $img->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            // Enregistrer l'image redimensionnée

            $img->encode('png', 75)->save('images/' . $restaurant->id . '/' . $imageName, 75);

            $restaurant->logo = $imageName;
            $restaurant->save();
        }

        if ($request->hasFile('banner')) {
            // Supprimer l'ancienne image s'il en existe une
            if ($restaurant->banner) {
                $oldImagePath = 'images/' . $restaurant->id . '/' . $restaurant->banner;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('banner');
            $imageName = session('restau_id') . '-banner-' . $restaurant->id . '.png';

            // Redimensionner l'image
            $img = Image::make($image);
            $img->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // Enregistrer l'image redimensionnée
            $img->encode('png', 75)->save('images/' . $restaurant->id . '/' . $imageName, 75);

            $restaurant->banner = $imageName;
            $restaurant->save();
        }
        return redirect('admin/?task=restaurant&show=base')
            ->with('success', 'Votre profil à été modifié avec succès');
    }

    public function getOneRestaurant($id, $name = null)
    {

        if ($name) {
            $id = $name;
        }

        $restaurant =  Restaurant::findOrFail($id);
        $design = Design::where('restaurant_id', $id)->first();

        $lastSeen = $restaurant->seen;
        $newSeen = $lastSeen + 1;
        $restaurant->seen = $newSeen;
        $restaurant->save();

        $currentDate = Carbon::today();

        $viewStat = ViewStatistic::where('restaurant_id', $id)
            ->where('url', 'home')
            ->whereDate('viewed_at', $currentDate)
            ->first();

        if ($viewStat) {
            $viewStat->views += 1;
            $viewStat->save();
        } else {
            $viewStat = new ViewStatistic();
            $viewStat->restaurant_id = $id;
            $viewStat->url = 'home';
            $viewStat->views = 1;
            $viewStat->viewed_at = $currentDate;
            $viewStat->save();
        }

        $categories = Category::where('is_main', 1)
            ->where('restaurant_id', $id)
            ->get();

        $categoryIds = $categories->pluck('id')->toArray();



        $allcategories = Category::where('restaurant_id', $id)
            ->get();

        $allcategoryIds = $allcategories->pluck('id')->toArray();

        /*
        $products = Product::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('categories.id', $categoryIds)->where('featured',1);
        })->orWhereDoesntHave('categories')->get();
*/


        $products = Product::whereHas('categories', function ($query) use ($allcategoryIds) {
            $query->whereIn('categories.id', $allcategoryIds)->where('featured', 1)->where('active', 1);
        })->get();


        // dd($featured_products);

        $currentCategory = Category::where('active', 1)
            ->where('restaurant_id', $id)
            ->first();
        $opinions = $restaurant->opinions;

        $generaltNote = 0;
        $starFull = 0;
        $starEmpty = 0;

        if (count($opinions) > 0) {
            foreach ($opinions as $opinion) {
                if ($opinion->active) {
                    $generaltNote = $opinion->note + $generaltNote;
                }
            }
            $note = ceil($generaltNote / count($opinions));

            $starFull = $note;
            $starEmpty = 5 - $note;
        }
        $opinionLength = count($opinions);
        return view('home-restaurant-new', compact(
            'categories',
            'products',
            'restaurant',
            'starFull',
            'design',
            'starEmpty',
            'generaltNote',
            'opinions',
            'opinionLength'
        ));

        if (isset($_GET['new_design'])) {

            return view('home-restaurant-new', compact(
                'categories',
                'products',
                'restaurant',
                'starFull',
                'design',
                'starEmpty',
                'generaltNote',
                'opinions',
                'opinionLength'
            ));
        } else {
            return view('home-restaurant', compact(
                'categories',
                'products',
                'restaurant',
                'starFull',
                'design',
                'starEmpty',
                'generaltNote',
                'opinions',
                'opinionLength'
            ));
        }
    }

    public function getRestaurantProductsWithCategories($name = null, $id, $categories_id)
    {
        // dd($id);




        $restaurant = Restaurant::findOrFail($id);
        $design = Design::where('restaurant_id', $id)->first();



        $category = Category::where('is_main', 1)
            ->where('id', $categories_id)
            ->where('restaurant_id', $id)
            ->where('active', 1)
            ->get();
        $allCategories = Category::where('is_main', 1)
            ->where('restaurant_id', $id)
            ->where('active', 1)
            ->get();

        $mainCategory = $category[0];

        $lastSeen = $mainCategory->seen;
        $newSeen = $lastSeen + 1;
        $mainCategory->seen = $newSeen;

        $mainCategory->save();

        $subCategories = [];
        $productsCatList = [];

        if ($mainCategory && $mainCategory->childs) {
            foreach ($mainCategory->childs as $subCategoryId) {
                $subCategories[$subCategoryId] = Category::find($subCategoryId);
            }
            foreach ($subCategories as $subCategory) {
                $subCategory->load('products');
                $products = $subCategory->products()->get();
                foreach ($products as $product) {
                    $product['subCategory'] = $subCategory->id;
                    array_push($productsCatList, $product);
                }
            }
        }
        if ($mainCategory) {
            $mainCategory->load('products');
            $products = $mainCategory->products()->get();
            foreach ($products as $product) {
                $product['category'] = $mainCategory->id;
                array_push($productsCatList, $product);
            }
        }

        $opinions = $restaurant->opinions;

        $generaltNote = 0;
        $starFull = 0;
        $starEmpty = 0;

        if (count($opinions) > 0) {
            foreach ($opinions as $opinion) {
                if ($opinion->active) {
                    $generaltNote = $opinion->note + $generaltNote;
                }
            }
            $note = ceil($generaltNote / count($opinions));

            $starFull = $note;
            $starEmpty = 5 - $note;
        }



        return view('restaurant-cat-products-new', compact(
            'restaurant',
            'mainCategory',
            'allCategories',
            'subCategories',
            'productsCatList',
            'starFull',
            'design',
            'starEmpty'
        ));
    }

    public function giveOpinions(CreateOpinionRequest $request)
    {
        $restaurant = Restaurant::find($request->restaurant_id);
        $restaurantOpinions = $restaurant->opinions;

        foreach ($restaurantOpinions as $item) {
            $authorEmail = $item->email;
            if ($authorEmail === $request->email) {
                $request->session()->flash('message', 'Votre email à déjà été utilisé pour donné un avis à se restaurant.');
                return redirect()->route('restaurantByName', [Str::slug($restaurant->name), $request->restaurant_id]);
            }
        }

        $opinion = new Opinion;
        if ($request->author && $request->email && $request->note && $request->note > 0 && $request->note <= 5) {

            $opinion->author = $request->author;
            $opinion->note = $request->note;
            $opinion->email = $request->email;
            $opinion->comment = $request->comment;
            $opinion->restaurant_id = $request->restaurant_id;
            $opinion->active = 1;
            $opinion->rgpd = 1;

            $opinion->save();
            $request->session()->flash('message', 'Votre avis à correctement été enregistré ! Merci d\'avoir pris le temps de noté ce restaurant');
            return redirect()->route('restaurantByName', [Str::slug($restaurant->name), $request->restaurant_id]);
        } else {
            $request->session()->flash('message', 'Votre avis n\'a pas pu être soumis, il semblerai qu\'il y des champ qui n\'ont pas été saisi');
            return redirect()->route('restaurantByName', [Str::slug($restaurant->name), $request->restaurant_id]);
        }
    }

    public function getWpInfos($wp_id, $wp_email, $token)
    {
        $user = User::where('email', $wp_email)->first();
        $user->wp_user_id = $wp_id;
        $user->wp_token = $token;
        $user->save();
        return redirect('https://monmenu.io/panier/');
    }

    public function createNewRestaurant(Request $request)
    {

        $restaurant = new Restaurant();
        $restaurant->name = $request->name;
        $restaurant->admin_id = Auth::user()->id;
        $restaurant->save();

        session(['restau_id' => $restaurant->id]);

        $design = new Design();
        $design->restaurant_id = $restaurant->id;
        $design->save();

        $directoryPath = 'images/' . $restaurant->id . '';

        if (!File::isDirectory($directoryPath)) {
            File::makeDirectory($directoryPath, 0777, true, true);
        }

        return redirect('admin?task=restaurant&show=base')
            ->with('success', 'Votre restaurant à été ajouté avec succès ! Commencer dés maintenant à le remplir.');
    }

    public function deleteRestaurant($id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant->admin_id !== Auth::User()->id) {
            return redirect('admin?task=new-restaurant')
                ->with('error', 'Vous ne pouvez pas supprimer un établissement qui ne vous appartient pas !');
        }

        if ($id == Auth::User()->restaurant_id) {
            return redirect('admin?task=new-restaurant')
                ->with('error', 'Vous ne pouvez pas supprimer votre établissement principal ! Veuillez contacter le support.');
        }

        $categories = Category::where('restaurant_id', $id)->get();

        $productsToDelete = [];
        if ($categories) {
            foreach ($categories as $item) {
                foreach ($item->products()->get() as $prod) {
                    array_push($productsToDelete, $prod);
                }
                $item->products()->detach();
                $item->delete();
            }
        }
        if ($productsToDelete) {
            foreach ($productsToDelete as $item) {
                $item->delete();
            }
        }
        if (!$restaurant) {
            return redirect('admin?task=new-restaurant')
                ->with('error', 'Restaurant non trouvé !');
        }

        $restaurant->delete();
        session(['restau_id' => null]);

        return redirect('admin?task=new-restaurant')
            ->with('success', 'Votre établissement a été supprimé avec succès !');
    }

    public function addAdmin(Request $request)
    {
        $restaurant = Restaurant::find($request->restaurant_id);

        if ($restaurant->admin_id === Auth::User()->id) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->restaurant_id = $request->restaurant_id;
            $user->role = "ROLE_SUBAD";
            $user->first_login = 1;
            $user->wp_user_id = Auth::User()->wp_user_id;

            $user->save();

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
                $mail->Subject = "Compte administrateur MonMenu.io";
                $htmlContent = "
                <a href='https://monmenu.io' style='display:block;margin:auto;'>
                    <img src='https://monmenu.io/menus/img/vitrine/logo.png' alt='Logo MonMenu.io' width='100px'
                        height='64px'>
                </a>";
                $htmlContent .= "<h1>Bonjour " .  $user->name . "</h1>";
                $htmlContent .= "<h2>" . Auth::User()->name . " vous a créé une compte administrateur pour gérer son établissement sur MonMenu.io !</h2>";
                $htmlContent .= "<h4>Vos identifiants : </h4>";
                $htmlContent .= "<br>";
                $htmlContent .= "<p>E-mail : " . $user->email . "</p>";
                $htmlContent .= "<p>Mot de passe : " . $request->password . "</p>";
                $htmlContent .= "<br>";
                $htmlContent .= "<p>Pour accéder à <a href='https://monmenu.io/menus/login'>MonMenu.io</a> cliquez sur le lien.</p>";
                $htmlContent .= "<p>Par mesure de sécurité votre mot de passe est provisoire, il sera seulement utilisable lors de votre première connexion, vous pourrez le définir à ce moment.</p>";
                $htmlContent .= "<br>";
                $htmlContent .= "<p>A bientot sur MonMenu.io !</p>";
                $mail->isHTML(true);
                $mail->Body = $htmlContent;
                $mail->AddAddress($user->email);

                $mail->send();
            } catch (Exception $e) {
                return "Erreur lors de l'envoi de l'e-mail : " . $mail->ErrorInfo;
            }
        } else {
            return redirect('admin?task=restaurant&show=base')
                ->with('error', 'Vous n\'etes pas le autorisé à faire cela');
        }

        return redirect('admin?task=new-restaurant')
            ->with('success', 'Votre administrateur à été ajouté avec succès !');
    }

    public function deleteAdmin($admin_id)
    {
        $admin = User::find($admin_id);

        $restaurant = Restaurant::find($admin->restaurant_id);

        if ($restaurant->admin_id === Auth::User()->id) {

            $admin->delete();

            return redirect('admin?task=new-restaurant')
                ->with('success', 'Votre administrateur à été supprimé avec succès !');
        } else {
            return redirect('admin?task=new-restaurant')
                ->with('error', 'Vous n\'etes pas le autorisé à faire cela');
        }
    }

    public function changeSubAdminPassword(Request $request)
    {

        if (!Hash::check($request->old_password, Auth::User()->password)) {
            return redirect()->route('first-login')
                ->with('error', 'L\'ancien mot de passe renseigné ne correspond pas à votre mot de passe ! Vérifié que vous avez saisi le bon mot de passe');
        } else {

            $user = User::find(Auth::User()->id);

            $user->password = Hash::make($request->new_password);
            $user->first_login = 0;

            $user->save();

            return redirect('admin')
                ->with('success', 'Votre mot de passe a été changer avec succès !');
        }
    }

    public function submitSuggestion(Request $request)
    {
        $suggestion = new Suggestion();

        $suggestion->title = $request->title;
        $suggestion->content = $request->content;
        $suggestion->user_id = Auth::User()->id;
        $suggestion->status = "consideration";


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
            $mail->Subject = "Nouvelle suggestion de " . Auth::User()->name;
            $htmlContent = "<h1>Bonjour l'équipe MonMenu !</h1>";
            $htmlContent .= "<br>";
            $htmlContent .= "<h2>" . Auth::User()->name . " a une suggestion à vous faire</h2>";
            $htmlContent .= "<br>";
            $htmlContent .= "<h4>{$suggestion->title}</h4>";
            $htmlContent .= "<br>";
            $htmlContent .= "<p>{$suggestion->content}</p>";
            $mail->isHTML(true);
            $mail->Body = $htmlContent;
            $mail->AddAddress("mehdi.raposo77@gmail.com");
            $mail->AddAddress("cliondor@gmail.com");

            $mail->send();
        } catch (Exception $e) {
            return "Erreur lors de l'envoi de l'e-mail : " . $mail->ErrorInfo;
        }

        $suggestion->save();
        return redirect('admin?task=suggestions')
            ->with('success', 'Votre suggestion à été envoyé avec succès !');
    }

    public function updateSuggesstionStatus(Request $request)
    {
        $suggestion = Suggestion::find($request->id);

        $suggestion->status = $request->status;

        $suggestion->save();

        return redirect('admin-panel#edit-sugg-' . $suggestion->id . '')
            ->with('success', 'Le status de votre suggestion à été modifié avec succès !');
    }

    public function valideCart(Request $request)
    {
        $restau_id = $request->restaurant_id;
        $restaurant = Restaurant::find($restau_id);

        if (!$restaurant->cart) {
            $url = $_SERVER['HTTP_REFERER'];
            return redirect($url);
        }

        $cart = json_decode($request->cart);
        $name = $request->name;
        $phone = $request->phone;
        $livraison = $request->livraison;
        $admin = User::find($restaurant->admin_id);

        $mail = new PHPMailer();

        try {
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->Username = "cliondor@gmail.com";
            $mail->Password = "pelorlrhapedelqd";
            $mail->CharSet = 'UTF-8';
            $mail->SetFrom("cliondor@gmail.com", "MonMenu.io");
            $mail->Subject = "Nouvelle commande de " . $name;
            $htmlContent = "<h1>Bonjour " . $admin->name . "</h1>";
            $htmlContent .= "<br>";
            $htmlContent .= "<h2>" . $name . " a fait une commande dans votre restaurant <strong>" . $restaurant->name . "</strong></h2>";
            $htmlContent .= "<br>";
            $htmlContent .= "<p> Voici son numero de téléphone : " . $phone . "</p>";
            $htmlContent .= "<br>";
            $htmlContent .= "<p> Voici son adresse e-mail : " . $request->email . "</p>";
            $htmlContent .= "<br>";
            $htmlContent .= "<p> Instruction de livraison : " . $livraison . "</p>";
            $htmlContent .= "<table border='1'>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix total</th>
            </tr>";
            foreach ($cart as $item) {
                $total = (int)$item->price * (int)$item->quantity;
                $htmlContent .= "<tr>
                <td>" . $item->productName . "</td>
                <td>" . $item->quantity . "</td>
                <td>" . $item->price . " €</td>
                <td>" . $total . " €</td>
            </tr>";
            }
            $htmlContent .= "</table>";
            $totalCartPrice = 0;
            foreach ($cart as $item) {
                $total = (int)$item->price * (int)$item->quantity;
                $totalCartPrice =  (int)$totalCartPrice + (int)$total;
            }

            $htmlContent .= "<h4> Prix total du panier de " . $name . " : " . $totalCartPrice . "€</h4>";
            $mail->isHTML(true);
            $mail->Body = $htmlContent;
            $mail->addBCC("mehdi.raposo77@gmail.com");
            $mail->addBCC("cliondor@gmail.com");
            $mail->AddAddress($admin->email);

            $mail->send();
        } catch (Exception $e) {
            return "Erreur lors de l'envoi de l'e-mail : " . $e;
        }

        $mail2 = new PHPMailer();

        try {
            $mail2->IsSMTP();
            $mail2->SMTPAuth = true;
            $mail2->SMTPSecure = 'ssl';
            $mail2->Host = 'smtp.gmail.com';
            $mail2->Port = 465;
            $mail2->Username = "cliondor@gmail.com";
            $mail2->Password = "pelorlrhapedelqd";
            $mail2->CharSet = 'UTF-8';
            $mail2->SetFrom("cliondor@gmail.com", "MonMenu.io");
            $mail2->Subject = "Votre commande chez " . $restaurant->name;
            $htmlContent = "<h1>Bonjour " . $name . "</h1>";
            $htmlContent .= "<br>";
            $htmlContent .= "<h2>Votre commande dans le restaurant <strong>" . $restaurant->name . "</strong> a bien été prise en compte</h2>";
            $htmlContent .= "<br>";
            $htmlContent .= "<p> Numéro de téléphone indiqué  : " . $phone . "</p>";
            $htmlContent .= "<br>";
            $htmlContent .= "<p> Instruction de livraison : " . $livraison . "</p>";
            $htmlContent .= "<table border='1'>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix total</th>
            </tr>";
            foreach ($cart as $item) {
                $total = (int)$item->price * (int)$item->quantity;
                $htmlContent .= "<tr>
                <td>" . $item->productName . "</td>
                <td>" . $item->quantity . "</td>
                <td>" . $item->price . " €</td>
                <td>" . $total . " €</td>
            </tr>";
            }
            $htmlContent .= "</table>";
            $totalCartPrice = 0;
            foreach ($cart as $item) {
                $total = (int)$item->price * (int)$item->quantity;
                $totalCartPrice =  (int)$totalCartPrice + (int)$total;
            }

            $htmlContent .= "<h4> Prix total de votre panier chez " . $restaurant->name . " : " . $totalCartPrice . "€</h4>";
            $mail2->isHTML(true);
            $mail2->Body = $htmlContent;
            $mail2->AddAddress($request->email);

            $mail2->send();
        } catch (Exception $e) {
            return "Erreur lors de l'envoi de l'e-mail : " . $e;
        }
        $url = $_SERVER['HTTP_REFERER'];
        return redirect($url)
            ->with('success', 'Votre commande à été envoyé avec succès !');
    }
}

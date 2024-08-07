<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use \Auth;

use \App\Models\Category;
use \App\Models\Restaurant;
use \App\Models\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         // $this->middleware('auth');
    }


    public function welcome()
    {
         if (isset($_GET['id'])) {
             $id = $_GET['id'];
         }else{
            $id = 1 ;
         }

          $restaurant = Restaurant::where('id' , $id)->first();
            return view('welcome' , compact('restaurant'));
    }



private function getParentCategories($category)
{
    $parentCategories = [];
    $this->getParentCategoryRecursive($category, $parentCategories);
    return array_reverse($parentCategories);
}

private function getParentCategoryRecursive($category, &$parentCategories)
{
    if ($category->childs && count($category->childs) > 0) {
        foreach ($category->childs as $childId) {
            $childCategory = Category::where('active', 1)->where('id', $childId)->first();
            if ($childCategory) {
                $parentCategories[] = $childCategory;
                $this->getParentCategoryRecursive($childCategory, $parentCategories);
            }
        }
    }
}





    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id = null, $slug = null)
    {
        if($slug === "logout"){
            Auth::logout();
            return redirect('login');
        }

        $user = Auth::User();

        // catégories  pour la top bar
        $mainCategories = Category::where('is_main' , 1)
            ->where('restaurant_id' , $user->restaurant_id)
            ->get();

        $restaurant = Restaurant::where('id' , $user->restaurant_id)->first();


        // $defaultCategory =  $mainCategories->count() ?  $mainCategories[0] : 1;

$defaultCategory = $mainCategories->count() ? $mainCategories[0] : null;

// Créer une catégorie par défaut si aucune catégorie n'est disponible
    if (!$defaultCategory) {

            $categorie = new Category();
           //  $categorie->id = 1;
            $categorie->name = 'Ma première catégorie';
            $categorie->slug = 'ma-premiere-categorie';
            $categorie->childs = null;
            $categorie->is_main = true;
            $categorie->active = true;
            $categorie->restaurant_id = session('restau_id');
            $categorie->save();

            $defaultCategory = $categorie;

             $mainCategories = Category::where('is_main' , 1)
            ->where('restaurant_id' , $user->restaurant_id)
            ->get();

            $currentCategory = Category::where('active' , 1)->where('id' , 1)->first();



            $categories = [];
            $parentCategories = [];
            $products = [];

             return view('home' , compact(
                'mainCategories',
                'categories',
                'parentCategories',
                'currentCategory',
                'products',
                'restaurant',
            ));


    }




        // Choisir un catégorie par défaut si vide
        $currentCategoryId = $id ? $id : $defaultCategory->id;

        $currentCategory = Category::where('active' , 1)->where('id' , $currentCategoryId)->first();
          $parentCategories = $this->getParentCategories($currentCategory);


        if($id && $currentCategory->slug != $slug)
            return redirect('/');

        if($currentCategory && $currentCategory->childs){

            $categories = [];

            foreach ($currentCategory->childs as $key) {
                $categories[$key] = Category::find($key);
            }

            $currentCategory->load('products');
            $products =  $currentCategory->products()->get();

            return view('home' , compact(
                'mainCategories',
                'categories',
                'parentCategories',
                'currentCategory',
                'products',
                'restaurant'
            ));
        }
        else{

            $currentCategory->load('products');
            $products =  $currentCategory->products()->get();

            return view('home' , compact(
                'mainCategories',
                'currentCategory',
                'parentCategories',
                'products',
                'restaurant',
            ));
        }
    }




      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexnocrud($id_resto = null, $id_cat = null, $slug = null)
    {


        // catégories  pour la top bar
        $mainCategories = Category::where('is_main' , 1)
            ->where('restaurant_id' , $id_resto)
            ->get();

        $restaurant = Restaurant::where('id' , $id_resto)->first();

        $defaultCategory = $mainCategories->count() ? $mainCategories[0] : null;

        // Choisir un catégorie par défaut si vide
        $currentCategoryId = $id_cat;

        $currentCategory = Category::where('active' , 1)->where('id' , $currentCategoryId)->first();

       // dd($currentCategory);


        if($id_resto && $currentCategory->slug != $slug)
           return redirect('/');

        if($currentCategory && $currentCategory->childs){

            $categories = [];

            foreach ($currentCategory->childs as $key) {
                $categories[$key] = Category::find($key);
            }

            $currentCategory->load('products');
            $products =  $currentCategory->products()->get();

            return view('dashboard/products' , compact(
                'mainCategories',
                'categories',
                'currentCategory',
                'products',
                'restaurant'
            ));
        }
        else{

            $currentCategory->load('products');
            $products =  $currentCategory->products()->get();

            return view('dashboard/products' , compact(
                'mainCategories',
                'currentCategory',
                'products',
                'restaurant',
            ));
        }
    }

    public function buildBreadcrumb($slug){

        $path =  explode('/', $slug);

    }

}

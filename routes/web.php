<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DesignController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\BaseController::class, 'vitrine'])->name('vitrine');

Route::get('/first-login', function () {
    return view('first-login');
})->name('first-login');

Auth::routes();


// Route::get('/admin', [App\Http\Controllers\BaseController::class, 'adminDashboard'])->name('admin');

Route::get('/logout', [App\Http\Controllers\BaseController::class, 'logout'])->name('logout');

Route::get('/admin-panel', [App\Http\Controllers\BaseController::class, 'adminPanel'])->name('admin-panel');

Route::get('/wp_infos/{wp_id}/{wp_email}/{token}', [App\Http\Controllers\RestaurantController::class, 'getWpInfos'])->name('route');

Route::post('/valideCart', [App\Http\Controllers\RestaurantController::class, 'valideCart'])->name('valideCart');

// Route::get(
//     '/restaurant-{restaurant_id}',
//     [App\Http\Controllers\RestaurantController::class, 'getOneRestaurant']
// )->name('restaurant');

/*
Route::get('/{restaurant_name}/{restaurant_id}', [App\Http\Controllers\RestaurantController::class, 'getOneRestaurant'])->where([
    'restaurant_name' => '[a-z-]+',
    'restaurant_id' => '[0-9]+',
])->name('restaurantByName');
*/

Route::get('/{restaurant_name}/{restaurant_id}', [App\Http\Controllers\RestaurantController::class, 'getOneRestaurant'])->where([
    'restaurant_name' => '[a-z-]+',
    'restaurant_id' => '[0-9]+',
])->name('restaurantByName');




Route::get('/{restaurant_name}/{restaurant_id}/categories-{category_id}', [App\Http\Controllers\RestaurantController::class, 'getRestaurantProductsWithCategories'])->name('restaurant-products');

Route::post('/restaurant-{restaurant_id}/avis', [App\Http\Controllers\RestaurantController::class, 'giveOpinions'])->name('restaurant-opinion');

// Route::get('/choose', [App\Http\Controllers\BaseController::class, 'chooseRestaurant'])->name('choose');

Route::post('/newRestau', [App\Http\Controllers\RestaurantController::class, 'createNewRestaurant'])->name('newRestau');

Route::post('/addAdmin', [App\Http\Controllers\RestaurantController::class, 'addAdmin'])->name('addAdmin');

Route::delete('/deleteAdmin/{admin_id}', [App\Http\Controllers\RestaurantController::class, 'deleteAdmin'])->name('deleteAdmin');

Route::post('/changeSubAdminPassword', [App\Http\Controllers\RestaurantController::class, 'changeSubAdminPassword'])->name('changeSubAdminPassword');

Route::post('/submitSuggestion', [App\Http\Controllers\RestaurantController::class, 'submitSuggestion'])->name('submitSuggestion');

Route::put('/updateSuggesstionStatus/{id}', [App\Http\Controllers\RestaurantController::class, 'updateSuggesstionStatus'])->name('updateSuggesstionStatus');

Route::delete('/delete-restaurant/{id}', [App\Http\Controllers\RestaurantController::class, 'deleteRestaurant'])->name('deleteRestaurant');

Route::get('/admin', [App\Http\Controllers\BaseController::class, 'dashboardRestau'])->name('single');

Route::get('/admin?task=stats', [App\Http\Controllers\BaseController::class, 'dashboardRestau'])->name('stats');

Route::get('/crownMail', [App\Http\Controllers\BaseController::class, 'crownMail'])->name('crownMail');

Route::get('/admin-restaurant', [App\Http\Controllers\HomeController::class, 'indexnocrud'])->where([
    'id_resto' => '[0-9]+',
    'id_cat' => '[0-9-]+',
    'slug' => '[a-z-]+',
])->name('singlecat');


Route::controller(CategorieController::class)->group(function () {
    // Route::get('/orders/{id}', 'show');
    Route::post('/addcat', 'store')->name('createcat');
    Route::put('/updatecat/{id}', 'update')->name('updatecat');
    Route::delete('/deletecat/{id}', 'delete')->name('deletecat');
    Route::get('/most-viewed-cats', 'mostViewedCats')->name('mostViewedCats');
    Route::patch('/categories/update-order', 'updateOrder')->name('categories.update-order');
});

Route::controller(RestaurantController::class)->group(function () {
    Route::put('/update/{id}', 'update')->name('updateInfos');
});


Route::controller(DesignController::class)->group(function () {
    Route::put('/updateDesign/{id}', 'update')->name('updateDesign');
});







Route::controller(ProductController::class)->group(function () {
    Route::post('/addprod', 'store')->name('createprod');
    Route::put('/updateprod/{id}', 'update')->name('updateprod');
    Route::delete('/deleteprod/{id}', 'delete')->name('deleteprod');
    Route::post('/add-view/{productId}', 'addOneView')->name('addOneView');
    Route::get('/most-viewed-products', 'mostViewedProducts')->name('mostViewedProducts');
    Route::delete('/delete-product-image/{id}', 'deleteProductImage')->name('deleteprodimage');
    Route::post('/add-variant', 'addVariant')->name('addVariant');
    Route::put('/update-variant/{id}', 'updateVariant')->name('updateVariant');
    Route::delete('/delete-variant/{id}', 'deleteVariant')->name('deleteVariant');

    Route::patch('/products/update-order', 'updateOrder')->name('products.update-order');
});

Route::controller(ProductController::class)->group(function () {
    Route::post('/updateresto', 'store')->name('updateresto');
    Route::get('/p/{id}/{resto_id}/product', 'showOne')->name('showOne');

    //    Route::get('/{id}/{resto_id}/product', 'showOne')->name('showOne');

    /*

Route::get('/{id}/{resto_id}/product', function () {

   //  echo "test";

     return view('product');

    // Route::get('/{id}/{resto_id}/product', 'showOne')->name('showOne');


    // die('ok 138');

})->name('showOne');

*/

    // /{restaurant_name}/{restaurant_id}/categories-{category_id}
    // Route::get('/product/{id}/{resto_id}/', 'showOne')->name('showOne');
    //  Route::get('{restaurant_name}/{resto_id}/product-{id}/p/', 'showOne')->name('showOne');
});



// Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');


/*
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
*/


#Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

# Route::get('/mon-espace', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

# Route::get('/restaurant/{restaurant_slug}', [App\Http\Controllers\BaseController::class, 'logRestaurant'])->name('restau');


# Route::get('/restaurant-{restaurant_id}', [App\Http\Controllers\BaseController::class, 'single'])->name('single');


# Route::get('/r/{restaurant_id}', [App\Http\Controllers\BaseController::class, 'single'])->name('single');


# Route::get('/infos/{id}', [App\Http\Controllers\RestaurantController::class, 'showinfos'])->name('showinfos');


/*

Route::get('/{restaurant_id}/', [App\Http\Controllers\BaseController::class, 'RestaurantHome'])->name('restohome');

Route::get('/home/{id}-{slug}', [App\Http\Controllers\HomeController::class, 'index'])->where(['id' => '[0-9]+', 'slug' => '[a-z-]+'])->name('cat');

*/

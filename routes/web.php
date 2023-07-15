<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Back\CrudBuilderController;
use App\Http\Controllers\Back\ApiBuilderController;

use App\Http\Controllers\front\FrontLandingController;


use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\Back\News\NewsController;
use App\Http\Controllers\Back\News\NewsCategoryController;

use App\Http\Controllers\Research\RecomenderController;
use App\Http\Controllers\Research\CertaintyFactorController;
use App\Http\Controllers\Research\CbrController;
use App\Http\Controllers\back\Tbl_transaksi\Tbl_transaksiController;


use App\Http\Controllers\Back\Setting_web\Setting_webController;

use App\Http\Controllers\back\Tbl_product\Tbl_productController;

use App\Http\Controllers\Back\Setting_menu\Setting_menuController;
use App\Http\Controllers\Back\Permissions\PermissionsController;

use App\Http\Controllers\back\Tbl_frame_category\Tbl_frame_categoryController;
use App\Http\Controllers\front\FrontCartController;
use App\Models\Tbl_product;
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

use Illuminate\Support\Facades\DB;

$res_setting_route = DB::select('select * from setting_route where deleted = "false"');
//dd($res_setting_route[0]->route_name);
for ($r = 0; $r < count($res_setting_route); $r++) {
    Route::resource($res_setting_route[$r]->route_name, $res_setting_route[$r]->controller_name);
}

$dataresource = array(
    ["setting_menu", "Setting_menuController::class"],
    ["permissions", "PermissionsController::class"],
    ["setting_web", "Setting_webController::class"]
);

Route::resource('setting_menu', Setting_menuController::class);
Route::resource('permissions', dPermissionsController::class);
// Route::resource($dataresource[2][0], Setting_webController::class);
//Route::resource($res_setting_route[0]->route_name, 'App\Http\Controllers\Back\Setting_web\Setting_webController');


// Route::get('/', function () {
//     return view('front.index');
// });

Route::get('/login', function () {
    return view('front.login');
});

Route::get('/', [FrontLandingController::class, 'index'])->name('frontlanding');

Route::get('/products', [Tbl_product::class, 'product_list'])->name('products');

##cart

Route::post('/products/cart/add', [FrontCartController::class, 'add_cart'])->name('add_cart');
Route::get('/products/cart/view', [FrontCartController::class, 'view_cart'])->name('view_cart');
Route::post('/products/cart/update', [FrontCartController::class, 'update_cart'])->name('update-cart');
Route::get('/products/cart/{id}/remove', [FrontCartController::class, 'remove_item'])->name('remove-item');
Route::get('/products/cart/clear', [FrontCartController::class, 'clear_item'])->name('clear-item');


Route::get('/crud', [CrudBuilderController::class, 'index'])->name('crud.index');
Route::post('/crud', [CrudBuilderController::class, 'index'])->name('crud.index');

Route::get('/apibuilder', [ApiBuilderController::class, 'index'])->name('apibuilder.index');
Route::post('/apibuilder', [ApiBuilderController::class, 'index'])->name('apibuilder.index');

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::resource('r1', RecomenderController::class);
Route::resource('r2', CertaintyFactorController::class);
Route::resource('r3', CbrController::class);


Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('news-category', NewsCategoryController::class);
    Route::resource('news', NewsController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/crud', [CrudBuilderController::class, 'index'])->name('crud.index');
    Route::post('/crud', [CrudBuilderController::class, 'index'])->name('crud.index');

    Route::resource("tbl_frame_category", Tbl_frame_categoryController::class);
    Route::resource("tbl_product", Tbl_productController::class);
    Route::resource("tbl_transaksi", Tbl_transaksiController::class);




    Route::get('/apibuilder', [ApiBuilderController::class, 'index'])->name('apibuilder.index');
    Route::post('/apibuilder', [ApiBuilderController::class, 'index'])->name('apibuilder.index');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

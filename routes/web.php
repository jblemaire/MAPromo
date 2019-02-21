<?php
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

Route::get('/', function () {
    return view('home',[
        'title' => 'Accueil',
        'types' => App\Type::get()
    ]);
});

Auth::routes();

Route::post('/city_search', 'HomeController@postCitiesSearch')->name('cities_search_post');
Route::post('/stores_search', 'HomeController@postStoresSearch')->name('stores_search_post');
Route::post('/categories_search', 'HomeController@postCategoriesSearch')->name('categories_search_post');

Route::get('/login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('/login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/register/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('/register/facebook/callback', 'Auth\RegisterController@handleProviderCallback');


/**Admin Part**/
Route::get('admin/', function () {
    return view('admin.admin', [
        'title' => 'Espace Admin',
    ]);
})->name('admin')->middleware('auth');
Route::get('admin/users_list', 'Admin\AdminController@getUsersList')->name('users_list')->middleware('auth');
Route::get('admin/magasins_list', 'Admin\AdminController@getMagasinsList')->name('magasins_list')->middleware('auth');
Route::get('admin/types_list', 'Admin\AdminController@getTypesList')->name('types_list')->middleware('auth');
Route::get('admin/categories_list', 'Admin\AdminController@getCategoriesList')->name('categories_list')->middleware('auth');
Route::get('admin/promotions_list', 'Admin\AdminController@getPromotionsList')->name('promotions_list')->middleware('auth');
Route::get('admin/adhesions_list', 'Admin\AdminController@getAdhesionsList')->name('adhesions_list')->middleware('auth');





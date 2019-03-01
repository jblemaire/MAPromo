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

/**Appel Ajax**/
Route::post('/city_search', 'HomeController@postCitiesSearch')->name('cities_search_post');
Route::post('/stores_search', 'HomeController@postStoresSearch')->name('stores_search_post');
Route::post('/categories_search', 'HomeController@postCategoriesSearch')->name('categories_search_post');
Route::post('admin/types_list/addType', 'Admin\AdminController@postTypes')->name('add_type')->middleware('admin');
Route::post('admin/categories_list/addCategorie', 'Admin\AdminController@postCategories')->name('add_categorie')->middleware('admin');
Route::post('admin/delete_com', 'Admin\AdminController@postDeleteCom')->name('delete_com')->middleware('admin');
Route::post('magasins/city_search_by_cp', 'ResponsableController@postCitiesSearchByCP')->name('cities_search_by_cp_post')->middleware('responsable');


/**Facebook Connect**/
Route::get('/login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('/login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/register/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('/register/facebook/callback', 'Auth\RegisterController@handleProviderCallback');

/**Responsable Part**/
Route::get('magasins/', 'ResponsableController@returnView')->name('magasins')->middleware('responsable');
Route::post('magasins/addStore', 'ResponsableController@postStores')->name('add_magasin')->middleware('responsable');
Route::get('magasins/update/{idMagasin}', 'ResponsableController@getUpdateStores')->name('update_magasin')->middleware('responsable');
Route::get('magasins/update', 'ResponsableController@postUpdateStores')->name('update_magasin_post')->middleware('responsable');



/**Admin Part**/
Route::get('admin/', function () {
    return view('admin.admin', [
        'title' => 'Espace Admin',
    ]);
})->name('admin')->middleware('admin');
Route::get('admin/users_list/{idUser?}', 'Admin\AdminController@getUsersList')->name('users_list')->middleware('admin');
Route::get('admin/magasins_list/{idMagasin?}', 'Admin\AdminController@getMagasinsList')->name('magasins_list')->middleware('admin');
Route::get('admin/magasins_list/user/{idUser?}', 'Admin\AdminController@getMagasinsListByUser')->name('magasins_list_user')->middleware('admin');
Route::get('admin/types_list', 'Admin\AdminController@getTypesList')->name('types_list')->middleware('admin');
Route::get('admin/categories_list/{idType?}', 'Admin\AdminController@getCategoriesList')->name('categories_list')->middleware('admin');
Route::get('admin/promotions_list', 'Admin\AdminController@getPromotionsList')->name('promotions_list')->middleware('admin');
Route::get('admin/promotions_list/magasin/{idMagasin?}', 'Admin\AdminController@getPromotionsListByMagasin')->name('promotions_list_magasin')->middleware('admin');
Route::get('admin/adhesions_list/promo/{idPromo?}', 'Admin\AdminController@getAdhesionsListByPromo')->name('adhesions_list_promo')->middleware('admin');
Route::get('admin/adhesions_list/user/{idUser?}', 'Admin\AdminController@getAdhesionsListByUser')->name('adhesions_list_user')->middleware('admin');



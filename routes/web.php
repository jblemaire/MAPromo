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
        'types' => App\Type::get(),
        'lastPromos' => App\Promotion::join('magasins', 'magasins.idMagasin', '=', 'promotions.idMagasin')->orderBY('promotions.created_at', 'DESC')->limit(10)->get(),
        'lastComms' => \Illuminate\Support\Facades\DB::table('adhesions')->join('promotions', 'adhesions.Promotion_idPromo', '=', 'promotions.idPromo')->join('users', 'adhesions.Internaute_idInternaute', '=', 'users.idUser')->where('commentaireAdhesion',"<>", "NULL")->orderBY('adhesions.updated_at', 'DESC')->limit(10)->get()
    ]);
})->name('home');

Route::get('/apropos', function () {
    return view('apropos',[
        'title' => 'À propos',
        'types' => App\Type::get()
    ]);
})->name('apropos');

Route::get('/compte_menu', function () {
    return view('compte',[
        'title' => 'Compte',
        'types' => App\Type::get()
    ]);
})->name('compte_menu');

Route::get('/contact', function () {
    return view('contact',[
        'title' => 'Contact',
        'types' => App\Type::get()
    ]);
})->name('contact');
Route::get('/cgu', function (){
    return view('cgu', [
        'title' => 'Condition Générales d\'Utilisation'
    ]);
})->name('cgu');
Route::get('/mentions_legales', function (){
    return view('mentionslegales', [
        'title' => 'Mentions Légales'
    ]);
})->name('mentionslegales');

Auth::routes();

/**Appel Ajax**/
Route::post('/city_search', 'HomeController@postCitiesSearch')->name('cities_search_post');
Route::post('/stores_search', 'HomeController@postStoresSearch')->name('stores_search_post');
Route::post('/categories_search', 'HomeController@postCategoriesSearch')->name('categories_search_post');
Route::post('admin/types_list/addType', 'Admin\AdminController@postTypes')->name('add_type')->middleware('admin');
Route::post('admin/categories_list/addCategorie', 'Admin\AdminController@postCategories')->name('add_categorie')->middleware('admin');
Route::post('admin/delete_com', 'Admin\AdminController@postDeleteCom')->name('delete_com')->middleware('admin');
Route::post('magasins/city_search_by_cp', 'Responsable\MagasinController@postCitiesSearchByCP')->name('cities_search_by_cp_post')->middleware('responsable');
Route::post('promotions/update_etat', 'Responsable\PromotionController@updateEtat')->name('update_etat_promotion')->middleware('responsable');
Route::post('/search_promos', 'HomeController@postPromosSearch')->name('promos_search_post');
Route::post('/add_adhesion', 'Client\ClientController@postAdhesion')->name('post_adhesion')->middleware('client');

/**Facebook Connect**/
Route::get('/login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('/login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/register/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('/register/facebook/callback', 'Auth\RegisterController@handleProviderCallback');

/**Client Part**/
Route::get('mes_promotions/', 'Client\ClientController@returnView')->name('mes_promotions')->middleware('client');
Route::get('details_promotion/{idPromo}', 'Client\ClientController@getPromo')->name('details_promo');
Route::post('details_promotion/{idPromo}/add_comment', 'Client\ClientController@postComment')->name('post_comment')->middleware('client');
Route::get('liste_promo/', 'Client\ClientController@getListPromo')->name('post_liste');

Route::get('compte/', 'Client\ClientController@myAccount')->name('compte')->middleware('auth');
Route::get('compte/editpassword', 'Client\ClientController@editpassword')->name('editpassword')->middleware('auth');
Route::post('compte/updatepassword', 'Client\ClientController@updatepassword')->name('updatepassword')->middleware('auth');
Route::get('compte/editinfos', 'Client\ClientController@editinfos')->name('editinfos')->middleware('auth');
Route::post('compte/updateinfos', 'Client\ClientController@updateinfos')->name('updateinfos')->middleware('auth');


/**Responsable Part**/
Route::get('magasins/', 'Responsable\MagasinController@returnView')->name('magasins')->middleware('responsable');
Route::post('magasins/addStore', 'Responsable\MagasinController@postStores')->name('add_magasin')->middleware('responsable');
Route::get('magasins/update/{idMagasin}', 'Responsable\MagasinController@getUpdateStores')->name('update_magasin')->middleware('responsable');
Route::post('magasins/updateStore', 'Responsable\MagasinController@postUpdateStores')->name('update_magasin_post')->middleware('responsable');
Route::get('magasins/deleteStore/{idMagasin}', 'Responsable\MagasinController@getDeleteStores')->name('delete_magasin')->middleware('responsable');

Route::get('promotions/magasins/{idMagasin?}', 'Responsable\PromotionController@returnView')->name('promotions')->middleware('responsable');
Route::post('promotions/', 'Responsable\PromotionController@getPromosFromStore')->name('promotion_magasins')->middleware('responsable');
Route::post('promotions/addPromo', 'Responsable\PromotionController@postPromo')->name('add_promo')->middleware('responsable');




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



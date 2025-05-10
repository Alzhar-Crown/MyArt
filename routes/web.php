<?php

use App\Http\Controllers\ControllerAdmin;
use App\Http\Controllers\ControllerCatalog;
use App\Http\Controllers\ControllerPortofolio;
use App\Http\Controllers\ControllerProfil;
use App\Http\Controllers\ControllerSearch;
use App\Http\Controllers\ControllerUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



// web.php

Route::get('/Login', function () {
    return view('formLogn');
});

Route::get('/myprofil', function () {
    return view('profil');});

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::get('/searchProfil', [ControllerSearch::class, 'ClearProfil'])->name('searchProfil');
Route::get('/searchCatalog', [ControllerSearch::class, 'ClearCatalog'])->name('searchCatalog');


Route::get('/', [ControllerUser::class, 'awal'])->name('awal');

Route::get('/admin', function () {

    return view('admin.login');
});
Route::post('/search', [ControllerSearch::class, 'search'])->name('search');


Route::get('/atmin', [ControllerAdmin::class, 'showLoginForm'])->name('admin.fl');
Route::post('/login', [ControllerAdmin::class, 'login'])->name('admin.login');
Route::get('/logout', [ControllerAdmin::class, 'logOut'])->name('admin.logout');
Route::get('/Ip', [ControllerAdmin::class, 'indexProfil'])->name('index.profil');
Route::get('/Ipor', [ControllerAdmin::class, 'indexPortofolio'])->name('index.porto');
Route::get('/Ic', [ControllerAdmin::class, 'indexCatalog'])->name('index.catalog');
Route::delete('/Dp/{id}', [ControllerAdmin::class, 'destroyProfil'])->name('destroy.profil');
Route::delete('/Dpr/{id}', [ControllerAdmin::class, 'destroyPorto'])->name('destroy.porto');
Route::delete('/Dcl/{id}', [ControllerAdmin::class, 'destroyCatal'])->name('destroy.catalog');
Route::resource('admin', ControllerAdmin::class);


Route::get('/user/clear', [ControllerUser::class, 'clearAllSession'])->name('user.clearSession');
Route::resource('user', ControllerUser::class);
Route::get('/success1', [ControllerUser::class, 'success1'])->name('user.success1');
Route::get('/Re-Acnt', [ControllerUser::class, 'editFirst'])->name('user.reacnt');
Route::post('/Autentikasi', [ControllerUser::class, 'autentikasi'])->name('user.auth');
Route::get('/showlogin', [ControllerUser::class, 'showlogin'])->name('user.login');
Route::post('/logout', [ControllerUser::class, 'logout'])->name('user.logout');
// Route::get('/clear-session/{key}', function ($key) {
//     session()->forget($key);  
//     return view('awal'); // Redirect ke halaman sebelumnya
// })->name('clear.session');



Route::resource('profil', ControllerProfil::class);
Route::get('/pf-1', function () {
    return view('p1');
});

Route::get('/myProfil', [ControllerProfil::class, 'myProfil'])->name('myprofil');
Route::get('/clear', [ControllerProfil::class, 'ClearSession'])->name('clear');


Route::get('/portoshow', [ControllerPortofolio::class, 'index'])->name('porto.index');
Route::post('/porto+', [ControllerPortofolio::class, 'store'])->name('store.porto');
Route::resource('portofolios', ControllerPortofolio::class);
Route::get('/clearProfil', [ControllerPortofolio::class, 'ClearProfil'])->name('clearProfil');


Route::post('/catal+', [ControllerCatalog::class, 'store'])->name('store.catal');
Route::resource('catalog', ControllerCatalog::class);
Route::get('/clearCatalog', [ControllerCatalog::class, 'ClearCatalog'])->name('clearCatalog');

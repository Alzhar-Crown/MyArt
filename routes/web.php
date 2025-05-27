<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ControllerAdmin;
use App\Http\Controllers\ControllerCart;
use App\Http\Controllers\ControllerCatalog;
use App\Http\Controllers\ControllerComment;
use App\Http\Controllers\ControllerHome;
use App\Http\Controllers\ControllerInteraksi;
use App\Http\Controllers\ControllerOrdered;
use App\Http\Controllers\ControllerPayment;
use App\Http\Controllers\ControllerPortofolio;
use App\Http\Controllers\ControllerProfil;
use App\Http\Controllers\ControllerSearch;
use App\Http\Controllers\ControllerThread;
use App\Http\Controllers\ControllerUser;
use App\Http\Controllers\ControllerWallet;
use Illuminate\Support\Facades\Route;
use App\Livewire\ShowThread;



use Pusher\Pusher;

Route::get('/test-pusher', function () {
    $pusher = new Pusher('key', 'secret', 'app_id', ['cluster' => 'ap1']);
    return 'Pusher instance created';
});

// web.php

Route::get('/Login', function () {
    return view('formLogn');
});

Route::get('/myprofil', function () {
    return view('profil');
});
Route::get('/profilshow/{id}', [ControllerProfil::class, 'showitem'])->name('shower');
Route::get('/portows/{id}', [ControllerProfil::class, 'portows'])->name('porsow');


// Route::get('/home', function () {
//     return view('home');
// })->middleware('auth');

Route::resource('home', ControllerHome::class)->middleware('auth');


Route::get('/detailp', [ControllerPayment::class, 'detailp'])->name('detailPayment');
Route::post('/payment', [ControllerPayment::class, 'payment'])->name('payment');
Route::get('/notification', [ControllerPayment::class, 'notification'])->name('notification');

Route::get('/searchProfil', [ControllerSearch::class, 'ClearProfil'])->name('searchProfil');
Route::get('/searchCatalog', [ControllerSearch::class, 'ClearCatalog'])->name('searchCatalog');
Route::get('/shows/{id}', [ControllerSearch::class, 'shows'])->name('shows');
Route::get('/showing/{id}', [ControllerSearch::class, 'showitem'])->name('showing');
Route::get('/showpor/{id}', [ControllerSearch::class, 'portows'])->name('porsp');



// Route::get('/', function () {
//     return 'Laravel jalan!';
// });
Route::get('/', [ControllerUser::class, 'awal'])->name('awal');

Route::get('/admin', function () {

    return view('admin.login');
});
Route::post('/search', [ControllerSearch::class, 'search'])->name('search');


Route::get('/atmin', [ControllerAdmin::class, 'showLoginForm'])->name('admin.fl');
Route::post('/login', [ControllerAdmin::class, 'login'])->name('admin.login');
Route::get('/indexx', [ControllerAdmin::class, 'index'])->name('admin.index');
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
Route::post('/sporto/{kategori}', [ControllerPortofolio::class, 'sporto'])->name('Sporto');
    


Route::post('/catal+', [ControllerCatalog::class, 'store'])->name('store.catal');
Route::get('/selling', [ControllerCatalog::class, 'selling'])->name('selling');
Route::get('/catalshow', [ControllerCatalog::class, 'index'])->name('catal.index');
Route::resource('catalog', ControllerCatalog::class);
Route::get('/clearCatalog', [ControllerCatalog::class, 'ClearCatalog'])->name('clearCatalog');
Route::post('/scatal/{kategori}', [ControllerCatalog::class, 'scatal'])->name('scatal');
Route::get('/scatalndex', [ControllerCatalog::class, 'scatalndex'])->name('scatalndex');

Route::resource('wallet', ControllerWallet::class);

Route::resource('cart', ControllerCart::class);
Route::post('/cart+', [ControllerCart::class, 'store'])->name('store.cart');
Route::post('/co', [ControllerCart::class, 'checkout'])->name('cart.co');
Route::get('/co1/{co1}', [ControllerCart::class, 'checkoutOne'])->name('cart.co1');
Route::post('/buy', [ControllerCart::class, 'buy'])->name('cart.buy');

Route::resource('ordered', ControllerOrdered::class);
Route::post('/download/{download}', [ControllerOrdered::class, 'download'])->name('download');

route::resource('interaction',ControllerInteraksi::class);
route::resource('forum',ControllerThread::class);
route::resource('chat',ControllerComment::class);
Route::post('/love/{love}', [ControllerInteraksi::class, 'love'])->name('love');
Route::post('/addMember/{thread}', [ControllerThread::class, 'joinForum'])->name('join');

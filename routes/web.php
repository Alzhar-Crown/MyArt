<?php

use App\Http\Controllers\ControllerAdmin;
use App\Http\Controllers\ControllerProfil;
use App\Http\Controllers\ControllerUser;
use Illuminate\Support\Facades\Route;



// web.php

Route::get('/Login', function () {
    return view('formLogn');
});
Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::get('/', [ControllerUser::class, 'awal'])->name('awal');

Route::get('/admin', function () {
    return view('admin.login');
});

Route::get('/atmin', [ControllerAdmin::class, 'showLoginForm'])->name('admin.fl');
Route::post('/login', [ControllerAdmin::class, 'login'])->name('admin.login');
Route::get('/logout', [ControllerAdmin::class, 'logOut'])->name('admin.logout');
Route::get('/Ip', [ControllerAdmin::class, 'indexProfil'])->name('index.profil');
Route::get('/Dp', [ControllerAdmin::class, 'destroyProfil'])->name('destroy.profil');
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
      
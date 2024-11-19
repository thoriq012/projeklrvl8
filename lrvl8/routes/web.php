<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Models\Employee;

Route::get('/', function () {
    $jumlahpegawai = Employee::count();
    $jumlahpegawaipria = Employee::where('jeniskelamin','pria')->count();
    $jumlahpegawaiwanita = Employee::where('jeniskelamin','wanita')->count();

    return view('welcome',compact('jumlahpegawai','jumlahpegawaipria','jumlahpegawaiwanita'));
})->middleware('auth');

Route::group(['middleware' => ['auth','HakAkses:admin']], function(){
    Route::get('/pegawai',[EmployeeController::class, 'index'])->name('pegawai');
});



Route::get('/tambahpegawai',[EmployeeController::class, 'tambahpegawai'])->name('tambahpegawai');

Route::post('/insertdata',[EmployeeController::class, 'insertdata'])->name('insertdata');

Route::get('/tampilkandata/{id}',[EmployeeController::class, 'tampilkandata'])->name('tampilkandata');

Route::post('/updatedata/{id}',[EmployeeController::class, 'updatedata'])->name('updatedata');

Route::get('/delete/{id}',[EmployeeController::class, 'delete'])->name('delete');

Route::get('/login',[LoginController::class, 'login'])->name('login');
Route::post('/loginproses',[LoginController::class, 'loginproses'])->name('loginproses');

Route::get('/register',[LoginController::class, 'register'])->name('register');
Route::post('/registeruser',[LoginController::class, 'registeruser'])->name('registeruser');

Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
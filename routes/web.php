
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;

// welcome route
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

//route to HomeController
// Route::get('profile', 'App\Http\Controllers\HomeController@showprofile');
Route::get('profile', [HomeController::class, 'showprofile']);
Route::get('home', [HomeController::class, 'home'])->name('home');
Route::get('about',[HomeController::class, 'about'])->name('about');
Route::get('contact',[HomeController::class ,'contact'])->name('contact');

//EmployeeController
Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');

//EmployeeController with Eloquent ORM
Route::get('employeelist', [EmployeeController::class, 'employeelist'])->name('employees.employeelist');

//Employee create route
Route::get('employees_create', [EmployeeController::class, 'create'])->name('employees.create');

//Employee store route
Route::post('employees_store', [EmployeeController::class, 'store'])->name('employees.store');

// AuthController routes show register and login
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::get('login', [AuthController::class, 'showLogin'])->name('login');

//submit register route
Route::post('register', [AuthController::class, 'register'])->name('register');

//login submit route 
Route::post('login', [AuthController::class, 'login'])->name('login');



//--------------------------------------------------------------------------
// Protected routes (only for authenticated users) where middleware 'auth' is applied
Route::middleware('auth')->group(function () {

//dashboard route
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

// stock route
Route::get('stock', [AuthController::class, 'stock'])->name('stock');

// order route
Route::get('order', [AuthController::class, 'order'])->name('order');

// report route
Route::get('report', [AuthController::class, 'report'])->name('report');

// profile route
Route::get('profile', [AuthController::class, 'profile'])->name('profile'); 

// setting route
Route::get('setting', [AuthController::class, 'setting'])->name('setting');

// logout route
Route::post('logout', [AuthController::class, 'logout'])->name('logout');  

});


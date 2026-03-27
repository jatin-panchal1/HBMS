<?php
use App\Http\Controllers\WebPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebPageController::class , 'landing'])->name('webpage.view');
Route::get('page/{name}', [WebPageController::class , 'viewPage'])->name('webpage.dynamic');

// Authorization Routes
Route::post('login',[AuthController::class , 'authenticate'])->name('login.authenticate');
Route::get('login',[AuthController::class , 'login'])->name('login');
Route::get('signup',[AuthController::class , 'signup'])->name('signup');
Route::post('signup',[AuthController::class , 'createUser'])->name('signup.create');
Route::get('logout', [UserController::class , 'logout'])->name('logout');

// authenticated routes for user and admin

Route::middleware(['auth'])->group(function (){
    // dashboard for admin
    Route::get('admin/dashboard' , [UserController::class , 'adminDashboard'])->name('dashboard.admin');
    // dashboard for user
    Route::get('user/dashboard' , [UserController::class , 'userDashboard'])->name('dashboard.user');
    // Routes for booking related actions
    Route::get('booking/all' , [BookingController::class , 'index'])->name('booking.all');
    Route::get('booking/my' , [BookingController::class , 'userBookings'])->name('booking.my');
    Route::get('booking/add' , [BookingController::class , 'add'])->name('booking.add');
    Route::post('booking/save' , [BookingController::class , 'save'])->name('booking.save');
    Route::get('booking/{id}' , [BookingController::class , 'getBookingsbyId'])->name('booking.edit');
    Route::post('booking/{id}' , [BookingController::class , 'viewDelete'])->name('booking.view.delete');
    Route::get('booking/delete/{id}' , [BookingController::class , 'updateBookingsbyId'])->name('booking.update');
    Route::post('booking/delete/{id}' , [BookingController::class , 'Delete'])->name('booking.delete');

    // Webpage related routes

    
    Route::get('WebPage/my' , [WebPageController::class , 'index'])->name('WebPage.my');
    Route::post('WebPage/add' , [WebPageController::class , 'add'])->name('WebPage.add');
    Route::post('WebPage/save' , [WebPageController::class , 'save'])->name('WebPage.save');
    Route::get('WebPage/{id}' , [WebPageController::class , 'edit'])->name('WebPage.edit');
    Route::post('WebPage/{id}' , [WebPageController::class , 'viewDelete'])->name('WebPage.view.delete');
    Route::get('WebPage/delete/{id}' , [WebPageController::class , 'update'])->name('WebPage.update');
    Route::post('WebPage/delete/{id}' , [WebPageController::class , 'Delete'])->name('WebPage.delete');

    // User related routes 

    Route::get('User' , [UserController::class , 'index'])->name('User.my');
    Route::post('User/add' , [UserController::class , 'add'])->name('User.add');
    Route::post('User/save' , [UserController::class , 'save'])->name('User.save');
    Route::get('User/{id}' , [UserController::class , 'edit'])->name('User.edit');
    Route::post('User/{id}' , [UserController::class , 'viewDelete'])->name('User.view.delete');
    Route::get('User/delete/{id}' , [UserController::class , 'update'])->name('User.update');
    Route::post('User/delete/{id}' , [UserController::class , 'Delete'])->name('User.delete');

    // User profile related routes 

    Route::get('users/profile', [UserController::class , 'getprofile'])->name('user.profile.get');
    Route::post('users/profile', [UserController::class , 'saveprofile'])->name('user.profile.save');


});
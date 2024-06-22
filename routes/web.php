<?php

use App\Http\Controllers\DefaultBasicController;
use App\Livewire\DefaultBasicComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'login'    => true,
    'logout'   => true,
    'register' => true,
    'reset'    => true,   // for resetting passwords
    'confirm'  => false,  // for additional password confirmations
    'verify'   => false,  // for email verification
]);

//Default after login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth routes
Route::middleware(['auth'])->group(function () {
    Route::prefix('basic-crud')->as('basic-crud.')->controller(DefaultBasicController::class)->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('show/{uuid}', 'show')->name('show');
        Route::get('edit/{uuid}', 'edit')->name('edit');
        Route::put('update/{uuid}', 'update')->name('update');
        Route::delete('destroy/{uuid}', 'destroy')->name('destroy');
    });

    Route::prefix('livewire-crud')->as('livewire-crud.')->group(function () {
        Route::get('/index', DefaultBasicComponent::class)->name('index');
    });
});

//Admin routes
Route::prefix('admin')->as('admin')->middleware(['auth', 'role:admin'])->group(function () {
});

//User routes
Route::prefix('user')->as('user')->middleware(['auth', 'role:user'])->group(function () {
});

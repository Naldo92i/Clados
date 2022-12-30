<?php

use App\Http\Controllers\Backend\AboutManageController;
use App\Http\Controllers\Backend\ConfigController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LogController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\ClasseurController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EtagereController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\NiveauController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'register' => false,
]);

//PUBLIC PAGES ROUTES
Route::get('/', [DashboardController::class, 'index'])->name('welcome');


//GO TO ADMINISTRATION LOGIN PAGE
Route::get('/administration/auth/login', function () {return view('auth.login');})->name('auth.login');
//ADMINISTRATION PAGES ROUTES
Route::group(['middleware' => ['web','auth'], 'prefix' => 'administration'], function() {
    Route::get('/', [DashboardController::class, 'index'])->name('home');


    //LOCAUX ROUTE
    Route::get('/locaux/datatable', [LocalController::class, 'datatable'])->middleware('permission:local-lire')->name('locaux.datatables');
    Route::get('/locaux', [LocalController::class, 'index'])->middleware('permission:local-lire')->name('locaux.index');
    Route::get('/locaux/create', [LocalController::class, 'create'])->middleware('permission:local-créer')->name('locaux.create');
    Route::post('/locaux/store', [LocalController::class, 'store'])->middleware('permission:local-créer')->name('locaux.store');
    Route::get('/locaux/edit/{local:uuid}', [LocalController::class, 'edit'])->middleware('permission:local-modifier')->name('locaux.edit');
    Route::patch('/locaux/update/{local:uuid}', [LocalController::class, 'update'])->middleware('permission:local-modifier')->name('locaux.update');
    Route::delete('/locaux/destroy/{local:uuid}', [LocalController::class, 'destroy'])->middleware('permission:local-supprimer')->name('locaux.destroy');


    //ETAGERES ROUTE
    Route::get('/etagere/datatable', [EtagereController::class, 'datatable'])->middleware('permission:etagere-lire')->name('etagere.datatables');
    Route::get('/etagere', [EtagereController::class, 'index'])->middleware('permission:etagere-lire')->name('etagere.index');
    Route::get('/etagere/create', [EtagereController::class, 'create'])->middleware('permission:etagere-créer')->name('etagere.create');
    Route::post('/etagere/store', [EtagereController::class, 'store'])->middleware('permission:etagere-créer')->name('etagere.store');
    Route::get('/etagere/edit/{etagere:uuid}', [EtagereController::class, 'edit'])->middleware('permission:etagere-modifier')->name('etagere.edit');
    Route::patch('/etagere/update/{etagere:uuid}', [EtagereController::class, 'update'])->middleware('permission:etagere-modifier')->name('etagere.update');
    Route::delete('/etagere/destroy/{etagere:uuid}', [EtagereController::class, 'destroy'])->middleware('permission:etagere-supprimer')->name('etagere.destroy');

    //NIVEAUX ROUTE
    Route::get('/niveaux/datatable', [NiveauController::class, 'datatable'])->middleware('permission:niveau-lire')->name('niveau.datatables');
    Route::get('/niveaux', [NiveauController::class, 'index'])->middleware('permission:niveau-lire')->name('niveau.index');
    Route::get('/niveaux/create', [NiveauController::class, 'create'])->middleware('permission:niveau-créer')->name('niveau.create');
    Route::post('/niveaux/store', [NiveauController::class, 'store'])->middleware('permission:niveau-créer')->name('niveau.store');
    Route::get('/niveaux/edit/{niveau:uuid}', [NiveauController::class, 'edit'])->middleware('permission:niveau-modifier')->name('niveau.edit');
    Route::patch('/niveaux/update/{niveau:uuid}', [NiveauController::class, 'update'])->middleware('permission:niveau-modifier')->name('niveau.update');
    Route::delete('/niveaux/destroy/{niveau:uuid}', [NiveauController::class, 'destroy'])->middleware('permission:niveau-supprimer')->name('niveau.destroy');

    //CLASSEUR ROUTE
    Route::get('/classeurs/datatable', [ClasseurController::class, 'datatable'])->middleware('permission:classeur-lire')->name('classeur.datatables');
    Route::get('/classeurs', [ClasseurController::class, 'index'])->middleware('permission:classeur-lire')->name('classeur.index');
    Route::get('/classeurs/create', [ClasseurController::class, 'create'])->middleware('permission:classeur-créer')->name('classeur.create');
    Route::post('/classeurs/store', [ClasseurController::class, 'store'])->middleware('permission:classeur-créer')->name('classeur.store');
    Route::get('/classeurs/edit/{classeur:uuid}', [ClasseurController::class, 'edit'])->middleware('permission:classeur-modifier')->name('classeur.edit');
    Route::patch('/classeurs/update/{classeur:uuid}', [ClasseurController::class, 'update'])->middleware('permission:classeur-modifier')->name('classeur.update');
    Route::delete('/classeurs/destroy/{classeur:uuid}', [ClasseurController::class, 'destroy'])->middleware('permission:classeur-supprimer')->name('classeur.destroy');

    //DOCUMENT ROUTE
    Route::get('/documents/datatable', [DocumentController::class, 'datatable'])->middleware('permission:document-lire')->name('document.datatables');
    Route::get('/documents', [DocumentController::class, 'index'])->middleware('permission:document-lire')->name('document.index');
    Route::get('/documents/create', [DocumentController::class, 'create'])->middleware('permission:document-créer')->name('document.create');
    Route::post('/documents/store', [DocumentController::class, 'store'])->middleware('permission:document-créer')->name('document.store');
    Route::get('/documents/edit/{document:uuid}', [DocumentController::class, 'edit'])->middleware('permission:document-modifier')->name('document.edit');
    Route::patch('/documents/update/{document:uuid}', [DocumentController::class, 'update'])->middleware('permission:document-modifier')->name('document.update');
    Route::delete('/documents/destroy/{document:uuid}', [DocumentController::class, 'destroy'])->middleware('permission:document-supprimer')->name('document.destroy');

    //ABOUT MANAGE ROUTE
    Route::get('/config', [ConfigController::class, 'index'])->middleware('permission:config-lire')->name('config.index');
    Route::post('/config/update', [ConfigController::class, 'update'])->middleware('permission:config-modifier')->name('config.update');

    //ROLES ROUTE
    Route::get('/roles/datatable', [RoleController::class, 'datatables'])->middleware('permission:role-lire')->name('roles.datatables');
    Route::get('/roles', [RoleController::class, 'index'])->middleware('permission:role-lire')->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->middleware('permission:role-créer')->name('roles.create');
    Route::post('/roles/store', [RoleController::class, 'store'])->middleware('permission:role-créer')->name('roles.store');
    Route::get('/roles/{id}/view', [RoleController::class, 'show'])->middleware('permission:role-lire')->name('roles.show');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->middleware('permission:role-modifier')->name('roles.edit');
    Route::patch('/roles/{id}/update', [RoleController::class, 'update'])->middleware('permission:role-modifier')->name('roles.update');
    Route::delete('/roles/{id}/destroy', [RoleController::class, 'destroy'])->middleware('permission:role-supprimer')->name('roles.destroy');

    //LOGS ROUTE
    Route::get('/logs/datatable', [LogController::class, 'datatables'])->middleware('permission:log-lire')->name('logs.datatables');
    Route::get('/logs', [LogController::class, 'index'])->middleware('permission:log-lire')->name('logs.index');
    Route::get('/logs/{id}/view', [LogController::class, 'show'])->middleware('permission:log-lire')->name('logs.show');


    //USERS ROUTES
    Route::get('/users/datatable', [UserController::class, 'datatables'])->middleware('permission:utilisateur-lire')->name('users.datatables');
    Route::get('/users', [UserController::class, 'index'])->middleware('permission:utilisateur-lire')->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->middleware('permission:utilisateur-créer')->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->middleware('permission:utilisateur-créer')->name('users.store');
    Route::get('/users/{user}/show', [UserController::class, 'show'])->middleware('permission:utilisateur-lire')->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware('permission:utilisateur-modifier')->name('users.edit');
    Route::patch('/users/{user}/update', [UserController::class, 'update'])->middleware('permission:utilisateur-modifier')->name('users.update');
    Route::get('/users/{user}/status', [UserController::class, 'status'])->middleware('permission:utilisateur-modifier')->name('users.status');
    Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->middleware('permission:utilisateur-supprimer')->name('users.destroy');

    
    //PROFILE ROUTES
    Route::get('/profile', [UserController::class, 'profile'])->middleware('permission:profil-lire')->name('profile.index');
    Route::get('/profile/avatar', [UserController::class, 'avatar'])->middleware('permission:profil-modifier')->name('profile.avatar');
    Route::post('/profile/avatar/change', [UserController::class, 'changeAvatar'])->middleware('permission:profil-modifier')->name('avatar.change');
    Route::get('/profile/password', [UserController::class, 'password'])->middleware('permission:profil-modifier')->name('profile.password');
    Route::post('/profile/password/reset', [UserController::class, 'passwordReset'])->middleware('permission:profil-modifier')->name('password.reset');

});

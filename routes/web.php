<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/ajout_livreur', function () {
    return view('ajout_livreur');
});
Route::get('/commande', function () {
    return view('commande');
});

Route::get('/statistiques _globales', function () {
    return view('statistiques _globales');
});



Route::get('/livraisons', [LivraisonController::class, 'create']);
Route::post('/livraisons', [LivraisonController::class, 'store'])->name('livraisons');
Route::get('/commande', [CommandeController::class, 'create']);
Route::post('/commande', [CommandeController::class, 'store'])->name('commande');


Auth::routes();


Route::prefix('utilisateurs')->middleware(['auth', 'Isadmin'])->group(function () {
    Route::get('/customer', [AdminController::class, 'customer'])->name('utilisateurs.customer');
    Route::get('/admin', [AdminController::class, 'admin_list'])->name('utilisateurs.admins');
    Route::get('/livreur_interne', [AdminController::class, 'livreur_interne'])->name('utilisateurs.livreurs_interne');
    Route::get('/livreur_externe', [AdminController::class, 'livreur_externe'])->name('utilisateurs.livreurs_externe');
    Route::get('/utilisateurs/{id}/edit', [AdminController::class, 'edit'])->name('utilisateurs.edit');
    Route::put('/utilisateurs/{id}', [AdminController::class, 'update'])->name('utilisateurs.update');
    Route::delete('/utilisateurs/{id}', [AdminController::class, 'destroy'])->name('utilisateurs.delete');
    Route::get('/utilisateurs', [AdminController::class, 'index'])->name('utilisateurs');

    /*  Route::patch('/utilisateurs/{id}/status', [AdminController::class, 'toggleStatus'])->name('utilisateurs.toggleStatus'); */
});



Route::prefix('commande')->middleware(['auth', 'Isadmin'])->group(function () {

    Route::get('/commande_table', [CommandeController::class, 'commande_table'])->name('commande_table');
    Route::get('/commande/create', [CommandeController::class, 'create'])->name('commande.create');
    Route::post('/commande', [CommandeController::class, 'store'])->name('commandes.store');
    Route::get('/commande_update/{id}/edite', [CommandeController::class, 'edite'])->name('commande.edit');
    Route::put('/commande_update/{id}', [CommandeController::class, 'updates'])->name('commande.updates');
    Route::delete('/commande/{id}', [CommandeController::class, 'destroys'])->name('commande.destroys');
    Route::put('/admin/commandes/{id}/statut', [CommandeController::class, 'updateStatut'])->name('commandes.update.statut');
    Route::get('/en-attente', [CommandeController::class, 'commande_en_attente'])->name('commandes.en_attente');
    Route::get('/en-cours', [CommandeController::class, 'commande_en_cours'])->name('commandes.en_cours');
    Route::get('/terminee', [CommandeController::class, 'commande_terminee'])->name('commandes.terminee');
    Route::get('/annulee', [CommandeController::class, 'commande_annulee'])->name('commandes.annulee');
    Route::get('/commandes/{statut}', [CommandeController::class, 'commandesParStatut'])->name('commandes.statut');
});

    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [UtilisateurController::class, 'edites'])->name('profile'); 
        Route::post('/profile/update', [UtilisateurController::class, 'updatees'])->name('profile.updatees');
        Route::post('/profile', [UtilisateurController::class, 'updateesProfil'])->name('profile.updateesProfil');
        Route::post('/profile/password', [UtilisateurController::class, 'updateePassword'])->name('profile.updateePassword');
    });


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['auth', Isadmin::class])
    ->name('home');


use App\Http\Controllers\UserController;

/* Route::get('/customer', [UserController::class, 'user_list'])->name('utilisateurs.customer');
Route::get('/utilisateurs/admin', [UserController::class, 'admin_list'])->name('utilisateurs.admins');
Route::get('/utilisateurs/livreur-interne', [UserController::class, 'livreur_interne_list'])->name('utilisateurs.livreurs_internes');
Route::get('/utilisateurs/livreur-externe', [UserController::class, 'livreur_externe_list'])->name('utilisateurs.livreurs_externes'); 
{{ $users->appends(request()->all())->links() }}
*/

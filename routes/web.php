<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SponsorsController as AdminSponsorsController;
use App\Http\Controllers\SponsorsController as SponsorsController;
use App\Http\Controllers\Admin\TournoisController as AdminTournoisController;
use App\Http\Controllers\Users\TournoisController as UsersTournoisController;
use App\Http\Controllers\Admin\ParticipantsController as AdminParticipantsController;
use App\Http\Controllers\Users\ParticipantsController as UsersParticipantsController;
use App\Http\Controllers\Admin\ContactsController as AdminContactsController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\AlbumController as AdminAlbumController;
use App\Http\Controllers\Users\AlbumController as UsersAlbumController;
use App\Http\Controllers\Admin\EventRegistrationController as AdminEventRegistrationController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\StatistiqueController as AdminStatistiqueController;
use App\Models\Sponsor;

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
    // Récupérer tous les sponsors non expirés
    $sponsors = Sponsor::where('sponsor_subscription_end_date', '>=', date('Y-m-d'))->get();
    return view('accueil', compact('sponsors'));
})->name('accueil');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//sponsor
Route::get('sponsors', [SponsorsController::class, 'index'])->name('user.sponsors.index'); // Route pour la liste des sponsors pour les utilisateurs normaux

// Route pour les détails du sponsor pour les utilisateurs normaux
Route::get('/sponsors/{id}', [SponsorsController::class, 'show'])->name('user.sponsors.show');




//tournoi
// i want route like user.tournois.index, user.tournois.show
Route::get('tournois', [UsersTournoisController::class, 'index'])->name('user.tournois.index'); // Route pour la liste des tournois pour les utilisateurs normaux

Route::get('tournois/{id}', [UsersTournoisController::class, 'show'])->name('user.tournois.show'); // Route pour les détails du tournoi pour les utilisateurs normaux

// route for : users.tournois.inscription.create
Route::get('tournois/{tournoi}/inscription/create', [UsersParticipantsController::class, 'create'])
    ->name('user.tournois.inscription.create');

//album
Route::get('albums', [UsersAlbumController::class, 'index'])->name('user.albums.index'); // Route pour la liste des albums pour les utilisateurs normaux
// album show
Route::get('albums/{id}', [UsersAlbumController::class, 'show'])->name('user.albums.show'); // Route pour les détails de l'album pour les utilisateurs normaux
//forum
Route::get('forums', function () {
    return view('forums');
})->middleware(['auth', 'verified'])->name('forums');

//evenement
Route::get('evenements', function () {
    return view('evenements');
})->middleware(['auth', 'verified'])->name('evenements');

//contact
Route::get('contacts', function () {
    return view('contacts');
})->name('contacts');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    // Redirection de '/admin/' vers '/admin/dashboard'
    Route::redirect('/', '/dashboard');

    // Gestion des sponsors
    Route::resource('sponsors', AdminSponsorsController::class);

    // Gestion des tournois
    Route::resource('tournois', AdminTournoisController::class);

    // Gestion des participants
    Route::resource('participants', AdminParticipantsController::class);

    // Ajout de la route pour le formulaire d'inscription multiple
    Route::get('/tournois/{tournoi}/participants/create', [AdminParticipantsController::class, 'create'])
        ->name('tournois.participants.create');

    // Gestion des contacts
    Route::resource('contacts', AdminContactsController::class);

    // Route pour afficher les contacts archivés
    Route::get('/contacts/archived', [AdminContactsController::class, 'archived'])
        ->name('contacts.archived');
    Route::put('/contacts/archive/{id}', [AdminContactsController::class, 'archive'])->name('contacts.archive');
    Route::put('/contacts/unarchive/{id}', [AdminContactsController::class, 'unarchive'])->name('contacts.unarchive');

    // Gestion des utilisateurs
    Route::resource('users', AdminUsersController::class);

    Route::resource('albums', AdminAlbumController::class);

    Route::delete('/images/{id}', [AdminAlbumController::class, 'destroyImage'])->name('images.destroy');


    // Routes pour les événements
    Route::resource('events', AdminEventController::class);

    // Routes pour les inscriptions aux événements
    Route::resource('eventregistrations', AdminEventRegistrationController::class);

    Route::get('/eventregistrations/{event}/create', [AdminEventRegistrationController::class, 'create'])
        ->name('eventregistrations.create');
    
    // Routes pour les statistiques
    Route::get('/statistiques', [AdminStatistiqueController::class, 'index'])->name('statistiques.index');
    
    

});






require __DIR__ . '/auth.php';

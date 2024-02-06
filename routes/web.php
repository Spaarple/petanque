<?php

use App\Http\Controllers\ProfileController;
use App\Models\CarouselImage;
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
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Users\JoueurController as UsersJoueurController;
use App\Models\Sponsor;
use App\Models\Tournois;
use Carbon\Carbon;

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

    $carouselImages = CarouselImage::all();

    // get the tournois that are not yet started but are in the future and order them by start date get only the first
    $tournois = Tournois::where('tournoi_start_date', '>=', Carbon::now())
        ->orderBy('tournoi_start_date', 'asc')
        ->get();
    return view('accueil', compact('sponsors', 'carouselImages', 'tournois'));
})->name('accueil');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'isVerified'])->name('dashboard');

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
})->middleware(['auth', 'isVerified'])->name('forums');

//evenement
Route::get('evenements', function () {
    return view('evenements');
})->middleware(['auth', 'isVerified'])->name('evenements');

//contact
Route::get('contacts', [AdminContactsController::class, 'messages'])->name('user.contacts.messages'); // Route pour la liste des contacts pour les utilisateurs normaux
// contact.create
Route::get('contacts/create', [AdminContactsController::class, 'create'])->name('user.contacts.create'); // Route pour créer un contact pour les utilisateurs normaux
// contact.store
Route::post('contacts', [AdminContactsController::class, 'store'])->name('user.contacts.store'); // Route pour enregistrer un contact pour les utilisateurs normaux

// Route pour les joueurs
Route::get('joueurs', [UsersJoueurController::class, 'index'])->middleware(['auth', 'isVerified'])->name('user.joueurs.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/photo', [ProfileController::class, 'uploadPhoto'])->name('profile.uploadPhoto');
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

    // routes pour les paramètres
    Route::resource('parametres', AdminSettingsController::class);
    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/carousel', [AdminSettingsController::class, 'updateCarousel'])->name('settings.updateCarousel');
    Route::post('/settings/logo', [AdminSettingsController::class, 'updateLogo'])->name('settings.updateLogo');
    Route::delete('/admin/carousel/{id}', [AdminSettingsController::class, 'deleteCarouselImage'])->name('settings.deleteCarouselImage');

});






require __DIR__ . '/auth.php';

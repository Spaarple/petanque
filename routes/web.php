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
use App\Http\Controllers\Admin\CompteRenduController as AdminCompteRenduController;
use App\Models\Sponsor;
use App\Models\Tournois;
use Carbon\Carbon;
use App\Models\TextContent;

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
    if (TextContent::where('key', 'homepage_presentation')->doesntExist()) {
        TextContent::create([
            'key' => 'homepage_presentation',
            'content' => 'Bienvenue sur notre site web. Nous sommes heureux de vous accueillir.'
        ]);
    }
    $textContent = TextContent::where('key', 'homepage_presentation')->first();
    return view('accueil', compact('sponsors', 'carouselImages', 'tournois', 'textContent'));
})->name('accueil');

Route::get('/mentions-legales', function () {
    return view('mentionslegales');
})->name('mentions-legales');

Route::get('/dashboard', function () {
    // get list of all the events and events
    $events = \App\Models\Event::all();
    $eventRegistrations = \App\Models\EventRegistration::all();
    $tournoiRegistrations = \App\Models\ParticipationTournois::all();
    $Tournois = \App\Models\Tournois::all();

    // fait deux listes, une ou avec les évenements et tournois ouverts auquel l'utilisateur peut s'inscrire et une autre avec les évenements et tournois auquel l'utilisateur est déjà inscrit
    $openEvents = [];
    $openTournois = [];
    $registeredEvents = [];
    $registeredTournois = [];
    // pour savoir si l'utilistateur est connecté il faut prendre son name et le comparer avec user_first_name et user_last_name de event ou user_first_name et user_last_name de tournois
    // on ne peux pas utiliser user_id car il n'est pas dans les tables event et tournois
    $user = auth()->user();
    $firstName = $user->first_name;
    $lastName = $user->last_name;


    // fix problème de relatio

    foreach ($events as $event) {
        // Vérifier si l'utilisateur est inscrit à cet événement
        $isRegistered = $eventRegistrations->where('event_id', $event->id)
            ->where('user_first_name', $firstName)
            ->where('user_last_name', $lastName);

        $isRegistered = $isRegistered->count() > 0;

        
        if ($isRegistered) {
            $registeredEvents[] = $event;
        } else {
            $openEvents[] = $event;
        }
    }


    foreach ($Tournois as $tournoi) {
        // Vérifier si l'utilisateur est inscrit à ce tournoi
        $isRegistered = $tournoiRegistrations->where('tournoi_id', $tournoi->id)
            ->where('user_first_name', $firstName)
            ->where('user_last_name', $lastName);

        $isRegistered = $isRegistered->count() > 0;

        if ($isRegistered) {
            $registeredTournois[] = $tournoi;
        } else {
            $openTournois[] = $tournoi;
        }
    }





    return view('dashboard', compact('openEvents', 'openTournois', 'registeredEvents', 'registeredTournois'));
})->middleware(['auth', 'isVerified'])->name('dashboard');

//sponsor
Route::get('sponsors', [SponsorsController::class, 'index'])->name('user.sponsors.index'); // Route pour la liste des sponsors pour les utilisateurs normaux

// Route pour les détails du sponsor pour les utilisateurs normaux
Route::get('/sponsors/{id}', [SponsorsController::class, 'show'])->name('user.sponsors.show');


//Compte rendu indexuser et showuser
Route::get('compte-rendus', [AdminCompteRenduController::class, 'indexuser'])->name('user.compte-rendus.index'); // Route pour la liste des compte-rendus pour les utilisateurs normaux
Route::get('compte-rendus/{compteRendu}', [AdminCompteRenduController::class, 'showuser'])->name('user.compte-rendus.show'); // Route pour les détails du compte-rendu pour les utilisateurs normaux

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
})->middleware(['auth', 'isApproved'])->name('forums');





//evenement

Route::resource('events', AdminEventController::class)->middleware(['auth', 'isApproved'])->names('user.events');
Route::get('/events/{event}/validate', [AdminEventController::class, 'validateEvent'])->middleware(['auth', 'isAdmin'])->name('user.events.validate');
Route::get('/events/{event}/unvalidate', [AdminEventController::class, 'unvalidateEvent'])->middleware(['auth', 'isAdmin'])->name('user.events.unvalidate');
Route::post('/eventregistrations', [AdminEventRegistrationController::class, 'store'])->middleware(['auth', 'isApproved'])
    ->name('users.eventregistrations.store');
Route::get('/eventregistrations/create/{eventId}', [AdminEventRegistrationController::class, 'create'])->middleware(['auth', 'isApproved'])
    ->name('users.eventregistrations.create');


//compte rendu
//Route::resource('compte-rendus', AdminCompteRenduController::class)->middleware(['auth', 'isApproved'])->names('user.compteRendus');

//contact
Route::get('contacts', [AdminContactsController::class, 'messages'])->name('user.contacts.messages'); // Route pour la liste des contacts pour les utilisateurs normaux
// contact.create
Route::get('contacts/create', [AdminContactsController::class, 'create'])->name('user.contacts.create'); // Route pour créer un contact pour les utilisateurs normaux
// contact.store
Route::post('contacts', [AdminContactsController::class, 'store'])->name('user.contacts.store'); // Route pour enregistrer un contact pour les utilisateurs normaux



// Route pour les joueurs
Route::get('joueurs', [UsersJoueurController::class, 'index'])->middleware(['auth', 'isApproved'])->name('user.joueurs.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/photo', [ProfileController::class, 'uploadPhoto'])->name('profile.uploadPhoto');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    // Redirection de '/admin/' vers '/admin/dashboard'
    Route::redirect('/', '/dashboard');

    // Gestion des sponsors
    Route::resource('sponsors', AdminSponsorsController::class);
    Route::delete('/sponsors/{sponsor}/photos/{photo}', [AdminSponsorsController::class, 'deletePhoto'])->name('sponsors.photos.delete');


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


    // Routes pour les inscriptions aux événements
    Route::resource('eventregistrations', AdminEventRegistrationController::class, ['except' => ['create']]);



    // Routes pour les statistiques
    Route::get('/statistiques', [AdminStatistiqueController::class, 'index'])->name('statistiques.index');

    // routes pour les paramètres
    Route::resource('parametres', AdminSettingsController::class);
    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/carousel', [AdminSettingsController::class, 'updateCarousel'])->name('settings.updateCarousel');
    Route::post('/settings/logo', [AdminSettingsController::class, 'updateLogo'])->name('settings.updateLogo');
    Route::delete('/admin/carousel/{id}', [AdminSettingsController::class, 'deleteCarouselImage'])->name('settings.deleteCarouselImage');
    Route::put('/settings/presentation', [AdminSettingsController::class, 'updatePresentation'])->name('settings.updatePresentation');

    // Route pour l'événement all
    Route::get('/events/all', [AdminEventController::class, 'all'])->name('events.all');

    // Route pour le compte rendu
    Route::resource('/compte-rendus', AdminCompteRenduController::class)->names('compte-rendus');
});






require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SponsorsController as AdminSponsorsController;
use App\Http\Controllers\SponsorsController as SponsorsController;
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
    $sponsors = Sponsor::all(); // Récupérer tous les sponsors
    return view('accueil', compact('sponsors'));
})->name('accueil');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//sponsor
Route::get('sponsors', [SponsorsController::class, 'index'])->name('user.sponsors.index'); // Route pour la liste des sponsors pour les utilisateurs normaux

// Route pour les détails du sponsor pour les utilisateurs normaux
Route::get('/sponsors/{id}', [SponsorsController::class, 'show'])->name('user.sponsors.show');




//tournoi/compétition
Route::get('tournois', function () {
    return view('tournois');
})->name('tournois');

//album
Route::get('albums', function () {
    return view('albums');
})->name('albums');

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

    // sponsors
    Route::resource('sponsors', AdminSponsorsController::class);
});





require __DIR__ . '/auth.php';

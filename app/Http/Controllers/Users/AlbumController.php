<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Image; // Corrigez la casse ici

class AlbumController extends Controller
{
    // Afficher tous les albums
    public function index()
    {
        $albums = Album::with('coverImage')->get(); // Pré-charger la relation coverImage
        return view('users.albums.index', compact('albums'));
    }

    // Afficher un album spécifique
    public function show(string $id)
    {
        $album = Album::with('images')->findOrFail($id); // Pré-charger les images de l'album
        return view('users.albums.show', compact('album'));
    }
}

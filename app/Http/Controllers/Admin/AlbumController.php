<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Image; // Supposons que ce modèle gère maintenant les images et les vidéos
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::all();
        return view('admin.albums.index', compact('albums'));
    }

    // Afficher le formulaire de création d'un nouvel album
    public function create()
    {
        return view('admin.albums.create');
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|max:255',
                'description' => 'nullable',
                'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi,wmv|max:10000' // Inclure les formats vidéo
            ]);

            $album = Album::create($request->only(['name', 'description']));

            if ($request->hasfile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('public/files'); // Stocker dans un dossier général pour les fichiers
                    $type = $file->getClientOriginalExtension();
                    Image::create([ // Utilisez un nom de modèle plus général si nécessaire
                        'album_id' => $album->id,
                        'file_path' => $path,
                        'type' => in_array($type, ['mp4', 'mov', 'avi', 'wmv']) ? 'video' : 'image' // Déterminer le type de fichier
                    ]);
                }
            }

            return redirect()->route('admin.albums.index')->with('success', 'Album créé avec succès.');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('admin.albums.index')->with('error', 'Une erreur est survenue lors de la création de l\'album.');
        }

    }

    // Mettre à jour un album spécifique
    public function update(Request $request, Album $album)
    {
        try{
            $request->validate([
                'name' => 'required|max:255',
                'description' => 'nullable',
                'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi,wmv|max:10000' // Inclure les formats vidéo
            ]);

            $album->update($request->only(['name', 'description']));

            if ($request->hasfile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('public/files');
                    $type = $file->getClientOriginalExtension();
                    Image::create([
                        'album_id' => $album->id,
                        'file_path' => $path,
                        'type' => in_array($type, ['mp4', 'mov', 'avi', 'wmv']) ? 'video' : 'image'
                    ]);
                }
            }

            return redirect()->route('admin.albums.index')->with('success', 'Album mis à jour avec succès.');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('admin.albums.index')->with('error', 'Une erreur est survenue lors de la mise à jour de l\'album.');
        }
    }

    // Afficher un album spécifique
    public function show(Album $album)
    {
        return view('admin.albums.show', compact('album'));
    }

    // Afficher le formulaire d'édition pour un album spécifique
    public function edit(Album $album)
    {
        return view('admin.albums.edit', compact('album'));
    }


    /**
     * Remove the specified resource from storage.
     */
    // Supprimer un album spécifique
    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('admin.albums.index')->with('success', 'Album supprimé avec succès.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CarouselImage;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\TextContent;
// log
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{
    public function index()
    {
        $carouselImages = CarouselImage::all();
        // Utilisez une clé descriptive pour identifier de manière unique le texte
        // Supposons que 'homepage_presentation' est une clé pour le texte de présentation de la page d'accueil
        // if exists
        if (TextContent::where('key', 'homepage_presentation')->doesntExist()) {
            TextContent::create([
                'key' => 'homepage_presentation',
                'content' => 'Bienvenue sur notre site web. Nous sommes heureux de vous accueillir.'
            ]);
        }
        $textContent = TextContent::where('key', 'homepage_presentation')->first();


        return view('admin.settings.index', compact('carouselImages', 'textContent'));
    }

    public function updateCarousel(Request $request)
    {

        try {
            // Validation des données
            $request->validate([
                'carousel_images' => 'nullable|array',
                'carousel_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            // [2024-02-04 10:15:43] local.ERROR: Trying to access array offset on value of type null  
            // dd($request->input('captions'));



            if ($request->hasFile('carousel_images')) {
                foreach ($request->file('carousel_images') as $index => $file) {
                    $path = $file->store('carousel_images', 'public');

                    CarouselImage::create([
                        'image_path' => $path,
                        // Pour associer chaque image à sa légende, assurez-vous que l'entrée 'captions' est également un tableau et accédez à l'élément correspondant.
                        'caption' => $request->input('captions')[$index] ?? null,
                    ]);
                }
            }



            return redirect()->back()->with('success', 'Les images du carousel ont été mises à jour avec succès.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            //return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour des images du carousel.');
        }
    }



    public function deleteCarouselImage($id)
    {
        $image = CarouselImage::findOrFail($id);
        Storage::delete('public/' . $image->image_path);
        $image->delete();

        return back()->with('success', 'Image supprimée avec succès.');
    }

    public function updateLogo(Request $request)
    {
        try {
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg', // 2MB Max
            ]);

            $logoPath = $request->file('logo')->store('logos', 'public');

            // Mettre à jour le chemin du logo dans le fichier de configuration (solution temporaire)
            // Attention : cette méthode n'est pas recommandée pour les modifications fréquentes ou en production
            $configPath = config_path('site.php');
            $content = file_get_contents($configPath);
            $content = preg_replace("/'logo_path' => '.*?'/", "'logo_path' => '{$logoPath}'", $content);
            file_put_contents($configPath, $content);

            return back()->with('success', 'Le logo a été mis à jour avec succès.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function updatePresentation(Request $request)
    {
        try {
            $request->validate([
                'content' => 'required|string',
            ]);

            // Supposons que vous ayez une colonne 'key' pour identifier le texte que vous souhaitez mettre à jour.
            // Si vous n'avez pas une telle colonne, assurez-vous d'ajouter une logique pour identifier l'enregistrement correct.
            $key = 'homepage_presentation'; // Utilisez une clé qui identifie de manière unique votre contenu textuel.

            $textContent = TextContent::firstOrCreate(['key' => $key]);
            $textContent->content = $request->input('content');
            $textContent->save();

            return redirect()->back()->with('success', 'Texte mis à jour avec succès.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du texte.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Services\AlertServiceInterface;

class SponsorsController extends Controller
{
    public function __construct(private readonly AlertServiceInterface $alertService)
    {
        // Ajoutez ici les middlewares nécessaires
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupération de tous les sponsors
        $sponsors = Sponsor::all();

        // Affichage de la vue avec les sponsors
        return view('admin.sponsors.index', compact('sponsors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Affichage de la vue avec le formulaire de création
        return view('admin.sponsors.create');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        try {
            // Validation des données du formulaire
            $validatedData = $request->validate([
                'sponsor_name' => 'required|string|max:255',
                'sponsor_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'sponsor_website' => 'nullable|url',
                'sponsor_description' => 'nullable|string',
                'sponsor_subscription_end_date' => 'required|date',
                // Inclure des règles de validation pour les autres champs si nécessaire
            ]);

            // Traitement du téléchargement du logo si présent
            if ($request->hasFile('sponsor_logo')) {
                $path = $request->file('sponsor_logo')->store('public/sponsors_logos');
                $validatedData['sponsor_logo'] = Storage::url($path);
            }

            // Création du sponsor
            Sponsor::create($validatedData);
        } catch (\Exception $e) {
            // Vous pouvez utiliser Log pour enregistrer l'erreur ou simplement la décharger
            $this->alertService->error('Une erreur est survenue : ' . $e->getMessage());
            return back();
        }
        $this->alertService->success('Sponsor créé avec succès.');
        return redirect()->route('admin.sponsors.index');


        // Redirection vers la liste des sponsors avec un message de succès
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        return view('admin.sponsors.show', compact('sponsor'));
    }


    public function edit($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        return view('admin.sponsors.edit', compact('sponsor'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'sponsor_name' => 'required|string|max:255',
            'sponsor_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'sponsor_website' => 'nullable|url',
            'sponsor_description' => 'nullable|string',
            'sponsor_subscription_end_date' => 'required|date',
            // Inclure des règles de validation pour les autres champs si nécessaire
        ]);

        // Traitement du téléchargement du logo si présent et différent
        if ($request->hasFile('sponsor_logo')) {
            $path = $request->file('sponsor_logo')->store('public/sponsors_logos');
            $validatedData['sponsor_logo'] = basename($path);
        }

        $sponsor = Sponsor::findOrFail($id);
        $sponsor->update($validatedData);

        $this->alertService->success('Sponsor mis à jour avec succès.');
        return redirect()->route('admin.sponsors.index');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->delete();

        $this->alertService->success('Sponsor supprimé avec succès.');
        return redirect()->route('admin.sponsors.index');
    }
}

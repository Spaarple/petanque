<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Services\AlertServiceInterface;
use App\Models\Photo;
use Illuminate\Support\Facades\DB;

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
        // Commencer une transaction pour s'assurer de la cohérence des données
        DB::beginTransaction();
        try {
            // Validation des données du formulaire
            $validatedData = $request->validate([
                'sponsor_name' => 'required|string|max:255',
                'sponsor_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'sponsor_website' => 'nullable|url',
                'sponsor_description' => 'nullable|string',
                'sponsor_subscription_end_date' => 'required|date',
                'sponsor_contact_email' => 'nullable|email',
                'sponsor_contact_phone' => 'nullable|string',
                'sponsor_contact_address' => 'nullable|string',



            ]);

            if ($request->hasFile('sponsor_logo')) {
                // Stockage de l'image dans le système de fichiers
                $imagePath = $request->file('sponsor_logo')->store('sponsors_logos', 'public');

                // Ajout du chemin de l'image dans le tableau des données validées
                $validatedData['sponsor_logo'] = $imagePath;
            }


            // Création du sponsor
            $sponsor = Sponsor::create($validatedData);

            //Traitemenet du téléchargement des photos de l'album
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('sponsor_photos', 'public');
                    Photo::create([
                        'sponsor_id' => $sponsor->id,
                        'path' => $path,
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            // Vous pouvez utiliser Log pour enregistrer l'erreur ou simplement la décharger
            DB::rollBack();
            Log::error('Erreur lors de la création du sponsor: ' . $e->getMessage());
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
        DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'sponsor_name' => 'required|string|max:255',
                'sponsor_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'sponsor_website' => 'nullable|url',
                'sponsor_description' => 'nullable|string',
                'sponsor_subscription_end_date' => 'required|date',
                'sponsor_contact_email' => 'nullable|email',
                'sponsor_contact_phone' => 'nullable|string',
                'sponsor_contact_address' => 'nullable|string',
            ]);

            $sponsor = Sponsor::findOrFail($id);

            if ($request->hasFile('sponsor_logo')) {
                // Suppression de l'ancien logo si nécessaire
                if ($sponsor->sponsor_logo && Storage::disk('public')->exists($sponsor->sponsor_logo)) {
                    Storage::disk('public')->delete($sponsor->sponsor_logo);
                }

                // Stockage du nouveau logo et mise à jour du chemin
                $imagePath = $request->file('sponsor_logo')->store('sponsors_logos', 'public');
                $validatedData['sponsor_logo'] = $imagePath;
            }

            $sponsor->update($validatedData);

            // Gestion de l'ajout de nouvelles photos à l'album du sponsor
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('sponsor_photos', 'public');
                    $sponsor->photos()->create(['path' => $path]);
                }
            }

            DB::commit();

            $this->alertService->success('Sponsor mis à jour avec succès.');
            return redirect()->route('admin.sponsors.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la mise à jour du sponsor: ' . $e->getMessage());
            $this->alertService->error('Une erreur est survenue lors de la mise à jour du sponsor.');
            return back()->withInput();
        }
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

<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tournois;
use App\Models\ParticipationTournois;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
class TournoisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // Récupération de tous les tournois
        // Sélectionnez uniquement les tournois dont la date de début est égale ou supérieure à la date actuelle
        $tournois = Tournois::where('tournoi_start_date', '>=', Carbon::now())
            ->orderBy('tournoi_start_date', 'asc')
            ->get();

        // Affichage de la vue avec les tournois
        return view('users.tournois.index', compact('tournois'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Affichage de la vue avec le formulaire de création
        return view('admin.tournois.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation des données du formulaire
            $validatedData = $request->validate([
                'tournoi_name' => 'required|string|max:255',
                'tournoi_start_date' => 'required|date',
                'tournoi_pre_inscription_fee' => 'required|numeric',
                'tournoi_inscription_fee' => 'required|numeric',
                'tournoi_max_participants' => 'required|numeric',
                'tournoi_team_local' => 'required|string|max:255',
                'tournoi_team_visitor' => 'required|string|max:255',
                // Inclure des règles de validation pour les autres champs si nécessaire
            ]);


            // Création du tournoi
            Tournois::create($validatedData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création du tournoi.');
        }

        return redirect()->route('admin.tournois.index')->with('success', 'Le tournoi a bien été créé.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupération du tournoi
        $tournoi = Tournois::findOrFail($id);

        // Récupération des participations
        $participants = ParticipationTournois::where('tournoi_id', $id)->get();


        // Affichage de la vue avec le tournoi et les participations
        return view('users.tournois.show', compact('tournoi', 'participants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupération du tournoi
        $tournoi = Tournois::findOrFail($id);

        // Affichage de la vue avec le formulaire d'édition
        return view('admin.tournois.edit', compact('tournoi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Récupération du tournoi
            $tournoi = Tournois::findOrFail($id);

            // Validation des données du formulaire
            $validatedData = $request->validate([
                'tournoi_name' => 'required|string|max:255',
                'tournoi_start_date' => 'required|date',
                'tournoi_pre_inscription_fee' => 'required|numeric',
                'tournoi_inscription_fee' => 'required|numeric',
                'tournoi_max_participants' => 'required|numeric',
                'tournoi_team_local' => 'required|string|max:255',
                'tournoi_team_visitor' => 'required|string|max:255',
            ]);

            // Mise à jour du tournoi
            $tournoi->update($validatedData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du tournoi.');
        }

        return redirect()->route('admin.tournois.index')->with('success', 'Le tournoi a bien été mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Récupération du tournoi
            $tournoi = Tournois::findOrFail($id);

            // Suppression du tournoi
            $tournoi->delete();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression du tournoi.');
        }

        return redirect()->route('admin.tournois.index')->with('success', 'Le tournoi a bien été supprimé.');
    }
}

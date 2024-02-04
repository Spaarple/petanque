<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tournois;
use App\Models\ParticipationTournois;
use Illuminate\Support\Facades\Log;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 404 redirect vers /admin/tournois
        return redirect()->route('admin.tournois.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($tournoiId)
    {
        $tournoi = Tournois::findOrFail($tournoiId);

        return view('admin.participants.create', compact('tournoi'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tournoi_id' => 'required|exists:tournois,id',
            'participants.*.first_name' => 'required|string|max:255',
            'participants.*.last_name' => 'required|string|max:255',
            'participants.*.email' => 'required|email',
            'participants.*.phone' => 'required|string',
        ]);

        foreach ($request->participants as $participantData) {
            // if number of participants is greater than the maximum allowed
            if (ParticipationTournois::where('tournoi_id', $request->tournoi_id)->count() >= Tournois::findOrFail($request->tournoi_id)->tournoi_max_participants) {
                // redirect to tournois show page with error message
                return redirect()->route('admin.tournois.show', $request->tournoi_id)->with('error', 'Le nombre maximum de participants a été atteint.');
            }
            ParticipationTournois::create([
                'tournoi_id' => $request->tournoi_id,
                'user_first_name' => $participantData['first_name'],
                'user_last_name' => $participantData['last_name'],
                'user_email' => $participantData['email'],
                'user_phone_number' => $participantData['phone'],
                // Ajoutez ici les autres champs requis par votre table
            ]);
        }

        return redirect()->back()->with('success', 'Inscriptions enregistrées avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // redirection vers /admin/tournois
        return redirect()->route('admin.tournois.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $participants = ParticipationTournois::findOrFail($id);

        return view('admin.participants.edit', compact('participants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $participation = ParticipationTournois::findOrFail($id);

        // Vérifier si c'est une mise à jour de statut
        if ($request->input('update_type') == 'status') {
            $participation->update(['is_accepted' => true]);
            return redirect()->back()->with('success', 'Le participant a été accepté.');
        } else {
            try {
                // Mise à jour des détails du participant
                $validatedData = $request->validate([
                    'user_first_name' => 'required|string|max:255',
                    'user_last_name' => 'required|string|max:255',
                    'user_email' => 'required|email',
                    'user_phone' => 'required|string',
                    // Validez les autres champs selon vos besoins
                ]);
                $participation->update($validatedData);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
            return redirect()->back()->with('success', 'Modifications enregistrées avec succès.');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $participation = ParticipationTournois::findOrFail($id);
        $participation->delete();

        return redirect()->back()->with('success', 'Suppression enregistrées avec succès.');
    }
}

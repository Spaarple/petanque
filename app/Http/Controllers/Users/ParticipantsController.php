<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tournois;
use App\Models\ParticipationTournois;
use Illuminate\Support\Facades\Log;
use App\Http\Services\AlertServiceInterface;

class ParticipantsController extends Controller
{
    public function __construct(private readonly AlertServiceInterface $alertService)
    {
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create($tournoiId)
    {
        $tournoi = Tournois::findOrFail($tournoiId);

        return view('users.participants.create', compact('tournoi'));
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
            ParticipationTournois::create([
                'tournoi_id' => $request->tournoi_id,
                'user_first_name' => $participantData['first_name'],
                'user_last_name' => $participantData['last_name'],
                'user_email' => $participantData['email'],
                'user_phone_number' => $participantData['phone'],
                // Ajoutez ici les autres champs requis par votre table
            ]);
        }

        $this->alertService->success('Inscription enregistrée avec succès.');
        return redirect()->route('user.tournois.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    // Afficher tous les événements validés
    public function index()
    {
        //$events = Event::where('is_validated', true)->get();
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    // Afficher le formulaire de création d'un nouvel événement
    public function create()
    {
        return view('admin.events.create');
    }

    // Enregistrer un nouvel événement
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'type' => 'required|string',
                'event_date' => 'required|date',
                'max_participants' => 'required|integer'
            ]);

            Event::create($request->all());

            return redirect()->route('admin.events.index')->with('success', 'Événement créé et en attente de validation.');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('admin.events.index')->with('error', 'Une erreur est survenue lors de la création de l\'événement.');
        }
    }

    // Valider un événement (pour les administrateurs)
    public function validateEvent(Event $event)
    {
        $event->update(['is_validated' => true]);
        return redirect()->route('admin.events.index')->with('success', 'Événement validé.');
    }

    // Afficher un événement spécifique
    public function show(Event $event)
    {
        $eventregistrations = EventRegistration::where('event_id', $event->id)->get();

        return view('admin.events.show', compact('event', 'eventregistrations'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    // Mettre à jour un événement dans la base de données
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string',
            'event_date' => 'required|date',
            'max_participants' => 'required|integer'
        ]);

        $event->update($request->all());

        return redirect()->route('admin.events.index')->with('success', 'Événement mis à jour avec succès.');
    }

    // Supprimer un événement
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Événement supprimé avec succès.');
    }
}
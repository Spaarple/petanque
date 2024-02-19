<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Services\AlertServiceInterface;
class EventRegistrationController extends Controller
{
    public function __construct(private readonly AlertServiceInterface $alertService)
    {
    }

    public function index()
    {
        return redirect()->route('admin.events.index');    
    }

    // create
    public function create($eventId)
    {
        $event = Event::findOrFail($eventId);
        return view('users.eventregistrations.create', compact('event'));
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'registrations.*.first_name' => 'required|string|max:255',
            'registrations.*.last_name' => 'required|string|max:255',
            'registrations.*.email' => 'required|email',
            'registrations.*.phone' => 'required|string',
        ]);
    
        foreach ($request->registrations as $registrationData) {
            EventRegistration::create([
                'event_id' => $request->event_id,
                'user_first_name' => $registrationData['first_name'],
                'user_last_name' => $registrationData['last_name'],
                'user_email' => $registrationData['email'],
                'user_phone_number' => $registrationData['phone'],
                // Ajoutez ici les autres champs requis par votre table
            ]);
        }
        //redirect to event show
        $this -> alertService -> success('Inscriptions enregistrées avec succès.');
        return redirect()->route('user.events.show', $request->event_id);
    
    }


    public function edit(string $id)
    {
        $eventsregistration = EventRegistration::findOrFail($id);
        return view('admin.eventregistration.edit', compact('eventsregistration'));
    }
    public function update(Request $request, string $id)
    {
        $eventregistration = EventRegistration::findOrFail($id);

        // Vérifier si c'est une mise à jour de statut
        if ($request->input('update_type') == 'status') {
            $eventregistration->update(['is_accepted' => true]);
            $this->alertService->success('Le participant a été accepté.');
            return redirect()->back();
        } else {
            try {
                // Mise à jour des détails du participant
                $eventregistrationData = $request->validate([
                    'user_first_name' => 'required|string|max:255',
                    'user_last_name' => 'required|string|max:255',
                    'user_email' => 'required|email',
                    'user_phone' => 'required|string',
                    // Validez les autres champs selon vos besoins
                ]);
                $eventregistration->update($eventregistrationData);
            } catch (\Exception $e) {
                $this->alertService->error('Une erreur est survenue lors de la mise à jour des détails du participant.');
                return redirect()->back();
            }
            $this->alertService->success('Modifications enregistrées avec succès.');
            return redirect()->back();
        }
    }
}

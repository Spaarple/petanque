<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contact;
use Illuminate\Support\Facades\Log;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function archived()
    {
        $archivedContacts = Contact::where('is_archived', true)->get();
        return view('admin.contacts.archived', compact('archivedContacts'));
    }

    /**
     * Archive the specified resource.
     */
    public function archive(Request $request, string $id)
    {
        try {
            // Utilisation de la méthode update pour modifier directement le contact
            Log::info("Archiving contact with ID: $id");
            Contact::where('id', $id)->update(['is_archived' => true]);
        } catch (\Exception $e) {
            Log::info("test");
            //Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l’archivage du contact.');
        }
        return redirect()->route('admin.contacts.index')->with('success', 'Le contact a bien été archivé.');
    }

    // unarchive
    public function unarchive(Request $request, string $id)
    {
        try {
            // Utilisation de la méthode update pour modifier directement le contact
            Log::info("Unarchiving contact with ID: $id");
            Contact::where('id', $id)->update(['is_archived' => false]);
        } catch (\Exception $e) {
            Log::info("test");
            //Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l’archivage du contact.');
        }
        return redirect()->route('admin.contacts.index')->with('success', 'Le contact a bien été archivé.');
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'contact_sender_email' => 'required|email',
                'contact_sender_message' => 'required|string',
            ]);
            Contact::create($validatedData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création du contact.');
        }
        return redirect()->route('admin.contacts.index')->with('success', 'Le contact a bien été créé.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contacts = Contact::findOrFail($id);
        return view('admin.contacts.edit', compact('contacts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $validatedData = $request->validate([
                'contact_sender_email' => 'required|email',
                'contact_sender_message' => 'required|string',
            ]);
            $contact->update($validatedData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la modification du contact.');
        }
        return redirect()->route('admin.contacts.index')->with('success', 'Le contact a bien été modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->delete();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression du contact.');
        }
        return redirect()->route('admin.contacts.index')->with('success', 'Le contact a bien été supprimé.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompteRendu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompteRenduController extends Controller
{
    public function index()
    {
        $compteRendus = CompteRendu::all();
        return view('admin.compteRendus.index', compact('compteRendus'));
    }

    public function all()
    {
        $compteRendus = CompteRendu::all();
        return view('compteRendus', compact('compteRendus'));
    }

    // Afficher le formulaire de création d'un nouveau compte rendu
    public function create()
    {
        return view('admin.compteRendus.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|max:255',
                'content' => 'required'
            ]);

            CompteRendu::create($request->only(['title', 'content']));

            return redirect()->route('admin.compteRendus.index')->with('success', 'Compte rendu créé avec succès.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withError('Une erreur est survenue : ' . $e->getMessage());
        }
    }

    // Mettre à jour un compte rendu spécifique
    public function update(Request $request, CompteRendu $compteRendu)
    {
        try {
            $request->validate([
                'title' => 'required|max:255',
                'content' => 'required'
            ]);

            $compteRendu->update($request->only(['title', 'content']));

            return redirect()->route('admin.compteRendus.index')->with('success', 'Compte rendu mis à jour avec succès.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withError('Une erreur est survenue : ' . $e->getMessage());
        }
    }

    // Supprimer un compte rendu spécifique
    public function destroy(CompteRendu $compteRendu)
    {
        try {
            $compteRendu->delete();
            return redirect()->route('admin.compteRendus.index')->with('success', 'Compte rendu supprimé avec succès.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withError('Une erreur est survenue : ' . $e->getMessage());
        }
    }
}

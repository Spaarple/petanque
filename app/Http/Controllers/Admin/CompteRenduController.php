<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompteRendu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Services\AlertServiceInterface;

class CompteRenduController extends Controller
{
    public function __construct(private readonly AlertServiceInterface $alertService)
    {
    }
    public function index()
    {
        $compteRendus = CompteRendu::all();
        return view('admin.compterendus.index', compact('compteRendus'));
    }

    public function indexuser()
    {
        $compteRendus = CompteRendu::all();
        return view('users.compterendus.index', compact('compteRendus'));
    }

    public function show(CompteRendu $compteRendu)
    {
        return view('admin.compterendus.show', compact('compteRendu'));
    }

    public function showuser(CompteRendu $compteRendu)
    {
        return view('admin.compterendus.show', compact('compteRendu'));
    }

    // Afficher le formulaire de création d'un nouveau compte rendu
    public function create()
    {
        return view('admin.compterendus.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|max:255',
                'content' => 'required'
            ]);

            CompteRendu::create($request->only(['title', 'content']));

            $this->alertService->success('Compte rendu créé avec succès.');
            return redirect()->route('admin.compte-rendus.index');
        } catch (\Exception $e) {
            $this->alertService->error('Une erreur est survenue : ' . $e->getMessage());
            return back();
        }
    }

    // edit
    public function edit(CompteRendu $compteRendu)
    {
        return view('admin.compterendus.edit', compact('compteRendu'));
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
            $this->alertService->success('Compte rendu mis à jour avec succès.');
            return redirect()->route('admin.compte-rendus.index');
        } catch (\Exception $e) {
            $this->alertService->error('Une erreur est survenue : ' . $e->getMessage());
            return back();
        }
    }

    // Supprimer un compte rendu spécifique
    public function destroy(CompteRendu $compteRendu)
    {
        try {
            $compteRendu->delete();
            $this->alertService->success('Compte rendu supprimé avec succès.');
            return redirect()->route('admin.compte-rendus.index');
        } catch (\Exception $e) {
            $this->alertService->error('Une erreur est survenue : ' . $e->getMessage());
            return back();
        }
    }
}

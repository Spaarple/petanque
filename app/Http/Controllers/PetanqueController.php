<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetanqueController extends Controller
{
    public function index()
    {
        return view('petanque');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email',
            'message' => 'required',
        ]);

        return redirect()->route('petanque')->with('success', 'Votre message a bien été envoyé');
    }

    
}

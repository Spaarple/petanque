<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\AlertServiceInterface;

class PetanqueController extends Controller
{
    public function __construct(private readonly AlertServiceInterface $alertService)
    {
    }
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
        $this->alertService->success('Votre message a bien été envoyé');
        return redirect()->route('petanque');
    }

    
}

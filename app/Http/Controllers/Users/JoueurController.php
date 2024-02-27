<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class JoueurController extends Controller
{
    public function index()
    {
        // si club = "ASCE ESCOUBLAC" ou ASCE Section Petanque
        $users = User::where('club', 'ASCE ESCOUBLAC') 
                     ->orWhere('club', 'ASCE Section Petanque')
                     ->where('is_approved', 1)
                     ->get(['first_name','last_name', 'email', 'profile_photo_path']);

        
        
        return view('users.joueurs.index', compact('users'));
    }
}

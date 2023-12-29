<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;

class SponsorsController extends Controller
{
    public function show($id) {
        $sponsor = Sponsor::findOrFail($id);
        return view('sponsors.show', compact('sponsor'));
    }

    public function index() {
        $sponsors = Sponsor::all();
        return view('sponsors.index', compact('sponsors'));
    }
    
}

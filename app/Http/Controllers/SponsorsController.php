<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;

class SponsorsController extends Controller
{
    public function show($id) {
        $sponsor = Sponsor::findOrFail($id);
        return view('users.sponsors.show', compact('sponsor'));
    }

    public function index() {
        $sponsors = Sponsor::where('sponsor_subscription_end_date', '>=', date('Y-m-d'))->get();
        return view('users.sponsors.index', compact('sponsors'));
    }
    
}

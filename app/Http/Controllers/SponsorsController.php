<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;
use App\Models\Photo;

class SponsorsController extends Controller
{
    public function show($id) {
        $sponsor = Sponsor::findOrFail($id);
        $images = Photo::where('sponsor_id', $id)->get();
        return view('users.sponsors.show', compact('sponsor', 'images'));
    }

    public function index() {
        $sponsors = Sponsor::where('sponsor_subscription_end_date', '>=', date('Y-m-d'))->get();
        return view('users.sponsors.index', compact('sponsors'));
    }
    
}

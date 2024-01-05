<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->string("licence")->nullable();
        //     $table->boolean("is_approved")->default(false);
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password');
        //     $table->enum("role",["admin","user"])->default("user");
        //     $table->rememberToken();
        //     $table->timestamps();
    
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'licence' => 'nullable|string',
                'is_approved' => 'required|boolean',
                'email_verified_at' => 'nullable|date',
                'password' => 'required|string',
                'role' => 'required|in:admin,user',
            ]);
            User::create($validatedData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création de l\'utilisateur.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::findOrFail($id);
        return view('admin.users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        return view('admin.users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $users = User::findOrFail($id);
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $users->id,
                'licence' => 'nullable|string',
                // value is 0 or 1
                'is_approved' => 'required|boolean',
                'role' => 'required|in:admin,user',
            ]);
            $users->update($validatedData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la modification de l\'utilisateur.');
        }
        return redirect()->route('admin.users.index')->with('success', 'L\'utilisateur a bien été modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $users = User::findOrFail($id);
            $users->delete();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression de l\'utilisateur.');
        }
        return redirect()->route('admin.users.index')->with('success', 'L\'utilisateur a bien été supprimé.');
    }
}

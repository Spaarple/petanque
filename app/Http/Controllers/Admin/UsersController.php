<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Http\Services\AlertServiceInterface;


class UsersController extends Controller
{
    public function __construct(private readonly AlertServiceInterface $alertService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
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
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
                'licence' => 'nullable|string',
                'club' => 'nullable|string',
                // value is 0 or 1
                'is_approved' => 'required|boolean',
                'role' => 'required|in:admin,user',
                'address' => 'nullable|string',
                'birthday' => 'nullable|date',
                // make phone number required and validate it
                'phone' => 'nullable|regex:/^0[1-9]([-. ]?[0-9]{2}){4}$/|required',
            ]);
            $users->update($validatedData);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->alertService->error('Une erreur est survenue lors de la modification de l\'utilisateur.');
            return redirect()->back();
        }
        $this->alertService->success('L\'utilisateur a bien été modifié.');
        return redirect()->route('admin.users.index');
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
            $this->alertService->error('Une erreur est survenue lors de la suppression de l\'utilisateur.');
            return redirect()->back();
        }
        $this->alertService->success('L\'utilisateur a bien été supprimé.');
        return redirect()->route('admin.users.index');
    }
}

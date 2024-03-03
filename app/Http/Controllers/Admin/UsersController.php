<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Http\Services\AlertServiceInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Event;


class UsersController extends Controller
{
    use HasRoles;
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
            $user = User::findOrFail($id);
    
            // Vérifiez si l'utilisateur est un admin
            if ($user->role === 'admin') {
                // Trouvez le prochain admin qui n'est pas l'utilisateur actuel
                $nextAdmin = User::where('role', 'admin')->where('id', '!=', $user->id)->first();
                if (!$nextAdmin) {
                    throw new \Exception("Aucun autre administrateur disponible pour attribuer les événements.");
                }
                // Attribuez les événements de l'utilisateur à supprimer au prochain admin
                $user->events()->update(['user_id' => $nextAdmin->id]);
            } else {
                // Pour un utilisateur non-admin, attribuez ses événements au premier admin disponible
                $adminUser = User::where('role', 'admin')->first();
                if ($adminUser) {
                    $user->events()->update(['user_id' => $adminUser->id]);
                }
            }
            
    
            // Maintenant que les événements ont été réattribués, supprimez l'utilisateur
            $user->delete();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->alertService->error('Une erreur est survenue lors de la suppression de l\'utilisateur.');
            return redirect()->back();
        }
        $this->alertService->success('L\'utilisateur a bien été supprimé.');
        return redirect()->route('admin.users.index');
    }
    
}

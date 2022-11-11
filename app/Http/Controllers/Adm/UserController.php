<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = null;
        $roles = Role::all();
        if ($request->search) {
            $users = User::where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                ->with('role')->get();
        } else {
            $users = User::with('role')->get();
        }
        return view('adm.users', ['users' => $users], ['roles' => $roles]);
    }

    public function ban(User $user)
    {
        $this->authorize('ban', $user);
        $user->update([
            'is_active' => false,
        ]);
        return back();
    }

    public function unban(User $user)
    {
        $this->authorize('unban', $user);
        $user->update([
            'is_active' => true,
        ]);

        return back();
    }

    public function edit(Request $request, User $user)
    {
        $this->authorize('edit', $user);
        $validated = $request->validate([
            'role_id' => 'required|numeric'
        ]);
        $user->update($validated);
        return back();
    }
}

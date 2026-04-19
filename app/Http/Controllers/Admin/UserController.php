<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function index() {
        $users = User::with('roles')->latest()->paginate(10);
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user) {
        $request->validate(['role' => 'required|exists:roles,name']);
        $user->syncRoles([$request->role]);
        return back()->with('success', 'Rol actualizado');
    }

    public function toggleStatus(User $user) {
        $user->update(['active' => !$user->active]);
        return back()->with('success', 'Estado actualizado');
    }
}
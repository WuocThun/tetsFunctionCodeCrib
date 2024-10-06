<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin'); // Chỉ cho phép admin truy cập

    }
    public function index()
    {
        $users = User::all(); // Lấy danh sách người dùng với vai trò của
        $roles = Role::all();
        return view('admin.content.permissions.index', compact('users','roles',));
    }
    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->assignRole($request->role);
        return redirect()->back()->with('success', 'Role assigned successfully!');
    }

    public function revokeRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->removeRole($request->role);
        return redirect()->back()->with('success', 'Role revoked successfully!');
    }

}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        try {
            return response()->json(User::with('roles')->get());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role'    => 'required|exists:roles,name',
        ]);

        try {

            $user = User::find($request->user_id);
            $user->assignRole($request->role);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }

        return response()->json(['message' => 'Role assigned successfully']);
    }
}

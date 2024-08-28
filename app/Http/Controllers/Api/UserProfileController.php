<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|string|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->all());
        return response()->json($user);
    }
}

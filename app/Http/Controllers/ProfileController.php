<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'water_limit' => 'required|numeric|min:0',
            'electricity_limit' => 'required|numeric|min:0',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->water_limit = $request->water_limit;
        $user->electricity_limit = $request->electricity_limit;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}

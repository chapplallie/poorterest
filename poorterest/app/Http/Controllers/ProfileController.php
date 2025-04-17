<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    
    public function edit()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        if (!($user instanceof User)) {
            return redirect('/profile/edit')->withErrors(['user' => 'Utilisateur non trouvé']);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        $user->save();

        return redirect('/profile')->with('success', 'Profil mis à jour avec succès.');
    }

    public function deactivate()
    {
        $user = Auth::user();
        if (!($user instanceof User)) {
            return redirect('/profile/edit')->withErrors(['user' => 'Utilisateur non trouvé']);
        }
        $user->active = false;
        $user->save();

        Auth::logout();

        return redirect('/')->with('success', 'Votre compte a été désactivé avec succès.');
    }
}

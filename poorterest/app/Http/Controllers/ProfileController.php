<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $authUser = Auth::user();
        $user = User::findorFail($id);
        if ($authUser->id !== $user->id && !$authUser->isAdmin()) {
            return redirect()->back()->with('error', 'Action non autorisée.');
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        $user->save();

        if ($authUser->isAdmin() && $authUser->id !== $user->id) {
        return redirect()->route('users')->with('success', 'Profil utilisateur mis à jour avec succès.');
        }

        return redirect('/profile')->with('success', 'Profil mis à jour avec succès.');
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $authUser = Auth::user();
       
        if ($authUser->id === $user->id && $authUser->isAdmin()) {
            return redirect()->back()->with('error', 'L\'admin ne peut pas supprimer son propre compte.');
        };
       
        if ($authUser->id === $user->id) {
            $user->active = false;
            $user->save();
            Auth::logout();
            return redirect()->route('home')->with('success', 'Votre compte a été décactivé.');
        }
        
        if ($authUser->isAdmin()) {
            $user->active = false;
            $user->save();
            return redirect()->route('users')->with('success', 'Votre compte a été désactivé.');
        }
        
        return redirect()->back()->with('error', 'Action non autorisé.');
    }


    public function index(Request $request) {

        $users = User::all();
        return view('users', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('usersEdit', compact('user'));
    }
}

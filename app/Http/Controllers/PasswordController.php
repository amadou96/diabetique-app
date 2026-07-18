<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function showForm()
    {
        return view('auth.password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password'          => 'required',
            'password'                  => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Le mot de passe actuel est obligatoire.',
            'password.required'         => 'Le nouveau mot de passe est obligatoire.',
            'password.min'              => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed'        => 'La confirmation ne correspond pas.',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Mot de passe modifié avec succès.');
    }
}

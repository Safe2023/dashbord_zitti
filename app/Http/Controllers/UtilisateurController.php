<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edites()
    {
        $user = auth()->user();
        return view('profile', compact('user')); // ou return view('users.profile', ...)
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatees(Request $request)
    {
        $user = Auth::user();
        $request->validate([

    
            'photo_profil' => 'required|image|mimes:jpg,jpeg,png|max:2048',


        ]);

        $imageName = time() . '.' . $request->photo_profil->extension();
        $request->photo_profil->move(public_path('upload/users'), $imageName);

        $user->photo_profil = $imageName;
       
        $user->save();

        return back()->with('success', 'Votre photo de profile a bien été changé.');
    }
    public function updateesProfil(Request $request)
    {
        $user = Auth::user();
        $request->validate([

            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,



        ]);

        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;

        $user->save();

        return back()->with('success', 'Information mise à jour avec succes.');
    }
    public function updateePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);


        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Ancien mot de passe incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Mot de passe mis à jour.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function customer()
    {
        $users = User::where('account_type', 'customer')->get();
        return view('utilisateurs', compact('users'))->with('title', 'Administrateurs');
    }

    public function admin_list()
    {
        $users = User::where('account_type', 'admin')->get();
        return view('utilisateurs', compact('users'))->with('title', 'Administrateurs');
    }
    public function livreur_interne()
    {
        $users = User::where('account_type', 'livreur_intern')->get();
        return view('utilisateurs', compact('users'))->with('title', 'Livreurs Internes');
    }

    public function livreur_externe()
    {
        $users = User::where('account_type', 'livreur_extern')->get();
        return view('utilisateurs', compact('users'))->with('title', 'Livreurs Externes');
    }

    /* public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->route('utilisateurs')->with('success', 'Statut mis à jour.');
    } */

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->account_type === 'admin') {
            return redirect()->back()->with('error', 'Impossible de supprimer un administrateur.');
        }

        $user->delete();
        return redirect()->back()->with('success', 'Utilisateur supprimé.');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('utilisateurs_update', compact('user'));
    }

   public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'date_of_birth' => 'nullable|date',
        'country' => 'nullable|string|max:100',
        'lang' => 'nullable|string|max:50',
        'address' => 'nullable|string|max:255',
        'type_engin' => 'nullable|string|max:100',
        'immatriculation' => 'nullable|string|max:100',
        'numéro_cip' => 'nullable|string|max:100',
        'numMatricule' => 'nullable|string|max:100',
        'status' => 'required|in:inactive,active,attente,confirmer,rejette,desactive',
        'photo_profil' => 'nullable|image|max:2048',
        'photo_cip' => 'nullable|image|max:2048',
    ]);

    // Préparation des données à mettre à jour
    $data = $request->only([
        'firstName', 'lastName', 'email', 'phone',
        'date_of_birth', 'country', 'lang', 'address',
        'type_engin', 'immatriculation', 'numéro_cip',
        'numMatricule', 'status'
    ]);

    // Traitement des images si présentes
    if ($request->hasFile('photo_profil')) {
        $data['photo_profil'] = $request->file('photo_profil')->store('photos_profil', 'public');
    }

    if ($request->hasFile('photo_cip')) {
        $data['photo_cip'] = $request->file('photo_cip')->store('photos_cip', 'public');
    }

    // Mise à jour
    $user->update($data);

    return redirect()->back()->with('success', 'Utilisateur mis à jour avec succès.');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

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
}

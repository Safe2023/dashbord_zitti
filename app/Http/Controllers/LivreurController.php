<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;

class LivreurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livreurs = Livreur::all();
        return view('admin.livreurs.index', compact('livreurs'));
    }

    public function create()
    {
        return view('admin.livreurs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:livreurs',
            'telephone' => 'required',
            'type' => 'required|in:interne,externe',
            'adresse' => 'nullable|string',
            'photo' => 'nullable|image',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('livreurs', 'public');
        }

        Livreur::create($data);

        return redirect()->route('admin.livreurs.index')->with('success', 'Livreur ajouté avec succès.');
    }


    /**
     * Store a newly created resource in storage.
     */
    
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
        public function edit(string $id)
        {
            return view('admin.livreurs.edit', compact('livreur'));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, Livreur $livreur)
        {
          $data = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:livreurs,email,' . $livreur->id,
            'telephone' => 'required',
            'type' => 'required|in:interne,externe',
            'adresse' => 'nullable|string',
            'photo' => 'nullable|image',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('livreurs', 'public');
        }

        $livreur->update($data);

        return redirect()->route('admin.livreurs.index')->with('success', 'Livreur mis à jour.');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Livreur  $livreur)
    {
        $livreur->delete();
        return redirect()->route('admin.livreurs.index')->with('success', 'Livreur supprimé.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Livraison;
use App\Models\User;
use Illuminate\Http\Request;

class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $livraisons = Livraison::latest()->paginate(10);
        return view('livraisons', compact('livraisons'));
    }

    public function create()
    {
        $livreurs = User::whereIn('account_type', ['livreur_interne', 'livreur_externe'])->get();
        $commandes = Commande::all(); 
        return view('livraisons', compact('livreurs', 'commandes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'livreur_id' => 'required|exists:users,id',
            'date_debut' => 'required|date',
            'distance_parcourue' => 'nullable|numeric',
            'position_actuelle' => 'nullable|string',
            'gps_actif' => 'required|boolean',
        ]);

        Livraison::create($request->all());

        return redirect()->route('livraisons')->with('success', 'Livraison créée.');
    }

    public function edit(Livraison $livraison)
    {
        $livreurs = User::whereIn('account_type', ['livreur_interne', 'livreur_externe'])->get();
        $commandes = Commande::all();
        return view('livraisons.edit', compact('livraison', 'livreurs', 'commandes'));
    }

    public function update(Request $request, Livraison $livraison)
    {
        $request->validate([
            'statut' => 'required|in:En attente,En cours,Livrée,Échouée',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date',
            'distance_parcourue' => 'nullable|numeric',
            'position_actuelle' => 'nullable|string',
            'gps_actif' => 'required|boolean',
        ]);

        $livraison->update($request->all());

        return redirect()->route('livraisons.index')->with('success', 'Livraison mise à jour.');
    }

    public function destroy(Livraison $livraison)
    {
        $livraison->delete();
        return redirect()->route('livraisons.index')->with('success', 'Livraison supprimée.');
    }
}

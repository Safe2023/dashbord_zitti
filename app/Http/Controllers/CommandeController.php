<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $commandes = Commande::with('customer')->get();

        $clients = User::where('account_type', 'customer')->get();
        return view('commande', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required',
            'adresse_depart' => 'required',
            'nom_dep' => 'required',
            'tel_dep' => 'required',
            'description_dep' => 'nullable',
            'adresse_desti' => 'required',
            'nom_desti' => 'required',
            'tel_desti' => 'required',
            'description_desti' => 'nullable',
            'poids' => 'nullable',
            'taille' => 'nullable',
            'message' => 'nullable',
            'prix' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('commandes', 'public');
        }

        Commande::create($data);
        return redirect()->back()->with('success', 'Commande ajoutée avec succès.');
    }
    public function updateStatut(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);

        $validated = $request->validate([
            'statut' => 'required|in:en_attente,en_cours,terminee,annulee',
        ]);

        $commande->statut = $validated['statut'];
        $commande->save();

        return back()->with('success', 'Statut mis à jour avec succès.');
    }

   public function commandesParStatut($statut)
{
    $commandes = Commande::where('statut', $statut)->get();
    return view('commande.liste', compact('commandes', 'statut'));
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
    public function edite($id)
    {
        $commandes = Commande::findOrFail($id);
        $clients = User::where('account_type', 'customer')->get();
        return view('commande_update', compact('commandes', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updates(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);

        $data = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'adresse_depart' => 'required|string',
            'nom_dep' => 'required|string',
            'tel_dep' => 'required|string',
            'description_dep' => 'nullable|string',
            'adresse_desti' => 'required|string',
            'nom_desti' => 'required|string',
            'tel_desti' => 'required|string',
            'description_desti' => 'nullable|string',
            'poids' => 'nullable|string',
            'taille' => 'nullable|string',
            'message' => 'nullable|string',
            'prix' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('commandes');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            if ($commande->image && file_exists(public_path('commandes/' . $commande->image))) {
                unlink(public_path('commandes/' . $commande->image));
            }

            $data['image'] = $imageName;
        }

        $commande->update($data);

        return redirect()->back()->with('success', 'Commande mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroys($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->delete();

        return redirect()->back()->with('success', 'Commande supprimée avec succès.');
    }
    public function commande_table()
    {
        $commandes = Commande::all();
        $clients = User::where('account_type', 'customer')->get();
        return view('commande_table', compact('commandes', 'clients'));
    }

    public function commande_en_attente()
    {
        $commandes = Commande::where('statut', 'en_attente')->get();
        $clients = User::all();
        return view('commande_table', compact('commandes', 'clients'))->with('title', 'Commandes en attente');
    }

    public function commande_en_cours()
    {
        $commandes = Commande::where('statut', 'en_cours')->get();
        $clients = User::all();
        return view('commande_table', compact('commandes', 'clients'))->with('title', 'Commandes en cours');
    }

    public function commande_terminee()
    {
        $commandes = Commande::where('statut', 'terminee')->get();
        $clients = User::all();
        return view('commande_table', compact('commandes', 'clients'))->with('title', 'Commandes terminée');
    }

    public function commande_annulee()
    {
        $commandes = Commande::where('statut', 'annulee')->get();
        $clients = User::all();
        return view('commande_table', compact('commandes', 'clients'))->with('title', 'Commandes annulée');
    }
}

@extends('layouts.header')
@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">


            <div class="filter cm-content-box box-primary mb-4">
                <div class="content-title d-flex justify-content-between align-items-center">
                    <div class="cpa"><i class="fa-solid fa-filter me-2"></i>Filtrer</div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <div class="cm-content-body form excerpt">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 mb-3">
                                <input type="text" class="form-control" placeholder="Titre">
                            </div>
                            <!--  <div class="col-xl-3 col-sm-6 mb-3">
                                <select class="form-select">
                                    <option value="1"> <a href=""></a>En attente </option>
                                    <option value="2">En cours</option>
                                    <option value="3">Treminer</option>
                                    <option value="4">Annuler</option>
                                  
                                </select>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif


            <div class="filter cm-content-box box-primary">
                <div class="content-title d-flex justify-content-between align-items-center">
                    @php
                    $titres = [
                    'en_attente' => 'Commandes en attente',
                    'en_cours' => 'Commandes en cours',
                    'terminee' => 'Commandes terminées',
                    'annulee' => 'Commandes annulées',
                    ];

                    $titreCommande = $titres[$statut ?? ''] ?? 'Liste des commandes';
                    @endphp

                    <div class="cpa">
                        <i class="fa-solid fa-box me-1"></i> {{ $titreCommande }}
                    </div>

                    <div class="tools">

                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ajouterCommandeModal">
                            <i class="fa fa-plus"></i> Nouvelle commande
                        </button>

                        <div class="modal fade" id="ajouterCommandeModal" tabindex="-1" aria-labelledby="ajouterCommandeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <form action="{{ route('commande') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ajouterCommandeModalLabel">Ajouter une nouvelle commande</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="customer_id">Client</label>
                                                    <select name="customer_id" id="customer_id" class="form-select" required>
                                                        <option value="">Sélectionner un client</option>
                                                        @foreach($clients as $client)
                                                        <option value="{{ $client->id }}">
                                                            {{ $client->firstName }} {{ $client->lastName }} (ID: {{ $client->id }})
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Adresse de départ</label>
                                                    <input type="text" name="adresse_depart" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label>Nom de l'expéditeur</label>
                                                    <input type="text" name="nom_dep" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Téléphone de l'expéditeur</label>
                                                    <input type="text" name="tel_dep" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label>Description</label>
                                                    <textarea name="description_dep" class="form-control"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Adresse de destination</label>
                                                    <input type="text" name="adresse_desti" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label>Nom du destinataire</label>
                                                    <input type="text" name="nom_desti" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Téléphone du destinataire</label>
                                                    <input type="text" name="tel_desti" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label>Description de la commande</label>
                                                    <textarea name="description_desti" class="form-control"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Poids</label>
                                                    <input type="text" name="poids" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label>Taille</label>
                                                    <input type="text" name="taille" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Message</label>
                                                    <textarea name="message" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label>Image (facultatif)</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Prix (€)</label>
                                                    <input type="number" name="prix" class="form-control" step="0.01" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="cm-content-body form excerpt">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-responsive-sm mb-0 table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client</th>
                                        <th>Nom depart</th>
                                        <th>Nom destination</th>
                                        <th>Téléphone depart</th>
                                        <th>Adresse de depart</th>
                                        <th>Adresse destinataire</th>
                                        <th>Téléphone destinataire</th>

                                        <th>Taille</th>
                                        <th>Message</th>
                                        <th>Image</th>
                                        <th>Poids</th>
                                        <th>Prix</th>
                                        <th>Créé le</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($commandes as $index => $commande)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td> {{ $commande->customer?->firstName }} {{ $commande->customer?->lastName }}</td>
                                        <td>{{ $commande->nom_dep }}</td>
                                        <td>{{ $commande->nom_desti }}</td>
                                        <td>{{ $commande->tel_dep }}</td>
                                        <td>{{ $commande->adresse_depart }}</td>
                                        <td>{{ $commande->adresse_desti }}</td>
                                        <td>{{ $commande->tel_desti }}</td>
                                        <td>{{ $commande->taille ?? '-' }}</td>
                                        <td>{{ $commande->message ?? '-' }}</td>
                                        <td>{{ $commande->image ?? '-' }}</td>
                                        <td>{{ $commande->poids ?? '-' }}</td>
                                        <td>{{ $commande->prix }} </td>
                                        <td>{{ $commande->created_at->format('d/m/Y') }}</td>

                                        <td>
                                            <form action="{{ route('commandes.update.statut', $commande->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                                @csrf
                                                @method('PUT')
                                                <select name="statut" onchange="this.form.submit()" class="form-select form-select-sm w-auto">
                                                    <option value="en_attente" {{ $commande->statut === 'en_attente' ? 'selected' : '' }}>En attente</option>
                                                    <option value="en_cours" {{ $commande->statut === 'en_cours' ? 'selected' : '' }}>En cours</option>
                                                    <option value="terminee" {{ $commande->statut === 'terminee' ? 'selected' : '' }}>Terminée</option>
                                                    <option value="annulee" {{ $commande->statut === 'annulee' ? 'selected' : '' }}>Annulée</option>
                                                </select>
                                            </form>
                                        </td>


                                        <td>
                                            <div class="d-flex gap-1">
                                                <!-- bouton -->
                                                <!-- Bouton pour ouvrir le modal -->
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editCommandeModal{{ $commande->id }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editCommandeModal{{ $commande->id }}" tabindex="-1" aria-labelledby="editCommandeModalLabel{{ $commande->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <form action="{{ route('commande.updates', $commande->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editCommandeModalLabel{{ $commande->id }}">Modifier la commande #{{ $commande->id }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label for="customer_id">Client</label>
                                                                            <select name="customer_id" id="customer_id" class="form-select" required>
                                                                                <option value="">Sélectionner un client</option>
                                                                                @foreach($clients as $client)
                                                                                <option value="{{ $client->id }}" {{ $client->id == old('customer_id', $commande->customer_id) ? 'selected' : '' }}>
                                                                                    {{ $client->firstName }} {{ $client->lastName }} (ID: {{ $client->id }})
                                                                                </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label>Adresse de départ</label>
                                                                            <input type="text" name="adresse_depart" class="form-control" value="{{ old('adresse_depart', $commande->adresse_depart) }}" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label>Nom de l'expéditeur</label>
                                                                            <input type="text" name="nom_dep" class="form-control" value="{{ old('nom_dep', $commande->nom_dep) }}" required>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label>Téléphone de l'expéditeur</label>
                                                                            <input type="text" name="tel_dep" class="form-control" value="{{ old('tel_dep', $commande->tel_dep) }}" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label>Description expéditeur</label>
                                                                            <textarea name="description_dep" class="form-control">{{ old('description_dep', $commande->description_dep) }}</textarea>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label>Adresse de destination</label>
                                                                            <input type="text" name="adresse_desti" class="form-control" value="{{ old('adresse_desti', $commande->adresse_desti) }}" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label>Nom du destinataire</label>
                                                                            <input type="text" name="nom_desti" class="form-control" value="{{ old('nom_desti', $commande->nom_desti) }}" required>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label>Téléphone du destinataire</label>
                                                                            <input type="text" name="tel_desti" class="form-control" value="{{ old('tel_desti', $commande->tel_desti) }}" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label>Description destinataire</label>
                                                                            <textarea name="description_desti" class="form-control">{{ old('description_desti', $commande->description_desti) }}</textarea>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label>Poids</label>
                                                                            <input type="text" name="poids" class="form-control" value="{{ old('poids', $commande->poids) }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label>Taille</label>
                                                                            <input type="text" name="taille" class="form-control" value="{{ old('taille', $commande->taille) }}">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label>Message</label>
                                                                            <textarea name="message" class="form-control">{{ old('message', $commande->message) }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label>Image (facultatif)</label>
                                                                            @if($commande->image)
                                                                            <div class="mb-2">
                                                                                <img src="{{ asset('storage/' . $commande->image) }}" alt="Image actuelle" width="150">
                                                                            </div>
                                                                            @endif
                                                                            <input type="file" name="image" class="form-control">
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <label>Prix</label>
                                                                            <input type="number" name="prix" class="form-control" step="0.01" value="{{ old('prix', $commande->prix) }}" required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                <form action="{{ route('commande.destroys', $commande->id) }}" method="POST" onsubmit="return confirm('Supprimer cette commande ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" title="Supprimer">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>



                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">Aucune commande trouvée.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



@endsection
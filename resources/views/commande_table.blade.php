@extends('layouts.header')
@section('content')

<div class="container-fluid">

    <div class="row">


        <div class="form-head d-flex mb-3 align-items-start">
            <div class="me-auto d-none d-lg-block">
                <h2 class="text-primary font-w600 mb-0">Tableau de bord</h2>
                <p class="mb-0">Bienvenue <strong>{{Auth::user()->lastName}} <strong>{{Auth::user()->firstName}}</strong></span></strong></span></p>
            </div>
            @php
            use Carbon\Carbon;
            $now = Carbon::now()->locale('fr_FR');
            @endphp

            <div class="dropdown custom-dropdown">
                <div class="btn btn-sm btn-primary light d-flex align-items-center svg-btn" data-bs-toggle="dropdown">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path d="M22.4281 2.856H21.8681V1.428C21.8681 0.56 21.2801 0 20.4401 0C19.6001 0 19.0121 0.56 19.0121 1.428V2.856H9.71606V1.428C9.71606 0.56 9.15606 0 8.28806 0C7.42006 0 6.86006 0.56 6.86006 1.428V2.856H5.57206C2.85606 2.856 0.560059 5.152 0.560059 7.868V23.016C0.560059 25.732 2.85606 28.028 5.57206 28.028H22.4281C25.1441 28.028 27.4401 25.732 27.4401 23.016V7.868C27.4401 5.152 25.1441 2.856 22.4281 2.856ZM5.57206 5.712H22.4281C23.5761 5.712 24.5841 6.72 24.5841 7.868V9.856H3.41606V7.868C3.41606 6.72 4.42406 5.712 5.57206 5.712ZM22.4281 25.144H5.57206C4.42406 25.144 3.41606 24.136 3.41606 22.988V12.712H24.5561V22.988C24.5841 24.136 23.5761 25.144 22.4281 25.144Z" fill="#2F4CDD" />
                        </g>
                    </svg>
                    <div class="text-start ms-3">
                        <span class="d-block fs-16">Aujourd'hui</span>
                        <small class="d-block fs-13">
                            {{ $now->translatedFormat('d F Y') }} - {{ $now->format('H:i') }}
                        </small>
                    </div>
                    <i class="fa fa-angle-down scale5 ms-3"></i>
                </div>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Rafraîchir</a>
                </div>
            </div>

        </div>
        <div class="col-md-12">


            <div class="filter cm-content-box box-primary mb-4">
                <div class="content-title d-flex justify-content-between align-items-center">
                    <div class="cpa"><i class="fa-solid fa-filter me-2"></i>Filtrer</div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <div class="cm-content-body form excerpt">
                    <form method="GET" action="{{ route('commande_table') }}" class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label for="date_debut" class="form-label">Date début</label>
                            <input type="date" vvvvv                                                                                                                         ="date_debut" value="{{ request('date_debut') }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="date_fin" class="form-label">Date fin</label>
                            <input type="date" name="date_fin" value="{{ request('date_fin') }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="adresse_desti" class="form-label">Destination</label>
                            <input type="text" name="adresse_desti" value="{{ request('adresse_desti') }}" class="form-control" placeholder="Ex: Calavi">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                        </div>
                    </form>

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
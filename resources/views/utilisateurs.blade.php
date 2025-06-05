@extends('layouts.header')
@section('content')

<!-- <div class="container mt-5">
    <h2 class="mb-4 text-center">Gestion des utilisateurs</h2>

   
    

</div> -->




<div class="container-fluid">
    <!-- Breadcrumb -->
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
                    <div class="cpa"><i class="fa-solid fa-file-lines me-1"></i>Liste des utilisateurs</div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                    </div>
                </div>

                <div class="cm-content-body form excerpt">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-responsive-sm mb-0 table-hover">
                                <thead>
                                    <tr>
                                        <th><input class="form-check-input" type="checkbox" id="checkAll"></th>
                                        <th>S.No</th>
                                        <th>Photo profil</th>
                                        <th>Photo CIP</th>
                                        <th>Nom complet</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Date de naissance</th>
                                        <th>Pays</th>
                                        <th>Langue</th>
                                        <th>Adresse</th>
                                        <th>Type engin</th>
                                        <th>Immatriculation</th>
                                        <th>Numéro CIP</th>
                                        <th>Numéro matricule</th>
                                        <th>Créé le</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $index => $user)
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input"></td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if ($user->photo_profil)
                                            <img src="{{ asset('storage/' . $user->photo_profil) }}" alt="Photo de profil" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->photo_cip)
                                            <img src="{{ asset('storage/' . $user->photo_cip) }}" alt="Photo CIP" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{ $user->lastName }} {{ $user->firstName }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone ?? '-' }}</td>
                                        <td>{{ $user->date_of_birth ?? '-' }}</td>
                                        <td>{{ $user->country ?? '-' }}</td>
                                        <td>{{ $user->lang ?? '-' }}</td>
                                        <td>{{ $user->address ?? '-' }}</td>

                                        <td>{{ $user->type_engin?? '-' }}</td>
                                        <td>{{ $user->immatriculation ?? '-' }}</td>

                                        <td>{{ $user->numéro_cip ?? '-' }}</td>

                                        <td>{{ $user->numMatricule ?? '-' }}</td>

                                        <!-- <td>
                                            @php
                                            $roles = [
                                            'admin' => 'Administrateur',
                                            'customer' => 'Customer',
                                            'livreur_intern' => 'Livreur Interne',
                                            'livreur_extern' => 'Livreur Externe'
                                            ];
                                            @endphp
                                            <span class="badge
                                                @switch($user->account_type)
                                                    @case('admin') bg-danger @break
                                                    @case('user') bg-secondary @break
                                                    @case('livreur_intern') bg-success @break
                                                    @case('livreur_extern') bg-warning text-dark @break
                                                    @default bg-light
                                                @endswitch">
                                                {{ $roles[$user->account_type] ?? $user->account_type }}
                                            </span>
                                        </td> -->
                                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge 
                                    @switch($user->status)
                                        @case('active') bg-success @break
                                        @case('inactive') bg-secondary @break
                                        @case('attente') bg-warning text-dark @break
                                        @case('confirmer') bg-info @break
                                        @case('rejette') bg-danger @break
                                        @case('desactive') bg-dark text-light @break
                                        @default bg-light
                                    @endswitch">
                                                {{ ucfirst($user->status) }}
                                            </span>
                                        </td>


                                        <td>
                                            <div class="d-flex gap-1">

                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                <!-- Modal d'édition -->
                                                <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <form method="POST" action="{{ route('utilisateurs.update', $user->id) }}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Modifier l'utilisateur #{{ $user->id }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                                </div>
                                                                <div class="modal-body row g-3">

                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Prénom</label>
                                                                        <input type="text" name="firstName" class="form-control" value="{{ $user->firstName }}" required>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Nom</label>
                                                                        <input type="text" name="lastName" class="form-control" value="{{ $user->lastName }}" required>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Email</label>
                                                                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Téléphone</label>
                                                                        <input type="tel" name="phone" class="form-control" value="{{ $user->phone }}" pattern="[0-9+\s]{8,15}" title="Numéro de téléphone valide requis">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Date de naissance</label>
                                                                        <input type="date" name="date_of_birth" class="form-control" value="{{ $user->date_of_birth }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Pays</label>
                                                                        <input type="text" name="country" class="form-control" value="{{ $user->country }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Langue</label>
                                                                        <input type="text" name="lang" class="form-control" value="{{ $user->lang }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Adresse</label>
                                                                        <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Type d'engin</label>
                                                                        <input type="text" name="type_engin" class="form-control" value="{{ $user->type_engin }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Immatriculation</label>
                                                                        <input type="text" name="immatriculation" class="form-control" value="{{ $user->immatriculation }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Photo de profil</label>
                                                                        <input type="file" name="photo_profil" class="form-control" accept="image/*">
                                                                        @if($user->photo_profil)
                                                                        <small>Image actuelle :</small><br>
                                                                        <img src="{{ asset('storage/' . $user->photo_profil) }}" alt="Photo actuelle" width="70" class="mb-2 rounded">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Numéro CIP</label>
                                                                        <input type="text" name="numéro_cip" class="form-control" value="{{ $user->numéro_cip }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Photo CIP</label>
                                                                        <input type="file" name="photo_cip" class="form-control" accept="image/*">
                                                                        @if($user->photo_cip)
                                                                        <small>Image actuelle :</small><br>
                                                                        <img src="{{ asset('storage/' . $user->photo_cip) }}" alt="Photo CIP actuelle" width="70" class="mb-2">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Numéro matricule</label>
                                                                        <input type="text" name="numMatricule" class="form-control" value="{{ $user->numMatricule }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Status</label>
                                                                        <select name="status" class="form-select">
                                                                            <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                                            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                                                            <option value="attente" {{ $user->status == 'attente' ? 'selected' : '' }}>En attente</option>
                                                                            <option value="confirmer" {{ $user->status == 'confirmer' ? 'selected' : '' }}>Confirmé</option>
                                                                            <option value="rejette" {{ $user->status == 'rejette' ? 'selected' : '' }}>Rejeté</option>
                                                                            <option value="desactive" {{ $user->status == 'desactive' ? 'selected' : '' }}>Désactivé</option>
                                                                        </select>
                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                                <!-- Supprimer -->
                                                <form action="{{ route('utilisateurs.delete', $user->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
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
                                        <td colspan="12" class="text-center">Aucun utilisateur trouvé.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
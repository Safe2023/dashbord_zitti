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
            <div class="filter cm-content-box box-primary mb-4 ">
                <div class="content-title d-flex justify-content-between align-items-center">
                    <div class="cpa"><i class="fa-solid fa-filter me-2"></i>Filtrer</div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <form method="GET" action="{{ route('utilisateurs') }}" class="row g-2 mb-3">
                    <div class="col-md-4 mb-4">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Rechercher nom, prénom ou email">
                    </div>

                    <div class="col-md-3 mb-4">
                        <select name="sort" class="form-select">
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date de création</option>
                            <option value="lastName" {{ request('sort') == 'lastName' ? 'selected' : '' }}>Nom</option>
                            <option value="email" {{ request('sort') == 'email' ? 'selected' : '' }}>Email</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-4">
                        <select name="direction" class="form-select">
                            <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Croissant</option>
                            <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Décroissant</option>
                        </select>
                    </div>

                    <div class="col-md-2 mb-4">
                        <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                    </div>
                </form>
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
                                    @if($users->isEmpty())
                                    <tr>
                                        <td colspan="12" class="text-center">Aucun utilisateur trouvé.</td>
                                    </tr>
                                    @else

                                    @foreach ($users as $index => $user)
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input"></td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if ($user->photo_profil)
                                            <img src="{{ asset('upload/users/' . $user->photo_profil) }}" alt="Photo de profil" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->photo_cip)
                                            <img src="{{ asset('upload/users/' . $user->photo_cip) }}" alt="Photo CIP" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
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

                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="row mt-5 mb-5">
                                <div class="col-md-12 d-flex justify-content-center">

                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
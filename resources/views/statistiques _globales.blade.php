<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <div class="content-body">
        <div class="container-fluid">
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">CMS</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Blog</a></li>
                        </ol>
                    </div>
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title">
                            <div class="cpa">
                                <i class="fa-solid fa-filter me-2"></i>Filter
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6">
                                        <input type="text" class="form-control mb-3 mb-xl-0" id="exampleFormControlInput1" placeholder="Title">
                                    </div>
                                    <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                                        <select class="default-select dashboard-select-2 wide w-100">
                                            <option selected>Select Status</option>
                                            <option value="1">Published</option>
                                            <option value="2">Draft</option>
                                            <option value="3">Trash</option>
                                            <option value="4">Private</option>
                                            <option value="5">Pending</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-sm-6">
                                        <input id="datepicker" class=" form-control mb-3 mb-xl-0">
                                    </div>
                                    <div class="col-xl-3 col-sm-6">
                                        <button class="btn btn-primary" title="Click here to Search" type="button"><i class="fa fa-search me-1"></i>Filter</button>
                                        <button class="btn btn-danger light" title="Click here to remove filter" type="button">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <ul class="d-flex align-items-center flex-wrap">
                            <li><a href="add-blog.html" class="btn btn-primary ">Add Blog</a></li>
                            <li><a href="blog-category.html" class="btn btn-primary mx-1">Blog Category</a></li>
                            <li><a href="blog-category.html" class="btn btn-primary mt-sm-0 mt-1">Add Blog Category</a></li>
                        </ul>
                    </div>
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title">
                            <div class="cpa">
                                <i class="fa-solid fa-file-lines me-1"></i>Blogs List
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-responsive-sm mb-0">
                                        <thead>
                                            <tr>
                                                <th style="">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="checkAll">
                                                        <label class="form-check-label" for="checkAll">

                                                        </label>
                                                    </div>
                                                </th>
                                                <th>S.No</th>
                                                <th><strong>Nom complet</strong></th>
                                                <th><strong>Email</strong></th>
                                                <th><strong>Téléphone</strong></th>
                                                <th><strong>Date de naissance</strong></th>
                                                <th><strong>Pays</strong></th>
                                                <th><strong>Langue</strong></th>
                                                <th><strong>Adresse</strong></th>
                                                <th><strong>Rôle</strong></th>
                                                <th><strong>Créé le</strong></th>
                                                <th style="width:85px;"><strong>Actions</strong></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->lastName }} {{ $user->firstName }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone ?? '-' }}</td>
                                                <td>{{ $user->date_of_birth ?? '-' }}</td>
                                                <td>{{ $user->country ?? '-' }}</td>
                                                <td>{{ $user->lang ?? '-' }}</td>
                                                <td>{{ $user->address ?? '-' }}</td>
                                                <td>
                                                    @php
                                                    $roles = [
                                                    'admin' => 'Administrateur',
                                                    'user' => 'Utilisateur',
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
                                                </td>
                                                <td>{{ $user->created_at->format('d/m/Y') }}</td>


                                                <td>
                                                    <div class="d-flex gap-1">
                                                        {{-- Modifier --}}
                                                        <!--   <a href="{{ route('utilisateurs.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Modifier">
                                                      <i class="bi bi-pencil-square"></i>
                                                                     </a> -->
                                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <form method="POST" action="{{ route('utilisateurs.update', $user->id) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Modifier l'utilisateur #{{ $user->id }}</h5>
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
                                                                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
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
                                                                                <label class="form-label">Rôle</label>
                                                                                <select name="account_type" class="form-select">
                                                                                    <option value="user" {{ $user->account_type == 'user' ? 'selected' : '' }}>Utilisateur</option>
                                                                                    <option value="admin" {{ $user->account_type == 'admin' ? 'selected' : '' }}>Administrateur</option>
                                                                                    <option value="livreur_intern" {{ $user->account_type == 'livreur_intern' ? 'selected' : '' }}>Livreur Interne</option>
                                                                                    <option value="livreur_extern" {{ $user->account_type == 'livreur_extern' ? 'selected' : '' }}>Livreur Externe</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-check-label">Actif</label>
                                                                                <div class="form-check form-switch">
                                                                                    <input class="form-check-input" type="checkbox" name="is_active" {{ $user->is_active ? 'checked' : '' }}>
                                                                                </div>
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
                                                        {{-- Supprimer --}}
                                                        <form action="{{ route('utilisateurs.delete', $user->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger" title="Supprimer">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>

                                                        {{-- Désactiver / Activer --}}
                                                        <form action="{{ route('utilisateurs.toggleStatus', $user->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm {{ $user->is_active ? 'btn-secondary' : 'btn-success' }}" title="{{ $user->is_active ? 'Désactiver' : 'Activer' }}">
                                                                <i class="bi {{ $user->is_active ? 'bi-lock' : 'bi-unlock' }}"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="11" class="text-center">Aucun utilisateur trouvé.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>
                                <div class="d-flex align-items-center justify-content-xl-between flex-wrap justify-content-center mt-3">
                                    <small>Page 1 of 5, showing 2 records out of 8 total, starting on record 1, ending on 2</small>
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination mb-2 mb-sm-0">
                                            <li class="page-item"><a class="page-link" href="javascript:void(0);"><i class="fa-solid fa-angle-left"></i></a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                            <li class="page-item"><a class="page-link " href="javascript:void(0);"><i class="fa-solid fa-angle-right"></i></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <td>
        <a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp rounded-circle me-1"><i class="fa fa-pencil"></i></a>
        <a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp rounded-circle"><i class="fa fa-trash"></i></a>
    </td>

</body>

</html>



  <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <form method="POST" action="{{ route('utilisateurs.update', $user->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Modifier l'utilisateur #{{ $user->id }}</h5>
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
                                                                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
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
                                                                        <label class="form-label">Rôle</label>
                                                                        <select name="account_type" class="form-select">
                                                                            <option value="user" {{ $user->account_type == 'user' ? 'selected' : '' }}>Utilisateur</option>
                                                                            <option value="admin" {{ $user->account_type == 'admin' ? 'selected' : '' }}>Administrateur</option>
                                                                            <option value="livreur_intern" {{ $user->account_type == 'livreur_intern' ? 'selected' : '' }}>Livreur Interne</option>
                                                                            <option value="livreur_extern" {{ $user->account_type == 'livreur_extern' ? 'selected' : '' }}>Livreur Externe</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-check-label">Actif</label>
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input" type="checkbox" name="is_active" {{ $user->is_active ? 'checked' : '' }}>
                                                                        </div>
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
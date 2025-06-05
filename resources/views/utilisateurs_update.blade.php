@extends('layouts.header')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Modifier l'utilisateur</h3>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Erreurs :</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('utilisateurs.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

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
<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="{{ route('utilisateurs') }}" class="btn btn-secondary">Annuler</a>
</div>
</form>
</div>
@endsection
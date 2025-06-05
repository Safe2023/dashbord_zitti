<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>

    <div class="conatiner">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">

                <h2 class="mb-4 mt-5 text-center">Créer une livraison</h2>
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
                <form action="{{ route('livraisons') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Commande</label>
                            <select name="commande_id" class="form-select" required>
                                @foreach($commandes as $commande)
                                <option value="{{ $commande->id }}">{{ $commande->id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Livreur</label>
                            <select name="livreur_id" class="form-select" required>
                                @foreach($livreurs as $livreur)
                                <option value="{{ $livreur->id }}">{{ $livreur->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class=" col-md-6">
                            <label class="form-label">Date début</label>
                            <input type="datetime-local" name="date_debut" class="form-control" required>
                        </div>

                        <div class=" col-md-6">
                            <label class="form-label">Date fin</label>
                            <input type="datetime-local" name="date_fin" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Position actuelle</label>
                            <input type="text" name="position_actuelle" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Distance parcourue (km)</label>
                            <input type="number" step="0.1" name="distance_parcourue" class="form-control" value="0">
                        </div>
                    </div>

                    <div class="row mb-3">

                        <div class=" col-md-6">
                            <label class="form-label">Statut</label>
                            <select name="statut" class="form-select" required>
                                @foreach(['En attente', 'En cours', 'Livrée', 'Échouée'] as $statut)
                                <option value="{{ $statut }}">{{ $statut }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">GPS actif</label>
                            <select name="gps_actif" class="form-select">
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>

</html>
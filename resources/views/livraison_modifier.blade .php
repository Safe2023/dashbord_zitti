<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>

            <h2 class="mb-4">Modifier la livraison #{{ $livraison->id }}</h2>

            <form action="{{ route('livraisons.update', $livraison->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Commande</label>
                    <select name="commande_id" class="form-select">
                        @foreach($commandes as $commande)
                        <option value="{{ $commande->id }}" {{ $commande->id == $livraison->commande_id ? 'selected' : '' }}>
                            {{ $commande->id }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Livreur</label>
                    <select name="livreur_id" class="form-select">
                        @foreach($livreurs as $livreur)
                        <option value="{{ $livreur->id }}" {{ $livreur->id == $livraison->livreur_id ? 'selected' : '' }}>
                            {{ $livreur->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Date début</label>
                    <input type="datetime-local" name="date_debut" class="form-control" value="{{ \Carbon\Carbon::parse($livraison->date_debut)->format('Y-m-d\TH:i') }}">
                </div>

                <div class="mb-3">
                    <label>Statut</label>
                    <select name="statut" class="form-select">
                        @foreach(['En attente', 'En cours', 'Livrée', 'Échouée'] as $statut)
                        <option value="{{ $statut }}" {{ $statut == $livraison->statut ? 'selected' : '' }}>
                            {{ $statut }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Position actuelle</label>
                    <input type="text" name="position_actuelle" class="form-control" value="{{ $livraison->position_actuelle }}">
                </div>

                <div class="mb-3">
                    <label>Distance parcourue (km)</label>
                    <input type="number" step="0.1" name="distance_parcourue" class="form-control" value="{{ $livraison->distance_parcourue }}">
                </div>

                <div class="mb-3">
                    <label>GPS actif</label>
                    <select name="gps_actif" class="form-select">
                        <option value="1" {{ $livraison->gps_actif ? 'selected' : '' }}>Oui</option>
                        <option value="0" {{ !$livraison->gps_actif ? 'selected' : '' }}>Non</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>


        <div class="col-md-3"></div>

    </div>
   
</body>

</html>
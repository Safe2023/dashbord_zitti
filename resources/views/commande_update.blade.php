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
            <div class="col-md-6 mx-auto">
                <div class="container mt-4">
                    <h4 class="mb-4 text-center">Modifier la commande</h4>

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('commande_update', $commande->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

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

                                                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                        </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>

</html>
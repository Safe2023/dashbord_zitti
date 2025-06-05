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
            <div class="col-md-6">
                <div class="container mt-4">
                    <h4 class="mb-4 text-center">Ajouter une nouvelle commande</h4>

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('commande') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="customer_id" >Client</label>
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
                                <label>Nom de l'expediteur</label>
                                <input type="text" name="nom_dep" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>Téléphone de l'expediteur</label>
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
                                <label>Nomde du destinataire</label>
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

                            <div class="col-md-6 mb-3">
                                <label>Prix (€)</label>
                                <input type="number" name="prix" class="form-control" step="0.01" required>
                            </div>

                        </div>


                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>

</html>



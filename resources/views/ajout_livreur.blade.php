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
                <h4 class="text-center mt-5 pt-5">Ajouter un livreur</h4>
                <form class="row g-3" method="post" enctype="multipart/form-data">
                     @csrf
                    @if (session ()-> has ('success') )
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif  
                    <div class="col-md-6">
                        <label for="text" class="form-label">Nom & prenom</label>
                        <input type="text" class="form-control" id="text" name="nomprenom">
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" name="email">
                    </div>

                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="inputtext" name="telephone">
                    </div>
                    <div class="col-md-6">
                        <label for="text" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="text" name="adresse">
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">State</label>
                        <select id="inputState" class="form-select" name="type">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo">
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>

            <div class="col-md-3"></div>

        </div>
    </div>


</body>

</html>
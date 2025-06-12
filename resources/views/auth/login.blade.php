
@extends('layouts.auth')

@section('title')
    Se connecter | Admin
@endsection

@section('content')
<div class="card overflow-hidden shadow">
    <div class="bg-primary bg-soft">
        <div class="row">
            <div class="col-7">
                <div class="text-primary p-4">
                    <h5 class="text-primary">Bienvenue !</h5>
                    <p>Veuillez entrer vos identifiants pour continuer la session.</p>
                </div>
            </div>
            <div class="col-5 align-self-end">
                <img src="images/dashbord/livraison.png" alt="Profil" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="card-body pt-0">
        <div class="auth-logo text-center">
            <a href="/" class="auth-logo-dark d-block mb-4">
                <div class="avatar-md profile-user-wid">
                    <span class="avatar-title rounded-circle bg-light">
                        <img src="images/dashbord/zitti.png" alt="Logo" class="rounded-circle" height="34">
                    </span>
                </div>
            </a>
        </div>

        <div class="p-2">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email" placeholder="Entrer votre email"
                        value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <div class="input-group auth-pass-inputgroup">
                        <input type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Entrer votre mot de passe"
                            id="password">
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                            <i class="mdi mdi-eye-outline" id="toggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>

                <div class="d-grid mt-3">
                    <button class="btn btn-primary" type="submit">Se connecter</button>
                </div>

                <div class="text-center mt-3">
                    @if (Route::has('password.request'))
                        <a class="text-muted" href="{{ route('password.request') }}">
                            <i class="mdi mdi-lock"></i> Mot de passe oublié ?
                        </a>
                    @endif

                    <p class="mt-2">Pas de compte ?
                        <a href="{{ route('register') }}" class="fw-medium text-primary">Créer maintenant</a>
                    </p>
                    <p class="mt-1">© <script>document.write(new Date().getFullYear())</script> MESSAGER EXPRESS</p>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

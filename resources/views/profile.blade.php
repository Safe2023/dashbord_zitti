@extends('layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

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
            <div class="row">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
                @endif
                <div class="col-md-3">
                    <form action="{{ route('profile.updatees') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ asset('upload/users/' . $user->photo_profil) }}" alt="Profil" class="avatar-xl rounded-circle img-thumbnail mb-2">
                                <input type="file" name="photo_profil" class="form-control mb-2">
                                <button type="submit" class="btn btn-sm btn-primary light">Changer la photo</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="details-tab" data-bs-toggle="tab" href="#details" role="tab">Détails personnels</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password" role="tab">Mot de passe</a>
                                </li>
                            </ul>

                            <div class="tab-content pt-3">
                                <!-- Détails personnels -->
                                <div class="tab-pane fade show active" id="details" role="tabpanel">
                                    <form action="{{ route('profile.updateesProfil') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <label>Nom</label>
                                                <input type="text" name="firstName" value="{{ old('firstName', $user->firstName) }}" class="form-control">
                                                @error('firstName') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label>Prénom</label>
                                                <input type="text" name="lastName" value="{{ old('lastName', $user->lastName) }}" class="form-control">
                                                @error('lastName') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label>E-mail</label>
                                                <input type="text" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-sm btn-primary light">Mettre à jour</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modifier le mot de passe -->
                                <div class="tab-pane fade" id="password" role="tabpanel">
                                    <form action="{{ route('profile.updateePassword') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <label>Ancien mot de passe</label>
                                                <input type="password" name="old_password" class="form-control">
                                                @error('old_password') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label>Nouveau mot de passe</label>
                                                <input type="password" name="password" class="form-control"> {{-- nom corrigé ici --}}
                                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label>Confirmer le mot de passe</label>
                                                <input type="password" name="password_confirmation" class="form-control">
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-sm btn-primary light">Changer le mot de passe</button>
                                        </div>
                                    </form>

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
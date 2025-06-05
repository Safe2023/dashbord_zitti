@extends('layouts.header')
@section('content')

@auth
@if(auth()->user()->account_type === 'admin')
<div class="container-fluid">
    <h1>principale</h1>
</div>
@else
<div class="alert alert-danger">Accès réservé à l’administrateur.</div>
@endif
@endauth
@endsection
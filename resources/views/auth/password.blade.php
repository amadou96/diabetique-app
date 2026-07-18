@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-5">

        <h2 class="mb-4">Changer mon mot de passe</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-4">

                <form method="POST" action="{{ route('password.update') }}">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Mot de passe actuel</label>
                        <input type="password"
                               name="current_password"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nouveau mot de passe</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               required minlength="8">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirmer le nouveau mot de passe</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Enregistrer le nouveau mot de passe
                    </button>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection

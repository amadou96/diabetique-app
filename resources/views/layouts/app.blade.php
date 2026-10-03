<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Patients Diabétiques</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">

    <div class="container">

        <a class="navbar-brand" href="{{ route('dashboard') }}">
            Gestion Patients Diabétiques
        </a>

        <div class="d-flex align-items-center gap-3">

            @auth

                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-light">
                    Tableau de bord
                </a>

                <a href="{{ route('patients.index') }}" class="btn btn-sm btn-outline-light">
                    Patients
                </a>

                <a href="{{ route('rendezvous.index') }}" class="btn btn-sm btn-outline-light">
                    Rendez-vous
                </a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('patients.create') }}" class="btn btn-sm btn-light">
                        + Patient
                    </a>
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-light">
                        Utilisateurs
                    </a>
                @endif

                <a href="{{ route('password.form') }}" class="text-white small text-decoration-none">
                    {{ auth()->user()->name }}
                    <span class="badge {{ auth()->user()->isAdmin() ? 'bg-danger' : 'bg-secondary' }} ms-1">
                        {{ auth()->user()->isAdmin() ? 'Admin' : 'Infirmier' }}
                    </span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light">
                        Déconnexion
                    </button>
                </form>

            @endauth

        </div>

    </div>

</nav>

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

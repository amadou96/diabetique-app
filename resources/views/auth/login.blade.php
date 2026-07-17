<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Gestion Patients Diabétiques</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-5">

            <div class="text-center mb-4">
                <h4 class="fw-bold text-primary">Gestion Patients Diabétiques</h4>
                <p class="text-muted">Connectez-vous pour accéder à l'application</p>
            </div>

            <div class="card shadow-sm">

                <div class="card-body p-4">

                    <h5 class="card-title mb-4">Connexion</h5>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Adresse email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email') }}"
                                   required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox"
                                   name="remember"
                                   class="form-check-input"
                                   id="remember">
                            <label class="form-check-label" for="remember">
                                Se souvenir de moi
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Se connecter
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>

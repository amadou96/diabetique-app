<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>Modifier le bilan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h2>Modifier le bilan</h2>

    <div class="card mb-4">

        <div class="card-body">

            <h4>
                {{ $patient->nom }}
                {{ $patient->prenom }}
            </h4>

            <p>
                Dossier :
                {{ $patient->numero_dossier }}
            </p>

        </div>

    </div>

    <form action="{{ route('bilans.update', $bilan->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        @include('bilans._form', ['bilan' => $bilan])

        <button class="btn btn-success">

            Enregistrer les modifications

        </button>

        <a href="{{ route('patients.show', $patient->id) }}"
           class="btn btn-secondary ms-2">

            Annuler

        </a>

    </form>

</div>

</body>

</html>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>Modifier Patient</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h2>Modifier Patient</h2>

    <form action="{{ route('patients.update', $patient->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Numéro de dossier <span class="text-danger">*</span></label>

            <input type="text"
                   name="numero_dossier"
                   class="form-control"
                   value="{{ old('numero_dossier', $patient->numero_dossier) }}"
                   required>

        </div>

        <div class="mb-3">

            <label>Nom</label>

            <input type="text"
                   name="nom"
                   class="form-control"
                   value="{{ $patient->nom }}">

        </div>

        <div class="mb-3">

            <label>Prénom</label>

            <input type="text"
                   name="prenom"
                   class="form-control"
                   value="{{ $patient->prenom }}">

        </div>

        <div class="mb-3">

            <label>Date naissance</label>

            <input type="date"
                   name="date_naissance"
                   class="form-control"
                   value="{{ $patient->date_naissance }}">

        </div>

        <div class="mb-3">

            <label>Sexe</label>

            <select name="sexe"
                    class="form-control">

                <option value="Masculin"
                    {{ $patient->sexe == 'Masculin' ? 'selected' : '' }}>

                    Masculin

                </option>

                <option value="Féminin"
                    {{ $patient->sexe == 'Féminin' ? 'selected' : '' }}>

                    Féminin

                </option>

            </select>

        </div>

        <div class="mb-3">

            <label>Téléphone</label>

            <input type="text"
                   name="telephone"
                   class="form-control"
                   value="{{ $patient->telephone }}">

        </div>

        <div class="mb-3">

            <label>Adresse</label>

            <input type="text"
                   name="adresse"
                   class="form-control"
                   value="{{ $patient->adresse }}">

        </div>

        <div class="mb-3">

            <label>Profession</label>

            <input type="text"
                   name="profession"
                   class="form-control"
                   value="{{ $patient->profession }}">

        </div>

        <div class="mb-3">

            <label>Groupe sanguin</label>

            <input type="text"
                   name="groupe_sanguin"
                   class="form-control"
                   value="{{ $patient->groupe_sanguin }}">

        </div>

        <div class="mb-3">

            <label>Allergies</label>

            <textarea name="allergies"
                      class="form-control">{{ $patient->allergies }}</textarea>

        </div>

        <div class="mb-3">

            <label>Antécédents</label>

            <textarea name="antecedents"
                      class="form-control">{{ $patient->antecedents }}</textarea>

        </div>

        <button class="btn btn-success">

            Mettre à jour

        </button>

    </form>

</div>

</body>
</html>
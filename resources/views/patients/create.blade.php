<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter Patient</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h2>Ajouter un patient</h2>

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('patients.store') }}"
          method="POST">

        @csrf

        <div class="mb-3">

            <label>Numéro de dossier <span class="text-danger">*</span></label>

            <input type="text"
                   name="numero_dossier"
                   class="form-control"
                   value="{{ old('numero_dossier') }}"
                   placeholder="ex : 61"
                   required>

            <small class="text-muted">Doit être unique. Les dossiers existants sont numérotés de 1 à 60.</small>

        </div>

        <div class="mb-3">

            <label>Nom</label>

            <input type="text"
                   name="nom"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Prénom</label>

            <input type="text"
                   name="prenom"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Date naissance</label>

            <input type="date"
                   name="date_naissance"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Sexe</label>

            <select name="sexe"
                    class="form-control">

                <option value="Masculin">
                    Masculin
                </option>

                <option value="Féminin">
                    Féminin
                </option>

            </select>

        </div>

        <div class="mb-3">

            <label>Téléphone</label>

            <input type="text"
                   name="telephone"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Adresse</label>

            <input type="text"
                   name="adresse"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Profession</label>

            <input type="text"
                   name="profession"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Groupe sanguin</label>

            <input type="text"
                   name="groupe_sanguin"
                   class="form-control">

        </div>
        <div class="mb-3">

    <label>Assuré</label>

    <select name="assure"
            class="form-control">

        <option value="Oui">

            Oui

        </option>

        <option value="Non">

            Non

        </option>

    </select>

</div>
<div class="mb-3">

    <label>Niveau scolarisation</label>

    <select name="niveau_scolarisation"
            class="form-control">

        <option value="Non scolarisé">

            Non scolarisé

        </option>

        <option value="Primaire">

            Primaire

        </option>

        <option value="Secondaire">

            Secondaire

        </option>

        <option value="Diplomé">

            Diplomé

        </option>

    </select>

</div>

        <div class="mb-3">

            <label>Allergies</label>

            <textarea name="allergies"
                      class="form-control"></textarea>

        </div>

        <div class="mb-3">

            <label>Antécédents</label>

            <textarea name="antecedents"
                      class="form-control"></textarea>

        </div>

        <button class="btn btn-primary">

            Enregistrer

        </button>

    </form>

</div>

</body>
</html>
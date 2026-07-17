<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>Nouveau bilan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h2>Nouveau bilan</h2>

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

    <form action="{{ route('bilans.store') }}"
          method="POST">

        @csrf

        <input type="hidden"
               name="patient_id"
               value="{{ $patient->id }}">

        <div class="mb-3">

            <label>Date du bilan</label>

            <input type="date"
                   name="date_bilan"
                   class="form-control"
                   required>

        </div>

        <div class="mb-3">

            <label>Nom du bilan</label>

            <select name="nom_bilan"
                    class="form-control"
                    required>

                <option value="">-- Choisir --</option>

                <optgroup label="Bilan glucidique">
                    <option value="HbA1c">HbA1c</option>
                    <option value="Glycémie à jeun">Glycémie à jeun</option>
                    <option value="Glycémie postprandiale">Glycémie postprandiale</option>
                </optgroup>

                <optgroup label="Bilan lipidique">
                    <option value="Cholestérol total">Cholestérol total</option>
                    <option value="LDL cholestérol">LDL cholestérol</option>
                    <option value="HDL cholestérol">HDL cholestérol</option>
                    <option value="Triglycérides">Triglycérides</option>
                </optgroup>

                <optgroup label="Bilan rénal">
                    <option value="Créatinine">Créatinine</option>
                    <option value="Urée">Urée</option>
                    <option value="Microalbuminurie">Microalbuminurie</option>
                    <option value="DFG">DFG (Débit de Filtration Glomérulaire)</option>
                </optgroup>

                <optgroup label="Autres">
                    <option value="NFS">NFS (Numération Formule Sanguine)</option>
                    <option value="Transaminases">Transaminases (ALAT/ASAT)</option>
                    <option value="TSH">TSH</option>
                    <option value="Fond d'œil">Fond d'œil</option>
                    <option value="ECG">ECG</option>
                    <option value="Autre">Autre</option>
                </optgroup>

            </select>

        </div>

        <div class="mb-3">

            <label>Résultat</label>

            <input type="text"
                   name="resultat"
                   class="form-control"
                   placeholder="ex : 7.2"
                   required>

        </div>

        <div class="mb-3">

            <label>Unité</label>

            <input type="text"
                   name="unite"
                   class="form-control"
                   placeholder="ex : %, g/L, mmol/L, mg/24h…">

        </div>

        <div class="mb-3">

            <label>Observations</label>

            <textarea name="observations"
                      class="form-control"
                      rows="3"
                      placeholder="Commentaire, interprétation…"></textarea>

        </div>

        <button class="btn btn-success">

            Enregistrer le bilan

        </button>

        <a href="{{ route('patients.show', $patient->id) }}"
           class="btn btn-secondary ms-2">

            Annuler

        </a>

    </form>

</div>

</body>

</html>

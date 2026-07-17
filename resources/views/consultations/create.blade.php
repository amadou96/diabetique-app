<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <title>Nouvelle consultation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h2>Nouvelle consultation</h2>

    {{-- État civil patient --}}
    <div class="card mb-4">
        <div class="card-body">

            <h5 class="card-title mb-3">État civil</h5>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nom :</strong> {{ $patient->nom }} {{ $patient->prenom }}</p>
                    <p><strong>Dossier :</strong> {{ $patient->numero_dossier }}</p>
                    <p><strong>Date de naissance :</strong> {{ $patient->date_naissance }}</p>
                    <p><strong>Sexe :</strong> {{ $patient->sexe }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Téléphone :</strong> {{ $patient->telephone ?? '—' }}</p>
                    <p><strong>Groupe sanguin :</strong> {{ $patient->groupe_sanguin ?? '—' }}</p>
                    <p><strong>Assuré :</strong> {{ $patient->assure ?? '—' }}</p>
                    <p><strong>Allergies :</strong> {{ $patient->allergies ?? '—' }}</p>
                </div>
            </div>

        </div>
    </div>

    <form action="{{ route('consultations.store') }}" method="POST">

        @csrf
        <input type="hidden" name="patient_id" value="{{ $patient->id }}">

        {{-- Date --}}
        <div class="mb-3">
            <label>Date consultation</label>
            <input type="date" name="date_consultation" class="form-control" required>
        </div>

        {{-- Constantes --}}
        <h5 class="mt-4 mb-3">Constantes</h5>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Glycémie capillaire (g/L)</label>
                <input type="number" step="0.01" name="glycemie" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Type glycémie</label>
                <select name="type_glycemie" class="form-control">
                    <option value="">-- Choisir --</option>
                    <option value="A jeun">A jeun</option>
                    <option value="Après repas">Après repas</option>
                    <option value="Aléatoire">Aléatoire</option>
                </select>
            </div>

        </div>

        <div class="mb-3">
            <label>Tension artérielle (mmHg)</label>
            <div class="row g-2">
                <div class="col">
                    <input type="number" name="tension_systolique" class="form-control"
                           placeholder="PAS — systolique (ex : 120)" min="60" max="250">
                </div>
                <div class="col-auto d-flex align-items-center fw-bold">/</div>
                <div class="col">
                    <input type="number" name="tension_diastolique" class="form-control"
                           placeholder="PAD — diastolique (ex : 80)" min="40" max="150">
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Fréquence cardiaque (bpm)</label>
                <input type="number" name="frequence_cardiaque" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Température (°C)</label>
                <input type="number" step="0.1" name="temperature" class="form-control">
            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Poids (kg)</label>
                <input type="number" step="0.01" name="poids" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Taille (m)</label>
                <input type="number" step="0.01" name="taille" class="form-control">
            </div>

        </div>

        {{-- Observations et traitement : admin uniquement --}}
        @if(auth()->user()->isAdmin())

            <h5 class="mt-4 mb-3">Suivi médical</h5>

            <div class="mb-3">
                <label>Observations</label>
                <textarea name="observations" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label>Traitement</label>
                <textarea name="traitement" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label>Prochain rendez-vous</label>
                <input type="date" name="prochain_rv" class="form-control">
            </div>

        @else

            {{-- Infirmier : prochain RV visible mais non modifiable --}}
            <div class="mb-3 mt-4">
                <label class="text-muted">Prochain rendez-vous</label>
                <input type="date" class="form-control" disabled
                       placeholder="Défini par le médecin">
                <small class="text-muted">Ce champ est réservé au médecin.</small>
            </div>

        @endif

        <button class="btn btn-success">Enregistrer la consultation</button>
        <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-secondary ms-2">Annuler</a>

    </form>

</div>

</body>

</html>

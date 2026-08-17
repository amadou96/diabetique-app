<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la consultation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Modifier la consultation</h2>

    {{-- Infos patient --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">État civil</h5>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nom :</strong> {{ $patient->nom }} {{ $patient->prenom }}</p>
                    <p><strong>Dossier :</strong> {{ $patient->numero_dossier }}</p>
                    <p><strong>Date de naissance :</strong> {{ $patient->date_naissance?->translatedFormat('d F Y') }}</p>
                    <p><strong>Sexe :</strong> {{ $patient->sexe }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Structure :</strong> {{ $patient->structure ?? '—' }}</p>
                    <p><strong>Groupe sanguin :</strong> {{ $patient->groupe_sanguin ?? '—' }}</p>
                    <p><strong>Assuré :</strong> {{ $patient->assure ?? '—' }}</p>
                    <p><strong>Allergies :</strong> {{ $patient->allergies ?? '—' }}</p>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('consultations.update', $consultation->id) }}" method="POST">

        @csrf
        @method('PUT')

        {{-- Date --}}
        <div class="mb-3">
            <label>Date consultation</label>
            <input type="date" name="date_consultation" class="form-control"
                   value="{{ old('date_consultation', $consultation->date_consultation->format('Y-m-d')) }}" required>
        </div>

        {{-- Constantes --}}
        <h5 class="mt-4 mb-3">Constantes</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Glycémie capillaire (g/L)</label>
                <input type="number" step="0.01" name="glycemie" class="form-control"
                       value="{{ old('glycemie', $consultation->glycemie) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Type glycémie</label>
                <select name="type_glycemie" class="form-control">
                    <option value="">-- Choisir --</option>
                    @foreach(['A jeun','Après repas','Aléatoire'] as $t)
                        <option value="{{ $t }}" {{ old('type_glycemie', $consultation->type_glycemie) === $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Tension artérielle (mmHg)</label>
            <div class="row g-2">
                <div class="col">
                    <input type="number" name="tension_systolique" class="form-control"
                           placeholder="PAS — systolique (ex : 120)" min="60" max="250"
                           value="{{ old('tension_systolique', $consultation->tension_systolique) }}">
                </div>
                <div class="col-auto d-flex align-items-center fw-bold">/</div>
                <div class="col">
                    <input type="number" name="tension_diastolique" class="form-control"
                           placeholder="PAD — diastolique (ex : 80)" min="40" max="150"
                           value="{{ old('tension_diastolique', $consultation->tension_diastolique) }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Fréquence cardiaque (bpm)</label>
                <input type="number" name="frequence_cardiaque" class="form-control"
                       value="{{ old('frequence_cardiaque', $consultation->frequence_cardiaque) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Température (°C)</label>
                <input type="number" step="0.1" name="temperature" class="form-control"
                       value="{{ old('temperature', $consultation->temperature) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Poids (kg)</label>
                <input type="number" step="0.01" name="poids" class="form-control"
                       value="{{ old('poids', $consultation->poids) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Taille (m)</label>
                <input type="number" step="0.01" name="taille" class="form-control"
                       value="{{ old('taille', $consultation->taille) }}">
            </div>
        </div>

        {{-- Suivi médical : admin uniquement --}}
        @if(auth()->user()->isAdmin())

            <h5 class="mt-4 mb-3">Suivi médical</h5>

            <div class="mb-3">
                <label>Observations</label>
                <textarea name="observations" class="form-control" rows="3">{{ old('observations', $consultation->observations) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Traitement</label>
                <textarea name="traitement" class="form-control" rows="3">{{ old('traitement', $consultation->traitement) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Prochain rendez-vous</label>
                <input type="date" name="prochain_rv" class="form-control"
                       value="{{ old('prochain_rv', $consultation->prochain_rv?->format('Y-m-d')) }}">
            </div>

        @else

            <div class="mb-3 mt-4">
                <label class="text-muted">Prochain rendez-vous</label>
                <input type="date" class="form-control" disabled
                       value="{{ $consultation->prochain_rv?->format('Y-m-d') }}">
                <small class="text-muted">Ce champ est réservé au médecin.</small>
            </div>

        @endif

        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
        <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-secondary ms-2">Annuler</a>

    </form>

</div>

</body>
</html>

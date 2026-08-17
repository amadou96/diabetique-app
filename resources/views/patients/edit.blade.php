@extends('layouts.app')

@section('content')

<div class="mb-4">
    <h2>Modifier le patient</h2>
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

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('patients.update', $patient->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Numéro de dossier <span class="text-danger">*</span></label>
                <input type="text" name="numero_dossier" class="form-control"
                       value="{{ old('numero_dossier', $patient->numero_dossier) }}" required>
            </div>

            <div class="mb-3">
                <label>Structure de suivi <span class="text-danger">*</span></label>
                <select name="structure" class="form-control" required>
                    <option value="">-- Choisir la structure --</option>
                    @foreach(['Centre Sante Sangalkam','Centre Sante Rufisque','Centre Sante Colobane','Centre Diabetique Rufisque','Clinique NABY','A Domicile'] as $s)
                        <option value="{{ $s }}" {{ old('structure', $patient->structure) === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" class="form-control"
                           value="{{ old('nom', $patient->nom) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" class="form-control"
                           value="{{ old('prenom', $patient->prenom) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Date de naissance <span class="text-danger">*</span></label>
                    <input type="date" name="date_naissance" class="form-control"
                           value="{{ old('date_naissance', $patient->date_naissance?->format('Y-m-d')) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Sexe <span class="text-danger">*</span></label>
                    <select name="sexe" class="form-control" required>
                        <option value="Masculin" {{ old('sexe', $patient->sexe) === 'Masculin' ? 'selected' : '' }}>Masculin</option>
                        <option value="Féminin"  {{ old('sexe', $patient->sexe) === 'Féminin'  ? 'selected' : '' }}>Féminin</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Téléphone</label>
                    <input type="text" name="telephone" class="form-control"
                           value="{{ old('telephone', $patient->telephone) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Groupe sanguin</label>
                    <input type="text" name="groupe_sanguin" class="form-control"
                           value="{{ old('groupe_sanguin', $patient->groupe_sanguin) }}">
                </div>
            </div>

            <div class="mb-3">
                <label>Adresse</label>
                <input type="text" name="adresse" class="form-control"
                       value="{{ old('adresse', $patient->adresse) }}">
            </div>

            <div class="mb-3">
                <label>Profession</label>
                <input type="text" name="profession" class="form-control"
                       value="{{ old('profession', $patient->profession) }}">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Assuré</label>
                    <select name="assure" class="form-control">
                        <option value="Oui" {{ old('assure', $patient->assure) === 'Oui' ? 'selected' : '' }}>Oui</option>
                        <option value="Non" {{ old('assure', $patient->assure) === 'Non' ? 'selected' : '' }}>Non</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Niveau scolarisation</label>
                    <select name="niveau_scolarisation" class="form-control">
                        @foreach(['Non scolarisé','Primaire','Secondaire','Diplomé'] as $n)
                            <option value="{{ $n }}" {{ old('niveau_scolarisation', $patient->niveau_scolarisation) === $n ? 'selected' : '' }}>{{ $n }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label>Allergies</label>
                <textarea name="allergies" class="form-control" rows="2">{{ old('allergies', $patient->allergies) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Antécédents</label>
                <textarea name="antecedents" class="form-control" rows="2">{{ old('antecedents', $patient->antecedents) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Mettre à jour</button>
            <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-secondary ms-2">Annuler</a>

        </form>

    </div>
</div>

@endsection

@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h1>Liste des patients</h1>

    @if(auth()->user()->isAdmin())
        <a href="{{ route('patients.create') }}" class="btn btn-primary">
            Ajouter un patient
        </a>
    @endif

</div>

{{-- Barre de recherche --}}
<form method="GET" action="{{ route('patients.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Rechercher par nom, prénom ou numéro de dossier…"
               value="{{ $search ?? '' }}">
        <button class="btn btn-primary" type="submit">Rechercher</button>
        @if($search)
            <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
                Effacer
            </a>
        @endif
    </div>
</form>

@if(isset($search) && $search)
    <p class="text-muted mb-3">
        {{ $patients->count() }} résultat(s) pour « {{ $search }} »
    </p>
@endif

@if($patients->isEmpty())
    <div class="alert alert-warning">
        Aucun patient trouvé.
    </div>
@endif

@foreach($patients as $patient)

<div class="card mb-3 shadow-sm border-0">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h5 class="mb-1">
                    {{ $patient->nom }} {{ $patient->prenom }}
                </h5>
                <small class="text-muted">{{ $patient->numero_dossier }}</small>
            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-info btn-sm">
                    Dossier
                </a>

                <a href="{{ route('consultations.create', ['patient_id' => $patient->id]) }}"
                   class="btn btn-success btn-sm">
                    Consultation
                </a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning btn-sm">
                        Modifier
                    </a>
                    <form action="{{ route('patients.destroy', $patient->id) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Supprimer ce patient ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                @endif

            </div>

        </div>

    </div>

</div>

@endforeach

@endsection

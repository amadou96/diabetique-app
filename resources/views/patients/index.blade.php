@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h1>
        Liste des patients
        @if(auth()->user()->isInfirmier() && auth()->user()->structure)
            <small class="fs-6 text-muted fw-normal ms-2">— {{ auth()->user()->structure }}</small>
        @endif
    </h1>

    <a href="{{ route('patients.create') }}" class="btn btn-primary">
        + Patient
    </a>

</div>

@if($filtre === 'sans_suivi')
    <div class="alert alert-warning d-flex justify-content-between align-items-center">
        <span>Affichage : patients <strong>sans suivi depuis plus de 3 mois</strong></span>
        <a href="{{ route('patients.index') }}" class="btn btn-sm btn-outline-secondary">Voir tous</a>
    </div>
@endif

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
                <small class="text-muted">Dossier {{ $patient->numero_dossier }}</small>
                @if(auth()->user()->isAdmin())
                    <small class="text-muted ms-2">· {{ $patient->structure }}</small>
                @endif
                @if($patient->telephone)
                    <br><small class="text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58L3.654 1.328z"/>
                        </svg>
                        {{ $patient->telephone }}
                    </small>
                @endif
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

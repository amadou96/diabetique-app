@extends('layouts.app')

@section('content')

<div class="mb-4">
    <h2>Rendez-vous</h2>
</div>

{{-- Sélecteur de date --}}
<form method="GET" action="{{ route('rendezvous.index') }}" class="mb-4">
    <div class="input-group" style="max-width: 350px;">
        <input type="date"
               name="date"
               class="form-control"
               value="{{ $date }}">
        <button class="btn btn-primary" type="submit">Afficher</button>
    </div>
</form>

{{-- Résultats --}}
<h5 class="mb-3">
    Patients attendus le
    <strong>{{ \Carbon\Carbon::parse($date)->translatedFormat('l d F Y') }}</strong>
    <span class="badge bg-primary ms-2">{{ $consultations->count() }}</span>
</h5>

@if($consultations->isEmpty())

    <div class="alert alert-warning">
        Aucun rendez-vous prévu pour cette date.
    </div>

@else

    <div class="list-group shadow-sm">

        @foreach($consultations as $consultation)

        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

            <div>
                <h6 class="mb-1">
                    {{ $consultation->patient->nom }}
                    {{ $consultation->patient->prenom }}
                </h6>
                <small class="text-muted">
                    Dossier : {{ $consultation->patient->numero_dossier }}
                </small>
            </div>

            <a href="{{ route('patients.show', $consultation->patient->id) }}"
               class="btn btn-info btn-sm">
                Dossier
            </a>

        </div>

        @endforeach

    </div>

@endif

@endsection

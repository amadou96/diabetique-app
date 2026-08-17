@extends('layouts.app')

@section('content')

<div class="mb-4">

    <h2>
        Dossier Patient
    </h2>

</div>

<div class="card mb-4 shadow-sm">

    <div class="card-body">

        <h4>

            {{ $patient->nom }}
            {{ $patient->prenom }}

        </h4>

        <p>
            <strong>Dossier :</strong>
            {{ $patient->numero_dossier }}
        </p>

        <p>
            <strong>Téléphone :</strong>
            {{ $patient->telephone }}
        </p>

        <p>
            <strong>Adresse :</strong>
            {{ $patient->adresse }}
        </p>

        <p>
            <strong>Profession :</strong>
            {{ $patient->profession }}
        </p>
                <p>

            <strong>Assuré :</strong>

            {{ $patient->assure }}

        </p>

        <p>

            <strong>Niveau scolarisation :</strong>

            {{ $patient->niveau_scolarisation }}

        </p>
        <p>
            <strong>Groupe sanguin :</strong>
            {{ $patient->groupe_sanguin }}
        </p>

        <p>
            <strong>Structure de suivi :</strong>
            {{ $patient->structure ?? '—' }}
        </p>

    </div>

</div>

<h3 class="mb-3">

    Historique des consultations

</h3>

@if($consultations->count() == 0)

    <div class="alert alert-warning">

        Aucune consultation enregistrée.

    </div>

@endif

@foreach($consultations as $consultation)

<div class="card mb-3 border-0 shadow-sm">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-start">

            <div>
                <h5 class="mb-1">
                    Consultation du {{ $consultation->date_consultation->translatedFormat('d F Y') }}
                </h5>
                <span class="badge bg-primary">IMC : {{ $consultation->imc }}</span>
            </div>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('consultations.edit', $consultation->id) }}"
                   class="btn btn-sm btn-outline-warning">
                    Modifier
                </a>
            @endif

        </div>

        <hr>

        <div class="row">

            <div class="col-md-4">

                <p>

                    <strong>Glycémie Capillaire :</strong>

                    {{ $consultation->glycemie }} g/L

                </p>

            </div>

            <div class="col-md-4">

                <p>

                    <strong>Type :</strong>

                    {{ $consultation->type_glycemie }}

                </p>

            </div>

            <div class="col-md-4">

                <p>

                    <strong>Tension :</strong>

                    {{ $consultation->tension_systolique }}/{{ $consultation->tension_diastolique }} mmHg

                </p>

            </div>

        </div>

        <div class="row">

            <div class="col-md-4">

                <p>

                    <strong>Poids :</strong>

                    {{ $consultation->poids }} kg

                </p>

            </div>

            <div class="col-md-4">

                <p>

                    <strong>Taille :</strong>

                    {{ $consultation->taille }} m

                </p>

            </div>

            <div class="col-md-4">

                <p>

                    <strong>Température :</strong>

                    {{ $consultation->temperature }} °C

                </p>

            </div>

        </div>

        <div class="row">

            <div class="col-md-4">

                <p>

                    <strong>Fréquence cardiaque :</strong>

                    {{ $consultation->frequence_cardiaque }} bpm

                </p>

            </div>

        </div>

        @if(auth()->user()->isAdmin())
        <hr>
        <p>
            <strong>Observations :</strong>
            {{ $consultation->observations }}
        </p>

        <p>
            <strong>Traitement :</strong>
            {{ $consultation->traitement }}
        </p>
        @endif

       

        <p>

            <strong>Prochain rendez-vous :</strong>

            {{ $consultation->prochain_rv?->translatedFormat('d F Y') ?? '—' }}

        </p>

    </div>

</div>

@endforeach


<hr class="my-5">

<div class="d-flex justify-content-between align-items-center mb-3">

    <h3>Résultats bilans</h3>

    <a href="{{ route('bilans.create', ['patient_id' => $patient->id]) }}"
       class="btn btn-primary btn-sm">

        + Ajouter un bilan

    </a>

</div>

@if($bilans->count() == 0)

    <div class="alert alert-warning">

        Aucun bilan enregistré.

    </div>

@else

<div class="table-responsive">

    <table class="table table-bordered table-hover shadow-sm">

        <thead class="table-primary">

            <tr>
                <th>Date</th>
                <th>Bilan</th>
                <th>Résultat</th>
                <th>Unité</th>
                <th>Observations</th>
            </tr>

        </thead>

        <tbody>

            @foreach($bilans as $bilan)

            <tr>

                <td>{{ $bilan->date_bilan->translatedFormat('d F Y') }}</td>

                <td>{{ $bilan->nom_bilan }}</td>

                <td>
                    <strong>{{ $bilan->resultat }}</strong>
                </td>

                <td>{{ $bilan->unite ?? '—' }}</td>

                <td>{{ $bilan->observations ?? '—' }}</td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endif

@endsection
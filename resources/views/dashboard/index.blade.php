@extends('layouts.app')

@section('content')

<div class="mb-4">
    <h2>Tableau de bord</h2>
    <p class="text-muted">{{ now()->translatedFormat('l d F Y') }}</p>
</div>

{{-- Cartes statistiques --}}
<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-primary" style="color:#0d6efd">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6 5.87H9m0 0a4 4 0 110-8 4 4 0 010 8zm6-4a4 4 0 10-8 0"/>
                    </svg>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-primary">{{ $totalPatients }}</div>
                    <div class="text-muted small">Patients total</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <a href="{{ route('rendezvous.index') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:#198754">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold text-success">{{ $rvAujourdhui }}</div>
                        <div class="text-muted small">RV aujourd'hui</div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle bg-info bg-opacity-10 p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:#0dcaf0">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-info">{{ $consultationsCeMois }}</div>
                    <div class="text-muted small">Consultations ce mois</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <a href="{{ route('patients.index', ['filtre' => 'sans_suivi']) }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:#ffc107">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold text-warning">{{ $sansSuivi }}</div>
                        <div class="text-muted small">Sans suivi +3 mois</div>
                    </div>
                </div>
            </div>
        </a>
    </div>

</div>

{{-- Ligne du bas : RV du jour + Dernières consultations --}}
<div class="row g-3">

    {{-- RV du jour --}}
    <div class="col-md-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center pt-3">
                <h6 class="mb-0 fw-bold">Rendez-vous du jour</h6>
                <a href="{{ route('rendezvous.index') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
            </div>
            <div class="card-body p-0">

                @if($rvDuJour->isEmpty())
                    <p class="text-muted p-3 mb-0">Aucun rendez-vous aujourd'hui.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($rvDuJour as $rv)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-semibold">
                                        {{ $rv->patient->nom }} {{ $rv->patient->prenom }}
                                    </span>
                                    <br>
                                    <small class="text-muted">{{ $rv->patient->numero_dossier }}</small>
                                </div>
                                <a href="{{ route('patients.show', $rv->patient->id) }}"
                                   class="btn btn-sm btn-outline-info">
                                    Dossier
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>
    </div>

    {{-- Dernières consultations --}}
    <div class="col-md-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-3">
                <h6 class="mb-0 fw-bold">Dernières consultations</h6>
            </div>
            <div class="card-body p-0">

                @if($dernieresConsultations->isEmpty())
                    <p class="text-muted p-3 mb-0">Aucune consultation enregistrée.</p>
                @else
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Patient</th>
                                <th>Date</th>
                                <th>Glycémie</th>
                                <th>IMC</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dernieresConsultations as $c)
                            <tr>
                                <td>
                                    <span class="fw-semibold">{{ $c->patient->nom }} {{ $c->patient->prenom }}</span>
                                    <br>
                                    <small class="text-muted">{{ $c->patient->numero_dossier }}</small>
                                </td>
                                <td>{{ $c->date_consultation->translatedFormat('d M Y') }}</td>
                                <td>
                                    @if($c->glycemie)
                                        {{ $c->glycemie }} g/L
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($c->imc)
                                        <span class="badge {{ $c->imc < 18.5 ? 'bg-warning' : ($c->imc < 25 ? 'bg-success' : ($c->imc < 30 ? 'bg-warning' : 'bg-danger')) }}">
                                            {{ $c->imc }}
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('patients.show', $c->patient->id) }}"
                                       class="btn btn-sm btn-outline-info">
                                        Dossier
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>

</div>

@endsection

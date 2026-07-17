<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function create(Request $request)
    {
        $patient = Patient::findOrFail($request->patient_id);

        return view('consultations.create', compact('patient'));
    }
    public function store(Request $request)
{
    $request->validate([

        'patient_id' => 'required',

        'date_consultation' => 'required',
    ]);

    // Calcul automatique IMC

    $imc = null;

    if ($request->poids && $request->taille) {

        $imc = $request->poids / ($request->taille * $request->taille);
    }

    $data = [
        'patient_id'          => $request->patient_id,
        'date_consultation'   => $request->date_consultation,
        'glycemie'            => $request->glycemie,
        'type_glycemie'       => $request->type_glycemie,
        'tension_systolique'  => $request->tension_systolique,
        'tension_diastolique' => $request->tension_diastolique,
        'frequence_cardiaque' => $request->frequence_cardiaque,
        'poids'               => $request->poids,
        'taille'              => $request->taille,
        'temperature'         => $request->temperature,
        'imc'                 => round($imc, 2),
    ];

    if (auth()->user()->isAdmin()) {
        $data['observations'] = $request->observations;
        $data['traitement']   = $request->traitement;
        $data['prochain_rv']  = $request->prochain_rv;
    }

    Consultation::create($data);

    return redirect()->route('patients.show', $request->patient_id)
            ->with('success', 'Consultation enregistrée avec succès');
}
}
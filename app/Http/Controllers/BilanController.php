<?php

namespace App\Http\Controllers;

use App\Models\Bilan;
use App\Models\Patient;
use Illuminate\Http\Request;

class BilanController extends Controller
{
    public function create(Request $request)
    {
        $patient = Patient::findOrFail($request->patient_id);

        return view('bilans.create', compact('patient'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id'  => 'required',
            'date_bilan'  => 'required|date',
            'nom_bilan'   => 'required',
            'resultat'    => 'required',
        ]);

        Bilan::create([
            'patient_id'   => $request->patient_id,
            'date_bilan'   => $request->date_bilan,
            'nom_bilan'    => $request->nom_bilan,
            'resultat'     => $request->resultat,
            'unite'        => $request->unite,
            'observations' => $request->observations,
        ]);

        return redirect('/patients/' . $request->patient_id)
            ->with('success', 'Bilan enregistré avec succès');
    }

    public function edit(Bilan $bilan)
    {
        $patient = $bilan->patient;

        return view('bilans.edit', compact('bilan', 'patient'));
    }

    public function update(Request $request, Bilan $bilan)
    {
        $request->validate([
            'date_bilan'  => 'required|date',
            'nom_bilan'   => 'required',
            'resultat'    => 'required',
        ]);

        $bilan->update([
            'date_bilan'   => $request->date_bilan,
            'nom_bilan'    => $request->nom_bilan,
            'resultat'     => $request->resultat,
            'unite'        => $request->unite,
            'observations' => $request->observations,
        ]);

        return redirect()->route('patients.show', $bilan->patient_id)
            ->with('success', 'Bilan modifié avec succès');
    }

    public function destroy(Bilan $bilan)
    {
        $patientId = $bilan->patient_id;
        $bilan->delete();

        return redirect()->route('patients.show', $patientId)
            ->with('success', 'Bilan supprimé avec succès');
    }
}

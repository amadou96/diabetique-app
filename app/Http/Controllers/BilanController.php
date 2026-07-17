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
}

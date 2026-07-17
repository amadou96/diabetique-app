<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $patients = Patient::when($search, function ($query) use ($search) {
                $query->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%")
                      ->orWhere('numero_dossier', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('patients.index', compact('patients', 'search'));
    }
    public function edit(Patient $patient)
{
    return view('patients.edit', compact('patient'));
}

public function update(Request $request, Patient $patient)
{
    $request->validate([
        'numero_dossier' => 'required|unique:patients,numero_dossier,' . $patient->id,
        'nom'            => 'required',
        'prenom'         => 'required',
        'date_naissance' => 'required',
        'sexe'           => 'required',
    ], [
        'numero_dossier.required' => 'Le numéro de dossier est obligatoire.',
        'numero_dossier.unique'   => 'Ce numéro de dossier est déjà utilisé.',
    ]);

    $patient->update([

        'numero_dossier' => $request->numero_dossier,

        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'date_naissance' => $request->date_naissance,
        'telephone' => $request->telephone,
        'sexe' => $request->sexe,

        'adresse' => $request->adresse,
        'profession' => $request->profession,

        'groupe_sanguin' => $request->groupe_sanguin,

        'allergies' => $request->allergies,

        'antecedents' => $request->antecedents,
    ]);

    return redirect('/patients')
            ->with('success', 'Patient modifié avec succès');
}

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    return view('patients.create');
}

public function store(Request $request)
{
    $request->validate([
        'numero_dossier' => 'required|unique:patients,numero_dossier',
        'nom'            => 'required',
        'prenom'         => 'required',
        'date_naissance' => 'required',
        'sexe'           => 'required',
    ], [
        'numero_dossier.required' => 'Le numéro de dossier est obligatoire.',
        'numero_dossier.unique'   => 'Ce numéro de dossier est déjà utilisé.',
    ]);

    Patient::create([

        'numero_dossier' => $request->numero_dossier,

        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'date_naissance' => $request->date_naissance,
        'sexe' => $request->sexe,

        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
        'profession' => $request->profession,

        'groupe_sanguin' => $request->groupe_sanguin,
        'allergies' => $request->allergies,
        'antecedents' => $request->antecedents,
        'assure' => $request->assure,

        'niveau_scolarisation' => $request->niveau_scolarisation,
    ]);

    return redirect('/patients')
            ->with('success', 'Patient ajouté avec succès');
}
public function destroy(Patient $patient)
{
    $patient->delete();

    return redirect('/patients')
            ->with('success', 'Patient supprimé avec succès');
}
public function show(Patient $patient)
{
    $consultations = $patient->consultations()
                             ->latest()
                             ->get();

    $bilans = $patient->bilans()
                      ->latest('date_bilan')
                      ->get();

    return view('patients.show', compact(
        'patient',
        'consultations',
        'bilans'
    ));
}
}
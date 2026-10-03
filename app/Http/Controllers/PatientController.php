<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $user   = auth()->user();
        $search = $request->input('search');
        $filtre = $request->input('filtre');

        $query = Patient::query();

        // Infirmier : filtrer par sa structure
        if ($user->isInfirmier() && $user->structure) {
            $query->where('structure', $user->structure);
        }

        // Filtre "sans suivi" (voir Patient::MOIS_SANS_SUIVI)
        if ($filtre === 'sans_suivi') {
            $idsAvecSuivi = Consultation::select('patient_id')
                ->where('date_consultation', '>=', now()->subMonths(Patient::MOIS_SANS_SUIVI)->toDateString())
                ->distinct()
                ->pluck('patient_id');
            $query->whereNotIn('id', $idsAvecSuivi);
        }

        // Recherche textuelle : chaque mot doit apparaître dans au moins un champ,
        // ce qui permet "Prénom Nom" comme "Nom Prénom"
        if ($search) {
            foreach (preg_split('/\s+/', trim($search)) as $mot) {
                $query->where(function ($q) use ($mot) {
                    foreach (['nom', 'prenom', 'numero_dossier', 'adresse', 'structure'] as $champ) {
                        $q->orWhere($champ, 'like', "%{$mot}%");
                    }
                });
            }
        }

        $patients = $query->latest()->get();

        return view('patients.index', compact('patients', 'search', 'filtre'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'numero_dossier' => 'required|unique:patients,numero_dossier',
            'structure'      => $user->isAdmin() ? 'required' : 'nullable',
            'structure_autre' => 'nullable|string|max:255|required_if:structure,' . Patient::STRUCTURE_AUTRES,
            'nom'            => 'required',
            'prenom'         => 'required',
            'date_naissance' => 'required',
            'sexe'           => 'required',
        ], [
            'numero_dossier.required' => 'Le numéro de dossier est obligatoire.',
            'numero_dossier.unique'   => 'Ce numéro de dossier est déjà utilisé.',
            'structure.required'      => 'La structure de suivi est obligatoire.',
            'structure_autre.required_if' => 'Veuillez préciser la structure de suivi.',
        ]);

        // L'infirmier crée dans sa propre structure
        $structure = $user->isInfirmier() ? $user->structure : Patient::structureFromRequest($request);

        Patient::create([
            'numero_dossier'       => $request->numero_dossier,
            'structure'            => $structure,
            'nom'                  => $request->nom,
            'prenom'               => $request->prenom,
            'date_naissance'       => $request->date_naissance,
            'sexe'                 => $request->sexe,
            'telephone'            => $request->telephone,
            'adresse'              => $request->adresse,
            'profession'           => $request->profession,
            'groupe_sanguin'       => $request->groupe_sanguin,
            'allergies'            => $request->allergies,
            'antecedents'          => $request->antecedents,
            'assure'               => $request->assure,
            'niveau_scolarisation' => $request->niveau_scolarisation,
        ]);

        return redirect('/patients')->with('success', 'Patient ajouté avec succès');
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'numero_dossier' => 'required|unique:patients,numero_dossier,' . $patient->id,
            'structure'      => 'required',
            'structure_autre' => 'nullable|string|max:255|required_if:structure,' . Patient::STRUCTURE_AUTRES,
            'nom'            => 'required',
            'prenom'         => 'required',
            'date_naissance' => 'required',
            'sexe'           => 'required',
        ], [
            'numero_dossier.required' => 'Le numéro de dossier est obligatoire.',
            'numero_dossier.unique'   => 'Ce numéro de dossier est déjà utilisé.',
            'structure.required'      => 'La structure de suivi est obligatoire.',
            'structure_autre.required_if' => 'Veuillez préciser la structure de suivi.',
        ]);

        $patient->update([
            'numero_dossier'       => $request->numero_dossier,
            'structure'            => Patient::structureFromRequest($request),
            'nom'                  => $request->nom,
            'prenom'               => $request->prenom,
            'date_naissance'       => $request->date_naissance,
            'telephone'            => $request->telephone,
            'sexe'                 => $request->sexe,
            'adresse'              => $request->adresse,
            'profession'           => $request->profession,
            'groupe_sanguin'       => $request->groupe_sanguin,
            'allergies'            => $request->allergies,
            'antecedents'          => $request->antecedents,
            'assure'               => $request->assure,
            'niveau_scolarisation' => $request->niveau_scolarisation,
        ]);

        return redirect()->route('patients.show', $patient->id)
                ->with('success', 'Patient modifié avec succès');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect('/patients')->with('success', 'Patient supprimé avec succès');
    }

    public function show(Patient $patient)
    {
        $consultations = $patient->consultations()->latest()->get();
        $bilans        = $patient->bilans()->latest('date_bilan')->get();

        return view('patients.show', compact('patient', 'consultations', 'bilans'));
    }
}

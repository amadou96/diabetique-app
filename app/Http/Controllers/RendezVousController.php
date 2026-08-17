<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $user = auth()->user();

        $query = Consultation::with('patient')->where('prochain_rv', $date);

        if ($user->isInfirmier() && $user->structure) {
            $patientIds = Patient::where('structure', $user->structure)->pluck('id');
            $query->whereIn('patient_id', $patientIds);
        }

        $consultations = $query->orderBy('created_at')->get();

        return view('rendezvous.index', compact('consultations', 'date'));
    }
}

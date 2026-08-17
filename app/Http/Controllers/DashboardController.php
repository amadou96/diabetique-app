<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isInfirmier() && $user->structure) {
            $patientIds = Patient::where('structure', $user->structure)->pluck('id');

            $totalPatients = $patientIds->count();

            $rvAujourdhui = Consultation::whereIn('patient_id', $patientIds)
                ->where('prochain_rv', today())->count();

            $consultationsCeMois = Consultation::whereIn('patient_id', $patientIds)
                ->whereMonth('date_consultation', now()->month)
                ->whereYear('date_consultation', now()->year)
                ->count();

            $idsAvecSuivi = Consultation::whereIn('patient_id', $patientIds)
                ->select('patient_id')
                ->where('date_consultation', '>=', now()->subMonths(3)->toDateString())
                ->distinct()
                ->pluck('patient_id');

            $sansSuivi = Patient::where('structure', $user->structure)
                ->whereNotIn('id', $idsAvecSuivi)->count();

            $rvDuJour = Consultation::with('patient')
                ->whereIn('patient_id', $patientIds)
                ->where('prochain_rv', today())
                ->orderBy('created_at')
                ->get();

            $dernieresConsultations = Consultation::with('patient')
                ->whereIn('patient_id', $patientIds)
                ->latest('date_consultation')
                ->take(5)
                ->get();
        } else {
            $totalPatients = Patient::count();

            $rvAujourdhui = Consultation::where('prochain_rv', today())->count();

            $consultationsCeMois = Consultation::whereMonth('date_consultation', now()->month)
                ->whereYear('date_consultation', now()->year)
                ->count();

            $idsAvecSuivi = Consultation::select('patient_id')
                ->where('date_consultation', '>=', now()->subMonths(3)->toDateString())
                ->distinct()
                ->pluck('patient_id');

            $sansSuivi = Patient::whereNotIn('id', $idsAvecSuivi)->count();

            $rvDuJour = Consultation::with('patient')
                ->where('prochain_rv', today())
                ->orderBy('created_at')
                ->get();

            $dernieresConsultations = Consultation::with('patient')
                ->latest('date_consultation')
                ->take(5)
                ->get();
        }

        return view('dashboard.index', compact(
            'totalPatients',
            'rvAujourdhui',
            'consultationsCeMois',
            'sansSuivi',
            'rvDuJour',
            'dernieresConsultations'
        ));
    }
}

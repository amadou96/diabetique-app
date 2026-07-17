<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Cartes statistiques
        $totalPatients = Patient::count();

        $rvAujourdhui = Consultation::where('prochain_rv', today())->count();

        $consultationsCeMois = Consultation::whereMonth('date_consultation', now()->month)
            ->whereYear('date_consultation', now()->year)
            ->count();

        // Patients sans consultation depuis plus de 3 mois (ou jamais suivis)
        $patientsAvecSuiviRecent = Consultation::select('patient_id')
            ->where('date_consultation', '>=', now()->subMonths(3)->toDateString())
            ->distinct()
            ->pluck('patient_id');

        $sansSuivi = Patient::whereNotIn('id', $patientsAvecSuiviRecent)->count();

        // Liste RV du jour
        $rvDuJour = Consultation::with('patient')
            ->where('prochain_rv', today())
            ->orderBy('created_at')
            ->get();

        // 5 dernières consultations
        $dernieresConsultations = Consultation::with('patient')
            ->latest('date_consultation')
            ->take(5)
            ->get();

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

<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', now()->toDateString());

        $consultations = Consultation::with('patient')
            ->where('prochain_rv', $date)
            ->orderBy('created_at')
            ->get();

        return view('rendezvous.index', compact('consultations', 'date'));
    }
}

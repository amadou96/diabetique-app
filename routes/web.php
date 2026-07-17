<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\BilanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\DashboardController;

// Auth (public)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', fn () => redirect()->route('dashboard'));

// Routes accessibles à tous les utilisateurs connectés
Route::middleware('auth')->group(function () {

    // Tableau de bord
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Patients : lecture autorisée pour tout le monde connecté
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');

    // Consultations : l'infirmier peut créer
    Route::get('/consultations/create', [ConsultationController::class, 'create'])->name('consultations.create');
    Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store');

    // Rendez-vous du jour
    Route::get('/rendez-vous', [RendezVousController::class, 'index'])->name('rendezvous.index');

    // Routes réservées à l'admin
    Route::middleware('role:admin')->group(function () {

        // Patients (écriture) — routes statiques avant {patient}
        Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
        Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
        Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
        Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
        Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');

        // Bilans
        Route::get('/bilans/create', [BilanController::class, 'create'])->name('bilans.create');
        Route::post('/bilans', [BilanController::class, 'store'])->name('bilans.store');

        // Gestion des utilisateurs
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Route dynamique en dernier pour ne pas intercepter /patients/create
    Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
});

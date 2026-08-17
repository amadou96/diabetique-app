<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function bilans()
    {
        return $this->hasMany(Bilan::class);
    }
    protected $casts = [
        'date_naissance' => 'date',
    ];

    protected $fillable = [

        'numero_dossier',
        'structure',

        'nom',
        'prenom',
        'date_naissance',
        'sexe',

        'telephone',
        'adresse',
        'profession',
        'assure',

        'niveau_scolarisation',

        'groupe_sanguin',
        'allergies',
        'antecedents'
    ];
}
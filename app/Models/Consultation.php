<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $casts = [
        'date_consultation' => 'date',
        'prochain_rv'       => 'date',
    ];

    protected $fillable = [

        'patient_id',

        'date_consultation',

        'glycemie',
        'tension_systolique',
        'tension_diastolique',
        'poids',
        'taille',
        'temperature',
        'imc',
        'type_glycemie',

        'observations',
        'traitement',
        'frequence_cardiaque',
        'prochain_rv'
        
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}


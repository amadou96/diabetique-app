<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bilan extends Model
{
    protected $casts = [
        'date_bilan' => 'date',
    ];

    protected $fillable = [
        'patient_id',
        'date_bilan',
        'nom_bilan',
        'resultat',
        'unite',
        'observations',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}

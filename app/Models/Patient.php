<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public const STRUCTURES = [
        'Centre Sante Sangalkam',
        'Centre Sante Rufisque',
        'Centre Sante Colobane',
        'Centre Diabetique Rufisque',
        'Centre Sante Keur Massar',
        'Clinique NABY',
        'A Domicile',
    ];

    public const STRUCTURE_AUTRES = 'Autres';

    // Un patient sans consultation depuis ce nombre de mois est "sans suivi"
    public const MOIS_SANS_SUIVI = 4;

    /**
     * Retourne la structure saisie : la valeur du champ libre si "Autres" est choisi.
     */
    public static function structureFromRequest($request): ?string
    {
        if ($request->structure === self::STRUCTURE_AUTRES) {
            return trim($request->structure_autre);
        }

        return $request->structure;
    }

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
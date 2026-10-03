{{-- Champs du formulaire bilan, partagés entre création et modification. $bilan est optionnel. --}}
@php
    $bilan = $bilan ?? null;
    $nomActuel = old('nom_bilan', $bilan?->nom_bilan);
    $types = [
        'Bilan glucidique' => ['HbA1c' => 'HbA1c', 'Glycémie à jeun' => 'Glycémie à jeun', 'Glycémie postprandiale' => 'Glycémie postprandiale'],
        'Bilan lipidique'  => ['Cholestérol total' => 'Cholestérol total', 'LDL cholestérol' => 'LDL cholestérol', 'HDL cholestérol' => 'HDL cholestérol', 'Triglycérides' => 'Triglycérides'],
        'Bilan rénal'      => ['Créatinine' => 'Créatinine', 'Urée' => 'Urée', 'Microalbuminurie' => 'Microalbuminurie', 'DFG' => 'DFG (Débit de Filtration Glomérulaire)'],
        'Autres'           => ['NFS' => 'NFS (Numération Formule Sanguine)', 'Transaminases' => 'Transaminases (ALAT/ASAT)', 'TSH' => 'TSH', "Fond d'œil" => "Fond d'œil", 'ECG' => 'ECG', 'Autre' => 'Autre'],
    ];
@endphp

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label>Date du bilan</label>
    <input type="date" name="date_bilan" class="form-control"
           value="{{ old('date_bilan', $bilan?->date_bilan?->format('Y-m-d')) }}" required>
</div>

<div class="mb-3">
    <label>Nom du bilan</label>
    <select name="nom_bilan" class="form-control" required>
        <option value="">-- Choisir --</option>
        @foreach($types as $groupe => $options)
            <optgroup label="{{ $groupe }}">
                @foreach($options as $valeur => $libelle)
                    <option value="{{ $valeur }}" {{ $nomActuel === $valeur ? 'selected' : '' }}>{{ $libelle }}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Résultat</label>
    <input type="text" name="resultat" class="form-control" placeholder="ex : 7.2"
           value="{{ old('resultat', $bilan?->resultat) }}" required>
</div>

<div class="mb-3">
    <label>Unité</label>
    <input type="text" name="unite" class="form-control" placeholder="ex : %, g/L, mmol/L, mg/24h…"
           value="{{ old('unite', $bilan?->unite) }}">
</div>

<div class="mb-3">
    <label>Observations</label>
    <textarea name="observations" class="form-control" rows="3"
              placeholder="Commentaire, interprétation…">{{ old('observations', $bilan?->observations) }}</textarea>
</div>

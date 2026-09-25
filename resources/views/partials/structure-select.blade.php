{{--
    Liste des structures avec option "Autres" + champ de saisie libre.
    Paramètres : $label, $current (valeur actuelle), $required (bool), $id (préfixe des ids)
--}}
@php
    $id       = $id ?? 'structure';
    $required = $required ?? true;
    $current  = old('structure', $current ?? null);
    $autres   = \App\Models\Patient::STRUCTURE_AUTRES;
    // Une valeur hors liste (déjà enregistrée) correspond à "Autres"
    $estAutre = $current === $autres || ($current && !in_array($current, \App\Models\Patient::STRUCTURES));
    $valeurAutre = old('structure_autre', ($estAutre && $current !== $autres) ? $current : '');
@endphp

<label class="form-label">{{ $label }} <span class="text-danger">*</span></label>
<select name="structure" class="form-control" id="{{ $id }}Select" {{ $required ? 'required' : '' }}>
    <option value="">-- Choisir la structure --</option>
    @foreach(\App\Models\Patient::STRUCTURES as $s)
        <option value="{{ $s }}" {{ $current === $s ? 'selected' : '' }}>{{ $s }}</option>
    @endforeach
    <option value="{{ $autres }}" {{ $estAutre ? 'selected' : '' }}>{{ $autres }}</option>
</select>

<div class="mt-2" id="{{ $id }}AutreField" @unless($estAutre) hidden @endunless>
    <input type="text" name="structure_autre" id="{{ $id }}AutreInput" class="form-control"
           value="{{ $valeurAutre }}" maxlength="255" placeholder="Préciser la structure">
</div>

<script>
    (function () {
        const select = document.getElementById('{{ $id }}Select');
        const field  = document.getElementById('{{ $id }}AutreField');
        const input  = document.getElementById('{{ $id }}AutreInput');

        function toggleAutre() {
            const autre = select.value === @json($autres);
            field.hidden   = !autre;
            input.required = autre;
        }

        select.addEventListener('change', toggleAutre);
        toggleAutre();
    })();
</script>

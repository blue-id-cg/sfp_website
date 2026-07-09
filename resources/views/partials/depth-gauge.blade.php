@php
    /**
     * Jauge de profondeur : reformule la progression de scroll en mètres forés,
     * en écho direct au métier de la SFP plutôt qu'un menu de points classique.
     */
@endphp
<div class="depth-gauge" id="depthGauge" aria-hidden="true">
    <div class="depth-gauge-readout">
        <span class="depth-gauge-value" id="depthValue">0 m</span>
        <span class="depth-gauge-label" id="depthLabel">Surface</span>
    </div>
    <div class="depth-gauge-rail">
        <div class="depth-gauge-fill" id="depthFill"></div>
        <span class="depth-gauge-bit" id="depthBit"></span>
    </div>
</div>

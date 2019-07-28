<div id="dadosGerais" class="w3-container w3-border w3-padding city">
  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-half">
      <label>Número Processo</label>
      <input class="w3-input w3-border" type="text" value="<?=$Processo->Numero?>" disabled>
    </div>
    <div class="w3-half">
      <label>Data Abertura</label>
      <input class="w3-input w3-border" type="text" value="<?=date('d/m/Y', strtotime($Processo->DataAbertura))?>" disabled>
    </div>
  </div>
  
  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-half">
      <label>Fase Atual</label>
      <input class="w3-input w3-border" type="text" value="<?=$Processo->FaseAtual?>" disabled>
    </div>
    <div class="w3-half">
      <label>Prazo Fase Atual</label>
      <input class="w3-input w3-border" type="text" value="<?=date('d/m/Y', strtotime($Processo->Prazo))?>" disabled>
    </div>
  </div>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-half">
      <label>Votos Recebidos</label>
      <input class="w3-input w3-border" type="text" value="<?=$Processo->NumeroVotos?>" disabled>
    </div>
    <div class="w3-half">
      <label>Situação</label>
      <input class="w3-input w3-border" type="text" value="<?=$Processo->Julgado ? 'Julgado' : 'Em Pauta' ?>" disabled>
    </div>
  </div>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-col">
      <b>Síntese</b>
      <p><?=$Processo->Sintese?></p>
    </div>
  </div>

</div>
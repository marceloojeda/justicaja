<?php
foreach($Processos as $processo) {
?>

<div class="w3-half">
  <header class="w3-container w3-light-grey w3-padding">
    <div class="w3-row w3-margin-bottom">
      <span class="w3-left"><b>Número: </b> <?=$processo['Numero']?></span>
      <span class="w3-right"><b>Abertura: </b><?=date('d/m/Y', strtotime($processo['DataAbertura']))?></span>
    </div>
    <div class="w3-row">
      <span class="w3-left"><b>Votos: </b> <?=$processo['NumeroVotos']?></span>
      <span class="w3-right"><b>Prazo: </b><?=date('d/m/Y', strtotime($processo['Prazo']))?></span>
    </div>
  </header>
  <div class="w3-container box-processo">
    <h6><b>Síntese do caso</b></h6>
    <p><?=$processo['Sintese']?></p>
  </div>
  <a href="<?=base_url().'monitor/Processos/verProcesso/'.$processo['Id']?>" class="w3-button w3-block w3-dark-grey">+ Ver Detalhes</a>
</div>

<?php } ?>
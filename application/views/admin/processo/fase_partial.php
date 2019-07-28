<div id="fase-modal" class="w3-modal">
  <form action="" method="post">
    <div class="w3-modal-content">

      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('fase-modal').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h4>Tramitar Processo</h4>
      </header>

      <div class="w3-container w3-margin">
        <div class="w3-row-padding">
            <div class="w3-half">
                <label class="w3-text-grey">Fase Atual</label>
                <input class="w3-input w3-border" type="text" id="faseAtual">
            </div>
            <div class="w3-half">
                <label class="w3-text-grey">Próxima Fase</label>
                <select class="w3-select" name="Fase" id="fases" required>
                    <option value="" disabled selected>Selecione</option>
                </select>
            </div>
        </div>
      </div>

      <footer class="w3-container w3-light-gray w3-padding">
        <input type="hidden" name="ProcessoId" id="idProcesso">
        <button class="w3-btn w3-green w3-right" type="submit">Salvar</button>
      </footer>

    </div>
  </form>
</div>
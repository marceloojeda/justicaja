<div class="w3-container">
  <h3>Dados do processo</h3>
  <p>Avalie as peças enviadas pelas partes, provas e documentações.</p>

  <div class="w3-bar w3-black">
    <button class="w3-bar-item w3-button tablink w3-red" onclick="openCity(event,'dadosGerais')">Dados gerais</button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'razoes')">Razões</button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'contestacao')">Contestação</button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'replica')">Réplica</button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'treplica')">Tréplica</button>

    <button class="w3-bar-item w3-button w3-right w3-text-yellow tablink" onclick="openCity(event,'solucoes')">Soluções Propostas</button>
  </div>
  
  <?php $this->load->view('monitor/Processos/detalhes_dados_gerais', $DadosView); ?>
  <?php $this->load->view('monitor/Processos/detalhes_razoes', $DadosView); ?>
  <?php $this->load->view('monitor/Processos/detalhes_contestacao', $DadosView); ?>

  <?php $this->load->view('monitor/Processos/detalhes_replica', $DadosView); ?>

  <?php $this->load->view('monitor/Processos/detalhes_treplica', $DadosView); ?>

  <?php $this->load->view('monitor/Processos/detalhes_solucoes', $DadosView); ?>

</div>
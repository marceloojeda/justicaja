<?php $this->load->view('admin/shared/header') ?>

<script src="<?php echo base_url();?>assets/js/admin/analysi/converter_pedido.js" type="text/javascript"></script>

<script src="https://www.w3schools.com/lib/w3.js"></script>

<section id="pedidoList">
  <div class="w3-container">
    <h2>Conversão de Pedido de Abertura de Processo</h2>
    <p>Confira e atualize, se for o caso, os dados das Partes. Na aba Prazos você deve confirmar o tempo de cada fase processual.</p>

    <div class="w3-bar w3-black">
      <button class="w3-bar-item w3-button tablink w3-red" onclick="openCity(event,'Autor')">Autor</button>
      <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Reu')">Réu</button>
      <?php if($dataPost["Promotor"] !== null) { ?>
      <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Promotor')">Promotor</button>
      <?php } ?>
      <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Docs')">Documentos</button>
      <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Provas')">Provas</button>
      <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Notificacoes')">Observações e Notificações</button>
      <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Razoes')">Razões e Constestações</button>
      <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Converter')">Salvar e Converter</button>
    </div>

    <form action="<?php echo base_url();?>admin/AnalysiPedido/ConfirmaPedido/<?=$dataPost['Pedido']['Id'];?>" method="post">
      <div id="Autor" class="w3-container w3-border city">
        <?php $this->load->view("admin/analysi/confirm_autor_partial", $dataPost); ?>
      </div>

      <div id="Reu" class="w3-container w3-border city" style="display:none">
        <?php $this->load->view("admin/analysi/confirm_reu_partial", $dataPost); ?>
      </div>

      <div id="Docs" class="w3-container w3-border city" style="display:none">
        <?php $this->load->view("admin/analysi/confirm_documentos_partial", $dataPost); ?>
      </div>
      <div id="Provas" class="w3-container w3-border city" style="display:none">
        <?php $this->load->view("admin/analysi/confirm_provas_partial", $dataPost); ?>
      </div>
      <div id="Notificacoes" class="w3-container w3-border city" style="display:none">
        <?php $this->load->view("admin/analysi/confirm_notificacoes_partial", $dataPost); ?>
      </div>
      <div id="Razoes" class="w3-container w3-border city" style="display:none">
        <?php $this->load->view("admin/analysi/confirm_contestacoes_partial", $dataPost); ?>
      </div>
      <div id="Converter" class="w3-container w3-border city" style="display:none">
        

        <div class="w3-panel w3-light-grey">
          <h5>Observações durante análise do PAP</h5>
          <div class="w3-panel">
            <?php echo $dataPost["Analise"]["Observacao"]; ?>
          </div>
        </div>

        <div class="w3-panel w3-light-grey">
          <h3>Síntese do Processo</h3>
          <div class="w3-panel">
            <div class="form-group">
              <textarea class="summernote" name="Sintese" required></textarea>
            </div>
          </div>
        </div>

        <div class="w3-panel w3-center">
          <button class="w3-btn w3-red w3-margin" type="submit">Guardar as alterações e converter esse pedido em processo</button>
        </div>
      </div>
    </form>
  </div>
</section>
<?php $this->load->view('admin/shared/footer') ?>
<div class="modal" tabindex="-1" role="dialog" id="razoes-aceite">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?=base_url()?>monitor/Processos/manifestacaoReu" method="post" role="form">
        <div class="modal-header">
          <h5 class="modal-title">Gostaria de se manifestar?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <textarea class="summernote" name="Observacao" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="PedidoId" value="<?=$DadosView['Pedido']['Id'];?>">
          <input type="hidden" name="AnaliseId" value="<?=$DadosView['Analise']['Id'];?>">
          <input type="hidden" id="manifestacao-tipo-aceito" name="ManifestacaoTipo" value="">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>
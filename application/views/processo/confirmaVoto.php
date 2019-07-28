<div class="modal fade" id="modalConfirmaVoto">
  <div class="modal-dialog" role="document"> 
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Atenção!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="CodigoSolucao">
        <p>Você confirma seu voto?</p>
        <div id="errorDialog" class="text-danger"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnConfirmaVoto">Sim</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
      </div>
    </div>
  </div>
</div>
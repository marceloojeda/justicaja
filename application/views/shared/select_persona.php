<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <img class="card-img-top img-fluid" src="<?php echo base_url();?>assets/img/done_icon.png" alt="Instauração de processos" width="50" height="60">
      </div>
      <div class="card-block">
        <h4 class="card-title">Instauração de processos</h4>
        <ul class="list-group">
          <li class="list-group-item">jksfjksdf fsjfhsdjkf</li>
          <li class="list-group-item">jksfjksdf fsjfhsdjkf</li>
          <li class="list-group-item">jksfjksdf fsjfhsdjkf</li>
          <li class="list-group-item">jksfjksdf fsjfhsdjkf</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <img class="card-img-top img-fluid" src="<?php echo base_url();?>assets/img/done_icon.png" alt="Instauração de processos" width="50" height="60">
      </div>
      <div class="card-block">
        <h4 class="card-title">Interagir com processos</h4>
        <ul class="list-group">
          <?php foreach ($dataView['clients'] as $key => $value) { ?>
          <li class="list-group-item">
            <a href="<?php echo base_url().'Account/StartDashboardTest/'.$value['ArbitroId'];?>"><?php echo $value['Nome'];?></a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <img class="card-img-top img-fluid" src="<?php echo base_url();?>assets/img/done_icon.png" alt="Instauração de processos" width="50" height="60">
      </div>
      <div class="card-block">
        <h4 class="card-title">Comentar sentenças</h4>
        <ul class="list-group">
          <li class="list-group-item">jksfjksdf fsjfhsdjkf</li>
          <li class="list-group-item">jksfjksdf fsjfhsdjkf</li>
          <li class="list-group-item">jksfjksdf fsjfhsdjkf</li>
          <li class="list-group-item">jksfjksdf fsjfhsdjkf</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('header') ?>

<script src="<?php echo base_url();?>assets/js/editProfile.js"></script>

<!-- <section id="create-account"> -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h3 class="mb-2">CADASTRE-SE</h3>
      </div>
    </div>
    <hr>
    <div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <form role="form" method="post" enctype="multipart/form-data">
        <div class="text-center mb-2">
          <img src="<?php echo base_url();?>assets/img/avatar_perfil.png" class="avatar img-circle" alt="avatar" id="imgFoto">
          <h6>foto do perfil</h6>

          <!-- <input type="file" name="FotoPerfil" class="file form-control" id="foto-perfil" data-show-preview="false"> -->
        </div>
        </form>

        <div class="mb-2">
          <a href="#" id="showPersonal" class="hide">Meus dados</a>
        </div>

        <div class="mb-2">
          <a href="#" id="showAndress" class="hide">Dados do Endereço</a>
        </div>

        <div class="mb-2">
          <a href="#" id="showLogin" class="hide">Dados de login</a>
        </div>
      </div>

      <?php echo form_hidden('Stage', $dataPost['stage']); ?>

      <div id="personal-info">
        <?php $this->load->view('account/personalInf_partial'); ?>
      </div>

      <div id="andress-info" class="hide">
        <?php $this->load->view('account/andressInf_partial'); ?>
      </div>

      <div id="login-info" class="hide">
        <?php $this->load->view('account/loginInf_partial'); ?>
      </div>
    </div>
  </div>

<!-- </section> -->

<?php $this->load->view('footer') ?>
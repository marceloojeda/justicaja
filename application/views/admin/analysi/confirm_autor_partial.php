<?php
  echo form_hidden("TipoPessoa_Autor", $dataPost["Autor"]["Tipo"]);
  echo form_hidden("TipoDocumento_Autor", $dataPost["Autor"]["DocumentoTipo"]);
  echo form_hidden("Autor[Id]", $dataPost["Autor"]["Id"]);
  echo form_hidden("Autor[DataCadastro]", $dataPost["Autor"]["DataCadastro"]);
?>

<div class="w3-panel w3-light-grey">
  <h5>Dados pessoais</h5>

  <div class="w3-row-padding" style="margin:0 -16px;">
    <div class="w3-half w3-margin-bottom">
      <label for="tipoPessoa">Tipo Pessoa</label>
      <select class="w3-select w3-border" id="tipoPessoa_Autor" name="Autor[Tipo]">
        <option value="Pessoa Física">Pessoa Física</option>
        <option value="Pessoa Jurídica">Pessoa Jurídica</option>
      </select>
    </div>
    <div class="w3-half">
      <label>Nome/Razão Social</label>
      <input type="text" name="Autor[Nome]" value="<?php echo $dataPost['Autor']['Nome']; ?>" class="w3-input w3-border">
    </div>
  </div>

  <div class="w3-row-padding" style="margin:0 -16px;">
    <div class="w3-half w3-margin-bottom">
      <label for="tipoPessoa">CPF/CNPJ</label>
      <input type="text" name="Autor[CpfCnpj]" value="<?php echo $dataPost['Autor']['CpfCnpj']; ?>" class="w3-input w3-border">
    </div>
    <div class="w3-half">
      <div class="w3-half">
        <label for="tipoDoc" class="w3-block w3-padding-top">Tipo Doc.</label>
        <select class="w3-select w3-border" id="tipoDoc_Autor" name="Autor[DocumentoTipo]">
          <option value="RG" selected>RG</option>
          <option value="Cart. Motorista">Cart. Motorista</option>
          <option value="OAB">OAB</option>
        </select>
      </div>
      <div class="w3-half">
        <label for="numDoc">Nº Documento</label>
        <input type="text" id="numDoc" name="Autor[DocumentoNumero]" class="w3-input w3-border" value="<?php echo $dataPost['Autor']['DocumentoNumero']; ?>">
      </div>
    </div>
  </div>
</div>

<div class="w3-panel w3-light-grey">
  <h5>Dados de contato</h5>
  <div class="w3-row-padding" style="margin:0 -16px;">
    <div class="w3-half w3-margin-bottom">
      <label for="email">Email</label>
      <input type="text" id="email" name="Autor[Email]" class="w3-input w3-border" value="<?php echo $dataPost['Autor']['Email']; ?>">
    </div>
    <div class="w3-half">
      <div class="w3-half">
        <label for="telefone">Fone fixo</label>
        <input type="text" id="telefone" name="Autor[FoneFixo]" class="w3-input w3-border" value="<?php echo $dataPost['Autor']['FoneFixo']; ?>">
      </div>
      <div class="w3-half">
        <label for="celular">Celular</label>
        <input type="text" id="celular" name="Autor[Celular]" class="w3-input w3-border" value="<?php echo $dataPost['Autor']['Celular']; ?>">
      </div>
    </div>
  </div>
</div>

<div class="w3-panel w3-light-grey">
  <h5>Dados do endereço</h5>
  <div class="w3-row-padding" style="margin:0 -16px;">
    <div class="w3-half w3-margin-bottom">
      <div class="w3-third">
        <label for="cep">CEP</label>
        <input type="text" id="cep" name="Autor[CEP]" class="w3-input w3-border" value="<?php echo $dataPost['Autor']['CEP']; ?>">
      </div>
      <div class="w3-twothird">
        <label for="endereco">Endereço</label>
        <input type="text" id="endereco" name="Autor[Endereco]" class="w3-input w3-border" value="<?php echo $dataPost['Autor']['Endereco']; ?>">
      </div>
    </div>
    <div class="w3-half">
      <div class="w3-half">
        <label for="numero">Casa/Lote</label>
        <input type="text" id="numero" name="Autor[Numero]" class="w3-input w3-border" value="<?php echo $dataPost['Autor']['Numero']; ?>">
      </div>
      <div class="w3-half">
        <label for="complemento">Complemento</label>
        <input type="text" id="complemento" name="Autor[ComplementoEndereco]" class="w3-input w3-border" value="<?php echo $dataPost['Autor']['ComplementoEndereco']; ?>">
      </div>
    </div>
  </div>

  <div class="w3-row-padding" style="margin:0 -16px;">
    <div class="w3-half w3-margin-bottom">
      <label for="bairro">Bairro/Setor</label>
      <input type="text" id="bairro" name="Autor[Bairro]" class="w3-input w3-border" value="<?php echo $dataPost['Autor']['Bairro']; ?>">
    </div>
    <div class="w3-half">
      <div class="w3-twothird">
        <label for="cidade">Cidade</label>
        <input type="text" id="cidade" name="Autor[Cidade]" class="w3-input w3-border" value="<?php echo $dataPost['Autor']['Cidade']; ?>">
      </div>
      <div class="w3-third">
        <label for="uf">UF</label>
        <input type="text" id="uf" name="Autor[UF]" class="w3-input w3-border" value="<?php echo $dataPost['Autor']['UF']; ?>">
      </div>
    </div>
  </div>
</div>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct() {
		parent::__construct();

		setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');
	}

	function Index()
	{
    $this->load->Model('PessoaModel');
    if($this->PessoaModel->GetDataUser('UsuarioAutenticado')){
      redirect(base_url()."monitor/Welcome");
    }
    
		$this->load->view('account/login');
	}


	function Login(){
		$this->load->model('PessoaModel');

		$loginInfo = array('Username' => $this->input->post('username'),
			'Password' => $this->input->post('password'));

		$usuarioAutenticado = $this->PessoaModel->AutenticarVisitante($loginInfo);

    if(!$usuarioAutenticado){
			$data['errorMessage'] = "Nome de usuário ou senha inválida!";
			$this->load->view('account/login', $data);
		}else{
			$this->load->model('PessoaModel');
			$client = $this->PessoaModel->GetByLogin($loginInfo['Username']);

			$userData = array(
				'Nome' => $client[0]['Nome'],
				'PessoaId' => $client[0]['PessoaId'],
				'ArbitroId' => $client[0]['ArbitroId'],
				'CpfCnpj' => $client[0]['CpfCnpj'],
				'UsuarioAutenticado' => true,
        'TipoUsuario' => $client[0]['UserType']
      );

			$this->PessoaModel->SetDataUser($userData);

			if($client[0]['UserType'] == 'Adm')
        redirect(base_url()."admin");
      else
        redirect(base_url()."monitor/Welcome");
    }
  }


  function username_check($str){
    $this->load->model('PessoaModel');
    $result = $this->PessoaModel->CheckUsername($str);

    if(!$result){
      $this->form_validation->set_message('username_check', 'E-mail informado não consta em nossa base de dados!');
      return false;
    }
    else
      return true;
  }

  function forgotPassword(){
    $this->form_validation->set_rules('Email', 'E-mail', 'required|valid_email|callback_username_check');

    if ($this->form_validation->run() == FALSE)
      $this->load->view('account/forgotPassword');
    else
    {
      $this->load->model('PessoaModel');
      $account = $this->PessoaModel->GetByLogin(trim($this->input->post('Email')));
      $hashData = hash("md5", $account[0]['Username']);
      $recoveryInfo = array(
        "AccountId" => $account[0]['AccountId'],
        "HashData" => $hashData,
        "DataRequisicao" => date('Y-m-d H:i:s')
      );
      $this->PessoaModel->RecuperacaSenha_Insert($recoveryInfo);

		  //Inicia o processo de configuração para o envio do email
      $config = Array(
       'useragent' => SMTP_AGENT,
       'protocol'  => SMTP_PROTOCOL,
       'smtp_host' => SMTP_HOST,
       'smtp_port' => SMTP_PORT,
       'smtp_user' => SMTP_USER,
       'smtp_pass' => SMTP_PASS,
       'mailtype'  => SMTP_MAILTYPE, 
       'charset'   => SMTP_CHARSET
     );

        // Inicializa a library Email, passando os parâmetros de configuração
      $this->email->initialize($config);

      	// Define remetente e destinatário
      	$this->email->from(SMTP_FROM, SMTP_FROM_NAME); // Remetente
      	// Destinatário
      	$this->email->to($this->input->post('Email'));

      	// Define o assunto do email
      	$this->email->subject("Justica Ja - Recuperacao de senha");

      	$texto = "<h2>"
        .htmlentities("Olá ".$account[0]['Nome'].",")
        ."</h2><p>"
        .htmlentities("Você está recebendo esse e-mail porque foi solicitado no site do Justiça Já uma recuperação da senha de acesso à plataforma.")
        ."</p><p>"
        .htmlentities("Caso você não tenha feito esse pedido, pedimos que descosidere essa mensagem.")
        ."</p><p>"
        ."Para alterar sua senha de acesso clique em:"
        ."</p><p>"
        ."<a href='".base_url()."Account/ResetPassword/".$hashData."'>"
        .base_url()."Account/ResetPassword/".$hashData
        ."</a></p>";


        $this->email->message($texto);

        if($this->email->send()){
          $data['Mensagem'] = $texto;
          $this->load->view('account/forgotConfirm', $data);
        }
      }
    }

    function ResetPassword(){
      if($this->uri->segment(3) === null){
        $data['dataPost'] = array(
          "errorMessage" => "Não foi possível identificar seu registro em nosso banco de dados.",
          "pessoa" => null
        );
        $this->load->view('account/resetPassword', $data);
      }

      $hashData = $this->uri->segment(3);

      $this->load->model('PessoaModel');

      $pessoa = $this->PessoaModel->GetByHashdata($hashData);

      if($pessoa !== null){

        $data['dataPost'] = array("pessoa" => $pessoa[0]);

        $this->load->view('account/resetPassword', $data);

      }
      else{
        $data['dataPost'] = array(
          "errorMessage" => "Não foi possível identificar seu registro em nosso banco de dados.",
          "pessoa" => null
        );
        $this->load->view('account/resetPassword', $data);
      }
    }

    function UpdatePassword(){
      $this->load->model('PessoaModel');

      $config = array(
        array(
          'field' => 'Password',
          'label' => 'Password',
          'rules' => 'required'
        ),
        array(
          'field' => 'ConfirmPassword',
          'label' => 'Password Confirmation',
          'rules' => 'required|matches[Password]'
        )
      );

      $dataUpdate = array(
        "Id" => $this->input->post('AccountId'),
        "Password" => $this->input->post('Password')
      );

      $this->form_validation->set_rules($config);

      $pessoa = $this->PessoaModel->GetById($this->input->post('PessoaId'));
      $dataInfo = array(
        "Nome" => $pessoa[0]['Nome'],
        "AccountId" => $this->input->post('AccountId'),
        "PessoaId" => $this->input->post('PessoaId')
      );

      if ($this->form_validation->run() == FALSE){

        $data['dataPost'] = array(
          "FormValidation" => false,
          "pessoa" => $dataInfo
        );

        $this->load->view('account/resetPassword', $data);
      }else{
        $this->PessoaModel->UpdatePassword($dataUpdate);

        $data['dataPost'] = array(
          "FormValidation" => true,
          "pessoa" => $dataInfo
        );

        $this->load->view('account/passwordUpdate', $data);
      }
    }

    function StartDashboardTest($id){
     $this->load->model('PessoaModel');
     $client = $this->PessoaModel->GetByArbitro($id);

     if($client == null)
      redirect(base_url());

    $userData = array(
      'Nome' => $client[0]['Nome'],
      'PessoaId' => $client[0]['PessoaId'],
      'ArbitroId' => $client[0]['ArbitroId'],
      'CpfCnpj' => $client[0]['CpfCnpj'],
      'UsuarioAutenticado' => true
    );

    $this->PessoaModel->SetDataUser($userData);

    redirect(base_url()."processo");
  }

  function Logout(){
    $userData = array('Nome','PessoaId','ArbitroId','CpfCnpj','UsuarioAutenticado','TipoUsuario');
    $this->load->model('PessoaModel');
    $this->PessoaModel->UnsetDataUser($userData);

    if($this->input->get('redirect')){
      redirect(base_url().$this->input->get('redirect'));
    }
    redirect(base_url());
  }

  function EditPerfil(){
    $this->load->model('PessoaModel');
    if($this->PessoaModel->GetDataUser('UsuarioAutenticado') == null){
      redirect(base_url());
    }

    $pessoa = $this->PessoaModel->GetById($this->PessoaModel->GetDataUser('PessoaId'));

    $data['dataPost'] = array("result" => $pessoa[0]);
    $this->load->view('account/editProfile', $data);
  }


  function Create(){
    $data['dataPost'] = array("result" => null, "stage" => "personalInfo");
    $this->load->view('account/editProfile', $data);
  }


  function SavePersonalInfo(){
    $this->load->model('PessoaModel');

    $config = array(
      array(
        'field' => 'Nome',
        'label' => 'Nome completo',
        'rules' => 'required'
      ),
      array(
        'field' => 'CpfCnpj',
        'label' => 'Cpf/Cnpj',
        'rules' => 'required'
      ),
      array(
        'field' => 'Celular',
        'label' => 'Celular',
        'rules' => 'required'
      ),
      array(
        'field' => 'Email',
        'label' => 'E-mail',
        'rules' => 'required|valid_email'
      )
    );

    $dataInsert = array(
      "Nome" => $this->input->post('Nome'),
      "CpfCnpj" => $this->input->post('CpfCnpj'),
      "Endereco" => '',
      "Bairro" => '',
      "Cidade" => '',
      "UF" => '',
      "Email" => $this->input->post('Email'),
      "FoneFixo" => $this->input->post('Telefone'),
      "Celular" => $this->input->post('Celular'),
      "Tipo" => $this->input->post('Tipo'),
      "DocumentoTipo" => $this->input->post('DocumentoTipo'),
      "DocumentoNumero" => $this->input->post('DocumentoNumero'),
      "DataCadastro" => date('Y-m-d H:i:s')
    );

    $this->form_validation->set_rules($config);

    if ($this->form_validation->run() == FALSE){
      $data['dataPost'] = array(
        "result" => $dataInsert,
        "stage" => "personalInfo",
        "FormValidation" => false
      );
      $this->load->view('account/editProfile', $data);
    } else {

      $codigoPessoa = $this->PessoaModel->Insert_Pessoa($dataInsert);

      $pessoa = $this->PessoaModel->GetById($codigoPessoa);

      $data['dataPost'] = array(
        "result" => $pessoa[0],
        "stage" => "andressInfo",
        "FormValidation" => true);
      $this->load->view('account/editProfile', $data);
    }
  }

  function SaveAndressInfo(){
    $this->load->model('PessoaModel');

    $config = array(
      array(
        'field' => 'Endereco',
        'label' => 'Endereço',
        'rules' => 'required'
      ),
      array(
        'field' => 'Numero',
        'label' => 'Numero/Lote',
        'rules' => 'required'
      ),
      array(
        'field' => 'Bairro',
        'label' => 'Bairro/Setor',
        'rules' => 'required'
      ),
      array(
        'field' => 'Cidade',
        'label' => 'Cidade',
        'rules' => 'required'
      ),
      array(
        'field' => 'UF',
        'label' => 'UF',
        'rules' => 'required'
      )
    );

    $dataInsert = array(
      "Endereco" => $this->input->post('Endereco'),
      "Numero" => $this->input->post('Numero'),
      "ComplementoEndereco" => $this->input->post('ComplementoEndereco'),
      "Bairro" => $this->input->post('Bairro'),
      "Cidade" => $this->input->post('Cidade'),
      "UF" => $this->input->post('UF'),
      "CEP" => $this->input->post('CEP')
    );

    $this->form_validation->set_rules($config);

    if ($this->form_validation->run() == FALSE){
      $data['dataPost'] = array(
   "result" => $dataInsert,
   "stage" => "andressInfo",
   "FormValidation" => false);
      $this->load->view('account/editProfile', $data);
    }else{

      $codigoPessoa = $this->PessoaModel->Update($dataInsert, $this->input->post('Id'));

      $pessoa = $this->PessoaModel->GetById($this->input->post('Id'));

      $data['dataPost'] = array(
        "result" => $pessoa[0],
        "stage" => "loginInfo",
        "FormValidation" => true
      );
      $this->load->view('account/editProfile', $data);
    }
  }


  function SaveLoginInfo(){
    $this->load->model('PessoaModel');

    $config = array(
      array(
        'field' => 'UserName',
        'label' => 'Username',
        'rules' => 'required'
      ),
      array(
        'field' => 'Password',
        'label' => 'Password',
        'rules' => 'required'
      ),
      array(
        'field' => 'ConfirmPassword',
        'label' => 'Password Confirmation',
        'rules' => 'required|matches[Password]'
      )
    );

    $dataInsert = array(
      "PessoaId" => $this->input->post('Id'),
      "UserName" => $this->input->post('UserName'),
      "Password" => $this->input->post('Password'),
      "DataCadastro" => date('Y-m-d H:i:s')
    );

    $this->form_validation->set_rules($config);

    if ($this->form_validation->run() == FALSE){
      $pessoa = $this->PessoaModel->GetById($this->input->post('Id'));
      $data['dataPost'] = array(
        "result" => $pessoa[0],
        "stage" => "loginInfo",
        "FormValidation" => false
      );
      $this->load->view('account/editProfile', $data);
    }else{

      $codigoPessoa = $this->PessoaModel->UpdateLogin($dataInsert);

      $pessoa = $this->PessoaModel->GetById($this->input->post('Id'));

      $data['dataPost'] = array(
        "result" => $pessoa[0],
        "stage" => "finally",
        "FormValidation" => true
      );
      $this->load->view('account/createConfirm', $data);
    }
  }

  function uploadFoto(){
    $file = isset($_FILES['FotoPerfil']) ? $_FILES['FotoPerfil'] : null;
    $uploaddir = FCPATH."assets/uploads/perfil/";
    if(!get_dir_file_info($uploaddir.$file['name'])){
      $uploadfile = $uploaddir . $file['name'];
      move_uploaded_file($file['tmp_name'], $uploadfile);

      $this->output->set_content_type('application/json')->set_output(json_encode($file['name']));
    }else{
      $temp = explode(".", $file["name"]);
      $newfilename = round(microtime(true)) . '.' . end($temp);
      $uploadfile = $uploaddir . $newfilename;
      move_uploaded_file($file['tmp_name'], $uploadfile);

      $this->output->set_content_type('application/json')->set_output(json_encode($newfilename));
    }
  }

  function confirmaCadastro(){
    if(!$this->input->get('hashTag')){
      $this->load->view('pedido/order-not-found');
      return;
    }

    $this->load->model('PessoaModel');

    $pessoa = $this->PessoaModel->confirmarEmail($this->input->get('hashTag'));

    $dataView = array(
      'Title' => 'Parabéns '.$pessoa['Nome'].',', 
      'Descricao' => 'Seu cadastrado foi confirmado com sucesso e você já pode acessar nossa plataforma.<p><a href="'.base_url().'monitor'.'">Clique aqui</a> para ver o Pedido de Abertura em que você é indicado como réu.</p>'
    );

    $data = array('dataView' => $dataView);

    $this->load->view('account/confirmaEmail', $data);
  }
}
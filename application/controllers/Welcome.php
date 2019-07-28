<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['dataView'] = array(
			"title" => "Justiça Já",
			"subtitle" => "Plataforma de Arbitragem Eletrônica");

		$this->load->view('welcome_message', $data);
	}

	function order($erro = null, $hashTag = null){
		if(!$this->input->get('hashTag') && is_null($hashTag)){
			$this->load->view('pedido/order-not-found');
			return;
		}

		$hashTag = is_null($hashTag) ? $this->input->get('hashTag') : $hashTag;
		$this->load->model('PedidoAberturaModel');
		$this->load->model('PessoaModel');

		$pedido = $this->PedidoAberturaModel->GetByCodigoAceite($hashTag);
		if(!$pedido){
			$this->load->view('pedido/order-not-found');
			return;
		}

		$account = $this->PessoaModel->getAccountByPessoaId($pedido[0]['ReuId']);
		$autores = $this->PessoaModel->GetById($pedido[0]['PessoaId']);
		$reus = $this->PessoaModel->GetById($pedido[0]['ReuId']);

		$autor = $autores[0];
		$reu = $reus[0];
		
		if(!$account){
			$data['dataView'] = array(
				"Title" => "Autenticação na Plataforma",
				"Subtitle" => "Para visualizar os dados do Pedido de Abertura de Processo, em que você é apontado como réu, é necessário ter um cadastro na plataforma.",
				"Pedido" => $pedido !== null ? $pedido[0] : null,
				"Autor" => $autor,
				"Reu" => $reu,
				"Erro" => $erro
			);

			$this->load->view('account/atualizaReu', $data);
			return;
		}

		$autor = null;
		$reu = null;

		if($pedido !== null){
			$autores = $this->PessoaModel->GetById($pedido[0]['PessoaId']);
			$reus = $this->PessoaModel->GetById($pedido[0]['ReuId']);

			$autor = $autores[0];
			$reu = $reus[0];
		}

		$data['dataView'] = array(
			"Title" => "Pedido de Abertura de Processo",
			"Subtitle" => "Segue dados do processo",
			"Pedido" => $pedido !== null ? $pedido[0] : null,
			"Autor" => $autor,
			"Reu" => $reu
		);

		$this->load->view('pedido/OrderReview', $data);
	}


	function salvarDadosReu(){
		if(!$this->input->post()){
			//$this->order("Favor preencher os campos abaixo.");
			$this->load->view('pedido/order-not-found');
			return;
		}

		$reuDados = array(
			'Nome' => $this->input->post('nome'),
			'Email' => $this->input->post('email'),
			'FoneFixo' => strlen($this->input->post('telefone')) <= 14 ? $this->input->post('telefone') : null,
			'Celular' => strlen($this->input->post('telefone')) > 14 ? $this->input->post('telefone') : null
		);

		$this->load->model('PessoaModel');
		$this->load->helper('user_session');

		$this->PessoaModel->Update($reuDados, $this->input->post('reuId'));

		$contaDados = array(
			'PessoaId' => $this->input->post('reuId'),
			'UserName' => $this->input->post('email'),
			'Password' => $this->input->post('senha'),
			'DataCadastro' => date('Y-m-d H:i:s'),
			'UserType' => 'Padrao',
			'CodigoConfirmacao' => GeraHash(40),
			'EmailConfirmado' => 0
		);

		// if($this->PessoaModel->GetByLogin($contaDados['UserName'])){
		// 	$erro = "E-mail já cadastrado.";
		// 	$this->order($erro, $this->input->post('hashTag'));
		// 	return;
		// }

		$this->PessoaModel->UpdateLogin($contaDados);

		$this->enviarEmailConfirmacao($reuDados,$contaDados);

		$dataView = array(
			'Title' => 'Cadastro realizado com sucesso!', 
			'Descricao' => 'Enviamos uma mensagem de confirmação pra você. Por favor, acesse seu e-mail e confirme seu cadastro.'
		);

		$data = array('dataView' => $dataView);

		$this->load->view('account/confirmaEmail', $data);
		
	}

	private function enviarEmailConfirmacao($pessoa, $conta){
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
      	$this->email->to($conta['UserName']);

      	// Define o assunto do email
      	$this->email->subject("Justica Ja - Confirmação do cadastro");

      	$texto = "<h2>"
      	.htmlentities("Olá ".$pessoa['Nome'].",")
      	."</h2><p>"
      	.htmlentities("Você está recebendo esse e-mail porque foi realizado um cadastro em seu nome, na plataforma Justiça Já.")
      	."</p><p>"
      	.htmlentities("Caso você não tenha feito esse pedido, pedimos que descosidere essa mensagem.")
      	."</p><p>"
      	."Para confirma seu cadastro, clique em:"
      	."</p><p>"
      	."<a href='".base_url()."Account/confirmaCadastro?hashTag=".$conta['CodigoConfirmacao']."'>"
      	.base_url()."Account/confirmaCadastro?hashTag=".$conta['CodigoConfirmacao']
      	."</a></p>";


      	$this->email->message($texto);

      	$this->email->send();
	}
}

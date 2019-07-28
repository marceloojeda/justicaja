<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends Admin_Controller
{

	function __construct() {
		parent::__construct();

		setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');

		$this->load->Model('PessoaModel');

		$this->load->Model('LogErroModel');

		if($this->PessoaModel->GetDataUser('UsuarioAutenticado') == null){
			redirect(base_url());
		}

		$this->load->helper('text');
	}

	function Index($target = null){
		$this->load->Model('PedidoAberturaModel');

		$start = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

		$filtro = array(
			"Autor" => isset($_POST['Autor']) ? $this->input->post('Autor') : null,
			"Reu" => isset($_POST['Reu']) ? $this->input->post('Reu') : null,
			"Cidade" => isset($_POST['Cidade']) ? $this->input->post('Cidade') : null,
			"UF" => isset($_POST['UF']) ? $this->input->post('UF') : "All",
			"Status" => isset($_POST['Status']) ? $this->input->post('Status') : "All",
			"PerPage" => 5,
			"Page" => $start,
			"Target" => $target,
			"TotalRegistros" => 0
		);

		//somente pedidos 'Em Andamento podem receber notificação
		//$filtro["Status"] = 1;

		$pedidos = $this->PedidoAberturaModel->GetByFiltro($filtro);

		// pagination
		$config = array();
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;
		$config["base_url"] = base_url() . "admin/notification";
		$config["total_rows"] = $pedidos['numRows'];
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);

		$filtro["TotalRegistros"] = $pedidos['numRows'];

		$data['dataPost'] = array(
			'Pedidos' => $pedidos["results"],
			'Filtro' => $filtro,
			'links' => $this->pagination->create_links()
		);

		$this->load->view('admin/notification/listagem_pedidos', $data);
	}

	function Notificar($id){
		$this->load->model('PedidoAberturaModel');
		$this->load->model('PessoaModel');

		$pedido = $this->PedidoAberturaModel->GetById($id);
		$autor = $this->PessoaModel->GetById($pedido[0]['PessoaId']);
		$reu = $this->PessoaModel->GetById($pedido[0]['ReuId']);
		$promotor = $pedido[0]['PromotorId'] == null
		? null
		: $this->PessoaModel->GetById($pedido[0]['PromotorId']);
		$notificacoes = $this->PedidoAberturaModel->GetNotificacoesByPedido($id);

		$data['dataView'] = array(
			"Title" => "Envio de Notificacao",
			"Subtitle" => "Meio de Comunicação",
			"Pedido" => $pedido[0],
			"Autor" => $autor[0],
			"Reu" => $reu[0],
			"Notificacoes" => $notificacoes
		);

		$this->load->view("admin/notification/Notificacao", $data);
	}

	function EnviarNotificacao(){
		$this->load->model('PedidoAberturaModel');
		$this->load->model('PessoaModel');

		$pessoaId = null;
		if($this->input->post('Parte') == "Autor")
			$pessoaId = $this->input->post('AutorId');
		else if($this->input->post('Parte') == "Reu")
			$pessoaId = $this->input->post('ReuId');
		else
			$pessoaId = $this->input->post('PromotorId');

		$dataInsert = array(
			"PedidoId" => $this->input->post('PedidoId'),
			"PessoaId" => $pessoaId,
			"ParteTipo" => $this->input->post('Parte'),
			"Data" => date('Y-m-d H:i:s'),
			"Meio" => $this->input->post('MeioComunicacao'),
			"EmailDestino" => $this->input->post('Destinatario'),
			"Observacao" => $this->input->post('Observacao')
		);

		$analiseId = $this->PedidoAberturaModel->Insert_PedidoNotificacao($dataInsert);

		if($this->input->post('MeioComunicacao') == "Email"){

			$pedido = $this->PedidoAberturaModel->GetById($this->input->post('PedidoId'));
			$reu = $this->PessoaModel->GetById($pedido[0]['ReuId']);

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
			$this->email->from(SMTP_FROM, SMTP_FROM_NAME);

      			// Destinatário
			$this->email->to($this->input->post('Destinatario'));

      			// Define o assunto do email
			$this->email->subject("Justica Ja - Notificacao");

			$this->email->message(convert_accented_characters($this->input->post("Observacao")));

			if($this->email->send()){
				$data['dataView'] = array(
					"Title" => "Pronto!",
					"Subtitle" => "Notificação do Réu registrada com sucesso."
				);
				$this->load->view('admin/shared/result', $data);
			}else{
				$data['dataView'] = array(
					"Title" => "Envio de Notificação",
					"Subtitle" => "Não conseguimos enviar o e-mail."
				);
				$this->load->view('admin/shared/result', $data);
			}
		}else{
			$data['dataView'] = array(
				"Title" => "Pronto!",
				"Subtitle" => "Notificação do Réu registrada com sucesso."
			);
			$this->load->view('admin/result', $data);
		}
	}
}
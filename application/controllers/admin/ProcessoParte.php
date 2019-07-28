<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ProcessoParte extends Admin_Controller{

	function listarPartes(){
		$start = $this->uri->segment(4) != null ? $this->uri->segment(4) : 0;

		$filtro = array(
			"Nome" => $this->input->post("Nome"),
			"CpfCnpj" => $this->input->post("CpfCnpj"),
			"Cidade" => $this->input->post("Cidade"),
			"UF" => $this->input->post("UF"),
			"Status" => $this->input->post("Status"),
			"PerPage" => 20,
			"Page" => $start,
			"TotalRegistros" => 0
		);

		$this->load->Model('PessoaModel');
		$pessoas = $this->PessoaModel->getByFiltro($filtro);

		// pagination
		$config = array();
		$config['per_page'] = $filtro['PerPage'];
		$config['uri_segment'] = 4;
		$config["base_url"] = base_url().'admin/ProcessoParte/listarPartes';
		$config["total_rows"] = sizeof($pessoas);
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);

		$dadosView = array(
			'Pessoas' => $pessoas,
			'Filtro' => $filtro,
			'links' => $this->pagination->create_links()
		);
		$this->setDadosView($dadosView);

		$this->render('admin/processo/listagem_partes');
	}
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
  protected $data = array();

  function __construct()
  {
    parent::__construct();

    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    
    $this->data['page_title'] = 'CI App';
    $this->data['before_head'] = '';
    $this->data['before_body'] ='';
    $this->data['breadcrumb'] = '';

    $this->data['InformacaoTela'] = '';
    $this->data['DadosView'] = null;
  }

  protected function render($the_view = NULL, $template = 'master')
  {
    if($template == 'json' || $this->input->is_ajax_request())
    {
      header('Content-Type: application/json');
      echo json_encode($this->data);
    }
    else
    {
      $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view,$this->data, TRUE);
      $this->load->view('templates/'.$template.'_view', $this->data);
    }
  }

  protected function setCustomScript($script){
    $this->data['before_body'] = $script;
  }

  protected function setCustomStyle($script){
    $this->data['before_head'] = $script;
  }
}

class Admin_Controller extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('PessoaModel');

    if(!$this->PessoaModel->GetDataUser('UsuarioAutenticado')){
      redirect(base_url().'monitor');
    }
    $this->load->library('breadcrumb');
    $this->data['page_title'] = 'Justiça Já - Dashboard';
  }

  protected function render($the_view = NULL, $template = 'admin_master')
  {
    parent::render($the_view, $template);
  }

  protected function setBreadcrumb($html){
    $this->data['breadcrumb'] = $html;
  }

  protected function setDadosView($dados){
    $this->data['DadosView'] = $dados;
  }
}

class Public_Controller extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->data['page_title'] = 'Justiça Já - Painel de monitoramento';

    // if(getInformacaoTela()){
    //   $this->data['InformacaoTela'] = getInformacaoTela();
    // }
  }

  protected function setDadosView($dados){
    $this->data['DadosView'] = $dados;
  }

  protected function render($the_view = NULL, $template = 'public_master')
  {
    parent::render($the_view, $template);
  }
}


class Parte_Controller extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('PessoaModel');

    if(!$this->PessoaModel->GetDataUser('UsuarioAutenticado')){
      redirect(base_url());
    }
    
    $this->data['page_title'] = 'Justiça Já - Painel de monitoramento';

    $this->load->helper('upload');
  }

  protected function render($the_view = NULL, $template = 'parte_master')
  {
    parent::render($the_view, $template);
  }

  protected function setDadosView($dados){
    $this->data['DadosView'] = $dados;
  }
}
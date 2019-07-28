<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Breadcrumb {

	private $crumb;

	function __construct(){
		$this->crumb = array();
	}

	public function incluirMigalha($texto, $rota)
	{
		$item = array('Texto' => $texto, 'Rota' => $rota);
		array_push($this->crumb, $item);
	}

	public function getHtml(){
		$html = '';
		if(is_array($this->crumb)){
			for ($i=0; $i < sizeof($this->crumb); $i++){
				if($this->crumb[$i] != end($this->crumb)){
					$html .= '<li class="breadcrumb-item">'
						.'<a href="'
						.$this->crumb[$i]['Rota']
						.'">'
						.$this->crumb[$i]['Texto']
						.'</a>'
						.'</i>';
				}else{
					$html .= '<li class="breadcrumb-item">'
					.$this->crumb[$i]['Texto']
					.'</i>';
				}
			}
		}
		var_dump($html);
		return $html;
	}
}
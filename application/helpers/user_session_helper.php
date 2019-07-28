<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function set_single_session($key, $value){
	$this->session->set_userdata($key, $value);
}



function remove_session($key){
	$this->session->unset_userdata($key);
}

function GeraHash($length)
{
	$chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	$clen   = strlen( $chars )-1;
	$id  = '';

	for ($i = 0; $i < $length; $i++) {
		$id .= $chars[mt_rand(0,$clen)];
	}
	return ($id);
}

function setInformacaoTela($mensagem){
	$this->session->set_flashdata('UserMessage', $mensagem);
}

function getInformacaoTela(){	
  return $this->session->flashdata('UserMessage');
}
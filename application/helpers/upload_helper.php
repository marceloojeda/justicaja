<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function uploadFile($file,$diretorio){
	
	$file = $_FILES[$file];

	$uploaddir = FCPATH.'assets/uploads/'.$diretorio.'/';

	$uploadfile = convert_accented_characters($file['name']);

	if(!get_dir_file_info($uploaddir.$uploadfile)){
		move_uploaded_file($file['tmp_name'], $uploaddir.$uploadfile);

		return $uploadfile;
	}else{
		$temp = explode(".", $file["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		$uploadfile = $uploaddir . $newfilename;
		move_uploaded_file($file['tmp_name'], $uploadfile);

		return $newfilename;
	}
}
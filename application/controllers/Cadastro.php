<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {


	function index()
	{
		$this->load->view('cadastro_view');
	}

	function ver_cadastro(){
		$this->load->view('vercadastro_view');

	}
	
}

?>
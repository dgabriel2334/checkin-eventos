<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
	}



	function getProfissoes()
	{
		$data = $this->api_model->profissoes();

		echo json_encode($data->result_array());

	}

	function checkin(){
		$url = 'http://gabriel.acessoexterno.icomanda.com:3342/api/consultausuario?id=';
		$data = array(
			'nome'	=>	$this->input->post('nome'),
			'email'	=>	$this->input->post('email'),
			'telefone'	=>	$this->input->post('telefone'),
			'profissao_id'	=>	$this->input->post('profissao_id')
			// 'qr_code'	=>	$imagem
		);

		$id = $this->api_model->insert_api($data);
		$imagem = $this->qrcode($url.''.$id, $this->input->post('email'));
		$imagem = array(
			'qr_code'	=>	$imagem
		);
		$this->api_model->update_api($id, $imagem);


		$array = array(
			'success'		=>	true,
			'imagem'		=>	$imagem
		);
		echo json_encode($array);

	}

	function consultausuario(){

		$resultado = $this->api_model->pesquisa($this->input->get('id'));
		$resultado['resultado'] = json_encode($resultado);
		$this->load->view('vercadastro_view', $resultado);

	}

	function qrcode($conteudo, $arquivo_nome){

		$this->load->library('ciqrcode');
		$params['data'] = $conteudo;
		$params['savename'] = './img/'.$arquivo_nome.'.png';
		$this->ciqrcode->generate($params);
		$imagedata = file_get_contents($params['savename']);
		$base64 = base64_encode($imagedata);
		// unlink($params['savename']);
		return $base64;

	}

}


?>
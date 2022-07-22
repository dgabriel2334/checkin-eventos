<?php
class Api_model extends CI_Model
{

	function profissoes()
	{
		$this->db->order_by('profissao_nome', 'ASC');
		return $this->db->get('participante_profissao');	
	}


	function insert_api($dados)
	{
		$this->db->insert('participante', $dados);
		$last_id = $this->db->insert_id();
		return $last_id;
	}

	function pesquisa($usuario_id)
	{
		$query = $this->db->query('SELECT p.*, pf.profissao_nome FROM participante p JOIN participante_profissao as pf on p.profissao_id = pf.id WHERE p.id = '.$usuario_id);
		return $query->result_array();
	}

	function update_api($usuario_id, $dados)
	{
		$this->db->where('id', $usuario_id);
		$this->db->update('participante', $dados);
	}

	function delete_single_user($usuario_id)
	{
		$this->db->where('id', $usuario_id);
		$this->db->delete('usuario');
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}

?>
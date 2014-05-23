<?php

class UserModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function addUser()
	{
		//Hash pass example
		//
		//$this->PasswordHash->HashPassword($password);
		//Compare pass example
		/*$password = $_POST['password'];
	     $actualPassword = get from db
		 $check = $this->PasswordHash->CheckPassword($password, $actualPassword);*/ 
		
		$this->load->library('PasswordHash',array(8, FALSE));
		$hash=$this->passwordhash->HashPassword($this->input->post('password'));
		
		$data=array('contacto'=>$this->input->post('cont'),
					'descricao'=>$this->input->post('desc',TRUE),
					'email'=>$this->input->post('email',TRUE),
					'latitude'=>$this->input->post('latitude'),
					'longitude'=>$this->input->post('longitude'),
					'morada'=>$this->input->post('address',TRUE),
					'nif'=>$this->input->post('nif'),
					'nome'=>$this->input->post('name',TRUE),
					'nome_prop'=>$this->input->post('resp',TRUE),
					'tipo'=>$this->input->post('entity'),
					'palavrapasse'=>$hash);
		$this->db->insert('temp_entidade',$data);  //Os utilizadores passam por um período probatório até que o admin os confirme.
	}
	
	public function setUserToPermanent($id)
	{
		$this->db->where("id_entidade",$id);		
		$query=$this->db->get("temp_entidade");
		
		if($query->num_rows()>0)
		{
			foreach($query->result() as $rows)
			{
				$data=array('contacto'=>$rows->contacto,
					'descricao'=>$rows->descricao,
					'email'=>$rows->email,
					'latitude'=>$rows->latitude,
					'longitude'=>$rows->longitude,
					'morada'=>$rows->morada,
					'nif'=>$rows->nif,
					'nome'=>$rows->nome,
					'nome_prop'=>$rows->nome_prop,
					'tipo'=>$rows->tipo,
					'palavrapasse'=>$rows->palavrapasse);
				$this->db->insert('entidade',$data);
				
				$this->deleteTempById($rows->id_entidade);
			}
			return true;
		}	
		else return false;
	}
	
	function getTempUsers()
	{
		$query = $this->db->get('temp_entidade');
		$data=array();
		if($query->num_rows()>0)
		{
			foreach($query->result() as $rows)
			{
				$user = array(
					  'id_entidade'  => $rows->id_entidade,
					  'nome'  => $rows->nome,
					  'email'    => $rows->email,
					  'contacto'  => $rows->contacto,
					  'descricao'    => $rows->descricao,
					  'morada'	=>$rows->morada,
					  'nif'  => $rows->nif,
					  'nome_prop'    => $rows->nome_prop,
					  'tipo'    => $rows->tipo		  
					);				
				array_push($data, $user);				
			}
			return $data;
		}	
		else return NULL;
	}
		
	function login($email,$password)
	{
		$this->load->library('PasswordHash',array(8, FALSE));			
		$this->db->where("email",$email);		
		$query=$this->db->get("entidade");
		if($query->num_rows()>0)
		{
			foreach($query->result() as $rows)
			{				
				$check = $this->passwordhash->CheckPassword($password, $rows->palavrapasse);
				//add all data to session
				if($check)
				{
					$newdata = array(
					  'id_entidade'  => $rows->id_entidade,
					  'nome'  => $rows->nome,
					  'email'    => $rows->email,
					  'logged_in'  => TRUE,
					);
				}
				else return false;
			}
			$this->session->set_userdata($newdata);
			return true;
		}
		return false;
	}
	
	public function getUserByID($id)
	{
		$this->db->where("id_entidade",$id);		
		$query=$this->db->get("entidade");
		
		if($query->num_rows()>0)
		{
			foreach($query->result() as $rows)
			{	
				$user = array(
					  'id_entidade'  => $rows->id_entidade,
					  'nome'  => $rows->nome,
					  'email'    => $rows->email,
					  'creditos'	=>$rows->creditos,
					  'contacto'  => $rows->contacto,
					  'descricao'    => $rows->descricao,
					  'morada'	=>$rows->morada,
					  'nif'  => $rows->nif,
					  'nome_prop'    => $rows->nome_prop,
					  'tipo'    => $rows->tipo
					);				
				return $user;
			}			
		}
		else return NULL;
	}
	
	public function editUserById($id)
	{
		$this->load->library('PasswordHash',array(8, FALSE));
		$hash=$this->passwordhash->HashPassword($this->input->post('password'));
		
		$data=array('contacto'=>$this->input->post('cont'),
					'descricao'=>$this->input->post('desc',TRUE),
					'email'=>$this->input->post('email',TRUE),
					'morada'=>$this->input->post('address',TRUE),
					'palavrapasse'=>$hash);
		$this->db->where('id_entidade', $id);
		$this->db->update('entidade', $data); 
	}
	
	public function deleteUserById($id)
	{} //Later, função no painel de administrador
	
	public function deleteTempById($id)
	{
		$this->db->where("id_entidade",$id);		
		$query=$this->db->delete("temp_entidade");
	}
	
	public function isAdmin($id)
	{
		$this->db->where("id_entidade",$id);		
		$query=$this->db->get("entidade");
	
		foreach($query->result() as $rows)
		{
			if($rows->admin==1) return true;
		}
		return false;
	}
	
	public function changeCredits($id, $balance)
	{
		//Obter número de créditos do utilizador
		$user=$this->getUserById($id);
		$newCredits=$user['creditos']+(int)$balance;
		if($newCredits>=0)
		{
			$this->db->where('id_entidade', $id);
			$this->db->update('entidade', array('creditos'=>$newCredits)); 
			return true;
		}
		return false;
	}
	
	public function checkIfExists($str)
	{
		$this->db->select('nome'); 
		$this->db->from('entidade');   
		$query=$this->db->get();
		
		foreach($query->result() as $rows)
		{
			if($str==$rows->nome) return true;
		}
		return false;
	}
}
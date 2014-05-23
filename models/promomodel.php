<?php

class PromoModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function insertPromo()
	{
		//Verificar a categoria
		$this->db->where("nome",$this->input->post('category'));		
		$query=$this->db->get("categoria");		
		$ret = $query->row();
		$cat_id=$ret->id_categoria;
		
		//Tratamento de booleanos
		if($this->input->post('reservation')=='yes')
			$reserva=1;
		else $reserva=0;
		
		if($this->input->post('ticket')=='yes')
		{
			$bilhete=1;
			$tipo=$this->input->post('tickettype');
		}
		else
		{
			$bilhete=0;
			$tipo=NULL;
		}
		
		//Inserir dados na tabela promoção
		$datapromo=array('inicio_promo'=>$this->input->post('launch'),
					'id_entidade'=>$this->session->userdata('id_entidade'),
					'fim_promo'=>$this->input->post('limit'),
					'desc_resumida'=>$this->input->post('desc',TRUE),
					'desc_completa'=>$this->input->post('desc_comp',TRUE),
					'reserva'=>$reserva,
					'condicoes'=>$this->input->post('cond',TRUE),
					'horario'=>$this->input->post('schedule',TRUE),
					'no_vouchers'=>$this->input->post('num'),
					'valor_voucher'=>$this->input->post('price'),
					'parceria'=>$this->input->post('dual'),
					'poupanca'=>$this->input->post('discount'),
					'bilhete'=>$bilhete,
					'zonas'=>$tipo);
		$this->db->insert('promo',$datapromo);
		$promo_id = $this->db->insert_id();
		
		//Inserir dados na tabela catpromo
		$datacat=array('id_categoria'=>$cat_id,
			'id_promo'=>$promo_id
		);
		$this->db->insert('catpromo',$datacat);		
	}
	
	public function getPromoById($id)
	{
		$query=$this->db->get_where('promo', array('id_promo' => $id));
		if($query->num_rows()>0)
		{
			foreach($query->result() as $rows)
			{
					$sql = "SELECT nome FROM categoria WHERE id_categoria = (SELECT id_categoria FROM catpromo WHERE id_promo= ?)";
					$query2=$this->db->query($sql, array($rows->id_promo));
					$row = $query2->row_array();
					$cat=$row['nome'];
					
				
					$promo = array(
					  'desc_completa'  => $rows->desc_completa,
					  'inicio_promo'  => $rows->inicio_promo,
					  'fim_promo'    => $rows->fim_promo,
					  'valor_voucher'  => $rows->valor_voucher,
					  'no_vouchers'    => $rows->no_vouchers,
					  'destaque'	=>$rows->destaque,
					  'id_promo'	=>$rows->id_promo,
					  'fim_destaque'  => $rows->fim_destaque,
					  'id_entidade'    => $rows->id_entidade,
					  'desc_resumida'  => $rows->desc_resumida,
					  'reserva'    => $rows->reserva,
					  'condicoes'	=>$rows->condicoes,
					  'parceria'=>$rows->parceria,
					  'horario'  => $rows->horario,
					  'poupanca'    => $rows->poupanca,
					  'bilhete'    => $rows->bilhete,
					  'hora_criacao'	=> $rows->hora_criacao,
					  'categoria'    => $cat,
					  'zonas'    => $rows->zonas		  
					);	
			}
		}
		return $promo;
	}
	
	public function promotePromo($id)
	{
		$promo=$this->getPromoById($id);
		if($promo['destaque']==0)
		{
			$date=new DateTime();
			$date->add(new DateInterval('P1W'));			
		}
		else
		{
			$date=new DateTime($promo['fim_destaque']);
			$date->add(new DateInterval('P1W'));			
		}
		$date=$date->format('Y-m-d');
		$this->db->where('id_promo', $id);
		$this->db->update('promo', array('destaque'=>1,'fim_destaque'=>$date));		
	}

	public function deletePromoById($id)
	{		
		$this->db->where("id_promo",$id);		
		$query=$this->db->delete("promo");	
	}

	public function editPromoById($id)
	{
		//Verificar a categoria
		$this->db->where("nome",$this->input->post('category'));		
		$query=$this->db->get("categoria");		
		$ret = $query->row();
		$cat_id=$ret->id_categoria;
		
		//Tratamento de booleanos
		if($this->input->post('reservation')=='yes') $reserva=1;
		else $reserva=0;
		
		if($this->input->post('ticket')=='yes')
		{
			$bilhete=1;
			$tipo=$this->input->post('tickettype');
		}
		else
		{
			$bilhete=0;
			$tipo=NULL;
		}
		
		//Inserir dados na tabela promoção
		$datapromo=array('inicio_promo'=>$this->input->post('launch'),
					'id_entidade'=>$this->session->userdata('id_entidade'),
					'fim_promo'=>$this->input->post('limit'),
					'desc_resumida'=>$this->input->post('desc',TRUE),
					'desc_completa'=>$this->input->post('desc_comp',TRUE),
					'reserva'=>$reserva,
					'condicoes'=>$this->input->post('cond',TRUE),
					'horario'=>$this->input->post('schedule',TRUE),
					'no_vouchers'=>$this->input->post('num'),
					'valor_voucher'=>$this->input->post('price'),
					'poupanca'=>$this->input->post('discount'),
					'parceria'=>$this->input->post('dual'),
					'bilhete'=>$bilhete,
					'zonas'=>$tipo);
		$this->db->where('id_promo', $id);
		$this->db->update('promo', $datapromo); 
		$promo_id = $this->db->insert_id();
		
		$this->db->where('id_promo', $id);
		$this->db->update('catpromo', array('id_categoria'=>$cat_id));			
	}
	
	public function getPromosByUser($id)
	{		
		$query = $this->db->get_where('promo', array('id_entidade' => $id));
		$data=array();
		
		if($query->num_rows()>0)
		{
			foreach($query->result() as $rows)
			{				
				$promo=$this->getPromoById($rows->id_promo);
				array_push($data, $promo);
			}
			return $data;
		}	
		else return NULL;
	}
	
	public function getExpiredPromos($id)
	{
		$totalPromos=$this->getPromosByUser($id);
		$result=array();
		foreach($totalPromos as $promo)
		{
			$date=new DateTime($promo['fim_promo']);
			$now=new DateTime();
			$dDiff=$now->diff($date);
			$dDiff =(int)$dDiff->format("%r%a");
			//echo $dDiff;
			if($dDiff<0) array_push($result,$promo);
		}
		return $result;
	}
	
	public function getCurrentPromos($id)
	{
		$totalPromos=$this->getPromosByUser($id);
		$result=array();
		foreach($totalPromos as $promo)
		{
			$date=new DateTime($promo['fim_promo']);
			$now=new DateTime();
			$dDiff=$now->diff($date);
			$dDiff =(int)$dDiff->format("%r%a");
			//echo $dDiff;
			if($dDiff>=0) array_push($result,$promo);
		}
		return $result;
	}
	
	public function checkExpiredPromo($id)
	{
		$promo=$this->getPromoById($id);
		$date=new DateTime($promo['fim_promo']);
		$now=new DateTime();
		$dDiff=$now->diff($date);
		$dDiff =(int)$dDiff->format("%r%a");
		
		if($dDiff<0) return true;
		else return false;
	}
	
	public function refreshPromos()
	{
		$user=$this->session->userdata('id_entidade');
		$promos=$this->getPromosByUser($user);
		
		foreach($promos as $p)
		{
			if($p['destaque']==1)
			{
				//var_dump($p);
				$date=new DateTime($p['fim_destaque']);
				$now=new DateTime();
				$dDiff=$now->diff($date);
				$dDiff =(int)$dDiff->format("%r%a");
				//echo 'diff '.$dDiff;
				if($dDiff<0)
				{
					$this->db->where('id_promo', $p['id_promo']);
					$this->db->update('promo', array('destaque'=>0,'fim_destaque'=>NULL));					
				}				
			}
		}
	}
	
	public function validateVoucher()
	{
		//Check session
		//Receive and validate voucher
		return false; //Tá a dar erro
	}
	
	
}
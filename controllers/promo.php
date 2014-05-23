<?php
	
class Promo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('promomodel');
		$this->load->model('usermodel');
	}
	
	public function insertPromo()
	{
		$this->load->library('form_validation');
				
		//Validation Rules
		$this->form_validation->set_rules('launch', 'Data de Lançamento', 'required');
		$this->form_validation->set_rules('limit', 'Data Limite', 'required|callback_d_check');
		$this->form_validation->set_rules('desc', 'Descrição Resumida', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('desc_comp', 'Descrição Completa', 'trim|required|max_length[300]');
		$this->form_validation->set_rules('cond', 'Condições Especiais', 'trim|required|max_length[120]');
		$this->form_validation->set_rules('schedule', 'Horário', 'trim|max_lenght[120]');
		$this->form_validation->set_rules('category', 'Categoria', 'callback_c_check');
		$this->form_validation->set_rules('num', 'Número de Vouchers', 'trim|required|is_numeric');
		$this->form_validation->set_rules('price', 'Preço por voucher', 'trim|required|is_numeric');
		$this->form_validation->set_rules('discount', 'Desconto por voucher', 'trim|required');
		$this->form_validation->set_rules('dual', 'Em conjunto com...', 'trim|callback_e_check');
		$this->form_validation->set_rules('tickettype', 'Tipo de Bilhete', 'callback_t_check');
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('/template/header');
			$this->load->view('/promo/create');
			$this->load->view('/template/footer');
		}
		else $this->success();
	}
	
	public function c_check($str)
	{
		if ($str == 'default')
		{
			$this->form_validation->set_message('c_check', 'Tem que escolher uma categoria.');
			return FALSE;
		}
		else return TRUE;
		
	}
	
	public function e_check($str)
	{
		if(!$str=="")
		{
			$result=$this->usermodel->checkIfExists($str);
			if(!$result||$str==$this->session->userdata('nome'))
			{
				$this->form_validation->set_message('e_check', 'A entidade escolhida não existe.');
				return FALSE;
			}
		}
		return TRUE;
	}
	
	public function d_check($date)
	{	
		$day = (int) substr($date, 8, 2);
		$month = (int) substr($date, 5, 2);
		$year = (int) substr($date, 0, 4);
		$valid=checkdate($month, $day, $year);
		if($valid)
		{
			//Ver se data limite é depois da hora atual.
			$date = new DateTime($date);
			$now  = new DateTime();
			$dDiff = $date->diff($now);
			$dDiff = (int)$dDiff->format("%r%a");
			//Ver se data início é antes da data limite
			$datebeg = new DateTime($this->input->post('launch'));
			$dDiff1= $date->diff($datebeg);
			$dDiff1 = (int)$dDiff1->format("%r%a");
						
			if ($dDiff<=0&&$dDiff1<=0) return true;
		}
		else
		{
			$this->form_validation->set_message('d_check','Insira datas válidas.');
			return false;
		}		
	}

	public function t_check($str)
	{
		if ($str == 'default'&&$this->input->post('ticket')=='yes')
		{
			$this->form_validation->set_message('t_check', 'Tem que escolher um tipo de bilhete.');
			return FALSE;
		}
		else return TRUE;		
	}
	
	public function success()
	{
		$this->promomodel->insertPromo();
		$this->load->view('/template/header');
		$this->load->view('/promo/create_success');
		$this->load->view('/template/footer');
	}
	
	public function editPromo($id)
	{
		$promo=$this->promomodel->getPromoById($id);
		$creationDate=strtotime($promo['hora_criacao']);
		$now=time();
		//echo date('Y-m-d H:i:s',$now);
		$timediff=$now-$creationDate;
		if($timediff<=900)
		{
			$this->load->library('form_validation');
				
			//Validation Rules
			$this->form_validation->set_rules('launch', 'Data de Lançamento', 'required');
			$this->form_validation->set_rules('limit', 'Data Limite', 'required|callback_d_check');
			$this->form_validation->set_rules('desc', 'Descrição Resumida', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('desc_comp', 'Descrição Completa', 'trim|required|max_length[300]');
			$this->form_validation->set_rules('cond', 'Condições Especiais', 'trim|required|max_length[120]');
			$this->form_validation->set_rules('schedule', 'Horário', 'trim|max_lenght[120]');
			$this->form_validation->set_rules('category', 'Categoria', 'callback_c_check');
			$this->form_validation->set_rules('num', 'Número de Vouchers', 'trim|required|is_numeric');
			$this->form_validation->set_rules('price', 'Preço por voucher', 'trim|required|is_numeric');
			$this->form_validation->set_rules('discount', 'Desconto por voucher', 'trim|required');
			$this->form_validation->set_rules('dual', 'Em conjunto com...', 'trim|callback_e_check');
			$this->form_validation->set_rules('tickettype', 'Tipo de Bilhete', 'callback_t_check');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('/template/header');
				$data['promoinfo']=$promo;
				$this->load->view('/promo/edit',$data);
				$this->load->view('/template/footer');
			}
			else
			{
				$this->promomodel->editPromoById($id);
				$this->load->view('/template/header');
				$this->load->view('/promo/edit_success');
				$this->load->view('/template/footer');
			}
		}
		else 
		{
			$this->load->view('/template/header');
			$this->load->view('/promo/edit_fail');
			$this->load->view('/template/footer');			
		}
	}
	
	public function deletePromo($id)
	{
		$promo=$this->promomodel->getPromoById($id);
		$this->load->view('/template/header');
		if($this->session->userdata('id_entidade')!==false)
		{
			if($this->session->userdata('id_entidade')||$promo['id_entidade']==$this->session->userdata('id_entidade')||$this->usermodel->isAdmin($this->session->userdata('id_entidade')))
			{
				$this->promomodel->deletePromoById($id);
				$this->load->view('/promo/delete_success');
			}}
		else $this->load->view('/promo/delete_fail');
		$this->load->view('/template/footer');
	}
	
	public function seeMoreInfo($id)
	{
		$promo=$this->promomodel->getPromoById($id);
		$data['promoinfo']=$promo;
		$this->load->view('/template/header');
		$this->load->view('/promo/moreinfo',$data);
		$this->load->view('/template/footer');		
	}
	
	public function promote($id)
	{
		$promo=$this->promomodel->getPromoById($id);
		if ($this->session->userdata('id_entidade')==$promo['id_entidade'])
		{
			if($this->usermodel->changeCredits($this->session->userdata('id_entidade'),-50)&&!$this->promomodel->checkExpiredPromo($id))
			{
				$this->promomodel->promotePromo($id);
				redirect('promo/seeMoreInfo/'.$id);
			}
			else
			{
				$this->load->view('/template/header');
				$this->load->view('/promo/promote_fail');
				$this->load->view('/template/footer');
			}
		}
		else redirect('main');
	}
	
	public function checkHistory()
	{
		$promos=$this->promomodel->getExpiredPromos($this->session->userdata('id_entidade'));
		$data['promos']=$promos;
		$this->load->view('/template/header');
		$this->load->view('/promo/history',$data);
		$this->load->view('/template/footer');
	}
	
	public function validateVoucher()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('code', 'Código do Voucher', 'trim');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('/template/header');
			$this->load->view('/promo/validate');
			$this->load->view('/template/footer');
		}
		//redirect('user/showPersonalArea');
		else
		{
				$result=$this->promomodel->validateVoucher();
				$this->load->view('/template/header');
				if($result) $this->load->view('/promo/validate_success');
				else $this->load->view('/promo/validate_fail');
				$this->load->view('/template/footer');
		}
	}
	
	
}
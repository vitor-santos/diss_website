<?php

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('promomodel');
	}
	public function register()
	{
		$this->load->library('form_validation');
				
		//Validation Rules
		$this->form_validation->set_rules('name', 'Nome', 'trim|required|is_unique[entidade.nome]');
		$this->form_validation->set_rules('resp', 'Nome do Responsável', 'trim|required');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|is_unique[entidade.email]');
		$this->form_validation->set_rules('nif', 'NIF', 'trim|required|is_numeric|is_unique[entidade.NIF]');
		$this->form_validation->set_rules('cont', 'Contacto', 'trim|required|exact_length[9]|numeric');
		$this->form_validation->set_rules('desc', 'Descrição', 'trim|required|max_length[400]');
		$this->form_validation->set_rules('address', 'Endereço', 'trim|required|max_lenght[200]');
		$this->form_validation->set_rules('password', 'Palavra Passe', 'trim|required|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('passconf', 'Confirmação da Palavra Passe', 'trim|required|matches[password]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('/template/header');
			$this->load->view('/user/register');
			$this->load->view('/template/form_footer');
		}
		else $this->success();
	}
	
	private function success()
	{
			$this->usermodel->addUser();
			$this->load->view('/template/header');
			$this->load->view('/user/register_success');
			$this->load->view('/template/form_footer');
	}
		
	public function login()
	{
		$email=$this->input->post('loginemail',TRUE);
		$password=$this->input->post('loginpass');
		
		$result=$this->usermodel->login($email,$password);
		if($result) $this->showPersonalArea(); //My page
		else  echo 'Fail'; //Error Page*/
 }
	
	public function logout()
	{
		$newdata = array
		(
			'user_id'   =>'',
			'user_name'  =>'',
			'user_email'     => '',
			'logged_in' => FALSE,
		);
		$this->session->unset_userdata($newdata);
		$this->session->sess_destroy();
		redirect('/main');
	}
	
	public function editProfile($id)
	{
		$this->load->library('form_validation');
				
		//Validation Rules
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email'); //set validation email rule
		$this->form_validation->set_rules('cont', 'Contacto', 'trim|required|exact_length[9]|numeric');
		$this->form_validation->set_rules('desc', 'Descrição', 'trim|required|max_length[400]');
		$this->form_validation->set_rules('address', 'Endereço', 'trim|required|max_lenght[200]');
		$this->form_validation->set_rules('password', 'Palavra Passe', 'trim|required|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('passconf', 'Confirmação da Palavra Passe', 'trim|required|matches[password]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('/template/header');
			$data['userinfo']=$this->usermodel->getUserById($id);
			$this->load->view('/user/edit',$data);
			$this->load->view('/template/form_footer');
		}
		else
		{
			$this->usermodel->editUserById($id);
			$this->load->view('/template/header');
			$this->load->view('/user/edit_success');
			$this->load->view('/template/form_footer');
		}
	}
	
	public function showPersonalArea()
	{
		$this->load->view('/template/header');
		$this->showProfile();
		if($this->usermodel->isAdmin($this->session->userdata('id_entidade')))
		{
			$this->showNotifications();
		}
		$this->promomodel->refreshPromos(); //Para o caso de haver promoções cujo destaque terminou, actualizar os campos.
		$this->showPromos();
		$this->load->view('/template/footer');
	}
	
	public function showProfile()
	{
		$data['userinfo']=$this->usermodel->getUserById($this->session->userdata('id_entidade'));
				
		$this->load->view('/template/myprofile',$data);
		
	}
	
	public function showNotifications()
	{
		$data['tempusers']=$this->usermodel->getTempUsers();
		$this->load->view('/template/notification',$data);
	}
	
	public function showPromos()
	{
		$data['promos']=$this->promomodel->getCurrentPromos($this->session->userdata['id_entidade']);
		$this->load->view('/template/mypromos',$data);
	}
	
	public function approveRegistration($id)
	{
		if($this->usermodel->isAdmin($this->session->userdata['id_entidade']))
		{
			$this->usermodel->setUserToPermanent($id);
			$this->showPersonalArea();
		}
		else redirect('/main');
	}
	
	public function rejectRegistration($id)
	{
		if($this->usermodel->isAdmin($this->session->userdata['id_entidade']))
		{
			$this->usermodel->deleteTempById($id);
			$this->showPersonalArea();
		}
		else redirect('/main');
	}
	
	public function contact()
	{
		//A ser realizador no futuro. Função para enviar mail para o responsável do negócio. 
	}
	
	public function getCredits($id)
	{
		/*$this->load->view('/template/header');
		$this->load->view('/user/credits') //Será necessário exibir um form etc.
		$this->load->view('/template/footer');*/
		
		$this->usermodel->changeCredits($id,100); //Teste. Credita 100 créditos ao utilizador.
		$this->showPersonalArea();
	}
}
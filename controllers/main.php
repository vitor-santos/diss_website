<?php

class Main extends CI_Controller {

	public function index()
	{
		$this->load->view('/template/header');
		$this->load->view('/main/general');
		$this->load->view('/template/footer_img');
	}
	
	public function contactUs()
	{	

		$this->load->library('form_validation');
		
		$this->load->library('email');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://smtp.gmail.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = EMAIL_ADDRESS; 
		$config['smtp_pass'] = PASS;
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$this->email->initialize($config);
		
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('subject', 'Assunto', 'trim|required|xss_clean');
		$this->form_validation->set_rules('message', 'Mensagem', 'trim|required|max_length[100]|xss_clean');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('/template/header');
			$this->load->view('/template/contact');
			$this->load->view('/template/footer');
		}
		else
		{
			
			$this->email->from($this->input->post('email'), $this->input->post('nome'));
			$this->email->to(EMAIL_ADDRESS); 
			
			$this->email->subject($this->input->post('subject'));
			$this->email->message($this->input->post('message'));	

			$this->email->send();
			//echo $this->email->print_debugger();
			
			$this->load->view('/template/header');
			$this->load->view('/template/contact_success');
			$this->load->view('/template/footer');
		}	
		
	}
	
	public function conditions()
	{
		$this->load->view('/template/header');
		$this->load->view('/main/conditions');
		$this->load->view('/template/header');
	}
	
	public function advantages()
	{
		$this->load->view('/template/header');
		$this->load->view('/main/advantages');
		$this->load->view('/template/header');
	}
	
	
	
	
	
}
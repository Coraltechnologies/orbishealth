<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function __construct(){

    parent::__construct();
		/////include model file
		$this->load->model('Welcome_model');
	}

	function index(){	
	
		//$this->load->view('index');
		//echo $this->session->userdata('user_session');
		
		$output['content'] 	= 'Hello World....';
		
		$output['name'] 	= 'mskt....';
		
		$this->template->render_content('index',$output);
		
		//$this->load->view('index',$output);
	
	}
	
	function get_version() {

    echo CI_VERSION; // echoes something like 1.7.1

	}
	
	
	function details(){
	
	//$this->load->view('index');
	
	$output['output'] = $this->Welcome_model->get_details();
	
	/*echo "<pre><br>";
	print_r($output);
	
	exit;
	
	foreach($output as $k_op => $val_op){
	
	echo $val_op['w_id'];
	echo "<br>";
	
	}*/
	
	
	
	
	$this->template->render_content('details',$output);
	
	}
	
	function login(){
		$this->template->render_content('login');
	}
	
	function login_check(){
	
		$this->load->library('form_validation'); 
		
		$this->form_validation->set_rules('u_login', 'Username', 'required');
		$this->form_validation->set_rules('u_pass', 'Password', 'required');
		//$this->form_validation->set_message();	
		if ($this->form_validation->run() == FALSE){
			$output['errors'] = validation_errors();
			$this->template->render_content('login', $output);
			return;
		} else{
			$result = $this->Welcome_model->login($_POST['u_login'], $_POST['u_pass']);
			
			if($result == 'Error'){
				$output['errors'] = 'Invalid Login details';
				$this->template->render_content('login', $output);
				return;
			}
			
			
		}
		
		//redirect('welcome/login');;
	}
	
	function image_upload(){
		
		
		if(isset($_FILES) && !empty($_FILES)){
			echo "<pre><br>";
			print_r($_FILES);
		}
		
		//exit;
		
		$config['upload_path'] = 'asset/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('image_file'))
		{
			$error = array('error' => $this->upload->display_errors());

		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

		}
		
		$this->template->render_content('image_upload', $error);
	}


}
?>
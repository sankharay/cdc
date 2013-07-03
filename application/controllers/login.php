<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	 function __construct(){
           parent::__construct(); 
    }
	 
	public function index()
	{
			$cap = $this->captcha();
			$this->load->view('login',$cap);
	}
	
	public function chklogin()
	{
		$error[] = array();
		$error_value = FALSE;
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$captcha =  "2";
		$this->session->set_userdata('captcha',$captcha);
		if($username == "")
		{
		$error[] = $this->lang->line('error_email_missing');
		$error_value = TRUE;
		}
		if($password == "")
		{
		$error[] = $this->lang->line('error_password_missing');
		$error_value = TRUE;
		}
		if($captcha == "")
		{
		$error[] = $this->lang->line('captcha_missing');
		$error_value = TRUE;
		}
		elseif(strtolower($this->session->userdata('captcha')) != $captcha)
		{
		$error[] = $this->lang->line('captcha_not_matched');
		$error_value = TRUE;
		}
		if($error_value == TRUE)
		{
		$cap = $this->session->set_userdata('error','Please check password or username wrong');
				redirect(BASE_URL.'/login/');
				exit;
		}
		else
		{
		$this->load->model("chklogin");
		$result = $this->chklogin->chklogin($username,$password);
				if($result == TRUE)
				{
				redirect(BASE_URL.'/home');
				exit;
				}
				else
				{
				$cap = $this->session->set_userdata('error','Please check password or username wrong');
				redirect(BASE_URL.'/login/');
				exit;
				}
		}
	}
	
	
	function captcha()
	{
		$this->load->helper('captcha');
		$vals = array(
		    'img_path' => './captcha/',
		    'img_url' => 'http://localhost/app/script/captcha/'
		    );
			$cap = create_captcha($vals);
			$datas = array(
		    'captcha_time' => $cap['time'],
		    'ip_address' => $this->input->ip_address(),
		    'word' => $cap['word']
		    );
			$this->session->set_userdata('captcha',$datas['word']);
			return $cap;
	}
	
}

?>
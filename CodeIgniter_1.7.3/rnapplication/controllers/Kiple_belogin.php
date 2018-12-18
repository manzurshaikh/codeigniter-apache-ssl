<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiple_belogin extends CI_Controller {
	
	public $Kiple_belogin;

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();

		$this->load->model('Mdl_lgn');
		$this->Kiple_belogin = new Mdl_lgn;

	}



	public function index(){

		$sess_lang 	= "en";		$rcv_response_1	= array();		$data['response_1']	= "";		$data['response_1_nr'] 	= "";

		if ($this->input->post('login_check') == "confirm"){ 

			$this->form_validation->set_rules('kp_username', 'Username', 'required');
			$this->form_validation->set_rules('kp_password', 'Password', 'required');

			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('errors', validation_errors());
			    redirect(base_url());
			}else{

				 $rcv_response_1 = $this->Kiple_belogin->get_AdminMember();

			}

			$response_processed 		= $this->_verify_login_fe($lgnfe_loginid,$lgnfe_loginpwd,$sess_lang,$staff_dept);
			$response_processed_cleaned	= json_decode($response_processed);
			$response[$response_processed_cleaned->result_segment] = $response_processed_cleaned->result;//general result only. no more than 2 join tables.
			//print_r($response_processed_cleaned); exit;

			// Add user data in session
			if(!empty($response_processed_cleaned->sess) && $response_processed_cleaned->sess <> "invalid_login"){
				$this->session->set_userdata('felogged_in', $response_processed_cleaned->sess);
				$this->session->set_userdata('paging_refno', "noinfo"); //global for paging refno
				redirect(base_url("kiple_bend"));
			}else{
				//print_r($response_processed_cleaned); exit;
				$data['message_display'] = $response_processed_cleaned->message;
				$this->session->set_flashdata('logout_msg', $response_processed_cleaned->message);
				$this->session->set_flashdata('logout_info', $response_processed_cleaned->result);
				redirect(base_url());
			}

		}else{

			if(empty($this->session->userdata['felogged_in']) || $this->session->userdata['felogged_in'] == "invalid_login"){
				$this->load->view('page_login_fe');
				$this->session->sess_destroy();
				$this->session->set_flashdata('logout_msg', "Session Over. Please Start again.");
			}else{
				$this->load->view('page_login');
			}

		}
		//print_r($this->session);

	}



	// Logout from admin page
	public function logout() {

		//print_r($this->session);
		//exit;

		$session_data = array(
							'username' => '',
							'email' => '',
							'status' => '',
							'dept' => ''
						);
		$this->session->unset_userdata('felogged_in', $session_data);
		$data['message_display'] = 'Successfully Logout';
		$this->session->set_flashdata('logout_msg', 'You have successfully Log Out !');
		redirect(base_url());

	}


	// password reset
	public function recovery() {

		$sess_lang 	= "EN";//lang session
		$lgnfe_loginid ="";		$lgnfe_email = "";		$lgnfe_mobile_no = "";		$loc = "";		$loc_sub = "";

		// for all location for this company
		$response_processed_loc			= $this->_verify_loc("EN", "recovery");
		$response_processed_loc_cleaned	= json_decode($response_processed_loc);
		$response['alisting_det_loc_1']	= (!empty($response_processed_loc_cleaned->result)) ? $response_processed_loc_cleaned->result : "";// loc result only. 
		

		if ($this->input->post('ferecoverynow') == "confirm"){


			if( !empty($this->input->post('lgnfe_loginid')) && !empty($this->input->post('lgnfe_email')) && !empty($this->input->post('lgnfe_mobile_no')) ){
				
				$lgnfe_loginid 	= $this->cleancontent_deep($this->input->post('lgnfe_loginid'));
				$lgnfe_email 	= $this->cleancontent_deep($this->input->post('lgnfe_email'));
				$lgnfe_mobile_no= $this->cleancontent_deep($this->input->post('lgnfe_mobile_no'));
				$loc 			= $this->cleancontent_deep($this->input->post('loc'));
				$loc_sub 		= $this->cleancontent_deep($this->input->post('loc_sub'));
				

				$response_processed 			= $this->_verify_reset_fe($lgnfe_loginid,$lgnfe_email,$lgnfe_mobile_no,$loc,$loc_sub);
				$response_processed_cleaned		= json_decode($response_processed);
				$response['alisting_result']	= (!empty($response_processed_cleaned->result)) ? $response_processed_cleaned->result : "";//result only.
				$response['alisting_message']	= (!empty($response_processed_cleaned->message)) ? $response_processed_cleaned->message : "";//msg only.
				//print_r($response_processed_cleaned); //exit;

			}

		}

		//$response_rest_debug	= $this->rest->debug(); //debug rest

		$this->load->view("page_login_fe_recovery", $response);

	}



	// password reset
	public function recovery2() {

		$sess_lang 	= "EN";//lang session
		$lgnfe_loginid ="";		$lgnfe_pwd = "";		$lgnfe_pwd2 = "";		$rrefno = "";

		// for all location for this company
		$response_processed_loc			= $this->_verify_loc("EN", "recovery");
		$response_processed_loc_cleaned	= json_decode($response_processed_loc);
		$response['alisting_det_loc_1']	= (!empty($response_processed_loc_cleaned->result)) ? $response_processed_loc_cleaned->result : "";// loc result only. 


		if( $this->input->post('ferecoverynow2') == "confirm" && !empty($this->input->post('reset_refno')) && !empty($this->input->post('lgnfe_loginid')) ){


			if( (!empty($this->input->post('lgnfe_pwd')) && !empty($this->input->post('lgnfe_pwd2'))) && $this->input->post('lgnfe_pwd') == $this->input->post('lgnfe_pwd2')){

				$lgnfe_loginid 	= $this->cleancontent_deep($this->input->post('lgnfe_loginid'));
				$lgnfe_pwd 		= $this->cleancontent_deep($this->input->post('lgnfe_pwd'));
				$lgnfe_pwd2		= $this->cleancontent_deep($this->input->post('lgnfe_pwd2'));
				$rrefno 		= $this->cleancontent_deep($this->input->post('reset_refno'));


				$response_processed 			= $this->_verify_reset_fe2($lgnfe_loginid,$lgnfe_pwd,$lgnfe_pwd2,$rrefno);
				$response_processed_cleaned		= json_decode($response_processed);
				$response['alisting_result']	= (!empty($response_processed_cleaned->result)) ? $response_processed_cleaned->result : "";//result only.
				$response['alisting_message']	= (!empty($response_processed_cleaned->message)) ? $response_processed_cleaned->message : "";//msg only.
				//print_r($response_processed_cleaned); //exit;

			}else{
				
			}

		}

		//$response_rest_debug	= $this->rest->debug(); //debug rest

		$this->load->view("page_login_fe_recovery2", $response);

	}



	private function _verify_login_fe($new_uname,$new_pwd,$new_lang,$new_staffdept){
		if(!empty($new_uname) && !empty($new_pwd) ){
			//return "<p>wir2 : $new_uname,$new_pwd</p>";
			return $this->rest->post('verifying_login_fe', array('major_type' => "admin", 'uname' => $new_uname, 'passwd' => $new_pwd, 'lang' => $new_lang, 'dept' => $new_staffdept, 'ipadd' => $this->input->ip_address()));
		}else{
			$this->load->view('page_login_fe');
		}


		/* $this->form_validation->set_rules('uname', 'Username', 'trim|required');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required');
		//$this->form_validation->set_rules('Captcha', 'Captcha', 'trim|required|callback_check_captcha');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('page_login', $data);
		}
		else
		{
			$data = $this->xmlrpc->check_login($this->input->post('MemberID'), $this->input->post('Password'));
			if ($data['status'] == "pass")
			{
				$this->session->set_userdata($data['data']);
				$this->session->set_userdata('language', $this->input->post('language'));
				redirect("home", "refresh");
			}
			else
			{
				$this->session->sess_destroy();
				$this->session->set_flashdata('err_message', $this->lang->line('login_'.$data['status']));
				redirect("login", "refresh");
			}
		} */

	}



	private function _verify_loc($new_lang,$new_reason){
		return $this->rest->post('grab_allcodes_only', array('major_type' => "codes_lct", 'lang' => $new_lang, 'reason' => $new_reason, 'compid' => 2, 'ipadd' => $this->input->ip_address()));
	}



	private function _verify_reset_fe($reset_lgnid,$reset_email,$reset_mobileno,$reset_loc,$reset_loc_sub){
		//echo "<p>WIR : $reset_lgnid,$reset_email,$reset_mobileno,$reset_loc,$reset_loc_sub </p>";
		//exit;

		if(!empty($reset_lgnid) && !empty($reset_email) && !empty($reset_mobileno) ){
			//return "<p>wir2 : $new_uname,$new_pwd</p>";
			return $this->rest->post('verifying_reset_fe', array('major_type' => "admin", 'ulgn_id' => $reset_lgnid, 'ulgn_email' => $reset_email, 'ulgn_mobile' => $reset_mobileno, 'ulgn_loc' => $reset_loc, 'ulgn_loc_sub' => $reset_loc_sub, 'ipadd' => $this->input->ip_address()));
		}else{
			$this->load->view('page_login_fe');
		}
	}

	
	
	private function _verify_reset_fe2($reset_lgnid,$reset_pwd,$reset_pwd2,$reset_refno){
		//echo "<p>WIR : $reset_lgnid,$reset_pwd,$reset_pwd2,$reset_refno </p>";
		//exit;

		if(!empty($reset_lgnid) && !empty($reset_pwd) && !empty($reset_pwd2) ){
			//return "<p>wir2 : $new_uname,$new_pwd</p>";
			return $this->rest->post('verifying_reset_fe2', array('major_type' => "admin", 'ulgn_id' => $reset_lgnid, 'ulgn_pwd' => $reset_pwd, 'ulgn_rrefno' => $reset_refno, 'ipadd' => $this->input->ip_address()));
		}else{
			$this->load->view('page_login_fe');
		}
	}


}
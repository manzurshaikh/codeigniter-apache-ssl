<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiple_bend extends CI_Controller {

   public $Kiple_bend;


   /**
    * Get All Data from this method.
    * @return Response
   */

   public function __construct() {

      parent::__construct(); 

      $this->load->model('Mdl_chk');
      $this->Kiple_bend = new Mdl_chk;

   }


   /**
    * Display Data this method.
    *
    * @return Response
   */

   public function index(){

		$rcv_response_1			= array();		$rcv_response_2 		= array();	$rcv_response_3 		 = array();	$rcv_response_4 		 = array();
		$rcv_response_5			= array();		$rcv_response_6 		= array();	$rcv_response_7 		 = array();	$data['response_5'] 	 = "";
		$data['response_1'] 	= "";			$data['response_2'] 	= "";		$data['response_3'] 	 = "";		$data['response_4'] 	 = "";
		$data['response_1_nr'] 	= "";			$data['response_2_nr'] 	= "";		$data['response_3_nr'] 	 = "";		$data['response_4_nr'] 	 = "";
		$data['response_5_nr'] 	= "";			$data['response_6_nr'] 	= "";		$data['response_3_strcd']= "";		$data['response_6'] 	 = "";
		$data['response_7'] 	= "";			$data['response_7_nr'] 	= "";		$data['result_rtn_cc']	 = "";		$data['result_rtn_cc_rw']= "";
		$data['response_7_2'] 	= "";			$data['response_7_2_nr']= "";

		if($this->input->post('report_check') == "confirm"){
			$this->form_validation->set_rules('kp_username', 'Username', 'required');
			//$this->form_validation->set_rules('kp_mobile', 'Mobile No', 'required');

			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('errors', validation_errors());
			    redirect(base_url('kiple_bend'));
			}else{
			   $rcv_response_1 = $this->Kiple_bend->get_KipleMember();

				if($rcv_response_1['result_rw'] > 0){

				   //chk profile "result_Id" => $rtn_id, "result_Email" => $rtn_email, "result_UName" => $rtn_usrnm, "result_uid" => $rtn_uid
				   $rcv_response_2 = $this->Kiple_bend->get_KipleProfile($rcv_response_1['result_Id']);

				   if($rcv_response_2['result_rw'] > 0){
						//chk wallet
					    $rcv_response_3 = $this->Kiple_bend->get_KipleWallet($rcv_response_1['result_Id']);

						if($rcv_response_3['result_rw'] > 0){
							//chk wallet history
							$rcv_response_4 = $this->Kiple_bend->get_KipleWalletHistory($rcv_response_1['result_Id']);


							if($rcv_response_4['result_rw'] > 0){
								//chk webcash wallet
								$rcv_response_5 = $this->Kiple_bend->get_WebcashWallet($rcv_response_3['result_wcId']);

								if($rcv_response_5['result_rw'] > 0){
									//chk webcash gateway history
									$rcv_response_6 = $this->Kiple_bend->get_WebcashGateway($rcv_response_1['result_Email'],$rcv_response_1['result_mobile']);


									if($rcv_response_6['result_rw'] > 0 && $rcv_response_6['result_rtn_cc_rw'] > 0){
										//chk adyan gateway
										$rcv_response_7 = $this->Kiple_bend->get_ZAPGateway($rcv_response_3['result_wcId'],$rcv_response_6['result_rtn_cc']['merchantref']);

										$data['response_7'] 	= $rcv_response_7['result_rtn'];
										$data['response_7_nr'] 	= $rcv_response_7['result_rw'];
										$data['response_7_2'] 	= $rcv_response_7['result_rtn_2'];
										$data['response_7_2_nr']= $rcv_response_7['result_rw_2'];

									}

									$data['response_6'] 	= $rcv_response_6['result_rtn'];
									$data['response_6_nr'] 	= $rcv_response_6['result_rw'];


								}

								$data['response_5'] 	= $rcv_response_5['result_rtn'];
								$data['response_5_nr']  = $rcv_response_5['result_rw'];

							}

							$data['response_4'] 	= $rcv_response_4['result_rtn'];
							$data['response_4_nr'] = $rcv_response_4['result_rw'];

						}//if($rcv_response_3['result_rw'] > 0) closing

						 $data['response_3_strcd']	= $rcv_response_3['result_rtn_strcr'];
						 $data['response_3'] 		= $rcv_response_3['result_rtn'];
						 $data['response_3_nr'] 	= $rcv_response_3['result_rw'];

				   }//if($rcv_response_2['result_rw'] > 0) closing

				   $data['response_2'] 		= $rcv_response_2['result_rtn'];
				   $data['response_2_nr'] 	= $rcv_response_2['result_rw'];
				   

				}//if($rcv_response_1['result_rw'] > 0) closing

				$data['response_1'] 	= $rcv_response_1['result_rtn'];
				$data['response_1_nr'] 	= $rcv_response_1['result_rw'];

			   //redirect(base_url('kiple_bend'));
			}// if ($this->form_validation->run() == FALSE) else closing
			
			
		}  
	   
	   
		
		
		$this->load->view('all_detail',$data);
   }


}
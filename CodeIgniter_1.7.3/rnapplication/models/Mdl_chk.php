<?php
class Mdl_chk extends CI_Model{
	
	public $Mdl_chk_CI;

	public function __construct() {

      parent::__construct(); 

		$this->Mdl_chk_CI = &get_instance();
		
		$this->db1 = $this->Mdl_chk_CI->load->database('default', TRUE);
		//$this->db2 = $CI->load->database('kP_Authentication', TRUE);
		//$this->db3 = $CI->load->database('kP_Wallet', TRUE);
		//$this->db4 = $CI->load->database('kP_Profile', TRUE);
		//$this->db5 = $CI->load->database('Webcash_Gateway', TRUE);
		//$this->db6 = $CI->load->database('ZAP_Gateway', TRUE);
		
   }
	
	
	/**** public function to record log only ****/
	public function lognow($log_action,$log_desc,$log_result,$log_uid,$log_compid,$log_ssid,$log_ipadd){

		$new_insert_log = array(
							'log_action' => str_replace("'","",$log_action),
							'log_desc' => str_replace("'","",$log_desc),
							'log_result' => str_replace("'","",$log_result),
							'log_uid' => $log_uid,
							'log_compid' => $log_compid,
							'log_session' => $log_ssid,
							'log_ipaddress' => $log_ipadd
						  );

		$exec_log = $this->db1->insert($this->db1->dbprefix('logs'), $new_insert_log);

		$finallogrec =  ($this->db1->insert_id() > 0) ? "log_recorded" : "log_ntrec";
		
		return $finallogrec;
	}
	


    public function get_KipleMember(){

		$db2 	= $this->Mdl_chk_CI->load->database('kP_Authentication', TRUE);	$Q_kp_m		= "";
		$chk_uname 	= "";		$chk_email 	= "";	$chk_mobile = "";			$rtn_email	= "";
		$query 		= "";		$query_nmrw	= "";	$query_rslt	= array();		$rtn_mobile	= "";
		$query_rslt2= array();	$rtn_id		= "";	$rtn_usrnm	= "";			$rtn_uid	= "";
		

		if(!empty($this->input->post("kp_username"))){
			$chk_uname = " a.UserName= '".$this->input->post("kp_username")."' ";
        }
		if(!empty($this->input->post("kp_mobile"))){
			$chk_mobile = " or a.PhoneNumber= '".$this->input->post("kp_mobile")."' ";
        }
        if(!empty($this->input->post("kp_email"))){
			$chk_email = " or a.Email= '".$this->input->post("kp_email")."' ";
        }
		

		if(!empty($chk_uname) || !empty($chk_email) || !empty($chk_mobile)){
			$db2->where($chk_uname.$chk_mobile.$chk_email);
			$Q_kp_m		= $db2->get_compiled_select('',FALSE);
			$query 		= $db2->get("Account a ");
			$query_nmrw	= $query->num_rows();
			$query_rslt	= $query->result_object();

			$rtn_id	= "(";		$rtn_usrnm	= "(";		$rtn_email	= "(";		$rtn_uid	= "(";		$rtn_mobile	= "(";
			foreach($query_rslt as $Kqr => $Vqr){
				$rtn_id		.= "'".$Vqr->Id."',";
				$rtn_usrnm	.= "'".$Vqr->UserName."',";
				$rtn_email	.= "'".$Vqr->Email."',";
				$rtn_uid	.= "'".$Vqr->user_id."',";
				$rtn_mobile	.= "'".$Vqr->PhoneNumber."',";
			}
			$rtn_uid	.= ";)";	$rtn_email	.= ";)";	$rtn_usrnm	.= ";)";	$rtn_id	.= ";)";	$rtn_mobile	.= ";)";
			
			$rtn_uid  	= str_replace(",;)",")",$rtn_uid);
			$rtn_email  = str_replace(",;)",")",$rtn_email);
			$rtn_usrnm  = str_replace(",;)",")",$rtn_usrnm);
			$rtn_id  	= str_replace(",;)",")",$rtn_id);
			$rtn_mobile = str_replace(",;)",")",$rtn_mobile);

			$query_rslt2 = array("result_rw" => $query_nmrw, "result_rtn" => $query_rslt, "result_Id" => $rtn_id, "result_Email" => $rtn_email, "result_UName" => $rtn_usrnm, "result_mobile" => $rtn_mobile, "result_uid" => $rtn_uid);
			
			$this->lognow("Kiple Member",str_replace("'","",$Q_kp_m),$query_nmrw,"",1,"",":::1");

		}else{
			$query_rslt2 = array("result_rw" => 0, "result_rtn" => "empty_list", "result_Id" => "", "result_Email" => "", "result_UName" => "", "result_mobile" => "", "result_uid" => "");
			
			$this->lognow("Kiple Member",str_replace("'","",$Q_kp_m),"FAILED : ".$query_nmrw,"",1,"",":::1");
		}

        return $query_rslt2;

    }


    public function get_KipleProfile($insp_p_params){

		$db4 = $this->Mdl_chk_CI->load->database('kP_Profile', TRUE);
		$q_kpprfl		= "";		$q_rslt_kpprfl	= array();
		$q_nmrw_kpprfl	= "";		$q_rslt_kpprfl2 = array();		$Q_kp_p			= ""; 
		$chk_p_email 	= "";		$chk_p_uname 	= "";			$chk_p_mobile 	= "";

		if(!empty($insp_p_params)){
			$db4->where("Id in ".$insp_p_params);
			$Q_kp_p			= $db4->get_compiled_select('',FALSE);
			$q_kpprfl 		= $db4->get("UserProfile");
			$q_nmrw_kpprfl	= $q_kpprfl->num_rows();
			$q_rslt_kpprfl	= $q_kpprfl->result_object();

			$chk_p_email	= "(";		$chk_p_uname	= "(";		$chk_p_mobile	= "(";
			foreach($q_rslt_kpprfl as $Kqrkpp => $Vqrkpp){
				$chk_p_email	.= "'".$Vqrkpp->Email."',";
				$chk_p_uname	.= "'".$Vqrkpp->UserName."',";
				$chk_p_mobile	.= "'".$Vqrkpp->PhoneNumber."',";
			}
			$chk_p_email	.= ";)";	$chk_p_uname	.= ";)";	$chk_p_mobile	.= ";)";

			$chk_p_email   = str_replace(",;)",")",$chk_p_email);
			$chk_p_uname   = str_replace(",;)",")",$chk_p_uname);
			$chk_p_mobile  = str_replace(",;)",")",$chk_p_mobile);

			$q_rslt_kpprfl2 = array("result_rw" => $q_nmrw_kpprfl, "result_rtn" => $q_rslt_kpprfl, "result_kpp_email" => $chk_p_email, "result_kpp_uname" => $chk_p_uname, "result_kpp_mobile" => $chk_p_mobile);

			$this->lognow("Kiple Profile",str_replace("'","",$Q_kp_p),$q_nmrw_kpprfl,"",1,"",":::1");
        }else{
			$q_rslt_kpprfl2 = array("result_rw" => 0, "result_rtn" => "empty_list", "result_kpp_email" => "", "result_kpp_uname" => "", "result_kpp_mobile" => "");

			$this->lognow("Kiple Profile",str_replace("'","",$Q_kp_p),"FAILED : ".$q_nmrw_kpprfl,"",1,"",":::1");
		}


        return $q_rslt_kpprfl2;

    }


    public function get_KipleWallet($insp_params){

		$db3 			= $this->Mdl_chk_CI->load->database('kP_Wallet', TRUE);
		$q_kpwallet			= "";		$q_rslt_kpwallet	= array();		$q_kpstrcd			= "";		$q_rslt_kpstrcd	= "";
		$q_nmrw_kpwallet	= "";		$q_rslt_kpwallet2	= array();		$q_nmrw_kpstrcd	= "";		
		$chk_webcash_id 	= "";		$Q_kp_w				= "";					$Q_kp_strcd				= "";

		if(!empty($insp_params)){
			$db3->where("Id in ".$insp_params);
			//$db3->order_by("CreatedAt", 'DESC');
			$Q_kp_w				= $db3->get_compiled_select('',FALSE);
			$q_kpwallet 		= $db3->get("Wallet.Wallet");
			$q_nmrw_kpwallet	= $q_kpwallet->num_rows();
			$q_rslt_kpwallet	= $q_kpwallet->result_object();

			$chk_webcash_id	= "(";
			foreach($q_rslt_kpwallet as $Kqrkpw => $Vqrkpw){
				$chk_webcash_id		.= "'".$Vqrkpw->WebCashId."',";
			}
			$chk_webcash_id	.= ";)";

			$chk_webcash_id   = str_replace(",;)",")",$chk_webcash_id);
			
			
			//get the storecard balance
			$Q_kp_strcd		= " select * from ".$db3->dbprefix("Wallet.StoreCard")." where WalletId in ".$insp_params;	
			$q_kpstrcd		= $db3->query($Q_kp_strcd);
			$q_nmrw_kpstrcd	= $q_kpstrcd->num_rows();
			
			$q_rslt_kpstrcd	= ($q_nmrw_kpstrcd > 0 && !empty($q_nmrw_kpstrcd)) ? $q_kpstrcd->result_object() : "empty_list";
			
			

			$q_rslt_kpwallet2 = array("result_rw" => $q_nmrw_kpwallet, "result_rtn" => $q_rslt_kpwallet, "result_wcId" => $chk_webcash_id, "result_rtn_strcr" => $q_rslt_kpstrcd);
			$this->lognow("Kiple Wallet",str_replace("'","",$Q_kp_w),$q_nmrw_kpwallet,"",1,"",":::1");
        }else{
			$q_rslt_kpwallet2 = array("result_rw" => 0, "result_rtn" => "empty_list", "result_wcId" => "", "result_rtn_strcr" => "");
			$this->lognow("Kiple Wallet",str_replace("'","",$Q_kp_w),"FAILED : ".$q_nmrw_kpwallet,"",1,"",":::1");
		}


        return $q_rslt_kpwallet2;

    }


    public function get_KipleWalletHistory($insp_h_params){

		$db3 			= $this->Mdl_chk_CI->load->database('kP_Wallet', TRUE);
		$q_kpwlt_h		= "";		$q_rslt_kpwlt_h	= array();
		$q_nmrw_kpwlt_h	= "";		$q_rslt_kpwlt_h2= array();
		$chk_webcash_id = "";		$Q_kp_wh		= "";

		if(!empty($insp_h_params)){
			$db3->select("CASE a.Action                
		WHEN  0 THEN 'Topup cash'
		WHEN 1 THEN 'Topup credit card'
		WHEN 2 THEN 'Withdrawal'
		WHEN 3 THEN 'Transfer'
		WHEN 4 THEN 'Payment'
		WHEN 5 THEN 'Bill Payment'
		WHEN 6 THEN 'Mobile Reload'
		WHEN 7 THEN 'Void'
		WHEN 8 THEN 'Get free voucher'
		WHEN 9 THEN 'Purchase voucher'
		WHEN 10 THEN 'Pay at table'
		WHEN 11 THEN 'Redeem voucher'
		WHEN 12 THEN 'Order & Pay'
		WHEN 13 THEN 'Received money'
		WHEN 14 THEN 'Topup StoreCard'
		WHEN 15 THEN 'Pay @ Counter'
		WHEN 16 THEN 'Pay @ Counter (user scan QR)'
		WHEN 17 THEN 'Top-up (FPX)'
		WHEN 18 THEN 'Top-up (OTC)'
		WHEN 19 THEN 'Reward'
		WHEN 20 THEN 'Topup Bonus'
		WHEN 21 THEN 'Refund'
		WHEN 22 THEN 'Static QR Payment'
		WHEN 23 THEN 'Online payment'
		WHEN 24 THEN 'Hold payment'
		WHEN 25 THEN 'Commit hold'
		WHEN 26 THEN 'Cancel hold'
		WHEN 27 THEN 'Timeout hold'
		WHEN 28 THEN 'Topup by CreditCard'
		WHEN 29 THEN 'Payment by CreditCard'
ELSE '-'
END action_desc, a.*");
			$db3->where("WalletId in ".$insp_h_params);
			$db3->where("CreatedAt > '2016-12-31 23:59:59.999999'");
			//$db3->order_by("CreatedAt", 'DESC');
			$Q_kp_wh		= $db3->get_compiled_select('',FALSE);
			$q_kpwlt_h 		= $db3->get("Wallet.TransactionHistory a");
			$q_nmrw_kpwlt_h	= $q_kpwlt_h->num_rows();
			$q_rslt_kpwlt_h	= $q_kpwlt_h->result_object();

			$q_rslt_kpwlt_h2 = array("result_rw" => $q_nmrw_kpwlt_h, "result_rtn" => $q_rslt_kpwlt_h);
			$this->lognow("Kiple Wallet History",str_replace("'","",$Q_kp_wh),$q_nmrw_kpwlt_h,"",1,"",":::1");
        }else{
			$q_rslt_kpwlt_h2 = array("result_rw" => 0, "result_rtn" => "empty_list");
			$this->lognow("Kiple Wallet History",str_replace("'","",$Q_kp_wh),"FAILED : ".$q_nmrw_kpwlt_h,"",1,"",":::1");
		}

        return $q_rslt_kpwlt_h2;

    }


    public function get_WebcashWallet($insp_ww_params){

		$db5 = $this->Mdl_chk_CI->load->database('Webcash_Gateway', TRUE);
		$q_wcwallet			= "";		$q_rslt_wcwallet = array();
		$q_nmrw_wcwallet	= "";		$q_rslt_wcwallet2= array();		$Q_wc_w		= "";
		$chk_wc_id 			= "";		$chk_wc_uid 	 = "";			$chk_wc_mid	= "";

		if(!empty($insp_ww_params)){
			$db5->where("member_id in ".$insp_ww_params);
			$Q_wc_w			= $db5->get_compiled_select('',FALSE);
			$q_wcwallet 	= $db5->get("webcash_production.wallets");
			$q_nmrw_wcwallet= $q_wcwallet->num_rows();
			$q_rslt_wcwallet= $q_wcwallet->result_object();

			$chk_wc_id	= "(";			$chk_wc_uid	= "(";		$chk_wc_mid	= "(";
			foreach($q_rslt_wcwallet as $Kqrwcw => $Vqrwcw){
				$chk_wc_id	.= "'".$Vqrwcw->id."',";
				$chk_wc_uid	.= "'".$Vqrwcw->user_id."',";
				$chk_wc_mid	.= "'".$Vqrwcw->member_id."',";
			}
			$chk_wc_id	.= ";)";		$chk_wc_uid	.= ";)";	$chk_wc_mid	.= ";)";

			$chk_wc_id   = str_replace(",;)",")",$chk_wc_id);
			$chk_wc_uid  = str_replace(",;)",")",$chk_wc_uid);
			$chk_wc_mid  = str_replace(",;)",")",$chk_wc_mid);

			$q_rslt_wcwallet2 = array("result_rw" => $q_nmrw_wcwallet, "result_rtn" => $q_rslt_wcwallet, "result_wc_id" => $chk_wc_id, "result_wc_uid" => $chk_wc_uid, "result_wc_mid" => $chk_wc_mid);
			$this->lognow("Webcash Wallet",str_replace("'","",$Q_wc_w),$q_nmrw_wcwallet,"",1,"",":::1");
        }else{
			$q_rslt_wcwallet2 = array("result_rw" => 0, "result_rtn" => "empty_list", "result_wc_id" => "", "result_wc_uid" => "", "result_wc_mid" => "");
			$this->lognow("Webcash Wallet",str_replace("'","",$Q_wc_w),"FAILED : ".$q_nmrw_wcwallet,"",1,"",":::1");
		}

        return $q_rslt_wcwallet2;

    }


    public function get_WebcashGateway($insp_wcgw_params_1,$insp_wcgw_params_2){

		$db5 = $this->Mdl_chk_CI->load->database('Webcash_Gateway', TRUE);
		$q_wcgw			 = "";		$q_rslt_wcgw = array();			$wcgw_cc	= array();
		$q_nmrw_wcgw	 = "";		$q_rslt_wcgw2= array();			$Q_wc_gw	= "";
		$chk_wcgw_cc_nmrw= 0;

		if(!empty($insp_wcgw_params_1) || !empty($insp_wcgw_params_2)){
			$db5->where("form_email in ".$insp_wcgw_params_1);

			if(!empty($insp_wcgw_params_2)){
				$db5->or_where("form_mobile in ".$insp_wcgw_params_2);
			}

			//$db5->order_by("created", 'DESC');
			$Q_wc_gw	= $db5->get_compiled_select('',FALSE);
			$q_wcgw 	= $db5->get("webcash_production.gateway_entries");
			$q_nmrw_wcgw= $q_wcgw->num_rows();
			$q_rslt_wcgw= $q_wcgw->result_object();

			foreach($q_rslt_wcgw as $Kqrwcwgw => $Vqrwcwgw){

				if($Vqrwcwgw->type == "CC"){
					$wcgw_cc	= array("tbl_id" => $Vqrwcwgw->id, "created_on" => $Vqrwcwgw->created, "modified_on" => $Vqrwcwgw->modified, "transid" => $Vqrwcwgw->transaction_id, "merchantref" => $Vqrwcwgw->merchant_reference, "amnt" => $Vqrwcwgw->amount);
					$chk_wcgw_cc_nmrw= 1;	$chk_wcgw_cc_nmrw++;
				}

			}


			$q_rslt_wcgw2 = array("result_rw" => $q_nmrw_wcgw, "result_rtn" => $q_rslt_wcgw, "result_rtn_cc_rw" => $chk_wcgw_cc_nmrw, "result_rtn_cc" => $wcgw_cc);
			$this->lognow("Webcash Gateway",str_replace("'","",$Q_wc_gw),$q_nmrw_wcgw,"",1,"",":::1");
        }else{
			$q_rslt_wcgw2 = array("result_rw" => 0, "result_rtn" => "empty_list", "result_rtn_cc_rw" => $chk_wcgw_cc_nmrw, "result_rtn_cc" => $wcgw_cc);
			$this->lognow("Webcash Gateway",str_replace("'","",$Q_wc_gw),"FAILED : ".$q_nmrw_wcgw,"",1,"",":::1");
		}

        return $q_rslt_wcgw2;

    }


	public function get_ZAPGateway($insp_zgw_params_1,$insp_zgw_params_2){

		$db6 = $this->Mdl_chk_CI->load->database('ZAP_Gateway', TRUE);
		$q_trans_zpgw		= "";		$q_trans_rslt_zpgw 		= array();		$Q_zp_gw_trans			= "";
		$q_trans_nmrw_zpgw	= "";		$q_trans_rslt_zpgw2		= array();		$Q_zp_gw_rspns			= "";
		$q_zpgw_trans		= "";		$chk_zpgw_id 			= "";			$q_tpp_rspns_zpgw		= "";	
		$q_tpp_rspns_nmrw	= "";		$q_tpp_rspns_rslt_zpgw 	= array();		$q_tpp_rspns_rslt_zpgw2 = array();	

		if(!empty($insp_zgw_params_1) && !empty($$insp_zgw_params_2)){
			//chk transaction tbl 1st
			$db6->where("wallet_id in ".$insp_zgw_params_1);
			$db6->where("adyan_reference in ".$insp_zgw_params_2);
			$Q_zp_gw_trans		= $db6->get_compiled_select('',FALSE);
			$q_zpgw_trans 		= $db6->get("gateway.transactions");
			$q_trans_nmrw_zpgw	= $q_zpgw_trans->num_rows();

			
			if($q_trans_nmrw_zpgw > 0){

				$q_trans_rslt_zpgw	= $q_zpgw_trans->result_object();
				
				$chk_zpgw_id 		= "(";
				foreach($q_trans_rslt_zpgw as $Kzpgw => $Vzpgw){
					$chk_zpgw_id	.= "'".$Vzpgw->id."',";
				}
				$chk_zpgw_id	.= ";)";
				$chk_zpgw_id   = str_replace(",;)",")",$chk_zpgw_id);


				//chk topup responses
				$Q_zp_gw_rspns			= " select * from ".$db6->dbprefix("gateway.topup_responses")." where transaction_id in ".$chk_zpgw_id;	
				$q_tpp_rspns_zpgw		= $db6->query($Q_zp_gw_rspns);
				$q_tpp_rspns_nmrw		= $q_tpp_rspns_zpgw->num_rows();
				$q_tpp_rspns_rslt_zpgw	= ($q_tpp_rspns_nmrw > 0 && !empty($q_tpp_rspns_nmrw)) ? $q_tpp_rspns_zpgw->result_object() : "empty_list";

			}

			$q_tpp_rspns_rslt_zpgw2 = array("result_rw" => $q_trans_nmrw_zpgw, "result_rtn" => $q_trans_rslt_zpgw, "result_rw_2" => $q_tpp_rspns_nmrw, "result_rtn_2" => $q_tpp_rspns_rslt_zpgw);
			$this->lognow("ZAP Gateway",str_replace("'","",$Q_zp_gw_trans. " | Q2 : ".$Q_zp_gw_rspns),"Trans rw : ".$q_trans_nmrw_zpgw." | Tpp Rspns rw : ".$q_tpp_rspns_nmrw,"",1,"",":::1");
        }else{
			$q_tpp_rspns_rslt_zpgw2 = array("result_rw" => 0, "result_rtn" => "empty_list", "result_rw_2" => 0, "result_rtn_2" => "empty_list");
			$this->lognow("ZAP Gateway",str_replace("'","",$Q_zp_gw_trans),"FAILED : ".$q_trans_nmrw_zpgw,"",1,"",":::1");
		}

        return $q_tpp_rspns_rslt_zpgw2;

    }



}

?>
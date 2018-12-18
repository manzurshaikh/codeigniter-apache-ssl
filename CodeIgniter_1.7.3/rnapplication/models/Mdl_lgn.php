<?php
class Mdl_lgn extends CI_Model{
	
	public $Mdl_lgn_CI;

	public function __construct() {

      parent::__construct(); 

		$this->Mdl_lgn_CI = &get_instance();
		$this->db1 = $this->Mdl_lgn_CI->load->database('default', TRUE);

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
	


	/**** public function to clean content deep only ****/
	public function cleancontent_deep($content2bcleaned){

		$content2bcleaned = str_replace(" ","",$content2bcleaned);
		$content2bcleaned = str_replace("/","",$content2bcleaned);
		$content2bcleaned = str_replace(":","",$content2bcleaned);
		$content2bcleaned = str_replace("^","",$content2bcleaned);
		$content2bcleaned = str_replace("*","",$content2bcleaned);
		$content2bcleaned = str_replace("'","",$content2bcleaned);
		$content2bcleaned = str_replace("#","",$content2bcleaned);
		$content2bcleaned = str_replace(";","",$content2bcleaned);
		$content2bcleaned = str_replace("?","",$content2bcleaned);
		$content2bcleaned = str_replace("%","",$content2bcleaned);
		$content2bcleaned = str_replace("$","",$content2bcleaned);
		$content2bcleaned = str_replace("&","",$content2bcleaned);
		$content2bcleaned = str_replace("insert","",$content2bcleaned);
		$content2bcleaned = str_replace(" insert ","",$content2bcleaned);
		$content2bcleaned = str_replace(" ;insert ","",$content2bcleaned);
		$content2bcleaned = str_replace(" ; insert ","",$content2bcleaned);
		$content2bcleaned = str_replace("update","",$content2bcleaned);
		$content2bcleaned = str_replace(" update ","",$content2bcleaned);
		$content2bcleaned = str_replace(" ;update ","",$content2bcleaned);
		$content2bcleaned = str_replace(" ; update ","",$content2bcleaned);
		$content2bcleaned = str_replace(" or ","",$content2bcleaned);
		$content2bcleaned = str_replace("delete","",$content2bcleaned);
		$content2bcleaned = str_replace(" delete ","",$content2bcleaned);
		$content2bcleaned = str_replace(" ;delete ","",$content2bcleaned);
		$content2bcleaned = str_replace(" ; delete ","",$content2bcleaned);
		//$content2bcleaned = rtrim($content2bcleaned);

		return $content2bcleaned;

	}

    public function get_AdminMember(){

		if(!empty($this->input->post("kp_username")) && !empty($this->input->post("kp_password"))){
			
			$lgnfe_loginid 	= $this->cleancontent_deep($this->input->post('kp_username'));	
			$lgnfe_loginpwd = $this->cleancontent_deep($this->input->post('kp_password'));
			
			$this->db1->where($chk_uname.$chk_mobile.$chk_email);
			$Q_kp_m		= $this->db1->get_compiled_select('',FALSE);
			$query 		= $this->db1->get("Account a ");
			$query_nmrw	= $query->num_rows();
			$query_rslt	= $query->result_object();
			
        }
		if(!empty($this->input->post("kp_mobile"))){
			$chk_mobile = " or a.PhoneNumber= '".$this->input->post("kp_mobile")."' ";
        }
        if(!empty($this->input->post("kp_email"))){
			$chk_email = " or a.Email= '".$this->input->post("kp_email")."' ";
        }
		

		if(!empty($chk_uname) || !empty($chk_email) || !empty($chk_mobile)){
			

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


    



}

?>
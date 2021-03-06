<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Process_checking extends CI_Controller {

	private $perpage	= 30;
	private $numlinks	= 10;


	function __construct(){

		parent::__construct();

		/* if(empty($this->session->userdata['felogged_in'])){

			$this->session->set_flashdata('logout_msg', "Session Over. Please Select again.");
			redirect(base_url()."stafflogin");

		}else{

			$this->frntlgn_uid 			= $this->session->userdata['felogged_in']->frtstf_id;
			$this->frntlgn_refno 		= $this->session->userdata['felogged_in']->frtstf_refno;
			$this->frntlgn_loc 			= $this->session->userdata['felogged_in']->frtstf_loc_id;
			$this->frntlgn_usrtype 		= $this->session->userdata['felogged_in']->frtstf_type;
			$this->frntlgn_dept 		= $this->session->userdata['felogged_in']->frtstf_dept;
			$this->frntlgn_code 		= $this->session->userdata['felogged_in']->frtstf_code;
			$this->frntlgn_compid 		= $this->session->userdata['felogged_in']->frtstf_compid;
			$this->frntlgn_permission 	= $this->session->userdata['felogged_in']->frtstf_permission;
			$this->frntlgn_usrname		= $this->session->userdata['felogged_in']->frtstf_username;
			$this->frntlgn_name			= $this->session->userdata['felogged_in']->frtstf_name;
			$this->frntlgn_email 		= $this->session->userdata['felogged_in']->frtstf_email;
			$this->frntlgn_mobile 		= $this->session->userdata['felogged_in']->frtstf_mobile;
			$this->frntlgn_lang 		= $this->session->userdata['felogged_in']->frtstf_lang;
			$this->frntlgn_sess_id 		= $this->session->userdata['felogged_in']->frtstf_sess_id;
			$this->frntlgn_expiry_date	= $this->session->userdata['felogged_in']->frtstf_expiry_date;
			$this->frntlgn_days2expire	= $this->session->userdata['felogged_in']->frtstf_days2expire;

		} */

	}


	function _remap($method, $params = array()){

		//$method contains the second segment of your URI @ function 2call b4 send all the params
		/* echo "<p>remap : ".$method." : URI -->> ".$this->uri->segment(1)."</p>";
		echo "<p>params : ";
			print_r($params);
		echo "</p>"; */
		$params_new[0] 	= $params[0];
		$params_new[1] 	= (!empty($params[1])) ? $params[1] : "";
		$params_new[2] 	= (!empty($params[2])) ? $params[2] : "";
		$params_new[3] 	= (!empty($params[3])) ? $params[3] : "";

		if(trim($this->uri->segment(1)) == "all_search" && empty($params_new[0])){
			$params_fnct = "search_all";
		}elseif($params_new[1] == "new" && !empty($params_new[1])){
			$params_fnct = ($params_new[0] == "checklist") ? "new_checklist" : "new_all";
		}else{
			$params_fnct = ($params_new[0] == "checklist") ? "get_checklist" : "get_all";
		}

		/* print_r($params_new[0]);echo "<p>params_fnct : ";
			print_r($params_fnct);
		echo "</p>"; */
		$this->$params_fnct($params_new[0],$params_new[1],$params_new[2],$params_new[3]);

	}


	/**** public function to clean content deep only ****/
	public function cleancontent_deep($content2bcleaned){
		
		//$arr_string = is_array(trim($content2bcleaned) ? json_encode($content2bcleaned) : $content2bcleaned;
		//$this->lognow("DATA 2BCLEANED cleancontent_deep ",str_replace("'","",$arr_string),"","",1,"admin","",":::1");
			
			
		//$content2bcleaned = str_replace(" ","",$content2bcleaned);
		//$content2bcleaned = str_replace("/","",$content2bcleaned);
		//$content2bcleaned = str_replace(":","&#58;",$content2bcleaned);
		//$content2bcleaned = str_replace("^","",$content2bcleaned);
		//$content2bcleaned = str_replace("*","",$content2bcleaned);
		$content2bcleaned = str_replace("'"," ",$content2bcleaned);
		$content2bcleaned = str_replace("#"," ",$content2bcleaned);
		$content2bcleaned = str_replace(";"," ",$content2bcleaned);
		$content2bcleaned = str_replace("?"," ",$content2bcleaned);
		//$content2bcleaned = str_replace("%"," ",$content2bcleaned);
		//$content2bcleaned = str_replace("$"," ",$content2bcleaned);
		$content2bcleaned = str_replace("insert"," ",$content2bcleaned);
		$content2bcleaned = str_replace(" insert "," ",$content2bcleaned);
		$content2bcleaned = str_replace(" ;insert "," ",$content2bcleaned);
		$content2bcleaned = str_replace(" ; insert "," ",$content2bcleaned);
		$content2bcleaned = str_replace("update"," ",$content2bcleaned);
		$content2bcleaned = str_replace(" update "," ",$content2bcleaned);
		$content2bcleaned = str_replace(" ;update "," ",$content2bcleaned);
		$content2bcleaned = str_replace(" ; update "," ",$content2bcleaned);
		$content2bcleaned = str_replace(" or "," ",$content2bcleaned);
		$content2bcleaned = str_replace("delete"," ",$content2bcleaned);
		$content2bcleaned = str_replace(" delete "," ",$content2bcleaned);
		$content2bcleaned = str_replace(" ;delete "," ",$content2bcleaned);
		$content2bcleaned = str_replace(" ; delete "," ",$content2bcleaned);
		//$content2bcleaned = rtrim($content2bcleaned);

		return $content2bcleaned;
	}


	public function get_all($view_type, $view_categ, $view_sub_categ, $view_detail_pgoffset){

		//$view_type 			 =  $this->uri->segment(3);/**** sub (type) - user, admin, rating  ****/
		//$view_categ 			 =  $this->uri->segment(4);/**** sub sub (category) - normal, super admin, normal admin, accounts, customer service ****/
		//$view_sub_categ 		 =  $this->uri->segment(5);/**** sub sub sub (category) - normal, super admin, admin, accounts, customer service ****/
		//$view_detail_pgoffset	 =  $this->uri->segment(6);/**** selected (details) - id, refno, role or  pagination ****/
		//$view_pgstart			 =  $this->uri->segment(7);/**** pg start 4 pagination ****/


		$postparams_2			= "";		$postparams_3				= "";		$update_concrete_reply_final= "";		$switch_detail_expl 	= "";
		$postparams_btn_result	= "";		$postparams_status_result	= "";		$update_concrete_reply2_final= "";		$switch_detail_expl_2 	= "";
		$additional_option		= array();	$rpt_date					= "";		$postparams_4= "";$postparams_5= "";	$postparams_6= "";
		$tesinfo_kg_cnt 		= array();	$tesinfo_cnt				= "";		$cncrt_xtr_cb_id = array();				$error_rcv = "";
		$datetimenow			= str_replace(" ","_",str_replace(":","-",DATE_TODAY_FULL));								$loc_main	= "";
		$response['content_cancel']	= "noinfo";										$template2view_new	= "";

		if(empty($view_detail_pgoffset)){
			$view_detail_pgoffset	= 0;		$switch_detail_expl_2 = "";
		}else{
			if(strpos($view_detail_pgoffset,"_",0) > 0){ 
				$switch_detail_expl	= explode("_",$view_detail_pgoffset);	$switch_detail_expl_2 = $switch_detail_expl[1];
			}else{
				$switch_detail_expl	= $view_detail_pgoffset;	$switch_detail_expl_2 = $switch_detail_expl;
			}
		}

		//for test info only
		$chk_cncrt_xtr_cb_no = "";		$chk_cncrt_xtr_cb_marking= "";		$chk_cncrt_xtr_date_cast = "";		$chk_cncrt_xtr_date_test = "";		$chk_cncrt_xtr_test_age  = "";
		$chk_cncrt_xtr_weight = "";		$chk_cncrt_xtr_density	 = "";;		$chk_cncrt_xtr_load_max  = "";		$chk_cncrt_xtr_strength  = "";		$chk_cncrt_xtr_remark 	 = "";

		$cncrt_xtr_cb_no = array();		$cncrt_xtr_cb_marking 	= array();		$cncrt_xtr_date_cast= array();		$cncrt_xtr_date_test= array();		$cncrt_xtr_test_age = array();
		$cncrt_xtr_weight= array();		$cncrt_xtr_density 		= array();		$cncrt_xtr_load_max = array();		$cncrt_xtr_strength = array();		$cncrt_xtr_remark 	= array();

		// for all location for this company
		$response_processed_loc			= $this->_cpumethod_limited("codes_lct", $view_categ, $view_sub_categ, 1, "ALL");
		$response_processed_loc_cleaned	= json_decode($response_processed_loc);


		$final_compid	= (!empty($this->input->post('update_'.$view_type.'_compid')) && $this->input->post('update_'.$view_type.'_compid') > 0) ? $this->input->post('update_'.$view_type.'_compid') : 1;

		$loc_tested		= 1;		$cncrt_xtr_cnt	 = "";		$cncrt_xtr_cnt_2	= "";			$cncrt_xtr_cnt_3 = "";

		$final_updt_co_code		= "";		$final_updt_co_name		= "";		$final_updt_co_mobile		= "";		$final_updt_co_email	= "";
		$final_updt_co_code_2	= "";		$final_updt_co_name_2	= "";		$final_updt_co_mobile_2		= "";		$final_updt_co_email_2	= "";

		$final_updt_prjct_code	= "";		$final_updt_prjct_name	= "";		$final_updt_prjct_remark	= "";		$final_updt_co_remark	= "";
		$final_updt_prjct_code_2= "";		$final_updt_prjct_name_2= "";		$final_updt_prjct_remark_2	= "";		$final_updt_co_remark_2	= "";

		//to upload pic
		$cleaned_upload_pic		= "";		$cleaned_img_pic	= "";		$cleaned_img_pic_2	= "";		$cleaned_img_pic_nw= "";		$cleaned_img_pic_nw_2= "";

		//pic db entry info
		$cleaned_img_pic_nw_3 	= "";		$img_upload_config_logo = array();		$response['alisting_update_pic'] = "";		$response['alisting_pic_size'] = "";	$response['alisting_pic_error']	= "";


		if($this->input->post('update_feedback_check') == "confirm"){
			//print_r($_POST); //exit;

			if($view_type == "concrete"){ //print_r($_POST); //exit;

				$rpt_date		= (!empty($this->input->post('update_ct_date_test_1'))) ? $this->input->post('update_ct_date_test_1'): DATE_TODAY;


				$postparams_1_tbl= $view_type;
				$postparams_1	 = json_encode(array("param_1_table" => $postparams_1_tbl,"param_1_refno" => $switch_detail_expl_2,"param_1_compid" => $final_compid,"param_1_category" => $this->input->post('update_'.$view_type.'_category'),"param_1_loc_id" => $loc_tested,"param_1_consignee" => $this->input->post('update_'.$view_type.'_consignee_id'),"param_1_consignee_address" => "","param_1_consignee_co" => $this->input->post('update_'.$view_type.'_consignee_co'),"param_1_consignee_co_id" => $this->input->post('update_'.$view_type.'_consignee_co_id'),"param_1_consignee_cgnee_co_id" => $this->input->post('update_'.$view_type.'_cgnee_co_id'),"param_1_consignee_address_co" => "","param_1_loc_project" => $this->input->post('update_project_loc'),"param_1_loc_project_id" => $this->input->post('update_'.$view_type.'_loc_project_id'),"param_1_loc_delivery" => $this->input->post('update_'.$view_type.'_loc_delivery'),"param_1_grade" => $this->input->post('update_'.$view_type.'_grade'),"param_1_cement_ratio" => $this->input->post('update_'.$view_type.'_cement_h2o'),"param_1_cement_brand" => $this->input->post('update_'.$view_type.'_cement_brand'),"param_1_aggt_fine" => $this->input->post('update_'.$view_type.'_aggt_fine'),"param_1_aggt_coarse" => $this->input->post('update_'.$view_type.'_aggt_coarse'),"param_1_admixture" => $this->input->post('update_'.$view_type.'_admixture'),"param_1_slump" => $this->input->post('update_'.$view_type.'_slump'),"param_1_dimension" => $this->input->post('update_'.$view_type.'_test_dimension'),"param_1_rpt_date" => $rpt_date,"param_1_remark" => $this->input->post('update_'.$view_type.'_remark')));


				//stop if there is no record on 1st box
				if(empty($this->input->post('update_ct_no_1')) && empty($this->input->post('update_ct_marking_1')) && empty($this->input->post('update_ct_date_cast_1')) && empty($this->input->post('update_ct_date_test_1')) && empty($this->input->post('update_ct_age_1')) && empty($this->input->post('update_ct_weight_1')) && empty($this->input->post('update_ct_density_1')) && empty($this->input->post('update_ct_load_max_1')) && empty($this->input->post('update_ct_strength_1'))){

					$error_rcv = "stop";

				}elseif(empty($this->input->post('update_project_loc')) && (empty($this->input->post('update_concrete_loc_project_id')))){
					$error_rcv = "stop_2";
				}else{

					//for test info cnt only.
					for($titm_cnt_0=1;$titm_cnt_0<7;$titm_cnt_0++){		
						if(!empty($this->input->post('update_ct_weight_'.$titm_cnt_0))){	
							$tesinfo_kg_cnt[] = $this->input->post('update_ct_weight_'.$titm_cnt_0);	
						}
					}
					$tesinfo_cnt	= sizeof($tesinfo_kg_cnt);

					//for test info only.
					for($titm_cnt=1;$titm_cnt<($tesinfo_cnt+1);$titm_cnt++){

						//fix the empty input box to data
						$batch_same_marking	 = (!empty($this->input->post('update_ct_marking_'.$titm_cnt))) ? $this->input->post('update_ct_marking_'.$titm_cnt) : $batch_same_marking;
						$batch_same_date_cast= (!empty($this->input->post('update_ct_date_cast_'.$titm_cnt))) ? $this->input->post('update_ct_date_cast_'.$titm_cnt) : $batch_same_date_cast;
						$batch_same_date_test= (!empty($this->input->post('update_ct_date_test_'.$titm_cnt))) ? $this->input->post('update_ct_date_test_'.$titm_cnt) : $batch_same_date_test;			
						$batch_same_test_age = (!empty($this->input->post('update_ct_age_'.$titm_cnt))) ? $this->input->post('update_ct_age_'.$titm_cnt) : $batch_same_test_age;


						$cncrt_xtr_cb_id[]		= (!empty($this->input->post('update_ct_id_'.$titm_cnt))) ? $this->input->post('update_ct_id_'.$titm_cnt) : "";
						$cncrt_xtr_cb_no[]		= (!empty($this->input->post('update_ct_no_'.$titm_cnt))) ? $this->input->post('update_ct_no_'.$titm_cnt) : $this->input->post('update_ct_no_'.($titm_cnt-1));
						$cncrt_xtr_cb_marking[] = $batch_same_marking;
						$cncrt_xtr_date_cast[] 	= $batch_same_date_cast;	
						$cncrt_xtr_date_test[] 	= $batch_same_date_test;
						$cncrt_xtr_test_age[] 	= $batch_same_test_age;
						$cncrt_xtr_weight[] 	= (!empty($this->input->post('update_ct_weight_'.$titm_cnt))) ? $this->input->post('update_ct_weight_'.$titm_cnt) : "";
						$cncrt_xtr_density[] 	= (!empty($this->input->post('update_ct_density_'.$titm_cnt))) ? $this->input->post('update_ct_density_'.$titm_cnt) : "";
						$cncrt_xtr_load_max[] 	= (!empty($this->input->post('update_ct_load_max_'.$titm_cnt))) ? $this->input->post('update_ct_load_max_'.$titm_cnt) : "";
						$cncrt_xtr_strength[] 	= (!empty($this->input->post('update_ct_strength_'.$titm_cnt))) ? $this->input->post('update_ct_strength_'.$titm_cnt) : "";
						$cncrt_xtr_remark[] 	= (!empty($this->input->post('update_ct_remark_'.$titm_cnt))) ? $this->input->post('update_ct_remark_'.$titm_cnt) : "";

					}

				}



				$cncrt_xtr_cnt	 = sizeof($cncrt_xtr_weight);
				$postparams_2_tbl= $view_type."_extra";
				$postparams_2	 = json_encode(array("param_2_table" => $postparams_2_tbl,"param_2_ct_id" => $cncrt_xtr_cb_id,"param_2_ct_cb_no" => $cncrt_xtr_cb_no,"param_2_ct_cb_marking" => $cncrt_xtr_cb_marking,"param_2_ct_date_cast" => $cncrt_xtr_date_cast,"param_2_ct_date_test" => $cncrt_xtr_date_test,"param_2_ct_test_age" => $cncrt_xtr_test_age,"param_2_ct_weight" => $cncrt_xtr_weight,"param_2_ct_density" => $cncrt_xtr_density,"param_2_ct_load_max" => $cncrt_xtr_load_max,"param_2_ct_strength" => $cncrt_xtr_strength,"param_2_ct_remark" => $cncrt_xtr_remark,"param_2_cnt" => $cncrt_xtr_cnt));
				

			}elseif($view_type == "user"){	//print_r($_POST); //exit;

				

				$postparams_1_tbl= $view_type;
				$postparams_1	 = json_encode(array("param_1_table" => $postparams_1_tbl,"param_1_refno" => $switch_detail_expl_2,"param_1_compid" => $final_compid,"param_1_loc_id" => $this->input->post('update_'.$view_type.'_loc_project'),"param_1_name" => $this->input->post('update_'.$view_type.'_name'),"param_1_mobile" => $this->input->post('update_'.$view_type.'_mobile'),"param_1_email" => $this->input->post('update_'.$view_type.'_email'),"param_1_pwd" => $this->input->post('update_new_pwd'),"param_1_remark" => $this->input->post('update_'.$view_type.'_remark')));


				$postparams_2_tbl= $view_type."_co";

				$final_updt_co_code		= $this->input->post('update_'.$postparams_2_tbl.'_code');			$final_updt_co_name	= $this->input->post('update_'.$postparams_2_tbl.'_name');	
				$final_updt_co_mobile	= $this->input->post('update_'.$postparams_2_tbl.'_mobile');		$final_updt_co_email= $this->input->post('update_'.$postparams_2_tbl.'_email');	
				$final_updt_co_remark	= $this->input->post('update_'.$postparams_2_tbl.'_remark');

				if(!empty($this->input->post('update_'.$postparams_2_tbl))){
					$final_updt_co_code_2	= $final_updt_co_code[$this->input->post('update_'.$postparams_2_tbl)];
					$final_updt_co_name_2	= $final_updt_co_name[$this->input->post('update_'.$postparams_2_tbl)];
					$final_updt_co_mobile_2	= $final_updt_co_mobile[$this->input->post('update_'.$postparams_2_tbl)];
					$final_updt_co_email_2	= $final_updt_co_email[$this->input->post('update_'.$postparams_2_tbl)];
					$final_updt_co_remark_2	= $final_updt_co_remark[$this->input->post('update_'.$postparams_2_tbl)];
				}

				$cncrt_xtr_cnt_2 = sizeof($this->input->post('update_'.$postparams_2_tbl.'_code'));
				$postparams_2	 = json_encode(array("param_2_table" => $postparams_2_tbl,"param_2_refno" => $switch_detail_expl_2,"param_2_id" => $this->input->post('update_'.$postparams_2_tbl),"param_2_code" => $final_updt_co_code_2,"param_2_name" => $final_updt_co_name_2,"param_2_mobile" => $final_updt_co_mobile_2,"param_2_email" => $final_updt_co_email_2,"param_2_remark" => $final_updt_co_remark_2,"param_2_cnt" => $cncrt_xtr_cnt_2));


				$postparams_3_tbl= $view_type."_project";

				$final_updt_prjct_code	= $this->input->post('update_'.$postparams_3_tbl.'_code');			$final_updt_prjct_name	= $this->input->post('update_'.$postparams_3_tbl.'_name');	
				$final_updt_prjct_remark= $this->input->post('update_'.$postparams_3_tbl.'_remark');

				if(!empty($this->input->post('update_'.$postparams_3_tbl))){
					$final_updt_prjct_code_2= $final_updt_prjct_code[$this->input->post('update_'.$postparams_3_tbl)];
					$final_updt_prjct_name_2= $final_updt_prjct_name[$this->input->post('update_'.$postparams_3_tbl)];
					$final_updt_prjct_remark_2	= $final_updt_prjct_remark[$this->input->post('update_'.$postparams_3_tbl)];
				}

				$cncrt_xtr_cnt_3 = sizeof($this->input->post('update_'.$postparams_3_tbl.'_code'));
				$postparams_3	 = json_encode(array("param_3_table" => $postparams_3_tbl,"param_3_refno" => $switch_detail_expl_2,"param_3_id" => $this->input->post('update_'.$postparams_3_tbl),"param_3_code" => $final_updt_prjct_code_2,"param_3_name" => $final_updt_prjct_name_2,"param_3_remark" => $final_updt_prjct_remark_2,"param_3_cnt" => $cncrt_xtr_cnt_3));


			}elseif(substr($view_type,strpos($view_type,"category"),8) == "category"){

				$postparams_1_tbl			= $view_type;
				$postparams_1				= json_encode(array("param_1_table" => $postparams_1_tbl,"param_1_code" => $this->input->post('update_'.$view_type.'_code'),"param_1_name" => $this->input->post('update_'.$view_type.'_name'),"param_1_category" => $this->input->post('update_'.$view_type),"param_1_order" => $this->input->post('update_'.$view_type.'_order')));			

			}


			/* echo "<p>error_rcv only : ";
				print_r($error_rcv);
			echo "</p>"; */

			if(!empty($postparams_1_tbl) && !empty($postparams_1) && empty($error_rcv)){


				$postparams_category			= json_encode(array("update_record" => $view_type));
				$response_processed 			= $this->_newmethod($view_type, $postparams_category,$postparams_1,$postparams_2,$postparams_3,$cleaned_img_pic_nw_3);
				$response_processed_cleaned		= json_decode($response_processed);

				//$response_rest_debug			= $this->rest->debug(); //debug rest
				$response['content_new_actv']	= $response_processed_cleaned->result_new;// general result only. no more than 2 join tables

				$response['alisting_update_pic']= ($cleaned_img_pic_nw_3 <> "PIC_UPLOAD_ERROR")? "img_logo_success": $cleaned_img_pic_nw_3;
				$response['alisting_pic_size']	= (!empty($cleaned_upload_pic[0]) && !empty($cleaned_upload_pic[1])) ? $cleaned_upload_pic[0]."x".$cleaned_upload_pic[1] : "";
				$response['alisting_pic_error']	= ($cleaned_img_pic_nw_3 == "PIC_UPLOAD_ERROR") ? $cleaned_img_pic_nw_2 : "";

			}elseif(!empty($error_rcv)){//array("result_new_update" => $result_process_last,"result_prcss" => $prcs_rslt, "result_rows" => $result_process_row, "message" => $message,"template2use" => "", "content_style" => "", "wir" => "", "sql_used" => "")

				$response['content_new_actv']	= json_decode("{\"result_new\":{\"result_new_update\":{\"rtn_rsl\":\"update_record\"},\"result_prcss\":{\"rslt_process_1\":\"failed\",\"rslt_refid_1\":\"\",\"rslt_refno_1\":\"\"},\"result_rows\":\"\",\"message\":\"Missing Info\"}");
				$response['content_error_1']	= $error_rcv;
			}else{
				$response['content_new_actv']	= "noinfo";
				$response['content_error_1']	= "noinfo";
			}

		}elseif($this->input->post('new_record_check_coname') == "confirm"){
			//print_r($_POST); //exit;
			$postparams_1_tbl= "user_co";
			$postparams_1	 = json_encode(array("param_1_table" => $postparams_1_tbl,"param_1_consignee" => $switch_detail_expl_2,"param_1_consignee_co" => $this->input->post('update_'.$view_type.'_co_name'),"param_1_loc_project" => $this->input->post('update_'.$view_type.'_co_prjct')));

			$postparams_category			= json_encode(array("new_record" => $postparams_1_tbl));
			$response_processed 			= $this->_newmethod($postparams_1_tbl, $postparams_category,$postparams_1,$postparams_2,$postparams_3,"");
			$response_processed_cleaned		= json_decode($response_processed);

			//$response_rest_debug			= $this->rest->debug(); //debug rest
			$response['content_new_actv']	= $response_processed_cleaned->result_new;// general result only. no more than 2 join tables

		}elseif($this->input->post('new_record_check_prjct') == "confirm"){
			//print_r($_POST); //exit;
			$postparams_1_tbl= "user_project";
			$postparams_1	 = json_encode(array("param_1_table" => $postparams_1_tbl,"param_1_consignee" => $switch_detail_expl_2,"param_1_loc_project" => $this->input->post('update_'.$view_type.'_prjct_loc')));

			$postparams_category			= json_encode(array("new_record" => $postparams_1_tbl));
			$response_processed 			= $this->_newmethod($postparams_1_tbl, $postparams_category,$postparams_1,$postparams_2,$postparams_3,"");
			$response_processed_cleaned		= json_decode($response_processed);

			//$response_rest_debug			= $this->rest->debug(); //debug rest
			$response['content_new_actv']	= $response_processed_cleaned->result_new;// general result only. no more than 2 join tables

		}else{
			$response['content_new_actv']	= "noinfo";
		}

		//print_r($_POST);

		$search_refno		= ($this->input->post('report_feedback_check') == "confirm") ? $this->input->post('search_refno')	: "ALL";


		if($this->input->post('report_feedback_check') == "confirm"){
			$loc_main	= $this->input->post('loc');
		}
		/* elseif($this->frntlgn_permission == "ALL" && empty($this->input->post('report_feedback_check'))){
			$loc_main	= "ALL";
		}
		elseif($this->frntlgn_permission != "ALL" && empty($this->input->post('report_feedback_check'))){
			$loc_main	= $this->frntlgn_loc;
		} */
		//$loc_main 			= ($this->input->post('report_feedback_check') == "confirm") ? $this->input->post('loc') 			: "ALL";

		$date_start			= ($this->input->post('report_feedback_check') == "confirm") ? $this->input->post('range_start') 	: "ALL";
		$date_end			= ($this->input->post('report_feedback_check') == "confirm") ? $this->input->post('range_end') 		: "ALL";

		//additional params for specific hunting
		$additional_option	= json_encode(array("search_refno" => $search_refno, "loc" => $loc_main, "date_s" => $date_start, "date_e" => $date_end));

		$response_processed 				= $this->_cpumethod($view_type, $view_categ, $view_sub_categ, $view_detail_pgoffset, $this->perpage, $additional_option);
		$response_processed_cleaned			= json_decode($response_processed);
		$template2view_new 					= "all_detail";
		$response['content_layout']			= $response_processed_cleaned->content_style;// general result only. no more than 2 join tables
		$response['content_view_type']		= $view_type;// general result only. no more than 2 join tables
		$response['alisting_paging_refno']	= (!empty($response_processed_cleaned->PagingInfo_1)) ? $response_processed_cleaned->PagingInfo_1 : "";// applicable for paging issue only

		//paging refno session
		$this->session->set_userdata('paging_refno', $response['alisting_paging_refno']);



		// pagination result
		$paging_config['attributes'] 	= array('class' => 'page-link');
		$paging_config['base_url'] 		= base_url($this->uri->segment(1));
		$paging_config['uri_segment'] 	= 2;
		$paging_config['total_rows']	= $response_processed_cleaned->result_rows_1;
		$paging_config['per_page'] 		= $this->perpage;
		$paging_config['num_links']		= $this->numlinks;

		//$paging_config['use_page_numbers']= TRUE;

		$paging_config['full_tag_open'] = '<ul class="pagination float-right nonprint">';

			$paging_config['prev_tag_open'] = '<li class="paginate_button page-item previous" >';
				$paging_config['prev_link'] 	= ' &laquo; ';
			$paging_config['prev_tag_close']= '</li>';

			$paging_config['cur_tag_open'] = '<li class="page-item active"><a href="#" data-dt-idx="'.$this->numlinks.'" tabindex="0" class="page-link">';
			$paging_config['cur_tag_close']= '</a></li>';
			$paging_config['num_tag_open'] = '<li class="page-item 12">';
			$paging_config['num_tag_close']= '</li>';
			$paging_config['first_tag_open'] = '<li class="page-item 89">';
			$paging_config['first_tag_close']= '</li>';
			$paging_config['last_tag_open'] = '<li class="page-item 45">';
			$paging_config['last_tag_close']= '</li>';

			$paging_config['next_tag_open'] = '<li class="page-item ">';
				$paging_config['next_link'] 	= ' &raquo; ';
			$paging_config['next_tag_close']= '</li>';

		$paging_config['full_tag_close']= '</ul>';

		$this->pagination->initialize($paging_config);

		//$response_rest_debug			= $this->rest->debug(); //debug rest
		//echo "<p>sql used : ".$response_processed_cleaned->sql_used."</p>";
		/* echo "<p>response send : ";
			print_r($response_processed_cleaned);
			//print_r($response);
		echo "</p>";  */

		//print_r($_POST);


		/* $response['alisting_fdbk_lvl']		= $this->fdbk_lvl;// response level
		$response['alisting_paging']		= $this->pagination->create_links();// paging only
		$response['alisting_type_1']		= $response_processed_cleaned->result_type_1;// general result only. no more than 2 join tables
		$response['alisting_type_2']		= (!empty($response_processed_cleaned->result_type_2)) ? $response_processed_cleaned->result_type_2 : "";// general result only. no more than 2 join tables
		$response['alisting_type_3']		= (!empty($response_processed_cleaned->result_type_3)) ? $response_processed_cleaned->result_type_3 : "";// general result only. no more than 2 join tables

		$response['alisting_details_1']		= $response_processed_cleaned->result_1;// general result only. no more than 2 join tables
		$response['alisting_details_2']		= (!empty($response_processed_cleaned->result_2)) ? $response_processed_cleaned->result_2 : "";// applicable for detail view & 2nd tab content
		$response['alisting_details_3']		= (!empty($response_processed_cleaned->result_3)) ? $response_processed_cleaned->result_3 : "";// applicable for detail view & 2nd tab content

		$response['alisting_fcateginfo_1']	= (!empty($response_processed_cleaned->FcategInfo_1)) ? $response_processed_cleaned->FcategInfo_1 : "";// applicable for detail view & 2nd tab content
		$response['alisting_fcateginfo_2']	= (!empty($response_processed_cleaned->FcategInfo_2)) ? $response_processed_cleaned->FcategInfo_2 : "";// applicable for detail view & 2nd tab content
		$response['alisting_fcateginfo_3']	= (!empty($response_processed_cleaned->FcategInfo_3)) ? $response_processed_cleaned->FcategInfo_3 : "";// applicable for detail view & 2nd tab content

		$response['alisting_codesinfo_1']	= (!empty($response_processed_cleaned->CodesInfo_1)) ? $response_processed_cleaned->CodesInfo_1 : "";// applicable for detail view & 2nd tab content
		$response['alisting_codesinfo_2']	= (!empty($response_processed_cleaned->CodesInfo_2)) ? $response_processed_cleaned->CodesInfo_2 : "";// applicable for detail view & 2nd tab content
		$response['alisting_codesinfo_3']	= (!empty($response_processed_cleaned->CodesInfo_3)) ? $response_processed_cleaned->CodesInfo_3 : "";// applicable for detail view & 2nd tab content

		$response['alisting_extrainfo_1']	= (!empty($response_processed_cleaned->ExtraInfo_1)) ? $response_processed_cleaned->ExtraInfo_1 : "";// applicable for detail view & 2nd tab content
		$response['alisting_extrainfo_2']	= (!empty($response_processed_cleaned->ExtraInfo_2)) ? $response_processed_cleaned->ExtraInfo_2 : "";// applicable for detail view & 2nd tab content
		$response['alisting_extrainfo_3']	= (!empty($response_processed_cleaned->ExtraInfo_3)) ? $response_processed_cleaned->ExtraInfo_3 : "";// applicable for detail view & 2nd tab content

		$response['alisting_message_1']		= $response_processed_cleaned->message_1;// general result only. no more than 2 join tables
		$response['alisting_message_2']		= (!empty($response_processed_cleaned->message_2)) ? $response_processed_cleaned->message_2 : "";// applicable for detail view & 2nd tab content
		$response['alisting_message_3']		= (!empty($response_processed_cleaned->message_3)) ? $response_processed_cleaned->message_3 : "";// applicable for detail view & 2nd tab content

		$response['alisting_ver_1']			= $response_processed_cleaned->result_ver_1;// general result only. no more than 2 join tables
		$response['alisting_ver_2']			= (!empty($response_processed_cleaned->result_ver_2)) ? $response_processed_cleaned->result_ver_2 : "";// applicable for detail view & 2nd tab content
		$response['alisting_ver_3']			= (!empty($response_processed_cleaned->result_ver_3)) ? $response_processed_cleaned->result_ver_3 : "";// applicable for detail view & 2nd tab content

		$response['alisting_rows_1']		= $response_processed_cleaned->result_rows_1;// general result only. no more than 2 join tables
		$response['alisting_rows_2']		= (!empty($response_processed_cleaned->result_rows_2)) ? $response_processed_cleaned->result_rows_2 : "";// applicable for detail view & 2nd tab content
		$response['alisting_rows_3']		= (!empty($response_processed_cleaned->result_rows_3)) ? $response_processed_cleaned->result_rows_3 : "";// applicable for detail view & 2nd tab content

		$response['alisting_det_loc_1']		= (!empty($response_processed_loc_cleaned->result_1)) 	? $response_processed_loc_cleaned->result_1 	: "";// loc result only. 

		$response['alisting_date_se_1']		= (!empty($response_processed_cleaned->Date_S_E_1))	? $response_processed_cleaned->Date_S_E_1	: "";// date range result only. 
		$response['alisting_loc_ms_1']		= (!empty($response_processed_cleaned->Loc_M_S_1)) 	? $response_processed_cleaned->Loc_M_S_1 	: "";// loc name result only.  */

		//admin to change info of the details
		/* $response['alisting_adm_type']		= $this->frntlgn_usrtype;
		$response['alisting_adm_id']		= $this->frntlgn_uid;
		$response['alisting_adm_refno']		= $this->frntlgn_refno;
		$response['alisting_adm_dept']		= $this->frntlgn_dept;
		$response['alisting_adm_code']		= $this->frntlgn_code;
		$response['alisting_adm_permission']= $this->frntlgn_permission; */

		$this->load->view($template2view_new, $response);

	}

	
	
	
	//function work correctly (checked & fixed on 04112018)
	public function search_auto($view_type, $view_categ, $view_sub_categ){
		//echo "<p>search_auto : $view_type, $view_categ, $view_sub_categ</p>";
		$query						= $this->input->get('term');
		$response_processed 		= $this->_searchrslt($view_type, $view_categ, $view_sub_categ, $query, "consignee");
		$response_processed_cleaned	= json_decode($response_processed);
		echo json_encode($response_processed_cleaned->result_found);
		//$response_rest_debug			= $this->rest->debug(); //debug rest
	}


	//function work correctly (checked & fixed on 04112018)
	public function search_auto_2($view_type, $view_categ, $view_sub_categ){
		//echo "<p>search_auto : $view_type, $view_categ, $view_sub_categ</p>";
		$query						= $this->input->get('term');
		$query_id					= $this->input->get('sgeid');
		$response_processed 		= $this->_searchrslt_2($view_type, $view_categ, $view_sub_categ, $query, $query_id, "c_o");
		$response_processed_cleaned	= json_decode($response_processed);
		echo json_encode($response_processed_cleaned->result_found);
		//$response_rest_debug			= $this->rest->debug(); //debug rest
	}


	//function work correctly (checked & fixed on 04112018)
	public function search_auto_3($view_type, $view_categ, $view_sub_categ){
		//echo "<p>search_auto : $view_type, $view_categ, $view_sub_categ</p>";
		$query						= $this->input->get('term');
		$query_id					= $this->input->get('sgeid');
		$query_id_2					= $this->input->get('cosgeid');
		$response_processed 		= $this->_searchrslt_3($view_type, $view_categ, $view_sub_categ, $query, $query_id, $query_id_2, "project");
		$response_processed_cleaned	= json_decode($response_processed);
		echo json_encode($response_processed_cleaned->result_found);
		//$response_rest_debug			= $this->rest->debug(); //debug rest
	}


	/**** private function sending & receiving for all listing only ****/
	private function _cpumethod_limited($switch_type, $switch_categ, $switch_categ_sub, $view_detail_pgoffset, $view_pglimit){
		echo "<p>_cpumethod_limited wir2 : $switch_type,$switch_categ,$switch_categ_sub,$view_detail_pgoffset, $view_pglimit</p>";
		$switch_detail_expl	= explode("_",$view_detail_pgoffset);
		$swtichsel	= "paging";		$switchdet = $view_detail_pgoffset;		$switchpglimit = $view_pglimit;

		//echo "<p>_cpumethod_limited 4srv : $switch_type,$switch_categ,$switch_categ_sub, $switchdet, $switchpglimit, $swtichsel</p>";
		//return $this->rest->post('everytng_limited', array('major_type' => $switch_type, 'major_categ' => $switch_categ, 'sub_categ' => $switch_categ_sub, 'dtl' => $switchdet, 'pg_limit' => $switchpglimit, 'pg_sel' => $swtichsel, 'adm_uid' => $this->frntlgn_uid, 'adm_type' => $this->frntlgn_usrtype, 'adm_dept' => $this->frntlgn_dept, 'adm_code' => $this->frntlgn_code, 'adm_permission' => $this->frntlgn_permission, 'adm_loc' => $this->frntlgn_loc));
	}



	/**** private function sending & receiving for all listing only ****/
	private function _cpumethod($switch_type, $switch_categ, $switch_categ_sub, $view_detail_pgoffset, $view_pglimit, $view_additional_option){
		echo "<p>wir2 : $switch_type,$switch_categ,$switch_categ_sub,$view_detail_pgoffset, $view_pglimit, $view_additional_option</p>";
		/* echo "<p>paging session  : ";
		print_r($this->session->userdata['paging_refno']);
		echo "</p>"; */
		//exit;
		
		$switch_detail_expl	= explode("_",$view_detail_pgoffset);
		if($switch_detail_expl[0] == "idd"){
			$swtichsel	= "detail";		$switchdet	= $switch_detail_expl[1];		$switchpglimit	= "";
		}else{
			$swtichsel	= "paging";		$switchdet	= $view_detail_pgoffset;		$switchpglimit	= $view_pglimit;
		}

		//echo "<p>_cpumethod 4srv : $switch_type,$switch_categ,$switch_categ_sub, $switchdet, $switchpglimit, $swtichsel</p>";
		//return $this->rest->post('everytng', array('major_type' => $switch_type, 'major_categ' => $switch_categ, 'sub_categ' => $switch_categ_sub, 'dtl_additional' => $view_additional_option, 'dtl' => $switchdet, 'pg_limit' => $switchpglimit, 'pg_sel' => $swtichsel, 'adm_uid' => $this->frntlgn_uid, 'adm_type' => $this->frntlgn_usrtype, 'adm_dept' => $this->frntlgn_dept, 'adm_code' => $this->frntlgn_code, 'adm_permission' => $this->frntlgn_permission, 'adm_compid' => $this->frntlgn_compid, 'adm_sess_id' => $this->frntlgn_sess_id, 'paging_refno' => $this->session->userdata['paging_refno']));
	}



	/**** private function sending & receiving for autocompelte consignor & consignee only ****/
	private function _searchrslt($switch_type, $switch_categ, $switch_categ_sub, $switch_search, $switch_search_type){
		//echo "<p>wir2 : $switch_type, $switch_categ, $switch_categ_sub, $switch_search</p>";
		//return $this->rest->get('everytng_3', array('major_type' => $switch_type, 'major_categ' => $switch_categ, 'sub_categ' => $switch_categ_sub, 'question' => $switch_search, 'question_type' => $switch_search_type, 'adm_uid' => $this->frntlgn_uid, 'adm_type' => $this->frntlgn_usrtype, 'adm_dept' => $this->frntlgn_dept, 'adm_permission' => $this->frntlgn_permission, 'adm_code' => $this->frntlgn_code, 'adm_sess_id' => $this->frntlgn_sess_id, 'adm_ipadd' => $this->input->ip_address()));
	}



	/**** private function sending & receiving for autocompelte consignor & consignee only ****/
	private function _searchrslt_2($switch_type, $switch_categ, $switch_categ_sub, $switch_search, $switch_search_id, $switch_search_type){
		//echo "<p>wir2 : $switch_type, $switch_categ, $switch_categ_sub, $switch_search</p>";
		//return $this->rest->get('everytng_4', array('major_type' => $switch_type, 'major_categ' => $switch_categ, 'sub_categ' => $switch_categ_sub, 'question' => $switch_search, 'question_client_id' => $switch_search_id, 'question_type' => $switch_search_type, 'adm_uid' => $this->frntlgn_uid, 'adm_type' => $this->frntlgn_usrtype, 'adm_dept' => $this->frntlgn_dept, 'adm_permission' => $this->frntlgn_permission, 'adm_code' => $this->frntlgn_code, 'adm_sess_id' => $this->frntlgn_sess_id, 'adm_ipadd' => $this->input->ip_address()));
	}



	/**** private function sending & receiving for autocompelte consignor & consignee only ****/
	private function _searchrslt_3($switch_type, $switch_categ, $switch_categ_sub, $switch_search, $switch_search_id, $switch_search_id_2, $switch_search_type){
		//echo "<p>wir2 : $switch_type, $switch_categ, $switch_categ_sub, $switch_search</p>";
		//return $this->rest->get('everytng_5', array('major_type' => $switch_type, 'major_categ' => $switch_categ, 'sub_categ' => $switch_categ_sub, 'question' => $switch_search, 'question_client_id' => $switch_search_id, 'question_co_id' => $switch_search_id_2, 'question_type' => $switch_search_type, 'adm_uid' => $this->frntlgn_uid, 'adm_type' => $this->frntlgn_usrtype, 'adm_dept' => $this->frntlgn_dept, 'adm_permission' => $this->frntlgn_permission, 'adm_code' => $this->frntlgn_code, 'adm_sess_id' => $this->frntlgn_sess_id, 'adm_ipadd' => $this->input->ip_address()));
	}


}
?>
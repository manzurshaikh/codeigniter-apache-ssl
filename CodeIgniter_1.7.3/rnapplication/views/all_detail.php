<?php $this->load->view('all_header');?>

<?php $this->load->view('all_nav_top');?>

<div class="container-fluid">
  <div class="row">

	<?php $this->load->view('all_nav_left');?>

	<main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
	
		
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2">Checking Info</h1>
			<div class="btn-toolbar mb-2 mb-md-0">
			  <!-- <div class="btn-group mr-2">
				<button class="btn btn-sm btn-outline-secondary">Share</button>
				<button class="btn btn-sm btn-outline-secondary">Export</button>
			  </div>
			  <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
				This week
			  </button>-->
			</div> 
		</div>


		<div class="col-md-8 order-md-1">
          <!-- <h4 class="mb-3">Checking Info</h4> -->
		  
		  <?php 			
			if ($this->session->flashdata('errors')){
				echo '<div class="alert alert-danger">';
					echo $this->session->flashdata('errors');
				echo "</div>";
			}
			
			$data_btn_submit = array('name' => 'btn_submit','id' => 'btn_submit','value' => 'true','type' => 'submit','content' => 'Check Now','class' => 'btn btn-primary btn-block');
			$hidden 	 = array('report_check' => 'confirm');
			$form_idname = "report_activity";

			echo form_open('', 'class="form-horizontal needs-validation" id="'.$form_idname.'" name="'.$form_idname.'" novalidate=""', $hidden);
		  ?>

            <div class="mb-3">
              <label for="kp_username">Username <span class="text-danger">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" id="kp_username" name="kp_username" placeholder="Username" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="kp_email">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" id="kp_email" id="kp_email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="kp_mobile">Mobile No <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="kp_mobile" name="kp_mobile" placeholder="60123456789">
              <div class="invalid-feedback">
                Please enter Mobile No.
              </div>
            </div>
			
            <hr class="mb-4">

		  <?php
			echo form_button($data_btn_submit);
		  ?>
			<?php echo form_close(); ?>
			
        </div>
		
		
		
		<div class="container py-2">

			
			<!-- timeline item 1 -->
			<div class="row">
				<!-- timeline item 1 left dot -->
				<div class="col-auto text-center flex-column d-none d-sm-flex">
					<div class="row h-50">
						<div class="col">&nbsp;</div>
						<div class="col">&nbsp;</div>
					</div>
					<h5 class="m-2">
						<span class="badge badge-pill bg-light border">&nbsp;</span>
					</h5>
					<div class="row h-50">
						<div class="col border-right">&nbsp;</div>
						<div class="col">&nbsp;</div>
					</div>
				</div>
				<!-- timeline item 1 event content -->
				<div class="col py-2">
					<div class="card">
						<div class="card-body">

							<?php 	$kpm_info = "";		$kpm_hr = "";		$kpm_info_createdon = "";
									if(!empty($response_1) & $response_1 <> "empty_list"){

										$kpm_info .= "<div class='bd-example'>";
										
											$kpm_info .= "<div class='table-responsive'>";
											
											$kpm_info .= "<table class='table'>";
												$kpm_info .= " <thead class='thead-dark'>";
													$kpm_info .= " <tr>";
														$kpm_info .= " <th scope='col'>#</th>";
														$kpm_info .= " <th scope='col'>Kiple ID /<br> Wallet ID (Id)</th>";
														$kpm_info .= " <th scope='col'>Full Name</th>";
														$kpm_info .= " <th scope='col'>User Name</th>";
														$kpm_info .= " <th scope='col'>Email</th>";
														$kpm_info .= " <th scope='col'>Mobile</th>";
														$kpm_info .= " <th scope='col'>User_ID</th>";
													$kpm_info .= " </tr>";
												$kpm_info .= " </thead>";
												$kpm_info .= " <tbody>";
											
												for($cnt_r1=0;$cnt_r1 < $response_1_nr;$cnt_r1++){

														$kpm_info .= " <tr>";
															$kpm_info .= " <td scope='col'>#</td>";
															$kpm_info .= " <td>".$response_1[$cnt_r1]->Id."</td>";
															$kpm_info .= " <td scope='col'>".$response_1[$cnt_r1]->FullName."</td>";
															$kpm_info .= " <td scope='col'>".$response_1[$cnt_r1]->UserName." (".$response_1[$cnt_r1]->Status.")</td>";
															$kpm_info .= " <td scope='col'>".$response_1[$cnt_r1]->Email."</td>";
															$kpm_info .= " <td scope='col'>".$response_1[$cnt_r1]->PhoneNumber." (".$response_1[$cnt_r1]->PhoneNumberVerified.")</td>";
															$kpm_info .= " <td scope='col'>".$response_1[$cnt_r1]->user_id."</td>";
														$kpm_info .= " </tr>";
													
														$kpm_info .= " <tr style='border-bottom: 3px solid #ff0000; '>";
															$kpm_info .= " <td colspan='7'>";
																$kpm_info_createdon = $response_1[$cnt_r1]->CreatedAt;
															
																$kpm_info .= "<div class='bd-callout bd-callout-warning m-t-20'>";
																
																if(!empty($response_2) & $response_2 <> "empty_list"){

																	$kpm_info .= "<h5 id='jquery-incompatibility'>Kiple Profile";
																		$kpm_info .= " <small>Wallet ID (Id : ".$response_2[$cnt_r1]->Id.") & user_id : ".$response_2[$cnt_r1]->user_id."</small> ";
																	$kpm_info .= "</h5>";

																	$kpm_info .= "<div class='row'>";
																		$kpm_info .= "<div class='col-md-3 col-3'>";
																			$kpm_info .= "Full Name<br>";
																			$kpm_info .= "<strong>".$response_2[$cnt_r1]->FullName." (".$response_2[$cnt_r1]->CreatedAt.")</strong>";
																		$kpm_info .= "</div>";
																				
																		$kpm_info .= "<div class='col-md-3 col-3'>";
																			$kpm_info .= "User Name<br>";
																			$kpm_info .= "<strong>".$response_2[$cnt_r1]->UserName." (".$response_2[$cnt_r1]->Status.")</strong>";
																		$kpm_info .= "</div>";
																				
																		$kpm_info .= "<div class='col-md-3 col-3'>";
																			$kpm_info .= "Email<br>";
																			$kpm_info .= "<strong>".$response_2[$cnt_r1]->Email."</strong>";
																		$kpm_info .= "</div>";
																				
																		$kpm_info .= "<div class='col-md-3 col-3'>";
																			$kpm_info .= "Mobile<br>";
																			$kpm_info .= "<strong>".$response_2[$cnt_r1]->PhoneNumber."</strong>";
																		$kpm_info .= "</div>";

																	$kpm_info .= "</div>";

																}else{
																	$kpm_info .= "<span class='text-danger'>User Profile Not Exist</span>";
																}

																$kpm_info .= "</div>";	


															$kpm_info .= " </td>";
														$kpm_info .= " </tr>";
													
													
													//$kpm_info .= "<hr class='p-b-20' />";

												}
											
												$kpm_info .= " </tbody>";
											$kpm_info .= " </table>";
											
											$kpm_info .= "</div>";
										$kpm_info .= "</div>";

									}else{
										$kpm_info .= "<span class='text-danger'>User Not Exist</span>";
									}

							?>
						
							<div class="float-right text-muted"><?php echo $kpm_info_createdon; ?></div>
							<h4 class="card-title text-muted">1. Kiple Member Info - (Total Rec : <?php echo $response_1_nr; ?>)</h4>
							<p class="card-text">
								<?php echo $kpm_info;	?>
							</p>
						</div><!--/.card-body closing-->
					</div><!--/.card closing-->
				</div><!--/.col py-2 closing-->
			</div>
			<!--/row-->
			
			
			<!-- timeline item 2 -->
			<div class="row">
				<div class="col-auto text-center flex-column d-none d-sm-flex">
					<div class="row h-50">
						<div class="col border-right">&nbsp;</div>
						<div class="col">&nbsp;</div>
					</div>
					<h5 class="m-2">
						<span class="badge badge-pill bg-success">&nbsp;</span>
					</h5>
					<div class="row h-50">
						<div class="col border-right">&nbsp;</div>
						<div class="col">&nbsp;</div>
					</div>
				</div>
				<div class="col py-2">
					<div class="card border-success shadow">
						<div class="card-body">
						
							<?php 	$kpw_info = "";		$kpw_info_createdon = "";		$kpw_wlt_bal = 0;

									if(!empty($response_3) & $response_3 <> "empty_list"){

										for($cnt_r3=0;$cnt_r3 < $response_3_nr;$cnt_r3++){
										//foreach ($response_3 as $item_3) { 

											$kpw_info .= "<div class='bd-example'>";
											
												$kpw_info .= "<div class='row'>";
													$kpw_info .= "<div class='col-md-8 col-8'>";

														$kpw_info .= "<dl>";
															$kpw_info .= "<dt>Kiple Wallet ID (Id)</dt>";
															$kpw_info .= "<dd>".$response_3[$cnt_r3]->Id."</dd>";
															$kpw_info .= "<dt>Full Name</dt>";
															$kpw_info .= "<dd>".$response_3[$cnt_r3]->FullName."</dd>";
															$kpw_info .= "<dt>User Name</dt>";
															$kpw_info .= "<dd>".$response_3[$cnt_r3]->WebCashId."</dd>";
															$kpw_info .= "<dt>User_ID</dt>";
															$kpw_info .= "<dd>".$response_3[$cnt_r3]->user_id."</dd>";
														$kpw_info .= "</dl>";
													
													$kpw_info .= "</div>";
												
													$kpw_info .= "<div class='col-md-4 col-4'>";

														$kpw_info .= "<h3>"; 
															$kpw_info .= "Storecard Bal : ";
															//$kpw_info .= "<br>";
															$kpw_info .= $response_3_strcd[$cnt_r3]->Balance." (".$response_3_strcd[$cnt_r3]->Status.")";
															$kpw_info .= "<br>";
															$kpw_info .= "<small>Modified on : ";
															$kpw_info .= $response_3_strcd[$cnt_r3]->ModifiedAt;
															$kpw_info .= "</small>";
														$kpw_info .= "</h3>";
														
														//print_r($response_3_strcd[$cnt_r3]);
														
														//stdClass Object ( [WalletId] => 35ab090c-b5e0-47bd-9d09-c3ee7a10bde3 [MerchantId] => 1837 [Balance] => 200 [CreatedAt] => 2018-11-28 18:41:51.510197 [CreatedBy] => [ExpireAt] => 2019-06-12 12:30:00.686134 [ModifiedAt] => 2018-12-14 12:30:00.686136 [ModifiedBy] => [Status] => 0 [user_id] => ) 
													
													$kpw_info .= "</div>";
												
												$kpw_info .= "</div>";//.row closing


												$kpw_info_createdon = $response_3[$cnt_r3]->CreatedAt;
												
												$kpw_info .= "<div class='bd-callout bd-callout-warning m-t-20'>";
												
													if(!empty($response_4) & $response_4 <> "empty_list"){
												
														$kpw_info .= "<h5 id='jquery-incompatibility'>Kiple Wallet History</h5>";

														$kpw_info .= "<div class='table-responsive'>";

															$kpw_info .= "<table class='table'>";
																$kpw_info .= " <thead class='thead-dark'>";
																	$kpw_info .= " <tr>";
																		$kpw_info .= " <th scope='col'>#</th>";
																		$kpw_info .= " <th scope='col'>Kiple Wallet /<br> History ID (Id)</th>";
																		$kpw_info .= " <th scope='col'>Date</th>";
																		$kpw_info .= " <th scope='col'>Action</th>";
																		$kpw_info .= " <th scope='col'>Webcash Trans <br>ID (Ref No)</th>";
																		$kpw_info .= " <th scope='col'>Amount</th>";
																		$kpw_info .= " <th scope='col'>Balance</th>";
																	$kpw_info .= " </tr>";
																$kpw_info .= " </thead>";
																$kpw_info .= " <tbody>";

																foreach ($response_4 as $item_4){

																	$kpw_info .= " <tr>";
																		$kpw_info .= " <td scope='col'>#</td>";
																		$kpw_info .= " <td>".$item_4->Id." (".$item_4->Status.")</td>";
																		$kpw_info .= " <td>".$item_4->CreatedAt."</td>";
																		$kpw_info .= " <td>".$item_4->action_desc." (".$item_4->Action.")</td>";
																		$kpw_info .= " <td>".$item_4->WebCashTransactionId." (".$item_4->WebCashTransactionRefNo.")</td>";
																		$kpw_info .= " <td>".$item_4->Amount." (Cash : ".$item_4->Cash.")</td>";
																		$kpw_info .= " <td>";
																		
																			if(!empty($item_4->WebCashTransactionId) && !empty($item_4->WebCashTransactionRefNo)){
																				$kpw_wlt_bal += $item_4->Cash;
																			}elseif($item_4->Action == 19){
																				$kpw_wlt_bal = $kpw_wlt_bal + $item_4->Amount;
																			}elseif($item_4->Action == 25){
																				$kpw_wlt_bal = $kpw_wlt_bal - $item_4->Amount;
																			}
																			
																			$kpw_info .= "<strong>".$kpw_wlt_bal."</strong>";
																			
																		$kpw_info .= "</td>";
																	$kpw_info .= " </tr>";

																	//$kpw_info .= "<hr class='m-b-20' />";

																}

																$kpw_info .= " </tbody>";
															$kpw_info .= " </table>";

														$kpw_info .= "</div>";	// . table-responsive closing

													}else{
														$kpw_info .= "<span class='text-danger'>Kiple Wallet History Not Exist</span>";
													}

												$kpw_info .= "</div>";	 //.bd-callout bd-callout-warning m-t-20 closing

											$kpw_info .= "</div>"; //.bd-example closing

											$kpw_info .= "<hr class='m-b-20' />";

										}

									}else{
										$kpw_info .= "<span class='text-danger'>Kiple Wallet Not Exist</span>";
									}

							?>
							
							
							<div class="float-right text-success"><?php echo $kpw_info_createdon; ?></div>
							<h4 class="card-title text-success">2. Kiple Wallet Info - (Total Rec : <?php echo $response_3_nr; ?>)</h4>
							<p class="card-text">
								<?php echo $kpw_info;	?>
							</p>
							<?php /* <button class="btn btn-sm btn-outline-secondary" type="button" data-target="#t2_details" data-toggle="collapse">Show Details ▼</button>
							<div class="collapse border" id="t2_details">
								<div class="p-2 text-monospace">
									<div>08:30 - 09:00 Breakfast in CR 2A</div>
									<div>09:00 - 10:30 Live sessions in CR 3</div>
									<div>10:30 - 10:45 Break</div>
									<div>10:45 - 12:00 Live sessions in CR 3</div>
								</div>
							</div> */ ?>
						</div><!--/ .card-body closing-->
					</div>
				</div><!--/ .col py-2 closing-->
			</div>
			<!--/row-->
			
			
			<!-- timeline item 3 -->
			<div class="row">
				<div class="col-auto text-center flex-column d-none d-sm-flex">
					<div class="row h-50">
						<div class="col border-right">&nbsp;</div>
						<div class="col">&nbsp;</div>
					</div>
					<h5 class="m-2">
						<span class="badge badge-pill bg-info">&nbsp;</span>
					</h5>
					<div class="row h-50">
						<div class="col border-right">&nbsp;</div>
						<div class="col">&nbsp;</div>
					</div>
				</div>
				<div class="col py-2">
					<div class="card border-info shadow"> 
						<div class="card-body">
							
							<?php 	$wcw_info = "";		$wcw_info_createdon = "";		$wcw_wlt_bal = 0;

									if(!empty($response_5) & $response_5 <> "empty_list"){
//print_r($response_5_nr);
										for($cnt_r5=0;$cnt_r5 < $response_5_nr;$cnt_r5++){

											$wcw_info .= "<div class='bd-example'>";

												$wcw_info .= "<div class='row'>";
													$wcw_info .= "<div class='col-md-8 col-8'>";

														$wcw_info .= "<dl>";
															$wcw_info .= "<dt>Webcash ID</dt>";
															$wcw_info .= "<dd>".$response_5[$cnt_r5]->member_id."</dd>";
															$wcw_info .= "<dt>User ID</dt>";
															$wcw_info .= "<dd>".$response_5[$cnt_r5]->user_id."</dd>";
														$wcw_info .= "</dl>";

													$wcw_info .= "</div>";
													
													$wcw_info .= "<div class='col-md-4 col-4'>";

														$wcw_info .= "<h3>"; 
															//$wcw_info .= "Point Bal : ".$response_5[$cnt_r5]->point_balance;
															//$wcw_info .= "<br>";
															$wcw_info .= "Cash Bal : ".$response_5[$cnt_r5]->cash_balance;
														$wcw_info .= "</h3>";

													$wcw_info .= "</div>";

												$wcw_info .= "</div>";//.row closing

												$wcw_info .= "<div class='bd-callout bd-callout-warning m-t-20'>";
												
													if(!empty($response_6) & $response_6 <> "empty_list"){
												
														$wcw_info .= "<h5 id='jquery-incompatibility'>Webcash Wallet History</h5>";
														
														
														$wcw_info .= "<div class='table-responsive'>";
											
															$wcw_info .= "<table class='table'>";
																$wcw_info .= " <thead class='thead-dark'>";
																	$wcw_info .= " <tr>";
																		$wcw_info .= " <th scope='col'>#</th>";
																		//$wcw_info .= " <th scope='col'>User Info</th>";
																		$wcw_info .= " <th scope='col'>Date</th>";
																		$wcw_info .= " <th scope='col'>Trans ID</th>";
																		$wcw_info .= " <th scope='col'>Topup UserID</th>";
																		$wcw_info .= " <th scope='col'>Bank Code</th>";
																		$wcw_info .= " <th scope='col'>Amount<br>(Status)</th>";
																		$wcw_info .= " <th scope='col'>Bal</th>";
																		$wcw_info .= " <th scope='col'>Merchant Ref<br>Predata<br>Postdata</th>";
																	$wcw_info .= " </tr>";
																$wcw_info .= " </thead>";
																$wcw_info .= " <tbody>";

																foreach ($response_6 as $item_6){

																	$wcw_info .= " <tr>";
																		$wcw_info .= " <td scope='col'>#</td>";
																		/* $wcw_info .= " <td>";
																			$wcw_info .= $item_6->form_name."<br>";
																			$wcw_info .= $item_6->form_mobile."<br>";
																			$wcw_info .= $item_6->form_email;
																		$wcw_info .= "</td>"; */
																		$wcw_info .= " <td>".str_replace(" ","<br>",$item_6->date)."</td>";
																		$wcw_info .= " <td>".$item_6->transaction_id."</td>";
																		$wcw_info .= " <td>".$item_6->gateway_topup_user_id."</td>";
																		$wcw_info .= " <td>".$item_6->bank_code."</td>";
																		$wcw_info .= " <td>".$item_6->amount."<br>(".$item_6->status.")</td>";
																		$wcw_info .= " <td>";

																			if($item_6->bank_code == "WEBCASH"){
																				$wcw_wlt_bal += $item_6->amount;
																			}

																			$wcw_info .= "<strong>".$wcw_wlt_bal."</strong>";
																		$wcw_info .= "</td>";

																		$wcw_info .= " <td>";
																			$wcw_info .= " <div style='width: 200px; '>";
																				$wcw_info .= " <p>".$item_6->merchant_reference."</p>";
																				$wcw_info .= " <p class='border border-info p-2'>".$item_6->pre_data."</p>";
																				$wcw_info .= " <p>".$item_6->post_data."</p>";
																			$wcw_info .= "</div>";
																		$wcw_info .= "</td>";
																	$wcw_info .= " </tr>";

																}

																$wcw_info .= " </tbody>";
															$wcw_info .= " </table>";

														$wcw_info .= "</div>";	// . table-responsive closing


													}else{
														$wcw_info .= "<span class='text-danger'>Webcash Wallet History Not Exist</span>";
													}

												$wcw_info .= "</div>";	// .bd-callout bd-callout-warning m-t-20 closing

											$wcw_info .= "</div>"; // .bd-example closing

											$wcw_info .= "<hr class='m-b-20' />";

										}

									}else{
										$wcw_info .= "<span class='text-danger'>Webcash Wallet Not Exist</span>";
									}

							?>
							
							<div class="float-right text-muted">Wed, Jan 11th 2019 8:30 AM</div>
							<h4 class="card-title">3. Webcash Wallet Info - (Total Rec : <?php echo $response_5_nr; ?>)</h4>
							<p>
								<?php echo $wcw_info;	?>
							</p>
						</div><!--/.card-body closing-->
					</div><!--/.card border-info shadow closing-->
				</div><!--/.col py-2 closing-->
			</div>
			<!--/row-->
			
			
			<!-- timeline item 4 -->
			<div class="row">
				<div class="col-auto text-center flex-column d-none d-sm-flex">
					<div class="row h-50">
						<div class="col border-right">&nbsp;</div>
						<div class="col">&nbsp;</div>
					</div>
					<h5 class="m-2">
						<span class="badge badge-pill bg-light border">&nbsp;</span>
					</h5>
					<div class="row h-50">
						<div class="col">&nbsp;</div>
						<div class="col">&nbsp;</div>
					</div>
				</div>
				<div class="col py-2">
					<div class="card">
						<div class="card-body">
						
							<?php 	$zpgw_info = "";		$zpgw_info_createdon = "";		$wcw_wlt_bal = "";

									if(!empty($response_7) & $response_7 <> "empty_list"){
print_r($response_7);
										for($cnt_r7=0;$cnt_r7 < $response_7_nr;$cnt_r7++){

											$zpgw_info .= "<div class='bd-example'>";

												$zpgw_info .= "<div class='row'>";
													$zpgw_info .= "<div class='col-md-8 col-8'>";

														$zpgw_info .= "<dl>";
															$zpgw_info .= "<dt>Webcash ID</dt>";
															//$zpgw_info .= "<dd>".$response_7[$cnt_r7]->member_id."</dd>";
															$zpgw_info .= "<dt>User ID</dt>";
															//$zpgw_info .= "<dd>".$response_7[$cnt_r7]->user_id."</dd>";
														$zpgw_info .= "</dl>";

													$zpgw_info .= "</div>";
													
													$zpgw_info .= "<div class='col-md-4 col-4'>";

														$zpgw_info .= "<h3>"; 
															//$zpgw_info .= "Point Bal : ".$response_7[$cnt_r7]->point_balance;
															$zpgw_info .= "<br>";
															//$zpgw_info .= "Cash Bal : ".$response_7[$cnt_r7]->cash_balance;
														$zpgw_info .= "</h3>";

													$zpgw_info .= "</div>";

												$zpgw_info .= "</div>";//.row closing

												$zpgw_info .= "<div class='bd-callout bd-callout-warning m-t-20'>";
												
													if(!empty($response_7_2) & $response_7_2 <> "empty_list"){
												
														$zpgw_info .= "<h5 id='jquery-incompatibility'>Webcash Wallet History</h5>";
														
														
														$zpgw_info .= "<div class='table-responsive'>";
											
															$zpgw_info .= "<table class='table'>";
																$zpgw_info .= " <thead class='thead-dark'>";
																	$zpgw_info .= " <tr>";
																		$zpgw_info .= " <th scope='col'>#</th>";
																		$zpgw_info .= " <th scope='col'>User Info</th>";
																		$zpgw_info .= " <th scope='col'>Date</th>";
																		$zpgw_info .= " <th scope='col'>Trans ID</th>";
																		$zpgw_info .= " <th scope='col'>Topup UserID</th>";
																		$zpgw_info .= " <th scope='col'>Merchant Ref<br>Predata<br>Postdata</th>";
																		$zpgw_info .= " <th scope='col'>Bank Code</th>";
																		$zpgw_info .= " <th scope='col'>Amount (Status)</th>";
																		$zpgw_info .= " <th scope='col'>Bal</th>";
																	$zpgw_info .= " </tr>";
																$zpgw_info .= " </thead>";
																$zpgw_info .= " <tbody>";

																foreach ($response_7_2 as $item_7_2){

																	/* $zpgw_info .= " <tr>";
																		$zpgw_info .= " <td scope='col'>#</td>";
																		$zpgw_info .= " <td>";
																			$zpgw_info .= $item_7_2->form_name."<br>";
																			$zpgw_info .= $item_7_2->form_mobile."<br>";
																			$zpgw_info .= $item_7_2->form_email;
																		$zpgw_info .= "</td>";
																		$zpgw_info .= " <td>".$item_7_2->date."</td>";
																		$zpgw_info .= " <td>".$item_7_2->transaction_id."</td>";
																		$zpgw_info .= " <td>".$item_7_2->gateway_topup_user_id."</td>";
																		$zpgw_info .= " <td>";
																		$zpgw_info .= " <p>".$item_7_2->merchant_reference."</p>";
																		$zpgw_info .= " <p class='border-info'>".$item_7_2->pre_data."</p>";
																		$zpgw_info .= " <p>".$item_7_2->post_data."</p>";
																		$zpgw_info .= "</td>";
																		$zpgw_info .= " <td>".$item_7_2->bank_code."</td>";
																		$zpgw_info .= " <td>".$item_7_2->amount." (".$item_7_2->status.")</td>";
																		$zpgw_info .= " <td>";
																		
																			if($item_7_2->bank_code == "WEBCASH"){
																				$wcw_wlt_bal += $item_7_2->amount;
																			}

																			$zpgw_info .= $wcw_wlt_bal;
																		$zpgw_info .= "</td>";
																			
																	$zpgw_info .= " </tr>"; */

																}

																$zpgw_info .= " </tbody>";
															$zpgw_info .= " </table>";

														$zpgw_info .= "</div>";	// . table-responsive closing


													}else{
														$zpgw_info .= "<span class='text-danger'>Webcash Wallet History Not Exist</span>";
													}

												$zpgw_info .= "</div>";	// .bd-callout bd-callout-warning m-t-20 closing

											$zpgw_info .= "</div>"; // .bd-example closing

											$zpgw_info .= "<hr class='m-b-20' />";

										}

									}else{
										$zpgw_info .= "<span class='text-danger'>Webcash Wallet Not Exist</span>";
									}

							?>
						
							<div class="float-right text-muted">Thu, Jan 12th 2019 11:30 AM</div>
							<h4 class="card-title">4. ZAP Gateway (CC) - (Total Rec : <?php echo $response_7_nr; ?>)</h4>
							<p>
								<?php echo $zpgw_info;	?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!--/row-->
		</div>
		<!--container-->

	</main>
  </div>
</div>


<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds.</p>

<?php $this->load->view('all_footer');?>
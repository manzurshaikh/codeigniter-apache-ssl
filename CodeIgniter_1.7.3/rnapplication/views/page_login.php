<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url("images/favicon.ico"); ?>">

    <title>Signin Kiple Backend</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url("css/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url("css/signin.css"); ?>" rel="stylesheet">
  </head>

  <body class="text-center">
  
	 <?php 			
			if ($this->session->flashdata('errors')){
				echo '<div class="alert alert-danger">';
					echo $this->session->flashdata('errors');
				echo "</div>";
			}

			$data_btn_submit = array('name' => 'btn_submit','id' => 'btn_submit','value' => 'true','type' => 'submit','content' => 'Sign in','class' => 'btn btn-lg btn-primary btn-block');
			$hidden 	 = array('login_check' => 'confirm');
			$form_idname = "login_activity";

			echo form_open('', 'class="form-signin needs-validation" id="'.$form_idname.'" name="'.$form_idname.'" novalidate=""', $hidden);
		  ?>
 
      <img class="mb-4" src="<?php echo base_url("images/bootstrap-solid.svg"); ?>" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="kp_username" class="sr-only">User Name</label>
      <input type="text" id="kp_username" name="kp_username" class="form-control" placeholder="User Name" required="" autofocus="">
		<div class="invalid-feedback" style="width: 100%;">
		  Your username is required.
		</div>
      <label for="kp_password" class="sr-only">Password</label>
      <input type="password" id="kp_password" name="kp_password" class="form-control" placeholder="Password" required="">
		<div class="invalid-feedback" style="width: 100%;">
		  Your Password is required.
		</div>

	  <?php
			echo form_button($data_btn_submit);
		  ?>
			<?php echo form_close(); ?>
			
      <p class="mt-5 mb-3 text-muted">© 2018</p>
    </form>

</body>
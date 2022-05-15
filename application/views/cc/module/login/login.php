<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-grid.min.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-reboot.min.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/css/stylecc.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/css/common.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/css/responsivecc.css" type="text/css" rel="stylesheet"/>

<title>Wedding Choice / Login</title>
</head>

<body>
<body class="login">

<div  id="site-container" class="site-container">
	 <div class="container">
        <div class="row">
        	<div class="col-md-4"></div><!--col-->
            <div class="col-md-4">
            	<div class="logo text-center">
                	<img src="<?php echo base_url();?>assets/img/png/gridlite-logo.png" width="250px"/>
                    <img src="<?php echo base_url();?>assets/img/png/gridlite-slogans.png" width="250px"/>
                </div>
            </div><!--col-->
            <div class="col-md-4"></div><!--col-->
        </div><!--row-->
     	<div class="row">
        	<div class="col-md-4"></div><!--col-->
            <div class="col-md-4">
             	<div class="loginform">
                  <div class="error-box">
                  	<?php
						$success_msg= $this->session->flashdata('success_msg');
						$error_msg= $this->session->flashdata('error_msg');
						
						if($success_msg){?>
							<div class="alert alert-success">
							  <?php echo $success_msg; ?>
							</div>
						<?php }
							if($error_msg){?>
								<div class="alert alert-danger">
								  <?php echo $error_msg; ?>
								</div>
					<?php } ?>
                  </div>
                    <form method="post" action="<?php echo base_url();?>cc/login/authentication">
                        <input type="email"  class="useremail form-control" placeholder="Email" name="email" />
                        <input type="password" class="userpassword form-control" placeholder="Password" name="password" />
                        <button type="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>                        
                    </form>
                </div>
            </div><!--col-->
            <div class="col-md-4"></div><!--col-->
        </div><!--row-->
     </div><!--container-->
	
</div><!--site container-->

	<script src="<?php echo base_url();?>assets/js/jquery-3.2.1.slim.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/js/popper.min.js" type="text/javascript"></script>  
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/customcc.js" type="text/javascript"></script>
</body>
</html>
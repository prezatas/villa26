<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
 $user_id=$this->session->userdata('user_id');
 if(!$user_id){
  $this->session->set_flashdata('error_msg', 'Please Login To Access This Area.');
  redirect(base_url('cc/login'));
 }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>	
	<?php $this->load->view("cc/include/link");?>
	<title>Wedding Choice / Add User</title>	
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden pace-done pace-done">

	<div  id="site-container" class="site-container">
	 
	  <?php $this->load->view("cc/include/header");?>
      
      <div class="app-body">
      	<?php $this->load->view("cc/include/sidebar");?>			
      		
            <main class="main">
            	<?php echo $breadcrumbs;?>
                <div class="container">
                	<div id="error_box" class="error-box">
						
						<?php /* echo "<div class=valid-error>".validation_errors(). "</div>";
							$success_msg= $this->session->flashdata('success_msg');
							$error_msg= $this->session->flashdata('error_msg');
        				?>
                        
                        <?php if($success_msg){ ?>
						  <div class="alert alert-success">
							<?php echo $success_msg; ?>
						  </div>
						<?php } ?>
                        
                        <?php if($error_msg){ ?>
                          <div class="alert alert-danger">
                            <?php echo $error_msg; ?>
                          </div>
                        <?php } */?>   
                    </div>
                	<div class="row">
                    	<div class="col-md-2"></div><!--cl-->
                        <div class="col-md-8">
                        	<div class="card">
                            	<form name="form" method="post" name="form" enctype="multipart/form-data" action="<?php echo base_url('cc/user/adduserprocess'); ?>" onsubmit="return addUser()">
                                <div class="card-header">
                                    <strong>Add User</strong>
                                    <small>Form</small>
                                </div><!--card header-->
                                        
                                <div class="card-body">
                                
                                	<div class="form-row">
                                    
                                    	<div class="form-group col-md-6">
                                        	<label for="fname">First Name<span class="required">*</span></label>
                                            <input type="text"  maxlength="20" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo set_value('fname'); ?>">
                                            <div class="form-error" id="error_fname"><?php echo form_error('fname'); ?></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                        	<label for="lname">Last Name<span class="required">*</span></label>
                                            <input type="text"  maxlength="20" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo set_value('lname'); ?>">
                                            <div class="form-error" id="error_lname"><?php echo form_error('lname'); ?></div>
                                        </div>
                                        
                                    </div><!--form row-->
                                            
                                    <div class="form-row">
                                    
                                        <div class="form-group col-md-6">
                                            <label for="tel">Telephone</label>
                                            <input type="tel"  maxlength="12"  maxlength="20" class="form-control" id="tel" name="tel" placeholder="eg : +947000000" value="<?php echo set_value('tel'); ?>">
                                            <div class="form-error" id="error_tel"><?php echo form_error('tel'); ?></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label for="nic">NIC NO</label>
                                            <input type="text" maxlength="10" class="form-control" id="nic" name="nic" placeholder="NIC Number" value="<?php echo set_value('nic'); ?>">
                                            <div class="form-error" id="error_nic"><?php echo form_error('nic'); ?></div>
                                        </div>
                                        
                                    </div><!--form row-->
                                            
                                    <div class="form-row">
                                        <div class="form-group col-sm-6">
                                            <label for="email">Email<span class="required">*</span></label>
                                            <input type="email" maxlength="50" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo set_value('email'); ?>">
                                            <div class="form-error" id="error_email"><?php echo form_error('email'); ?></div>
                                        </div>
                                        <div class="form-group col-md-6">
                                           <label for="role">Role<span class="required">*</span></label>
                                             <select id="role" name="role" class="form-control" >
                                                 <option value="">Choose...</option>
                                                 <?php foreach($roles as $role){?>
                                                 
                                                 <option value="<?php echo $role->ur_id;?>" <?php echo set_select('role',  $role->ur_id); ?>><?php echo $role->ur_title;?></option>
                                                
                                                 <?php }?>
                                             </select>
                                             <div class="form-error" id="error_role"><?php echo form_error('role'); ?></div>
                                        </div>
                                        
                                    </div><!--form row-->
                                            
                                    <div class="form-row">
                                    
                                    	<div class="form-group col-sm-6">
                                            <label for="password">Password<span class="required">*</span> (Not more than 15 characters.)</label>
                                            <input type="password" maxlength="15" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>">
                                           <div class="form-error" id="error_password"><?php echo form_error('password'); ?></div>
                                        </div>
                                        
                                        <div class="form-group col-sm-6">
                                            <label for="cpassword">Confirm Password<span class="required">*</span> (Not more than 15 characters.)</label>
                                            <input type="password" maxlength="15" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" value="<?php echo set_value('cpassword'); ?>">
                                           <div class="form-error" id="error_cpassword"><?php echo form_error('cpassword'); ?></div>
                                        </div>
                                        
                                        
                                     </div><!--form row-->
                                        </div><!--card body-->
                                        <div class="card-footer">
											<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
											<button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
										</div><!--card footer-->
                                        </form>
                                     </div>
                                </div><!--grid-->
                                <div class="col-md-2"></div><!--cl-->
                         
                    
                    </div><!--rw-->
                
                </div>
			</main>
            
            	
      </div><!--app body-->	

</div><!--site container--> 
	<?php $this->load->view("cc/include/footer");?>
</body>
</html>
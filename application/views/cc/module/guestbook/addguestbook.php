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
	<title>Wedding Choice / Add Guestbook</title>	
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
                            	       <form id="form" name="form" method="post" enctype="multipart/form-data" onsubmit="return addUser()" action="<?php echo base_url('cc/guestbook/addguestbookprocess')?>">
                                
                                <div class="card-header">
                                    <strong>Add Guestbook</strong>
                                    <small>Form</small>
                                </div><!--card header-->
                                
                                
                                      
                                <div class="card-body">
                                	
                                	<div class="form-row">
                                    
                                    	<div class="form-group col-md-6">
                                        	<label for="name">Name<span class="required">*</span></label>
                                            <input type="text"  maxlength="50" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo set_value('name'); ?>">
                                            <div class="form-error" id="error_name"><?php echo form_error('name'); ?></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                        	<label for="title">Title<span class="required">*</span></label>
                                            <input type="text"  maxlength="20" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo set_value('title'); ?>">
                                            <div class="form-error" id="error_title"><?php echo form_error('title'); ?></div>
                                        </div>
                                        
                                    </div><!--form row-->
                                    
                                    <div class="form-row">
                                    
                                    	<div class="form-group col-md-6">
                                        	<label for="email">Email<span class="required">*</span></label>
                                            <input type="text"  maxlength="100" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
                                            <div class="form-error" id="error_email"><?php echo form_error('email'); ?></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                        </div>
                                        
                                    </div><!--form row-->
                                            
                                    <div class="form-row">
                                    
                                    	
                                        
                                        <div class="form-group col-md-12">
                                        	<label for="comment">Description<span class="required">*</span></label>
                                            <textarea type="text"  maxlength="500" rows="7" class="form-control" id="comment" name="comment" placeholder="Comment" onkeyup="countChar(this)"><?php echo set_value('comment'); ?></textarea>
                                            <div id="charNum"></div>
                                            <div class="form-error" id="error_comment"><?php echo form_error('comment'); ?></div>
                                        </div>
                                        
                                    </div><!--form row-->
                                            
                                    
                                        </div><!--card body-->
                                        <div class="card-footer">
											<button type="submit"  class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
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
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
	<title>Wedding Choice / View Guestbook</title>	
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
                            	<?php foreach($guestbooks as $guestbook){?>
                            	
                                <div class="card-header">
                                    <strong>View Guestbook</strong>
                                    <small>Form</small>
                                </div><!--card header-->
                                        
                                <div class="card-body">
                                
                                	<div class="form-row">
                                    
                                    	<div class="form-group col-md-6">
                                        	<label for="name">Name<span class="required">*</span></label>
                                            <input type="text"  maxlength="50" class="form-control" id="name" name="name" placeholder="Name"  readonly  value="<?php echo $guestbook->g_name;?>">
                                           
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                        	<label for="title">Title<span class="required">*</span></label>
                                            <input type="text"  maxlength="20" class="form-control" id="title" name="title" placeholder="Title" readonly value="<?php echo $guestbook->g_title;?>">
                                            
                                        </div>
                                        
                                    </div><!--form row-->
                                    
                                    <div class="form-row">
                                    
                                    	<div class="form-group col-md-6">
                                        	<label for="email">Email<span class="required">*</span></label>
                                            <input type="text"  maxlength="100" class="form-control" id="email" name="email" placeholder="Email" readonly value="<?php echo $guestbook->g_email;?>">
                                            
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                        </div>
                                        
                                    </div><!--form row-->
                                    
                                    <div class="form-row">
                                    
                                    	
                                        
                                        <div class="form-group col-md-12">
                                        	<label for="comment">Description<span class="required">*</span></label>
                                            <textarea type="text"  maxlength="500" rows="7" class="form-control" id="comment" name="comment" placeholder="Comment"  readonly><?php echo $guestbook->g_comment;?></textarea>
                                            
                                        </div>
                                        
                                    </div><!--form row-->
                                            
                                    
                                </div><!--card body-->
                                <div class="card-footer">
                                    
                                </div><!--card footer-->
                                        
                             <?php }?>
                          	</div>
                     	 </div><!--cl-->
                      	<div class="col-md-2"></div><!--cl-->
                         
                    
                    </div><!--rw-->
                
                </div>
			</main>
            
            	
      </div><!--app body-->	

</div><!--site container--> 
	<?php $this->load->view("cc/include/footer");?>
</body>
</html>
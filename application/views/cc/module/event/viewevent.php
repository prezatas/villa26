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
	<title>Wedding Choice / View Event</title>	
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
                            	<?php foreach($events as $event){?>
                            	
                                <div class="card-header">
                                    <strong>View Event</strong>
                                    <small>Form</small>
                                </div><!--card header-->
                                        
                                <div class="card-body">
                                
                                	<div class="form-row">
                                    
                                    	<div class="form-group col-md-6">
                                        	<label for="image">Event Image<span class="required">*</span></label>
                                            <img src="<?php echo base_url();?>assets/img/event/<?php echo $event->e_image;?>" width="200px" class="img-fluid"/>
                                            <div class="form-error" id="error_image"><?php echo form_error('image'); ?></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                        	<label for="etitle">Event Title<span class="required">*</span></label>
                                            <input type="text"  maxlength="20" readonly class="form-control" id="etitle" name="etitle" placeholder="Event Title" value="<?php echo $event->e_title;?>">
                                            <div class="form-error" id="error_etitle"><?php echo form_error('etitle'); ?></div>
                                        </div>
                                        
                                    </div><!--form row-->
                                
                                	
                                            
                                    <div class="form-row">
                                    
                                    	<div class="form-group col-md-12">
                                        	<label for="description">Description<span class="required">*</span></label>
                                            <textarea type="text" readonly  maxlength="500" rows="7" class="form-control" id="description" name="description" placeholder="Description" onkeyup="countChar(this)"><?php echo $event->e_description;?></textarea>
                                            <div id="charNum"></div>
                                            <div class="form-error" id="error_description"><?php echo form_error('description'); ?></div>
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
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
	<title>Wedding Choice / Add Booking</title>	
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
                            	       <form id="form" name="form" method="post" enctype="multipart/form-data" onsubmit="return addUser()" action="<?php echo base_url('cc/booking/addbookingprocess')?>">
                                
                                <div class="card-header">
                                    <strong>Add Booking</strong>
                                    <small>Form</small>
                                </div><!--card header-->
                                
                                
                                      
                                <div class="card-body">
                                	
                                	<div class="form-row">
                                    
                                    	<div class="form-group col-md-4">
                                        	<label for="checkin">Checkin<span class="required">*</span></label>
                                            <input type="date"   class="form-control" id="checkin" name="checkin"  value="<?php echo set_value('checkin'); ?>">
                                            <div class="form-error" id="error_checkin"><?php echo form_error('checkin'); ?></div>
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                        	<label for="checkout">Checkout<span class="required">*</span></label>
                                            <input type="date"   class="form-control" id="checkout" name="checkout"  value="<?php echo set_value('checkout'); ?>">
                                            <div class="form-error" id="error_checkout"><?php echo form_error('checkout'); ?></div>
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                        	<label for="country">Country<span class="required">*</span></label>
                                            <input type="text" maxlength="20"  class="form-control" id="country" name="country"  value="<?php echo set_value('country'); ?>">
                                            <div class="form-error" id="error_countrty"><?php echo form_error('country'); ?></div>
                                        </div>
                                        
                                    </div><!--form row-->
                                    
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
                                        	<label for="nog">Number of Guest<span class="required">*</span></label>
                                            <select name="nog" id="nog" class="form-control">
                                            	<option value="">No of Guest</option>
                                                <option value="1" <?php echo set_select('nog',1); ?>>1</option>
                                                <option value="2" <?php echo set_select('nog',2); ?>>2</option>
                                                <option value="3" <?php echo set_select('nog',3); ?>>3</option>
                                                <option value="4" <?php echo set_select('nog',4); ?>>4</option>
                                                <option value="5" <?php echo set_select('nog',5); ?>>5</option>
                                                <option value="6" <?php echo set_select('nog',6); ?>>6</option>
                                                <option value="7" <?php echo set_select('nog',7); ?>>7</option>
                                                <option value="8" <?php echo set_select('nog',8); ?>>8</option>
                                                <option value="9" <?php echo set_select('nog',9); ?>>9</option>
                                            </select>
                                            <div class="form-error" id="error_nog"><?php echo form_error('nog'); ?></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                        	<label for="nor">Number of Rooms<span class="required">*</span></label>
                                            <select name="nor" id="nor" class="form-control">
                                            	<option value="">No of Room</option>
                                                <option value="1" <?php echo set_select('nor',1); ?>>1</option>
                                                <option value="2" <?php echo set_select('nor',2); ?>>2</option>
                                                <option value="3" <?php echo set_select('nor',3); ?>>3</option>
                                                <option value="4" <?php echo set_select('nor',4); ?>>4</option>
                                                
                                            </select>
                                            <div class="form-error" id="error_nor"><?php echo form_error('nor'); ?></div>
                                        </div>
                                        
                                    </div><!--form row-->
                                    
                                    <div class="form-row">
                                    
                                    	<div class="form-group col-md-6">
                                        	<label for="email">Email<span class="required">*</span></label>
                                            <input type="text"  maxlength="100" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
                                            <div class="form-error" id="error_email"><?php echo form_error('email'); ?></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                        	<label for="tel">Telephone<span class="required">*</span></label>
                                            <input type="text"  maxlength="15" class="form-control" id="tel" name="tel" placeholder="Telephone" value="<?php echo set_value('tel'); ?>">
                                            <div class="form-error" id="error_tel"><?php echo form_error('tel'); ?></div>
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
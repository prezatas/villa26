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
	<title>Wedding Choice / View Booking</title>	
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
                            	<?php foreach($bookings as $booking){?>
                            	
                                <div class="card-header">
                                    <strong>View Guestbook</strong>
                                    <small>Form</small>
                                </div><!--card header-->
                                        
                                <div class="card-body">
                                
                                	<div class="form-row">
                                    
                                    	<div class="form-group col-md-4">
                                        	<label for="checkin">Checkin<span class="required">*</span></label>
                                            <input type="date" readonly   class="form-control" id="checkin" name="checkin"  value="<?php echo $booking->b_checkin; ?>">
                                            
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                        	<label for="checkout">Checkout<span class="required">*</span></label>
                                            <input type="date" readonly  class="form-control" id="checkout" name="checkout"  value="<?php echo $booking->b_checkout; ?>">
                                            
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                        	<label for="country">Country<span class="required">*</span></label>
                                            <input type="text" readonly maxlength="20"  class="form-control" id="country" name="country"  value="<?php echo $booking->b_country; ?>">
                                            
                                        </div>
                                        
                                    </div><!--form row-->
                                    
                                    <div class="form-row">
                                    
                                    	<div class="form-group col-md-6">
                                        	<label for="fname">First Name<span class="required">*</span></label>
                                            <input type="text"  readonly maxlength="20" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo $booking->b_fname; ?>">
                                            
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                        	<label for="lname">Last Name<span class="required">*</span></label>
                                            <input type="text"  readonly maxlength="20" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo $booking->b_lname; ?>">
                                           
                                        </div>
                                        
                                    </div><!--form row-->
                                    
                                    <div class="form-row">
                                    
                                    	<div class="form-group col-md-6">
                                        	<label for="nog">Number of Guest<span class="required">*</span></label>
                                            <input type="text" readonly maxlength="20" class="form-control" id="nog" name="nog" placeholder="Number of Guests" value="<?php echo $booking->b_nog; ?>">
                                            <?php /* <select name="nog" id="nog" class="form-control">
                                            	<option value="">No of Guest</option>
                                                    <option value="1" <?php echo set_select('nog', '1', !strcmp($booking->b_nog,"1") ? TRUE : FALSE); ?>>1</option>
                                                	<option value="2" <?php echo set_select('nog', '2', !strcmp($booking->b_nog,"2") ? TRUE : FALSE); ?>>2</option>
                                                <option value="3" <?php echo set_select('nog',3); ?>>3</option>
                                                <option value="4" <?php echo set_select('nog',4); ?>>4</option>
                                                <option value="5" <?php echo set_select('nog',5); ?>>5</option>
                                                <option value="6" <?php echo set_select('nog',6); ?>>6</option>
                                                <option value="7" <?php echo set_select('nog',7); ?>>7</option>
                                                <option value="8" <?php echo set_select('nog',8); ?>>8</option>
                                                <option value="9" <?php echo set_select('nog',9); ?>>9</option>
                                            </select>*/?>
                                            
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                        	<label for="nor">Number of Rooms<span class="required">*</span></label>
                                            <label for="nog">Number of Guest<span class="required">*</span></label>
                                            <input type="text" readonly maxlength="20" class="form-control" id="nor" name="nor" placeholder="Number of Rooms" value="<?php echo $booking->b_nor; ?>">
                                        </div>
                                        
                                    </div><!--form row-->
                                    
                                    <div class="form-row">
                                    
                                    	<div class="form-group col-md-6">
                                        	<label for="email">Email<span class="required">*</span></label>
                                            <input type="text" readonly  maxlength="100" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $booking->b_email; ?>">
                                            
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                        	<label for="tel">Telephone<span class="required">*</span></label>
                                            <input type="text" readonly maxlength="15" class="form-control" id="tel" name="tel" placeholder="Telephone" value="<?php echo $booking->b_tel; ?>">
                                            
                                        </div>
                                        
                                    </div><!--form row-->
                                            
                                    <div class="form-row">
                                    
                                    	
                                        
                                        <div class="form-group col-md-12">
                                        	<label for="comment">Description<span class="required">*</span></label>
                                            <textarea type="text" readonly  maxlength="500" rows="7" class="form-control" id="comment" name="comment" placeholder="Comment" onkeyup="countChar(this)"><?php echo $booking->b_comment; ?></textarea>
                                            <div id="charNum"></div>
                                            
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
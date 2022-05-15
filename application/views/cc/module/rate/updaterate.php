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
	<title>Wedding Choice / Update Rate</title>	
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
                    	
                        <div class="col-md-8">
                        	<div class="card">
                            	<?php foreach($rates as $rate){?>
                            	<form name="formi" method="post" name="formi" enctype="multipart/form-data" action="<?php echo base_url('cc/rate/updaterateprocess'); ?>">
                                <div class="card-header">
                                    <strong>Update Rate</strong>
                                    <small>Form</small>
                                </div><!--card header-->
                                        
                                <div class="card-body">
                                
                                	<div class="form-row">
                                    
                                    	<div class="form-group col-md-6">
                                        	<label for="rtitle">Rate Title<span class="required">*</span></label>
                                            <input type="hidden" name="rid" id="rid"  value="<?php  echo $rate->r_id;?>">
                                            <input type="hidden" name="pageno" id="pageno"  value="<?php echo $this->input->get("pageno");?>">
                                            <input type="text"  maxlength="20" class="form-control" id="rtitle" name="rtitle" placeholder="Rate Title" value="<?php echo set_value('rtitle',$rate->r_title); ?>">
                                            <div class="form-error" id="error_rtitle"><?php echo form_error('rtitle'); ?></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6"></div>
                                        
                                    </div><!--form row-->
                                    
                                    <div class="form-row">
                                    
                                    	<div class="form-group col-md-6">
                                        	<label for="bed">Bed</label>
                                            <input type="text"  maxlength="6" class="form-control" id="bed" name="bed" placeholder="Bed" value="<?php echo set_value('bed',$rate->r_bed); ?>">
                                            <div class="form-error" id="error_bed"><?php echo form_error('bed'); ?></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                        	<label for="size">Size(sqft)</label>
                                            <input type="text"  maxlength="6" class="form-control" id="size" name="size" placeholder="Size(sqft)" value="<?php echo set_value('size',$rate->r_size); ?>">
                                            <div class="form-error" id="error_size"><?php echo form_error('size'); ?></div>
                                        </div>
                                        
                                    </div><!--form row-->
                                    
                                    
                                    <div class="form-row">
                                    
                                        <div class="form-group col-md-6">
                                        	<label for="price">Price<span class="required">*</span></label>
                                            <input type="text"  maxlength="10" class="form-control" id="price" name="price" placeholder="Price" value="<?php echo set_value('price',$rate->r_price); ?>">
                                            <div class="form-error" id="error_price"><?php echo form_error('price'); ?></div>
                                        
                                        </div>
                                        <div class="form-group col-md-6"></div>
                                        
                                    </div><!--form row-->
                                            
                                    <div class="form-row">
                                    
                                    	<div class="form-group col-md-12">
                                        	<label for="description">Description<span class="required">*</span></label>
                                            <textarea type="text"  maxlength="500" rows="7" class="form-control" id="description" name="description" placeholder="Description" onkeyup="countChar(this)"><?php echo set_value('description',$rate->r_description); ?></textarea>
                                            <div id="charNum"></div>
                                            <div class="form-error" id="error_description"><?php echo form_error('description'); ?></div>
                                        </div>
                                        
                                        
                                        
                                    </div><!--form row-->
                                            
                                    
                                            
                                    
                                        </div><!--card body-->
                                        <div class="card-footer">
											<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
											<button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
										</div><!--card footer-->
                                        </form>
                                        <?php } ?>
                                     </div>
                                </div><!--cl-->
                                <div class="col-md-4">
                                	<div class="card">
                            			<?php foreach($rates as $rate){?>
                            	<form name="form" method="post" name="form" enctype="multipart/form-data" action="<?php echo base_url('cc/rate/updateimageprocess'); ?>" onsubmit="return imageValidate()">
                                <div class="card-header">
                                    <strong>Update Image Category</strong>
                                    <small>Form</small>
                                </div><!--card header-->
                                        
                                <div class="card-body">
                                
                                	<div class="form-row">
                                    
                                    	<div class="form-group col-md-12">
                                        	<label for="image">Rate Image<span class="required">*</span></label>
                                            <input type="hidden" name="rid" id="rid"  value="<?php  echo $rate->r_id;?>">
                                            <input type="hidden" name="pageno" id="pageno"  value="<?php echo $this->input->get("pageno");?>">
                                            <input type="hidden" name="oldimage" id="oldimage"  value="<?php echo $rate->r_image;?>">
                                            <input type="file"  class="form-control" id="image" name="image"  value="<?php echo set_value('image'); ?>">	
                                            <div class="form-error" id="error_image"><?php echo form_error('image'); ?></div>
                                            <div class="text-center">
                                            	<img src="<?php echo base_url();?>assets/img/rate/<?php echo $rate->r_image;?>" width="50%" class="img-fluid"/>
                                             </div>
                                            
                                        </div>
                                        
                                        <div class="form-group col-md-6"></div>
                                        
                                    </div><!--form row-->
                                
                                    
                                        </div><!--card body-->
                                        <div class="card-footer">
											<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
											<button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
										</div><!--card footer-->
                                        </form>
                                        <?php } ?>
                                     </div>
                                </div><!--cl-->
                         
                    
                    </div><!--rw-->
                
                </div>
			</main>
            
            	
      </div><!--app body-->	

</div><!--site container--> 
	<?php $this->load->view("cc/include/footer");?>
</body>
</html>
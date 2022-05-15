<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    
    <?php $this->load->view("include/link");?>
	<title>Villa26 / Guestbook</title>

	
</head>
<body>


	<?php $this->load->view("include/header");?>	
    	
    
     
<div id="site-content">
	
    
    <div class="guestbook">
    	<div class="guest-wrap mg-t-30">
        	<div class="container-fluid section-container">
            		<div class="row section-title text-center">
                        <div class="col-md-12">
                            <h2>Guestbook</h2>
                        </div><!--cl-->
                        
                    </div><!--rw-->
                
                    
                    <div class="row">
                    	<div class="col-md-2"></div><!--cl-->
                        <div class="col-md-8">
                         	<div class="bookform-wrap">
                                 <form name="form" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>guestbook/addguestbookprocess" onsubmit="return addGuestbook()">
     
                                  <!--  Details -->
                                  <div class="form-group">
                                  	<div class="row">
                                        <div class="col-md-6">
                                          <div class="controls">
                                        	<label>Your Name *</label>
                                        	<input type="text" name="name" class="form-control"  placeholder="Your Name">
                                            <div class="form-error" id="error_name"><?php echo form_error('name'); ?></div>
                                          </div>
                                       </div><!--cl-->
                                       
                                       <div class="col-md-6">
                                          <div class="controls">
                                        	<label>Email *</label>
                                        	<input type="email" name="email" class="form-control" placeholder="Your Email">
                                            <div class="form-error" id="error_email"><?php echo form_error('email'); ?></div>
                                          </div>
                                       </div><!--cl-->
                                    </div>
                                  </div><!--form--group-->
                                  
                                  
                                  <div class="form-group">
                                  	<div class="row">
                                        <div class="col-md-6">
                                          <div class="controls">
                                        	<label>Subject *</label>
                                        	<input type="text"  name="subject" class="form-control"  placeholder="Subject">
                                            <div class="form-error" id="error_email"><?php echo form_error('subject'); ?></div>
                                          </div>
                                       </div><!--cl-->
                                       <div class="col-md-6">
                                          <div class="controls">
                                        	<label>Your Comments *</label>
                                        	<textarea maxlength="500" name="message" id="message"  class="form-control" rows="6"></textarea>
                                            <div class="form-error" id="error_comments"><?php echo form_error('message'); ?></div>
                                          </div>
                                       </div><!--cl-->
                                    </div>
                                  </div><!--form--group-->
                                      
                                  
                                      
                                  
                                  <div class="form-group">
                                  	<div class="row">
                                        <div class="col-md-12">
                                            <div class="">
                                                <button class="formbtn"><a class="btn btn-white">Submit</a></button>
                                            </div>
                                        </div><!--col-->
                                   </div> <!--row-->
                                  </div> <!-- /.form-group -->
                                </form> 
                            </div>	   
                        </div><!--cl-->
                        <div class="col-md-2"></div><!--cl-->
                        
                    </div><!--rw-->
              </div><!--section-container-->
        </div><!---guest wrap-->
        
        <div class="guest-line mg-t-30">
        	<div class="container section-container">
            		<?php foreach($guestbooks  as $guestbook){?>
                    <div class="row">
                    	
                        <div class="col-md-12">
                         	<div class="review-wrap">
                                <div class="review-title">
                                    <h3><?php echo $guestbook->g_title;?></h3>
                                </div>   
                                <div class="review-quote">
                                    <p><?php  $string = nl2br_except_pre($guestbook->g_comment);
									echo $string;?></p>
                                </div>
                                <div class="review-author">
                                    <h3><?php echo $guestbook->g_name;?></h3><span class="details"><?php echo $guestbook->g_date;?></span>
                                </div>   
                            </div>	
                        </div><!--cl-->
                        
                        
                    </div><!--rw-->
                    <?php } ?>
              </div><!--section-container-->
        </div><!---guest line-->
        
        
    </div><!--guestbook-->
    

</div><!--site content-->

<?php $this->load->view("include/footer");?>
</body>
</html>
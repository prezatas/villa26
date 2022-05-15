<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    
    <?php $this->load->view("include/link");?>
	<title>Villa26 / Gallery</title>

	
</head>
<body>


	<?php $this->load->view("include/header");?>	
    	
    
     
<div id="site-content">
	
    
    <div class="gallery">
    	<div class="interior-design mg-t-30">
        	<div class="container section-container">
            	
                    <div class="row section-title text-center">
                        <div class="col-md-12">
                            <h2>Gallery</h2>
                        </div><!--cl-->
                        
                    </div><!--rw-->
                    
                    <div class="row section-sub-title">
                        <div class="col-md-12">
                            <h4>Interior Design</h4>
                            <p>Feel Free To Have A Great Look Of The Interior View At Villa 26</p>
                        </div>
                    </div>
                    <div class="row">
                    	<?php foreach($ids as $id ){?>
                        <div class="col-md-4">
                            <div class="gallery-wrap">
                                <div class="gallery-inner">
                                        
                                    <div class="image" style="background-image:url(<?php echo base_url();?>assets/img/gallery/<?php echo $id->g_image;?>)">
                                    
                                    
                                    </div>
                                        
                                    
                                </div>
                            </div>
                        </div><!--cl-->
                        <?php } ?>
                        
                        
                    </div><!--rw-->
                    
                    <div class="row mg-t-30">
                        <div class="col-md-12">
                            <div class="btn-holder">
                                        <a href="<?php echo base_url();?>gallery/interior" class="btn btn-white">View More</a>
                            </div>
                        </div><!--cl-->
                    </div><!--rw-->
                </div><!--section-container-->
        </div><!---interior-->
              
             
        <div class="food-and-beverage mg-t-30">
        	<div class="container section-container">       
               
                   <div class="row section-sub-title">
                        <div class="col-md-12">
                            <h4>Food and Beverage</h4>
                            <p>Our Dining Concept Is Unique, Special And Ensures Our Guest Will Always Have The Best.</p>
                        </div>
                    </div>
                    <div class="row">
                    	<?php foreach($fbs  as $fb ){?>
                        <div class="col-md-4">
                            <div class="gallery-wrap">
                                <div class="gallery-inner">
                                        
                                    <div class="image" style="background-image:url(<?php echo base_url();?>assets/img/gallery/<?php echo $fb->g_image;?>)">
                                    
                                    
                                    </div>
                                        
                                    
                                </div>
                            </div>
                        </div><!--cl-->
                         <?php } ?>
                        
                    </div><!--rw-->
                    
                    <div class="row mg-t-30">
                        <div class="col-md-12">
                            <div class="btn-holder">
                                        <a href="<?php echo base_url();?>gallery/fandb" class="btn btn-white">View More</a>
                            </div>
                        </div><!--cl-->
                    </div><!--rw-->
               
              
             </div><!--section-container-->
          </div><!---foodandbeverage--> 
    </div><!--gallery-->
    

</div><!--site content-->

<?php $this->load->view("include/footer");?>
</body>
</html>
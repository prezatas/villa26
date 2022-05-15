<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    
    <?php $this->load->view("include/link");?>
	<title>Villa26 / Rate View</title>

	
</head>
<body>


	<?php $this->load->view("include/header");?>	
    	
    
     
<div id="site-content">
	
    
    <div class="gallery">
    	<div class="interior-design mg-t-30">
        	<div class="container section-container">
            		<?php foreach($rates  as $rate ){?>
                    <div class="row section-title text-center">
                        <div class="col-md-12">
                            <h2><?php echo $rate->r_title;?></h2>
                        </div><!--cl-->
                        
                    </div><!--rw-->
                    
                    <div class="row section-sub-title mg-tb-30">
                        <div class="col-md-12">
                        	<img src="<?php echo base_url();?>assets/img/rate/<?php echo $rate->r_image;?>" width="100%"/>
						</div>
                         
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                        	<p>No of Bed(s)&nbsp;<?php echo $rate->r_bed;?></p>
                            <p>Size (sqft)&nbsp;<?php echo $rate->r_size;?></p>
                            <p>Price&nbsp;<span class="price"><?php echo $rate->r_price;?></span></p>
                        	<p> <?php $string = nl2br_except_pre($rate->r_description);
									echo $string;?></p>
                        </div>
                     </div><!--rw-->
                    <?php } ?>
                    
                    
                    
                </div><!--section-container-->
        </div><!---interior-->
              
             
        
    </div><!--gallery-->
    
    <section class="section section-ending">
        	<div class="container section-container">
            	
                
                <div class="row">
                    <div class="col-md-12 text-center">
                    	<blockquote>
                            <p>“The Villa 26 is a gorgeous place to enjoy your life”</p>
                            <div class="booknowbtn"><a href="<?php echo base_url();?>booknow" >Book Now</a></div>
                        </blockquote>
                    </div><!--cl-->
                    
                    
                </div><!--rw-->
             </div><!--section-container-->
    </section>
    

</div><!--site content-->

<?php $this->load->view("include/footer");?>
</body>
</html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    
    <?php $this->load->view("include/link");?>
	<title>Villa26 / Rate</title>

	
</head>
<body>


	<?php $this->load->view("include/header");?>	
    	
    
     
<div id="site-content">
	
    
    <div class="rate">
    	<div class="rate-wrap mg-t-30">
        	<div class="container section-container">
            	
                    <div class="row section-title text-center">
                        <div class="col-md-12">
                            <h2>Rate</h2>
                        </div><!--cl-->
                        
                    </div><!--rw-->
                
                    
                    <div class="row">
                    	<?php foreach($rates as $rate ){?>
                        <div class="col-md-6">
                        	
                            <div class="rooms mg-b-10">
                            	<div class="thumb-inner">
                                    <div class="thumb-image" style="background-image:url(<?php echo base_url();?>assets/img/rate/<?php echo $rate->r_image;?>)">
                                    </div>
                                </div>
                            	
                                <div class="info">
                                	<h3><?php echo $rate->r_title;?></h3>
                                    <p> <?php $string = nl2br_except_pre($rate->r_description);
										$string = word_limiter($string, 20);
										echo $string;?></p>
                                    
                                    <div class="btn-holder">
                                        <a href="<?php echo base_url();?>rate/view?rateid=<?php echo $rate->r_id;?>" class="btn btn-white">Check Details</a>						
                                    </div>
                                </div>
                            </div>
                            
                        </div><!--cl-->
                        <?php } ?>
                        
                    </div><!--rw-->
                    
                    <div class="row mg-t-30">
                        <div class="col-md-12">
                            <div class="pagination">
                            	<?php echo $links;?>
                        	</div>    
                        </div><!--cl-->
                    </div><!--rw-->
                    
               
           </div><!--section-container-->
        </div><!---rate wrap-->
    </div><!--rate-->
    

</div><!--site content-->

<?php $this->load->view("include/footer");?>
</body>
</html>
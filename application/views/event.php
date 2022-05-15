<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    
    <?php $this->load->view("include/link");?>
	<title>Villa26 / Event</title>

	
</head>
<body>


	<?php $this->load->view("include/header");?>	
    	
    
     
<div id="site-content">
	
    
    <div class="event">
    	<div class="event-wrap mg-t-30">
        	<div class="container section-container">
            	
                    <div class="row section-title text-center">
                        <div class="col-md-12">
                            <h2>Event</h2>
                        </div><!--cl-->
                        
                    </div><!--rw-->
                
                    
                    <div class="row">
                    	<?php foreach($events as $event){?>
                        <div class="col-md-4">
                            <div class="event-item">
                                <figure>
                                    <div class="overlay"></div>
                                    <div class="thumb-inner">
                                    	<div class="thumb-image" style="background-image:url(<?php echo base_url();?>assets/img/event/<?php echo $event->e_image;?>)"></div>
                                    	
                                    </div>
                                </figure>
                                <div class="event-text text-left">
                                    <h3><?php echo $event->e_title;?></h3>
                                    <p class="mg-t-15"><?php $string = nl2br_except_pre($event->e_description);
										$string = word_limiter($string, 20);
										echo $string;?></p>
                                    <p class="event-details"><?php echo $event->e_date;?></p>
                                    <div class="btn-holder">
                                        <a href="<?php echo base_url();?>event/view?eventid=<?php echo $event->e_id;?>" class="btn btn-white">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div><!--cl-->
                        <?php } ?>
                        
                        
                    </div><!--rw-->
                    
               
           </div><!--section-container-->
         </div><!---event wrap-->
    </div><!--event-->
    

</div><!--site content-->

<?php $this->load->view("include/footer");?>
</body>
</html>
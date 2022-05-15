<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    
    <?php $this->load->view("include/link");?>
	<title>Villa26 / Event View</title>

	
</head>
<body>


	<?php $this->load->view("include/header");?>	
    	
    
     
<div id="site-content">
	
    
    <div class="gallery">
    	<div class="interior-design mg-t-30">
        	<div class="container section-container">
            		<?php foreach($events  as $event ){?>
                    <div class="row section-title text-center">
                        <div class="col-md-12">
                            <h2><?php echo $event->e_title;?></h2>
                        </div><!--cl-->
                        
                    </div><!--rw-->
                    
                    <div class="row section-sub-title mg-tb-30">
                        <div class="col-md-12">
                        	<img src="<?php echo base_url();?>assets/img/event/<?php echo $event->e_image;?>" width="100%"/>
						</div>
                         
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                        	
                        	<p> <?php $string = nl2br_except_pre($event->e_description);
									echo $string;?></p>
                            <p class="event-details text-right"><?php echo $event->e_date;?></p>
                        </div>
                     </div><!--rw-->
                    <?php } ?>
                    
                    
                    
                </div><!--section-container-->
        </div><!---interior-->
              
             
        
    </div><!--gallery-->
    
    
    

</div><!--site content-->

<?php $this->load->view("include/footer");?>
</body>
</html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    
    <?php $this->load->view("include/link");?>
	<title>Villa26 / Gallery View</title>

	
</head>
<body>


	<?php $this->load->view("include/header");?>	
    	
    
     
<div id="site-content">
	
    
    <div class="gallery">
    	<div class="interior-design mg-t-30">
        	<div class="container section-container">
            	
                    <div class="row section-title text-center">
                        <div class="col-md-12">
                            <h2>Gallery View</h2>
                        </div><!--cl-->
                        
                    </div><!--rw-->
                    
                    <div class="row section-sub-title">
                        <div class="col-md-12">
                        	<?php $gallerytype= $this->uri->segment(2);?>
							
							<?php if($gallerytype=="interior"){?>
                                <h4>Interior Design</h4>
                                <p>Feel Free To Have A Great Look Of The Interior View At Villa 26</p>
                          	<?php } ?>
                            
                            <?php if($gallerytype=="fandb"){?>
                                <h4>Food and Beverage</h4>
                            	<p>Our Dining Concept Is Unique, Special And Ensures Our Guest Will Always Have The Best.</p>
                          	<?php } ?>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="demo-gallery">
            				<ul id="lightgallery" class="list-unstyled row">
                            <?php foreach($galleries  as $gallery ){?>
                                <li  class="col-md-4" data-src="<?php echo base_url();?>assets/img/gallery/<?php echo $gallery->g_image;?>" data-sub-html="<h4>Villa 26</h4><p><?php echo $pagetitle;?> Gallery</p>" data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">
                                    <a href="">
                                    <div class="gallery-wrap">
                                    	<div class="gallery-inner">
                                            <div class="image" style="background-image:url(<?php echo base_url();?>assets/img/gallery/<?php echo $gallery->g_image;?>)">
                                            <img class="img-responsive" src="<?php echo base_url();?>assets/img/gallery/<?php echo $gallery->g_image;?>" alt="Thumb-1" width="100%" style="visibility:hidden">
                                            </div>
                                    	</div>
                                    </div>
                                    </a>
                                </li>
                			<?php } ?>
            				</ul>
       					 </div>
                       
                    
                        
                        
                    </div><!--rw-->
                    
                    
                    
                    <div class="row mg-t-30">
                        <div class="col-md-12">
                            <div class="pagination">
                            	<?php echo $links;?>
                        	</div>    
                        </div><!--cl-->
                    </div><!--rw-->
                </div><!--section-container-->
        </div><!---interior-->
              
             
        
    </div><!--gallery-->
    

</div><!--site content-->

<?php $this->load->view("include/footer");?>
</body>
</html>
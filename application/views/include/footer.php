<footer id="main-footer">
    <section class="section foot-top pd-tb-10">
        <div class="container-fluid section-container">
            <div class="row">
                <div class="col-md-4">
                	<h2>Villa 26</h2>
                    <p>Our Villa, with its homey setup and excellent amenities, creates a relaxing and comfortable ambience for our guests throughout their stay.</p>
                    <p>Our Villa, with its homey setup and excellent amenities, creates a relaxing and comfortable ambience for our guests throughout their stay.</p>
                </div><!--cl-->
                <div class="col-md-4">
                	<h2>Site Map</h2>
                    <div class="widget-content">
                        <ul class="list-unstyled">
                        <?php $first_part = $this->uri->segment(1);?>
                            <li class="<?php if($first_part=="home" || $first_part==""){echo 'active';}?>"><a href="<?php echo base_url();?>">Home</a></li>
                            <li class="<?php if($first_part=="gallery"){echo 'active';}?>"><a href="<?php echo base_url();?>gallery/view">Gallery</a></li>
                            <li class="<?php if($first_part=="rate"){echo 'active';}?>"><a href="<?php echo base_url();?>rate">Rate</a></li>
                            <li class="<?php if($first_part=="event"){echo 'active';}?>"><a href="<?php echo base_url();?>event">Event</a></li>
                            <li class="<?php if($first_part=="guestbook"){echo 'active';}?>"><a href="<?php echo base_url();?>guestbook">Guest Book</a></li>
                            
                        </ul>
                    </div>
                </div><!--cl-->
                
                <div class="col-md-4">
                	<h2>Contact Info</h2>
                    <div class="textwidget">
						<div class="textwidget">
							<p>+94 71 442 3918<br>
							+94 71 366 5733</p>
							<p>26, Sri Hemanandha Mawatha,<br>
							Bataganvila, Galle,Galle 80000</p>
							<p>Sun – Sat 24hr</p>
                            
							<div style="margin-top: 20px;">
								<div class="social_wrapper shortcode dark ">
                                    <ul class="list-unstyled list-inline">
                                        <li class="facebook list-inline-item"><a target="_blank" title="Facebook" href=""><i class="fa fa-facebook"></i></a></li>
                                        <li class="twitter list-inline-item"><a target="_blank" title="Twitter" href=""><i class="fa fa-twitter"></i></a></li>
                                        <li class="youtube list-inline-item"><a target="_blank" title="Youtube" href=""><i class="fa fa-youtube"></i></a></li>
                                        <li class="google list-inline-item"><a target="_blank" title="Google+" href=""><i class="fa fa-google-plus"></i></a></li>
                                        <li class="pinterest list-inline-item"><a target="_blank" title="Pinterest" href=""><i class="fa fa-pinterest"></i></a></li>
                                        <li class="instagram list-inline-item"><a target="_blank" title="Instagram" href=""><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                    <a class="back-to-top" href="#" style="display: inline;">&nbsp;</a>
								</div>
							</div>
						</div>
					</div>
                </div><!--cl-->
             </div><!--rw-->
         </div><!--section-container-->
     </section>
     
     <section class="section foot-bottom pd-tb-10">
        <div class="container-fluid section-container">
            <div class="row text-center">
                <div class="col-md-12">
                   	<p class="mg-b-0">© Copyright 2017 - www.thevilla26.com - . ​All Rights Reserved. Designed and Developed by Gridlite Solutions</p> 
                </div><!--cl-->
                
             </div><!--rw-->
         </div><!--section-container-->
     </section>
</footer>	
</div><!--site container-->

	<script src="<?php echo base_url();?>assets/js/jquery-3.2.1.slim.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/bliss-slider.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/caleandar.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/demo.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/lightgallery.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/custom.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/lightgallery.js" type="text/javascript"></script>
    
    <script type="text/javascript">
    $(function() {
        $("#slider").blissSlider({
            auto: 1,
            transitionTime: 500,
            timeBetweenSlides: 4000
        });
    });
    </script>
    <script>
		lightGallery(document.getElementById('lightgallery'));
	</script>
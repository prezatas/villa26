<div id="cover"> 
	<i class="circle-preloader"></i> 
    loading...
</div>
<div id="site-container">
<header id="main-header">
    <section class="section head-top pd-tb-10">
        <div class="container-fluid section-container">
            <div class="row">
                <div class="col-md-6">
                	
                </div><!--cl-->
                <div class="col-md-6 text-right">
                   <ul class="contactwrap list-inline mb-0">
                        <li class="list-inline-item"><label class="mg-b-0">Office&nbsp;</label>+94 71 442 3918</li>/
                        <li class="list-inline-item"><label class="mg-b-0">Hotline&nbsp;</label>+94 71 366 5733</li>
                   </ul>
                </div><!--cl-->
             </div><!--rw-->
         </div><!--section-container-->
     </section>
     
     <section class="section head-mid pd-tb-10">
        <div class="container-fluid section-container">
            <div class="row">
                <div class="col-md-3">
                    <div class="logowrap">
                        <img src="<?php echo base_url();?>/assets/img/png/logomain.png" class="img-fluid" alt="Responsive image" width="70px"/>
                    </div>
                </div><!--cl-->
                
                <div id="navbar" class="col-md-9">
                    <nav class="navbar navbar-expand-lg navbar-light">
                     
                      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                    
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                        <?php $first_part = $this->uri->segment(1);?>
                          <li class="nav-item <?php if($first_part=="home" || $first_part==""){echo 'active';}?>">
                            <a class="nav-link" href="<?php echo base_url();?>">Home</a>
                          </li>
                          <li class="nav-item <?php if($first_part=="tour"){echo 'active';}?>">
                            <a class="nav-link" href="<?php echo base_url();?>tour">Tour</a>
                          </li>
                          <li class="nav-item <?php if($first_part=="gallery"){echo 'active';}?> ">
                            <a class="nav-link" href="<?php echo base_url();?>gallery">Gallery</a>
                          </li>
                          <li class="nav-item <?php if($first_part=="rate"){echo 'active';}?> ">
                            <a class="nav-link" href="<?php echo base_url();?>rate">Rate</a>
                          </li>
                          <li class="nav-item <?php if($first_part=="event"){echo 'active';}?> ">
                            <a class="nav-link" href="<?php echo base_url();?>event">Event</a>
                          </li>
                          <li class="nav-item <?php if($first_part=="guestbook"){echo 'active';}?> ">
                            <a class="nav-link" href="<?php echo base_url();?>guestbook">Guest Book</a>
                          </li>
                          
                          <li class="nav-item <?php if($first_part=="booknow"){echo 'active';}?> booknowbtn">
                            <a class="nav-link" href="<?php echo base_url();?>booknow">Book Now</a>
                          </li>
                          
                       
                        </ul>
                        
                      </div>
                    </nav>
                    
                </div><!--cl-->
             </div><!--rw-->
         </div><!--section-container-->
     </section>
</header>
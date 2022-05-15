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
	<title>Wedding Choice / Dashboard</title>	
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden pace-done pace-done">

	<div  id="site-container" class="site-container">
	 
	  <?php $this->load->view("cc/include/header");?>
      
      <div class="app-body">
      	<?php $this->load->view("cc/include/sidebar");?>			
      		
            <main class="main">
            	<?php echo $breadcrumbs;?>
                <div class="container">
                	<div class="row">
                    	<div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-md-9 col-xs-9 text-right">
                                            <div class="huge">5</div>
                                            <div>System Users</div>
                                            <div class="small">(Active)</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo base_url();?>cc/user/manageuser">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
    
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div><!--cl-->
                        
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-md-9 col-xs-9 text-right">
                                            <div class="huge">1</div>
                                            <div>System Gallery</div>
                                            <div class="small">(Active)</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo base_url();?>cc/gallery/managegallery">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
    
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div><!--cl-->
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-md-9 col-xs-9 text-right">
                                            <div class="huge">7</div>
                                            <div>System Rate</div>
                                            <div class="small">(Active)</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo base_url();?>cc/rate/managerate">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
    
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div><!--cl-->
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-md-9 col-xs-9 text-right">
                                            <div class="huge">6</div>
                                            <div>System Event</div>
                                            <div class="small">(Active)</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo base_url();?>cc/event/manageevent">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
    
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
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
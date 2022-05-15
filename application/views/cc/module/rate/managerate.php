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
	<title>Wedding Choice / Manage Rate</title>	
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden pace-done pace-done">

	<div  id="site-container" class="site-container">
	 
	  <?php $this->load->view("cc/include/header");?>
      
      <div class="app-body">
      	<?php $this->load->view("cc/include/sidebar");?>			
      		
            <main class="main">
            	<?php echo $breadcrumbs;?>
                <div class="container">
                	<div id="error_box" class="error-box">
						
						<?php  echo "<div class=valid-error>".validation_errors(). "</div>";
							$success_msg= $this->session->flashdata('success_msg');
							$error_msg= $this->session->flashdata('error_msg');
        				?>
                        
                        <?php if($success_msg){ ?>
						  <div class="alert alert-success">
							<?php echo $success_msg; ?>
						  </div>
						<?php } ?>
                        
                        <?php if($error_msg){ ?>
                          <div class="alert alert-danger">
                            <?php echo $error_msg; ?>
                          </div>
                        <?php } ?>   
                    </div>
                	<div class="row">
                        <div class="col-md-12">
                        	<div class="card">
                            	
                                <div class="card-header">
                                	<div class="row">
                                    	<div class="col-md-6">
                                    		<i class="fa fa-align-justify"></i> Manage Rate Table
                                        </div>
                                        <div class="col-md-6">
                                            <div class="main-search">
                                                <form action="<?php echo base_url('cc/rate/managerate')?>" method="post">
                                                    <input  name="search" type="text" class="search-input" placeholder="Search for ..." value="<?= $search ?>">
                                                    <button name="submit" type="submit" value="submit" class="search-nav-button" ><span><i class="fa fa-search"></i></span></button>
                                                    <a  class="search-nav-button btn-refresh"  href="<?php if($search !=""){ echo base_url('cc/rate/unsetsearch');}else{echo base_url('cc/rate/managerate');}?>"><span><i class="fa fa-refresh"></i></span></a>
                                                </form>
                                            </div>
                                         </div>
                            		</div>
                                </div><!--card header-->
                                
                                <ul class="ul-btn-lists  mB-20">
                                    
                                    <li>
                                        <form name="deletefiles" action="<?php echo base_url('cc/rate/deleterateselectprocess')?>" method="post">
                                            <input type="button" name="selectall" value="SelectAll" class="btn-sr" onclick="checkAll()" style="margin-left:5px;">
                                            <input type="button" name="unselectall" value="DeSelectAll" class="btn-sr" onclick="uncheckAll()" style="margin-left:5px;">
                                            <input name="dsubmit" type="button" value="Delete Selected" class="btn-sr" style="margin-left:5px;" onclick="return confirmDeleteSubmit()">


                                    </li>
                                </ul>
                                        
                                <div class="card-body">
                                
                                	<table class="table table-responsive-sm table-bordered table-striped table-sm">
                                        		<thead>
                                        			<tr>
                                                    	<th>#</th>
                                                        <th>Image</th>
                                        				<th>Title</th>
                                                        <th>Bed</th>
                                                        <th>Activation</th>
                                                        <th>Action</th>
                                                        <th>Select</th>
                                        			</tr>
                                        		</thead>
                                        		
                                                <tbody>
                                                	<?php
													$pageno= $this->uri->segment(4); 
													$sno = $row+1;
                                                  	foreach($rates as $rate){
                                                  	$no=$sno++;
													?>
                                        			<tr>
                                                    	<td><?php echo $no;?></td>
                                                        <td><img src="<?php echo base_url();?>assets/img/rate/<?php echo $rate->r_image;?>" width="50px"/></td>
                                                        <td><?php echo $rate->r_title;?></td>
                                                        <td><?php echo $rate->r_bed;?></td>
                                                        <td class="active-td">
                                                        	<?php if($rate->r_status=="active"){?>
                                                            <a href="<?php echo base_url('cc/rate/rateactivation')?>?r_id=<?php echo $rate->r_id;?>&action=deactive&pageno=<?php echo $pageno;?>" onClick="return getConfirm('Deactivate')">
                                                                <button type="button" class="btn-red btn-active">Deactivate</button></a>
                                                            <?php } else{?>
                                                            <a href="<?php echo base_url('cc/rate/rateactivation')?>?r_id=<?php echo $rate->r_id; ?>&action=active&pageno=<?php echo $pageno;?>" onClick="return getConfirm('Activate')">
                                                                <button type="button" class="btn-green btn-active">Activate</button></a>
                                                        	<?php } ?>
                                                        </td>
                                                        <td>
                                                        <div class="action-buttons">
                                                            <a class="" href="<?php echo base_url('cc/rate/viewrate')?>?r_id=<?php echo $rate->r_id;?>">
                                                                <i class="ace-icon fa fa-search bigger-130"></i>
                                                            </a>

                                                            <a class="green" href="<?php echo base_url('cc/rate/updaterate')?>?r_id=<?php echo $rate->r_id;?>&pageno=<?php echo $pageno;?>">
                                                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                            </a>

                                                            

                                                            <a class="red" onclick="return confirmDelete()" href="<?php echo base_url('cc/rate/deleterateprocess')?>?r_id=<?php echo $rate->r_id;?>">
                                                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                        <td>
                                                        	<input type="checkbox" value="<?php echo $rate->r_id;?>" name="checklist[]" id="check_box">
                                                        </td>
                                        			</tr>
                                                    <?php }?>
                                                </tbody>
                                       		</table>
                                            
                                        </div><!--card body-->
                                        <div class="card-footer">
											<nav>
                                            <?php echo $links;?>
                                            </nav>
										</div><!--card footer-->
                                        
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
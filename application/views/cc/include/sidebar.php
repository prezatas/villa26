<div class="sidebar">
	<nav class="sidebar-nav">
		<ul class="nav">
        	<li class="nav-title">
            	Welcome&nbsp;:<br/><?php echo $this->session->userdata('user_lname');?>
                (<?php echo $this->session->userdata('user_ur_title');?>)
            </li>            

			<li class="divider"></li>
            <li class="nav-item open">
            	<a class="nav-link" href="<?php echo base_url();?>cc/login/dashboard"><i class="fa fa-dashboard"></i> Dashboard <span class="badge badge-primary">NEW</span></a>
            </li>
			<li class="divider"></li>
            <li class="nav-title">System</li>
            <li class="nav-item nav-dropdown">
            	<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user"></i>System User</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                    	<a class="nav-link" href="<?php echo base_url();?>cc/user/manageuser"><i class="fa fa-file-text"></i> Manage User</a>
                    </li>
                    <li class="nav-item">
                    	<a class="nav-link" href="<?php echo base_url();?>cc/user/adduser"><i class="fa fa-plus"></i>Add User</a>
                    </li>
                </ul>
            </li>
            
			<li class="nav-title">Gallery</li>
            
			<li class="nav-item nav-dropdown">
            	<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user"></i>Interior</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                    	<a class="nav-link" href="<?php echo base_url();?>cc/interior/manageinterior"><i class="fa fa-file-text"></i> Manage Interior</a>
                    </li>
                    <li class="nav-item">
                    	       <a class="nav-link" href="<?php echo base_url();?>cc/interior/addinterior"><i class="fa fa-plus"></i>Add Interior</a>
                    </li>
                </ul>
            </li>
            
            
            <li class="nav-item nav-dropdown">
            	<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user"></i>F & B</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                    	<a class="nav-link" href="<?php echo base_url();?>cc/fandb/managefandb"><i class="fa fa-file-text"></i> Manage F & B</a>
                    </li>
                    <li class="nav-item">
                    	       <a class="nav-link" href="<?php echo base_url();?>cc/fandb/addfandb"><i class="fa fa-plus"></i>Add F & B</a>
                    </li>
                </ul>
            </li>
            <li class="divider"></li>
            <li class="nav-title">Componants</li>
			
            <li class="nav-item nav-dropdown">
            	<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user"></i>Rate</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                    	<a class="nav-link" href="<?php echo base_url();?>cc/rate/managerate"><i class="fa fa-file-text"></i> Manage Rate</a>
                    </li>
                    <li class="nav-item">
                    	       <a class="nav-link" href="<?php echo base_url();?>cc/rate/addrate"><i class="fa fa-plus"></i>Add Rate</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
            	<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user"></i>Event</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                    	<a class="nav-link" href="<?php echo base_url();?>cc/event/manageevent"><i class="fa fa-file-text"></i> Manage Event</a>
                    </li>
                    <li class="nav-item">
                    	       <a class="nav-link" href="<?php echo base_url();?>cc/event/addevent"><i class="fa fa-plus"></i>Add Event</a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item nav-dropdown">
            	<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user"></i>Gbook</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                    	<a class="nav-link" href="<?php echo base_url();?>cc/guestbook/manageguestbook"><i class="fa fa-file-text"></i> Manage Gbook</a>
                    </li>
                    <li class="nav-item">
                    	       <a class="nav-link" href="<?php echo base_url();?>cc/guestbook/addguestbook"><i class="fa fa-plus"></i>Add Gbook</a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item nav-dropdown">
            	<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-user"></i>Booking</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                    	<a class="nav-link" href="<?php echo base_url();?>cc/booking/managebooking"><i class="fa fa-file-text"></i> Manage Booking</a>
                    </li>
                    <li class="nav-item">
                    	       <a class="nav-link" href="<?php echo base_url();?>cc/booking/addbooking"><i class="fa fa-plus"></i>Add Booking</a>
                    </li>
                </ul>
            </li>
            
			<li class="divider"></li>
            <li class="nav-title">Extras</li>

			
            <li class="nav-item nav-dropdown">
				<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-paper-plane-o"></i> Pages</a>
				<ul class="nav-dropdown-items">
                    <li class="nav-item">
                    	<a class="nav-link" href="views/pages/register.html" target="_top"><i class="fa fa-user"></i>Profile</a>
                    </li>
                    <li class="nav-item">
                    	<a class="nav-link" href="<?php echo base_url();?>cc/login/logout" target="_top"><i class="fa fa-lock"></i> Logout</a>
                    </li>
                
                </ul>
			</li>

		</ul>
	</nav>
	<button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
    <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
    <span class="navbar-toggler-icon"></span>
    </button>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
            	<a class="nav-link" href="<?php echo base_url();?>cc/login/dashboard">Dashboard</a>
            </li>
            <li class="nav-item px-3">
            	<a class="nav-link" href="<?php echo base_url();?>cc/user/manageuser">Users</a>
            </li>
            <li class="nav-item px-3">
            	<a class="nav-link" href="#">Profile</a>
            </li>
        </ul>
        
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item d-md-down-none">
            	<a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item d-md-down-none">
            	<a class="nav-link" href="#"><i class="icon-list"></i></a>
            </li>
            <li class="nav-item d-md-down-none">
            	<a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
            </li>
            <li class="nav-item dropdown">
            	<a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            	<img src="<?php echo base_url();?>assets/img/default/user.png" class="img-avatar">
            	</a>
            	<div class="dropdown-menu dropdown-menu-right">
            		
                    <div class="dropdown-header text-center">
                    	<strong>Settings</strong>
                    </div>
            
            		<a class="dropdown-item" href="<?php echo base_url();?>cc/login/logout"><i class="fa fa-lock"></i> Logout</a>
            	</div>
            </li>
        </ul>

</header>
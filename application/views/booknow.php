<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$arr=array();

function createDateRange($startDate, $endDate, $format = "Y-m-d")
{
    $begin = new DateTime($startDate);
    $end = new DateTime($endDate);

    $interval = new DateInterval('P1D'); // 1 Day
    $dateRange = new DatePeriod($begin, $interval, $end);

    $range = array();
    foreach ($dateRange as $date) {
        $range[] = $date->format($format);
    }

    return $range;
}
foreach ($bookings as $booking){
			$checkout=$booking->b_checkout;	
		

$arr1=createDateRange($booking->b_checkin, $booking->b_checkout);

foreach ($arr1 as $key => $value) {
   array_push($arr,$value);
	     
}
array_push($arr,$checkout);
}
//print_r($arr);

foreach ($arr as $value) {

	
	     
}

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    
    <?php $this->load->view("include/link");?>
	<title>Villa26 / Book Now</title>

	
</head>
<body>


	<?php $this->load->view("include/header");?>	
    	
    
     
<div id="site-content">
	
    
    <div class="booknow">
    	<div class="book-wrap mg-t-30">
        	<div class="container-fluid section-container">
            		<div class="row section-title text-center">
                        <div class="col-md-12">
                            <h2>Book Now</h2>
                        </div><!--cl-->
                        
                    </div><!--rw-->
                
                    
                    <div class="row">
                    	<div class="col-md-6">
                        	<p>Check all the available dates from calendar.</p>
                        	<div id="caleandar">
                        	 </div>
                        </div><!--cl-->
                        <div class="col-md-6">
                        	<div id="error_box" class="error-box">
								<?php
                                    
            
                                    $success_msg= $this->session->flashdata('success_msg');
                                    $error_msg= $this->session->flashdata('error_msg');
            
                                        if($success_msg){
                                          ?>
                                          <div class="alert alert-success">
                                            <?php echo $success_msg; ?>
                                          </div>
                                        <?php
                                        }
                                        if($error_msg){
                                          ?>
                                          <div class="alert alert-danger">
                                            <?php echo $error_msg; ?>
                                          </div>
                                          <?php
                                        }
                                ?>       
                
                            </div>
                         	<div class="bookform-wrap">
                                 <form name="form" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>booknow/addbooknowprocess" onsubmit="return addGuestbook()">
     
                                  <!--  Details -->
                                  <div class="form-group">
                                  	<div class="row">
                                        <div class="col-md-4">
                                          <div class="controls">
                                        	<label>Check In*</label>
                                        	<input type="date" name="checkin" class="form-control" value="<?php echo set_value('checkin'); ?>">
                                           <div class="form-error" id="error_checkin"><?php echo form_error('checkin'); ?></div>
                                          </div>
                                       </div><!--cl-->
                                       
                                       <div class="col-md-4">
                                          <div class="controls">
                                        	<label>Check Out*</label>
                                        	<input type="date" name="checkout" class="form-control" value="<?php echo set_value('checkout'); ?>">
                                            <div class="form-error" id="error_checkout"><?php echo form_error('checkout'); ?></div>
                                          </div>
                                       </div><!--cl-->
                                       <div class="col-md-4">
                                          <div class="controls">
                                        	<label>Country *</label>
                                        	<input type="text" name="country" maxlength="20"  class="form-control"  placeholder="Your Country Name" value="<?php echo set_value('country'); ?>">
                                            <div class="form-error" id="error_country"><?php echo form_error('country'); ?></div>
                                          </div>
                                       </div><!--cl-->
                                    </div>
                                  </div><!--form--group-->
                                  
                                  
                                  <div class="form-group">
                                  	<div class="row">
                                        <div class="col-md-6">
                                          <div class="controls">
                                        	<label>First Name *</label>
                                        	<input type="text" name="fname" maxlength="20"  class="form-control"  placeholder="First Name" value="<?php echo set_value('fname'); ?>">
                                            <div class="form-error" id="error_fname"><?php echo form_error('fname'); ?></div>
                                          </div>
                                       </div><!--cl-->
                                       <div class="col-md-6">
                                          <div class="controls">
                                        	<label>Last Name *</label>
                                        	<input type="text" name="lname" maxlength="20"  class="form-control"  placeholder="Last Name" value="<?php echo set_value('lname'); ?>">
                                            <div class="form-error" id="error_lname"><?php echo form_error('lname'); ?></div>
                                          </div>
                                       </div><!--cl-->
                                    </div>
                                  </div><!--form--group-->
                                  
                                  <div class="form-group">
                                  	<div class="row">
                                        <div class="col-md-6">
                                          <div class="controls">
                                        	<label>Number of Guests *</label>
                                        	<select name="nog" id="nog" class="form-control">
                                            	<option value="">No of Guest</option>
                                                <option value="1" <?php echo set_select('nog',1); ?>>1</option>
                                                <option value="2" <?php echo set_select('nog',2); ?>>2</option>
                                                <option value="3" <?php echo set_select('nog',3); ?>>3</option>
                                                <option value="4" <?php echo set_select('nog',4); ?>>4</option>
                                                <option value="5" <?php echo set_select('nog',5); ?>>5</option>
                                                <option value="6" <?php echo set_select('nog',6); ?>>6</option>
                                                <option value="7" <?php echo set_select('nog',7); ?>>7</option>
                                                <option value="8" <?php echo set_select('nog',8); ?>>8</option>
                                                <option value="9" <?php echo set_select('nog',9); ?>>9</option>
                                            </select>
                                            <div class="form-error" id="error_nog"><?php echo form_error('nog'); ?></div>
                                          </div>
                                       </div><!--cl-->
                                       <div class="col-md-6">
                                          <div class="controls">
                                        	<label>Number of Rooms *</label>
                                        	<select name="nor" id="nor" class="form-control">
                                            	<option value="">No of Room</option>
                                                <option value="1" <?php echo set_select('nor',1); ?>>1</option>
                                                <option value="2" <?php echo set_select('nor',2); ?>>2</option>
                                                <option value="3" <?php echo set_select('nor',3); ?>>3</option>
                                                <option value="4" <?php echo set_select('nor',4); ?>>4</option>
                                                
                                            </select>
                                            <div class="form-error" id="error_nor"><?php echo form_error('nor'); ?></div>
                                          </div>
                                       </div><!--cl-->
                                    </div>
                                  </div><!--form--group-->
                                  
                                  <div class="form-group">
                                  	<div class="row">
                                        <div class="col-md-6">
                                          <div class="controls">
                                        	<label>Email *</label>
                                        	<input type="email" name="email" maxlength="100" class="form-control" placeholder="Email" value="<?php echo set_value('email'); ?>">
                                            <div class="form-error" id="error_email"><?php echo form_error('email'); ?></div>
                                          </div>
                                       </div><!--cl-->
                                       <div class="col-md-6">
                                          <div class="controls">
                                        	<label>Telephone*</label>
                                        	<input type="text" name="tel" maxlength="15" class="form-control" placeholder="Eg: +94700000000" value="<?php echo set_value('tel'); ?>">
                                            <div class="form-error" id="error_lname"><?php echo form_error('tel'); ?></div>
                                          </div>
                                       </div><!--cl-->
                                    </div>
                                  </div><!--form--group-->
                                  
                                  <div class="form-group">
                                  	<div class="row">
                                        <div class="col-md-12">
                                          <div class="controls">
                                        	<label>Please describe your needs</label>
                                        	<textarea type="text"  maxlength="500" rows="7" class="form-control" id="comment" name="comment" placeholder="Comment" onkeyup="countChar(this)"><?php echo set_value('comment'); ?></textarea>
                                            <div id="charNum"></div>
                                            <div class="form-error" id="error_comment"><?php echo form_error('comment'); ?></div>
                                          </div>
                                       </div><!--cl-->
                                       <div class="col-md-6"></div><!--cl-->
                                    </div>
                                  </div><!--form--group-->
                                  
                                  <div class="form-group">
                                  	<div class="row">
                                        <div class="col-md-12">
                                          <div class="controls">
                                        	<input type="checkbox" name="agree" id="check"  value="agree"> Agree with the 
                                            <a href="" data-toggle="modal" data-target="#termsandconditions">
                                              terms and conditions
                                            </a>
                                            <div class="form-error" id="error_tandc"></div>
                                            <div class="modal fade" id="termsandconditions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Terms and Conditions</h5>
                                                  </div>
                                                  <div class="modal-body">
                                                    <ul>
                                                    	<li>
                                                        	Check-in<br/>
                                                        	1:00 PM - 11:30 PM
														</li>
														
                                                        <li>
                                                            Check-out<br/>
                                                            12:00 AM - 11:00 AM
                                                        </li>
                                                        <li>
                                                        	Cancellation / Prepayment<br/>
															Cancellation and prepayment policies vary according to room type. Please enter the dates of your stay and check what conditions apply to your preferred room.
                                                        </li>
                                                        <li>
                                                        	Pets<br/>
															Pets are allowed on request. Charges may apply.
                                                        </li>
                                                        <li>
                                                        	Cash only<br/>
															No credit cards accepted, only cash
                                                        </li>
                                                        <li>
                                                        	Children and Extra Beds<br/>
All children are welcome.
All children under 12 years are charged USD 5 per night for extra beds.
Any additional older children or adults are charged USD 5 per night for extra beds.
The maximum number of extra beds in a room is 1.
Any type of extra bed is upon request and needs to be confirmed by management.
                                                        </li>
                                                        <li>
                                                        	Additional fees are not calculated automatically in the total cost and will have to be paid for separately during your stay.
                                                        </li>
                                                        <li>
                                                        	Important Information<br/>
Please inform Villa 26 of your expected arrival time in advance. You can use the Special Requests box when booking, or contact the property directly using the contact details provided in your confirmation.
                                                        </li>
                                                    </ul>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                   
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            
                                            
                                            
                                            
                                            
                                          </div>
                                       </div><!--cl-->
                                       <div class="col-md-6"></div><!--cl-->
                                    </div>
                                  </div><!--form--group-->
                                      
                                  
                                      
                                  
                                  <div class="form-group">
                                  	<div class="row">
                                        <div class="col-md-12">
                                            <div class="">
                                                <button class="formbtn" id="btncheck"><a class="btn btn-white">Book Now</a></button>
                                            </div>
                                        </div><!--col-->
                                   </div> <!--row-->
                                  </div> <!-- /.form-group -->
                                </form> 
                            </div>	   
                        </div><!--cl-->
                    </div><!--rw-->
              </div><!--section-container-->
        </div><!---booknow-->
        
</div><!--site content-->

<?php $this->load->view("include/footer");?>
<script type="text/javascript">
		<?php 
		
		
		 
		 /*	echo "var d = new Date('$booking->b_checkin');";
			echo "year = d.getFullYear();";
			echo "month = d.getMonth();";
			echo "day = d.getDate();";	
			
			echo "var d1 = new Date('$booking->b_checkout');";
			echo "year1 = d1.getFullYear();";
			echo "month1 = d1.getMonth();";
			echo "day1 = d1.getDate();";	*/
			
		echo "var events = [";
		
		
foreach ($arr as $value) {
	  $arr2=explode('-',$value);
  
    $year=$arr2[0];
	$month=$arr2[1]-1;
	$day=$arr2[2];
	echo "{'Date': new Date($year, $month, $day), 'Title': 'Booked.'},";
	     
}
		
		/*echo "{'Date': new Date(year, month, day), 'Title': 'Doctor appointment at 3:25pm.'},";
		for($i=1;$i<=2;$i++){
			echo "{'Date': new Date(2018, 03, $i), 'Title': 'Doctor appointment at 3:25pm.'},";
		}
		*/
		//echo "{'Date': new Date(year1, month1, day1), 'Title': 'Doctor appointment at 3:25pm.'},"; 
		echo "];";
		
		
		


		
		?>
	  

	
	var settings = {};
	var element = document.getElementById('caleandar');
	caleandar(element, events, settings);
    </script>
</body>
</html>
// JavaScript Document

/* stickey header*/

$(function(){
        // Check the initial Poistion of the Sticky Header
        var stickyHeaderTop = $('.head-mid').offset().top;
		var header = $(".head-mid");

        $(window).scroll(function(){
                if( $(window).scrollTop() > stickyHeaderTop ) {
                        header.addClass("fixed");
                } else {
                       // $('#menuwrap').css({position: 'static', top: '0px'});
                       // $('#menuwrap').css('display', 'block');
					   header.removeClass("fixed");
                }
        });
  });

//preloader

$(window).on('load', function () {
$("#cover").fadeOut(1750);
});
//back to top
	// Scroll page bottom to top
	$(window).scroll(function() {
		if ($(this).scrollTop() > 500) {
			$('.back-to-top').fadeIn(500);
		} else {
			$('.back-to-top').fadeOut(500);
		}
	});							
	$('.back-to-top').click(function(event) {
		event.preventDefault();		
		$('html, body').animate({scrollTop: 0}, 800);
	});		




//count character
	//count characters

function countChar(val) {
	var len = val.value.length;
	if (len >= 500) {
	  val.value = val.value.substring(0, 500);
	} else {
	  $('#charNum').text(500 - len);
	}
  };
//btn disable until check
$('#check').change(function () {
    $('#btncheck').prop("disabled", !this.checked);
}).change()

function addGuestbook() {
	
    var name = document.forms["form"]["name"].value;
	var email = document.forms["form"]["email"].value;
	var comments = document.forms["form"]["comments"].value;

    
    if (name == "") {
        document.getElementById("error_name").innerHTML = "This field is required !";
        return false;
    }
	
	if (email == "") {
        document.getElementById("error_email").innerHTML = "This field is required !";
        return false;
    }
	if (comments == "") {
        document.getElementById("error_comments").innerHTML = "This field is required !";
        return false;
    }
	
  
}

function addBooking() {
	
    var checkin = document.forms["form"]["checkin"].value;
	var checkout = document.forms["form"]["checkout"].value;
	var country = document.forms["form"]["country"].value;
	var firstname = document.forms["form"]["firstname"].value;
	var lastname = document.forms["form"]["lastname"].value;
	var nop = document.forms["form"]["nop"].value;
	var nor = document.forms["form"]["nor"].value;
	var email = document.forms["form"]["email"].value;
	var telephone = document.forms["form"]["telephone"].value;
	var agree = document.forms["form"]["agree"].value;

	var ToDate = new Date();
    
    if (checkin == "") {
        document.getElementById("error_checkin").innerHTML = "This field is required !";
        return false;
    }
	if (new Date(checkin).getTime() < ToDate.getTime()) {
        document.getElementById("error_checkin").innerHTML = "Please select valid date !";
        return false;
    }
	
	if (checkout == "") {
        document.getElementById("error_checkout").innerHTML = "This field is required !";
        return false;
    }
	if (new Date(checkout).getTime() < ToDate.getTime()) {
       document.getElementById("error_checkout").innerHTML = "Please select valid date !";
        return false;
    }
	if (country == "") {
        document.getElementById("error_country").innerHTML = "This field is required !";
        return false;
    }
	if (firstname == "") {
        document.getElementById("error_firstname").innerHTML = "This field is required !";
        return false;
    }
	
	if (lastname == "") {
        document.getElementById("error_lastname").innerHTML = "This field is required !";
        return false;
    }
	if (nop == "") {
        document.getElementById("error_nop").innerHTML = "This field is required !";
        return false;
    }
	if (nor == "") {
        document.getElementById("error_nor").innerHTML = "This field is required !";
        return false;
    }
	if (email == "") {
        document.getElementById("error_email").innerHTML = "This field is required !";
        return false;
    }
	if (telephone == "") {
        document.getElementById("error_telephone").innerHTML = "This field is required !";
        return false;
    }
	
	if (form.agree.checked==false) {
        document.getElementById("error_tc").innerHTML = "You must agree with our terms and conditions!";
        return false;
    }
	
 
}

jQuery(document).ready(function($) {

$(document).ready(function($) {

	// hide messages 
	$(".error").hide();
	$(".failure").hide();
	$(".success").hide();
	
	$('#contactform input').click(function(e) {
        $(".error").fadeOut();
    });
	
	// on submit...
	$("#submit").click(function(event) {
		event.stopPropagation();   
        event.preventDefault();
		$(".error").hide();

		//required:
		
		//name
		var name = $("input#name").val();
		if(name == ""){
			//$("#error").fadeIn().text("Name required.");
			$('#fname').fadeIn('slow');
			$("input#name").focus();
			return false;
		}
		
		//subject (check if entered anything)
		var subject = $("input#subject").val();
		//email (check if entered anything)
		if(subject == ""){
			//$("#error").fadeIn().text("Subject required");
			$('#fsubject').fadeIn('slow');
			$("input#subject").focus();
			return false;
		}
		
		//email (check if entered anything)
		var email = $("input#email").val();
		//email (check if entered anything)
		if(email == ""){
			//$("#error").fadeIn().text("Email required");
			$('#fmail').fadeIn('slow');
			$("input#email").focus();
			return false;
		}
		
		//email (check if email entered is valid)

		if (email !== "") {  // If something was entered
			if (!isValidEmailAddress(email)) {
				$('#fmail').fadeIn('slow'); //error message
				$("input#email").focus();   //focus on email field
				return false;  
			}
		} 

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
};

		
		
		
		// comments
		var comments = $("#msg").val();
		
		if(comments == ""){
			//$("#error").fadeIn().text("Email required");
			$('#fmsg').fadeIn('slow');
			$("input#msg").focus();
			return false;
		}



        $.ajax({
		type: $("#contactform").attr('method'),
		url: $("#contactform").attr('action'),
		data: $("#contactform").serialize(),
		success: function(data) {
		if(data == 'success')
		{
           $(".success").fadeIn();
		   $(".failure").hide();        
	 	   $("#contactform").fadeOut();
		}
		else
		{
		  $(".failure").fadeIn();
		  $(".success").hide();
		  
		}

		}
		});






	});  
		
		
	// on success...
	 function success(){

	 	//alert('test');

	 }
	
    return false;
});

});
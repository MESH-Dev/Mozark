$(document).ready(function($) {

	// hide messages 
	$(".error").hide();
	$(".success").hide();
	
	$('#contactform input').click(function(e) {
        $(".error").fadeOut();
    });
	
	// on submit...
	$("#contactform #submit").click(function() {
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
		
		//email (check if entered anything)
		var email = $("input#email").val();
		//email (check if entered anything)
		if(email == ""){
			//$("#error").fadeIn().text("Email required");
			$('#femail').fadeIn('slow');
			$("input#email").focus();
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

		//email (check if email entered is valid)

		if (email !== "") {  // If something was entered
			if (!isValidEmailAddress(email)) {
				$('#femail').fadeIn('slow'); //error message
				$("input#email").focus();   //focus on email field
				return false;  
			}
		} 

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
};

		
		
		
		// comments
		var comments = $("#message").val();
		
		if(comments == ""){
			//$("#error").fadeIn().text("Email required");
			$('#fmessage').fadeIn('slow');
			$("input#message").focus();
			return false;
		}
	});  
		
		
	// on success...
	 function success(){
	 	$("#success").fadeIn();
	 	$("#contactForm").fadeOut();
	 }
	
    return false;
});


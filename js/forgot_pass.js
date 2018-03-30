$(document).ready(function() {
    var errorEmail = [];
    $("#next").attr("disabled", true);

    // check if email field is changed
    $("#forgotEmail").change(function(){  
        $(".tickEmail").css("display", "none");
        var email = $("#forgotEmail").val();
        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");
        $("#ema").text("");
        var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i

        if (email.length ==0 || !pattern.test(email)) {
        $("#ema").text("Invalid Email ID. ");
        errorEmail[0] = 0;
        } else {
        $.ajax({
        	//The URL for the request
        	url: "../api/email_check.php",
        	//The data to send 
        	data: {
        		email: $("#forgotEmail").val()
        	},
        	// Whether this is a POST or GET request
        	type: "POST",    
        	// The type of data we expect back
    		dataType : "json",
            success: function(response){
                var resp = response.email;
                if(resp === '') {
                    resp = "This email is not registered with us!! Please SignUp first."
                    errorEmail[0] = 0;
                } else {
                    errorEmail[0] = 1;
                    $("#next").attr("disabled", false);
                    resp ="";
                }
                
                $("#ema").text(resp);
            }
        });
        }

	});

});
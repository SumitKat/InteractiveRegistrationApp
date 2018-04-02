$(document).ready(function() {
    var errorEmail = [];
    var flag = false;

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
                    resp ="";
                }
                
                $("#ema").text(resp);
            }
        });
        }

	});

        $("#forgotForm").submit(function(e){
            if(errorEmail[0] == 0 || errorEmail.length == 0) {
                e.preventDefault();
                $("#ema").text("Please fill the email correctly");
            }
     });

});
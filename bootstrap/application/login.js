$(document).ready(function(){

$('#loginform').validate({
    rules: {
        email_id: 
        {
            required: true,
        },
		password: 
        {
            required: true,
        },
		
    },
messages : {
   email_id: {
    required: "Enter Your  Email Id"
    },
	password: {
    required: "Enter The Password"
    },
 },
  
    highlight: function(element) {
        $(element).closest('.form-control').addClass('error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-control').removeClass('error');
    },
    
 });    


  });

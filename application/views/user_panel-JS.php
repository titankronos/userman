<!-- Custom JavaScript for user_panel.php page -->
<script type="text/javascript">
$(document).ready(function() {
		
		jQuery.validator.addMethod("matchingPasswords", 
			function(value, element) {
				var pass1 = $("input[name=password1]");
				var valid = ( ( element.value === pass1.val() ) || ( element.value === "" ) && ( pass1.val() === "" ) );
				if ( !valid  ) 
				{ 
					return false; 
				} 
				return true; 
			}, "Please ensure both passwords are correct." 
		); 

		
		jQuery.validator.addMethod("noneSelected", 
			function(value, element) { 
				if (element.value == "None") 
				{ 
					return false; 
				} 
				return true; 
			}, "Please select an option." 
		); 
		
		 $('#contactInfo').validate({
		 		 ignore: ":disabled",
		 		 onfocusout: function(element) { $(element).valid(); },
		 		 rules: {
            "username": {
                minlength: 10,
                required: true
            },
            "first_name": {
                required: true
            },
            "last_name": {
                required: true
            },
            "phone": {
                maxlength: 10,
                minlength: 10,
                required: true,
                number: true,
                digits: true
            },
            "cur_street": {
            	required: true
            },
            "cur_state": {
            	noneSelected: true
            },
            "cur_city": {
            	required: true
            },
            "cur_zip": {
            	required: true
            },
            "perm_street": {
            	required: true
            },
            "perm_state": {
            	noneSelected: true
            },
            "perm_city": {
            	required: true
            },
            "perm_zip": {
            	required: true
            },
            "password2": {
            	matchingPasswords: true
            }
            
        },
        messages: {
        	"phone": "Please enter a valid cellphone number.",
        	"cur_street": "Please enter a valid address.", 
					"cur_state": "Please select a valid state.",
					"cur_city": "Please enter a valid city.",
					"cur_zip": "Please enter a valid zip code.",
        	"perm_street": "Please enter a valid address.", 
					"perm_state": "Please select a valid state.",
					"perm_city": "Please enter a valid city.",
					"perm_zip": "Please enter a valid zip code."
        }
    });
		
		
		
  $('#copy_address').click(function() {
  // Run this only if the copy address checked is clicked
    if ($("#copy_address").is(":checked")) {
      // If the copy address is checked copy the values
      $("input[name=perm_street]").val($("input[name=cur_street]").val());
      $("input[name=perm_street]").attr('readonly', true);
      $("input[name=perm_city]").val($("input[name=cur_city]").val());
      $("input[name=perm_city]").attr('readonly', true);
      $("input[name=perm_zip]").val($("input[name=cur_zip]").val());
      $("input[name=perm_zip]").attr('readonly', true);
      $("#perm_state").val($("#cur_state").val());
      $("#perm_state").attr('readonly', true);
    } else { // Clear out the boxes when unchecked
      $("input[name=perm_street]").val("");
      $("input[name=perm_street]").attr('readonly', false);
      $("input[name=perm_city]").val("");
      $("input[name=perm_city]").attr('readonly', false);
      $("input[name=perm_zip]").val("");
      $("input[name=perm_zip]").attr('readonly', false);
      $("#perm_state").val("None");
      $("#perm_state").attr('readonly', false);
    }
  });
});
</script>


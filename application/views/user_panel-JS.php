<!-- Custom JavaScript for user_panel.php page -->
<script type="text/javascript">
$(document).ready(function() {
  $('#copy_address').click(function() {
  // Run this only if the copy address checked is clicked
    if ($("#copy_address").is(":checked")) {
      // If the copy address is checked copy the values
      $("input[name=perm_street]").val($("input[name=cur_street]").val());
      $("input[name=perm_city]").val($("input[name=cur_city]").val());
      $("input[name=perm_zip]").val($("input[name=cur_zip]").val());
      $("#perm_state").val($("#cur_state").val());
    } else { // Clear out the boxes when unchecked
      $("input[name=perm_street]").val("");
      $("input[name=perm_city]").val("");
      $("input[name=perm_zip]").val("");
      $("#perm_state").val("None");
    }
  });
});
</script>


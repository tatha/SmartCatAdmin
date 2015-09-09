// JavaScript Document
$(document).ready(function(e) {
    
	var role = $("#role");
	
	var permForm = $("#permForm");
	var saveBtn = $("#saveBtn");
	
	role.change(function(e) {
        window.location.href = 'manage_permission.php?role='+role.val();
    });
	
	saveBtn.click(function(e) {
        permForm.submit();
    });
	
	
});
// JavaScript Document
$(document).ready(function(){
	
	var changePasswd = $("#changePasswd");
	
	var oldPassword = $("#oldPassword");
	var newPassword = $("#newPassword");
	var newPassword2 = $("#newPassword2");
	
	var saveBtn = $("#saveBtn");
	
	saveBtn.click(ChangePassword);
	
	function ChangePassword() {
				
		changePasswd.submit();
		
	}
	
	changePasswd.validate({
		rules: {
			oldPassword: {
				required: true
			},
			newPassword: {
				required: true
			},
			newPassword2: {
				required: true,
				equalTo: "#newPassword"
			}
		},
		messages: {
			oldPassword: {
				required: "Please provide your old password"
			},
			newPassword: {
				required: "Please provide a new password"
			},
			newPassword2: {
				required: "Please confirm new password",
				equalTo: "Confirm password should be same as new password"
			}
		}   
	});
	
})
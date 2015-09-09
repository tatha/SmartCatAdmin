// JavaScript Document
$(document).ready(function(){
	
	var editProfile = $("#editProfile");
	
	var u_fname = $("#u_fname");
	var u_lname = $("#u_lname");
	var u_email = $("#u_email");
	var u_contact = $("#u_contact");
	var u_role = $("#u_role");
	var up_board = $("#up_board");
	var up_class = $("#up_class");
	var up_subject = $("#up_subject");
	
	var up_board = $("#up_board");
	var up_class = $("#up_class");
	
	var saveBtn = $("#saveBtn");
	
	up_board.change(GetClass);
	saveBtn.click(SaveProfile);
	
	function GetClass() {
		$.ajax({
			type:'POST',
			url:"manage_roster_ajax.php",
			data:"action=getClass&b_id="+up_board.val(),
			success:function(result) {
				up_class.html(result);
			}
		})
	}
	
	function SaveProfile() {
		
		switch(u_role.val()) {
			case '3': {
				up_subject.rules( "add", {
				  required: true,
				  messages: {
					required: "Please select your subject(s)"
				  }
				});
				up_class.rules( "remove" );
				break;
			}
			case '4': {
				up_class.rules( "add", {
				  required: true,
				  messages: {
					required: "Please select your class"
				  }
				});
				up_subject.rules( "remove" );
				break;
			}
			default: {
				console.log('Default Case');
			}
		}
		
		editProfile.submit();
		
	}
	
	editProfile.validate({
		rules: {
			u_fname: {
				required: true
			},
			u_lname: {
				required: true
			},
			u_email: {
				required: true,
				email: true
			},
			u_contact: {
				required: true,
				number: true,
				minlength: 10
			},
			up_board: {
				required: true
			}
		},
		messages: {
			u_fname: {
				required: "Please provide your first name"
			},
			u_lname: {
				required: "Please provide your last name"
			},
			u_email: {
				required: "Please provide your email",
				email: "Please provide valid email"
			},
			u_contact: {
				required: "Please provide your contact number",
				number: "Please provide valid contact number",
				minlength: "Please provide valid contact number"
			},
			up_board: {
				required: "Please provide your board"
			}
		}   
	});
	
})
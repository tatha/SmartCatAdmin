// JavaScript Document
$(document).ready(function(){
	
	//JS Variable
	var id;
	var addBtn = $("#addBtn");
	
	var userList = $("#userList");
	
	var actnLink = $(".actnLink");
	
	//JS Triggers
	addBtn.click(function(){
		EditUser('');
	});
	actnLink.click(DoAction);
	
	//JS Init
	userList.dataTable({
		"bPaginate":false,
		"bInfo":false,
		"sDom":'flrt',
		"bJQueryUI": false,
		"aoColumnDefs": [
		  { "bSortable": false, "bSearchable": false, "bVisible": true, "aTargets": [ 5 ] }
		],
		"bAutoWidth": false,
		"bLengthChange": false,
		"fnInitComplete": function(oSettings, json) {
		  $('.dataTables_filter>label>input').attr('id', 'search');
		}
	});
	
	//JS Functions
	function DoAction() {
		var b = this.id.split('_');
		switch(b[0]) {
			case 'edit': {
				EditUser(b[1]);
				break;
			}
			case 'delete': {
				$.alert({
					type:'confirm',
					title:'Delete Confirmation',
					text:'<p>Are you sure to delete this?</p>',
					callback:function(){
						$.ajax({
							type:'POST',
							url:"manage_user_ajax.php",
							data:"action=deleteUser&u_id="+b[1],
							success:function(result) {
								$.alert.close();
								$.alert({
									type:'alert',
									title:'Delete Confirmation',
									text:'<p>User has been deleted.</p>',
									callback:function(){
										window.location.reload();
									}
								})
							}
						})
					}
				})
				break;
			}
			case 'passwd': {
				$.alert({
					type:'confirm',
					title:'Reset Confirmation',
					text:'<p>Are you sure to reset account password?</p>',
					callback:function(){
						$.ajax({
							type:'POST',
							url:"manage_user_ajax.php",
							data:"action=resetUserPassword&u_id="+b[1],
							success:function(result) {
								$.alert.close();
								$.alert({
									type:'alert',
									title:'Reset Confirmation',
									text:'<p>Password has been reset to default.</p>',
									callback:function(){
										window.location.reload();
									}
								})
							}
						})
					}
				})
				break;
			}
			case 'unlock': {
				$.ajax({
					type:'POST',
					url:"manage_user_ajax.php",
					data:"action=unlockUser&u_id="+b[1],
					success:function(result) {
						$.alert.close();
						$.alert({
							type:'alert',
							title:'Reset Confirmation',
							text:'<p>User has been unlocked.</p>',
							callback:function(){
								window.location.reload();
							}
						})
					}
				})
				break;
			}
			default: {
				
			}
		}
		
	}
	
	function EditUser(id) {
		
		$.ajax({
			type:'POST',
			url:"manage_user_ajax.php",
			data:"action=openModal&u_id="+id,
			success:function(result) {
				
				var modaltitle;
				if(id=='') {
					modalTitle = 'Add New User';
				} else {
					modalTitle = 'Edit User';
				}
				$.modal({
					title:modalTitle,
					html:result
				})
				
				//Rebind AJAX
				$(document).ready(function(){
					
					var genRandBtn = $("#genRandBtn");				
					var saveBtn = $("#saveBtn");
					var cancelBtn = $("#cancelBtn");
					
					/*var validateMethod = $.fn.validate;
					$.fn.validate = function (o) {
						if (o && o.rules) { 
							for (var name in o.rules) {
								var rule = o.rules[name]; 
								console.log(rule.required);
								if (rule.required == true) { 
									//var label = $('label[for=' + name + ']'); 
									var label = $('#'+name).parent().parent().children().eq(0).find('span'); 
									label.text("*"); 
								} 
							} 
						} 
						return $.proxy(validateMethod, this)(o); 
					};*/
					
					$("#userForm").validate({
						rules: {
							u_username: {
								required: function() {
									return $("#u_id").val() == ''
								}
							},
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
							u_password: {
								required: function() {
									return $("#u_id").val() == ''
								},
								minlength:6
							},
							u_password_2: {
								required: function() {
									return $("#u_id").val() == ''
								},
								equalTo: "#u_password"
							},
							u_role: {
								required: true
							}
						},
						messages: {
							u_username: {
								required: "Please provide username"
							},
							u_fname: {
								required: "Please provide first name"
							},
							u_lname: {
								required: "Please provide last name"
							},
							u_email: {
								required: "Please provide email address",
								email: "Please provide valid email address"
							},
							u_password: {
								required: "Please provide a password",
								minlength: "Password should be atleast 6 charecter long"
							},
							u_password_2: {
								required: "Please provide confirm password",
								equalTo: "Confirm password should be same as the password"
							},
							u_role: {
								required: "Please select user role"
							}
						},
						errorLabelContainer: "#messageBox",
						wrapper: "li"
					});
					
					saveBtn.click(SaveUser);
					cancelBtn.click(function(){
						$.modal.close();
					})
					
					$(":input").blur(function(){
						if($(this).hasClass('error')) {
							ValidateUser();
						}
					});
					$(":input").change(function(){
						if($(this).hasClass('error')) {
							ValidateUser();
						}
					});
					
					genRandBtn.click(function(){
						var text = "";
						var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
						for( var i=0; i < 10; i++ )
							text += possible.charAt(Math.floor(Math.random() * possible.length));
						$("#randString").text('Generated Password : '+text);
						$("#u_password").val(text);
						$("#u_password_2").val(text);
					})
					
					function SaveUser() {
						
						if(!ValidateUser()) {
							return false;
						}
						
						var fd = $("#userForm").serialize();
						$.ajax({
							type:'POST',
							url:"manage_user_ajax.php",
							data:fd,
							success: function(result) {
								if(result) {
									$.modal.close();
									$.alert({
										type:'alert',
										title:'Success',
										text:"<p>User updated.</p>",
										callback:function() {
											window.location.reload();
										}
									})
								} else {
									$.alert({
										type:'alert',
										title:'Error',
										text:"<p>Failed to update list. Try again...</p>"
									})
								}
							}
						})
					}
					
					
					function ValidateUser() {
						
						if($("#userForm").valid()) {
							return true;
						} else {
							return false;
						}
					
					}
					
				})
				
			}
		})
		
	}
	
	function RequiredValidation(param1) {
		if($.trim(param1.val())=='') {
			return false;
		} else {
			return true;
		}
	}
	
})
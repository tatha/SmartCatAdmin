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
		"sDom":'lrt',
		"bJQueryUI": false,
		"aoColumnDefs": [
		  { "bSortable": false, "bSearchable": false, "bVisible": true, "aTargets": [ 7 ] }
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
					
					var saveBtn = $("#saveBtn");
					var cancelBtn = $("#cancelBtn");
					
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
						
						var errFlag = 0;
						
						
						var u_role = $("#u_role");
						
						
						if(RequiredValidation(u_role)) {
							u_role.removeClass("error");
						} else {
							u_role.addClass("error");
							errFlag++;
						}
						
						if(errFlag==0) {
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
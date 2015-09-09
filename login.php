<?php require_once('includes/head.php'); ?>
<?php
$return = false;
$message = 'Please enable javascript in your browser.';
if(isset($_REQUEST)&&$_REQUEST['key']=='login') {
	$return = $instAuth->Login($_REQUEST);
	switch($return) {
		case '0': {
			$message = 'Please provide both username and password';
			break;
		}
		case '1': {
			$message = 'Please provide valid username and password';
			break;
		}
		case '2': {
			$message = 'User has been temporarily disabled. Please contact system admin.';
			break;
		}
		default: {
			
		}
	}
}
?>
<!doctype html>
<html>
<head>
<?php require_once('includes/html_head.php'); ?>
</head>

<body class="loginPage">
<div class="container-fluid">
  <div id="header">
    <div class="row-fluid">
      <div class="navbar">
        <div class="navbar-inner">
          <div class="container"> <a class="brand" href="index.html">Smart <span class="slogan">Cat</span></a> </div>
        </div>
        <!-- /navbar-inner --> 
      </div>
      <!-- /navbar --> 
    </div>
    <!-- End .row-fluid --> 
    
  </div>
  <!-- End #header --> 
  
</div>
<!-- End .container-fluid -->

<div class="container-fluid">
  <div class="loginContainer">
  	<div class="clearfix">&nbsp;</div>
  	<?php if($return!==false) { ?>
  	<div class="alert alert-error">
        <button class="close" data-dismiss="alert">×</button>
        <strong><?=$message?></strong>
    </div>
    <?php } ?>
    <form class="form-horizontal" name="loginForm" id="loginForm" action="" method="post">
    <input type="hidden" name="key" value="login">
      <div class="form-row row-fluid">
        <div class="span12">
          <div class="row-fluid">
            <label class="form-label span12" for="username"> Username: <span class="icon16 icomoon-icon-user-3 right gray marginR10"></span> </label>
            <input class="span12" id="username" type="text" name="username" value="" placeholder="Your Username" tabindex="1"/>
          </div>
        </div>
      </div>
      <div class="form-row row-fluid">
        <div class="span12">
          <div class="row-fluid">
            <label class="form-label span12" for="password"> Password: <span class="icon16 icomoon-icon-locked right gray marginR10"></span> <span class="forgot"><a href="#">Forgot your password?</a></span> </label>
            <input class="span12" id="password" type="password" name="password" value="" placeholder="Your Password" tabindex="2"/>
          </div>
        </div>
      </div>
      <div class="form-row row-fluid">
        <div class="span12">
          <div class="row-fluid">
            <div class="form-actions">
              <div class="span12 controls">
                <input type="checkbox" id="keepLoged" value="Value" class="styled" name="logged" tabindex="4"/>
                Keep me logged in
                <button type="submit" class="btn btn-info right" id="loginBtn" tabindex="3"><span class="icon16 icomoon-icon-enter white"></span> Login</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- End .container-fluid --> 

<script type="text/javascript">
// document ready function
$(document).ready(function() {
	$("input, textarea, select").not('.nostyle').uniform();
	$("#loginForm").validate({
		rules: {
			username: {
				required: true
			},
			password: {
				required: true
			}  
		},
		messages: {
			username: {
				required: "Please provide your username"
			},
			password: {
				required: "Please provide your password"
			}
		}   
	});
});
</script> 

</body>
</html>
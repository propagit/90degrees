<!DOCTYPE html>
<html lang="en-us" id="lock-page">
	<head>
		<meta charset="utf-8">
		<title> FlareRetail - Admin</title>
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- #CSS Links -->
		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url() . ASSETS_PATH;?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url() . ASSETS_PATH;?>css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url() . ASSETS_PATH;?>css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url() . ASSETS_PATH;?>css/smartadmin-skins.min.css">

		<!-- SmartAdmin RTL Support is under construction
			 This RTL CSS will be released in version 1.5
		<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url() . ASSETS_PATH;?>css/smartadmin-rtl.min.css"> -->

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url() . ASSETS_PATH;?>css/your_style.css"> -->

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url() . ASSETS_PATH;?>css/demo.min.css">

		<!-- page related CSS -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url() . ASSETS_PATH;?>css/lockscreen.min.css">

		<!-- #FAVICONS -->
		<link rel="shortcut icon" href="<?=base_url() . ASSETS_PATH;?>img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?=base_url() . ASSETS_PATH;?>img/favicon/favicon.ico" type="image/x-icon">

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<!-- #APP SCREEN / ICONS -->
		<!-- Specifying a Webpage Icon for Web Clip
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="<?=base_url() . ASSETS_PATH;?>img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?=base_url() . ASSETS_PATH;?>img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?=base_url() . ASSETS_PATH;?>img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?=base_url() . ASSETS_PATH;?>img/splash/touch-icon-ipad-retina.png">

		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="<?=base_url() . ASSETS_PATH;?>img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="i<?=base_url() . ASSETS_PATH;?>mg/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="<?=base_url() . ASSETS_PATH;?>img/splash/iphone.png" media="screen and (max-device-width: 320px)">

	</head>

	<body>

		<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<form id="login-form" class="lockscreen animated flipInY smart-form client-form">
              <header>
                  Sign In
              </header>

              <fieldset>

                  <section>
                      <label class="label">Username</label>
                      <div class="login-input">
                      <label class="input"> <i class="icon-append fa fa-user"></i>
                          <input type="text" name="username">
                          <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter your username</b></label>
                      </div>
                  </section>

                  <section>
                      <label class="label">Password</label>
                      <div class="login-input">
                      <label class="input"> <i class="icon-append fa fa-lock"></i>
                          <input type="password" name="password">
                          <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                      </div>
                  </section>
              </fieldset>
              <footer>
                  <button type="button" class="btn btn-primary" id="btn-login">
                      Sign in
                  </button>
              </footer>

			</form>

		</div>

		<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script src="<?=base_url() . ASSETS_PATH;?>js/plugin/pace/pace.min.js"></script>

	    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script> if (!window.jQuery) { document.write('<script src="<?=base_url() . ASSETS_PATH;?>js/libs/jquery-2.0.2.min.js"><\/script>');} </script>

	    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script> if (!window.jQuery.ui) { document.write('<script src="<?=base_url() . ASSETS_PATH;?>js/libs/jquery-ui-1.10.3.min.js"><\/script>');} </script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events
		<script src="<?=base_url() . ASSETS_PATH;?>js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

		<!-- BOOTSTRAP JS -->
		<script src="<?=base_url() . ASSETS_PATH;?>js/bootstrap/bootstrap.min.js"></script>

		<!-- JQUERY VALIDATE -->
		<script src="<?=base_url() . ASSETS_PATH;?>js/plugin/jquery-validate/jquery.validate.min.js"></script>

		<!-- JQUERY MASKED INPUT -->
		<script src="<?=base_url() . ASSETS_PATH;?>js/plugin/masked-input/jquery.maskedinput.min.js"></script>

		<!--[if IE 8]>

			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

		<![endif]-->

		<script>
		$(function(){
			$('#btn-login').click(function(){
				$.ajax({
					type: "POST",
					url: '<?=ajax_url();?>login/validate_admin',
					data: $('#login-form').serialize(),
					success: function(html) {
						if(html == 'failed'){
							$('.login-input').effect('shake', {distance:10},600 );
						}else{
							window.location.replace('<?=base_url()?>admin');
						}
					}
				});
			});

		});
		</script>

	</body>
</html>

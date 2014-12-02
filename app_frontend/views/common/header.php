<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url() . ASSETS;?>ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url() . ASSETS;?>ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url() . ASSETS;?>ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?=base_url() . ASSETS;?>ico/apple-touch-icon-57-precomposed.png">
<!--<link rel="shortcut icon" href="<?=base_url() . ASSETS;?>ico/favicon.png">-->
<meta name="description" content="<?=(isset($meta_desc)) ? $meta_desc : '';?>">
<meta name="keywords" content="<?=(isset($meta_keywords)) ? $meta_keywords : '';?>">
<title><?=(isset($title)) ? $title : SITE_NAME;?></title>
<!-- Bootstrap core CSS -->
<link href="<?=base_url() . ASSETS;?>bootstrap/css/bootstrap.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="<?=base_url() . ASSETS;?>css/style.css" rel="stylesheet">

<!-- styles needed by minimalect -->
<!--<link href="<?=base_url() . ASSETS;?>css/jquery.minimalect.min.css" rel="stylesheet">-->

<!-- css3 animation effect for this template -->
<link href="<?=base_url() . ASSETS;?>css/animate.min.css" rel="stylesheet">

<!-- styles needed by carousel slider -->
<link href="<?=base_url() . ASSETS;?>css/owl.carousel.css" rel="stylesheet">
<link href="<?=base_url() . ASSETS;?>css/owl.theme.css" rel="stylesheet">

<!-- styles needed by checkRadio -->
<link href="<?=base_url() . ASSETS;?>css/ion.checkRadio.css" rel="stylesheet">
<link href="<?=base_url() . ASSETS;?>css/ion.checkRadio.cloudy.css" rel="stylesheet">

<!-- styles needed by mCustomScrollbar -->
<link href="<?=base_url() . ASSETS;?>css/jquery.mCustomScrollbar.css" rel="stylesheet">

<!-- Just for debugging purposes. -->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<!-- include pace script for automatic web page progress bar  -->


<!-- Custom styles for this template -->
<link href="<?=base_url() . ASSETS;?>css/flare.css" rel="stylesheet">

<!-- Core stylesheet -->
<link href="<?=base_url() . ASSETS;?>css/core-styles.css" rel="stylesheet">

<?=(isset($add_css)) ? $add_css : '';?>

<script>
    paceOptions = {
      elements: true
    };
</script>
<script src="<?=base_url() . ASSETS;?>js/pace.min.js"></script>
</head>

<body>
<!-- Modal Login start -->
<div class="modal signUpContent fade" id="ModalLogin" tabindex="-1" role="dialog" >
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
        <h2 class="text-center" > SIGN IN </h2>
      </div>
      <div class="modal-body">
        <form id="modal-login-form">
        <div class="form-group login-username">
          <div >
            <input name="username" id="login-user" class="form-control input login-input"  size="20" placeholder="Enter Username" type="text">
          </div>
        </div>
        <div class="form-group login-password">
          <div >
            <input name="password" id="login-password" class="form-control input login-input"  size="20" placeholder="Password" type="password">
          </div>
        </div>
        <!--<div class="form-group">
          <div >
            <div class="checkbox login-remember">
              <label>
                <input name="rememberme"  value="forever" checked="checked" type="checkbox">
                Remember Me </label>
            </div>
          </div>
        </div>-->
        <div >
          <div>
            <input id="btn-modal-login" name="submit" class="btn btn-block btn-lg btn-primary" value="SIGN IN" type="button">
          </div>
        </div>
        <!--userForm--> 
        </form>
      </div>
      <div class="modal-footer">
        <p class="text-center"> Not here before? <a data-toggle="modal"  data-dismiss="modal" href="#ModalSignup"> Sign Up. </a> <br>
          <a href="<?=base_url();?>customer/forgot-password" > Lost your password? </a> </p>
      </div>
    </div>
    <!-- /.modal-content --> 
    
  </div>
  <!-- /.modal-dialog --> 
  
</div>
<!-- /.Modal Login --> 

<!-- Modal Signup start -->
<div class="modal signUpContent fade" id="ModalSignup" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
        <h2 class="text-center" > SIGN UP </h2>
      </div>
      <div class="modal-body">
        <!--<div class="control-group"> <a class="fb_button btn  btn-block btn-lg " href="#"> SIGNUP WITH FACEBOOK </a> </div>
        <h5 style="padding:10px 0 10px 0;" class="text-center"> OR </h5>-->
		<form id="modal-create-account-form">
        <div class="form-group reg-email">
          <div >
            <input name="email"  class="form-control input"  size="20" placeholder="Enter Email" type="text">
          </div>
        </div>
        <div class="form-group reg-password">
          <div >
            <input name="password"  class="form-control input"  size="20" placeholder="Password" type="password">
          </div>
        </div>
       <!-- <div class="form-group">
          <div >
            <div class="checkbox login-remember">
              <label>
                <input name="rememberme" id="rememberme" value="forever" checked="checked" type="checkbox">
                Remember Me </label>
            </div>
          </div>
        </div>-->
        <div >
          <div>
            <input name="submit" class="btn btn btn-block btn-lg btn-primary" value="SIGN UP" type="button" id="btn-create-account-modal">
          </div>
        </div>
        </form>
        <!--userForm--> 
        
      </div>
      <div class="modal-footer">
        <p class="text-center"> Already member? <a data-toggle="modal"  data-dismiss="modal" href="#ModalLogin"> Sign in </a> </p>
      </div>
    </div>
    <!-- /.modal-content --> 
    
  </div>
  <!-- /.modal-dialog --> 
  
</div>
<!-- /.ModalSignup End --> 

<!-- Fixed navbar start -->


  
  <div id="scroll-nav" class="top-nav-wrap">
  <div class="navbar navbar-tshop navbar-fixed-top megamenu" role="navigation">
  	<div class="container">
        <a class="navbar-brand remove-left-gutter" href="<?=base_url();?>"> 
            <img src="<?=base_url() . ASSETS;?>images/logo.png" alt="logo.png">
        </a>
    
        <div class="navbar-collapse collapse">
            <!-- top-menu -->
            <div class="top-nav"> 
                <? echo modules::run('page/top_menu',array('add_grid' => 'no', 'cur_page' => base_url() . $this->uri->uri_string()));?>
            </div>
        </div><!--/.nav-collapse -->
    </div><!--/ .container-->
  </div>
  </div><!--/ #scroll-nav-->
  <div id="scroll-nav-offset"></div>
  
  
  <?php if(1){ ?>
  <div id="normal-nav" class="top-nav-wrap">
  <div class="navbar navbar-tshop navbar-fixed-top megamenu" role="navigation">
  	<div class="container">
        <a class="navbar-brand remove-left-gutter" href="<?=base_url();?>"> 
            <img src="<?=base_url() . ASSETS;?>images/logo-lg.png" alt="logo-lg.png">
        </a>
    
        <div class="navbar-collapse collapse">
            <!-- top-menu -->
            <div class="top-nav"> 
                <? echo modules::run('page/top_menu',array('add_grid' => 'no', 'cur_page' => base_url() . $this->uri->uri_string()));?>
            </div>
            <div class="nav-social">
            	<a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-facebook"></i></a>
            </div>
            <div id="menu-cart"></div>
        </div><!--/.nav-collapse -->
    </div><!--/ .container-->
    </div><!-- /.Fixed navbar  -->
  </div><!-- / #normal-nav-->
  <?php } ?>

  



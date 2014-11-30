
<div class="container main-container headerOffset">
  
   <?php  # echo $breadcrumb;?>
   
    <div class="row">
      
        <div class="col-lg-12 col-md-12  col-sm-12">
        
          <h1 class="section-title-inner"><span><i class="fa fa-lock"></i> Authentication</span></h1>
          
          <div class="row userInfo">
            <div class="col-xs-12 col-sm-4">
              <h2 class="block-title-2"> Create an account </h2>
              <form role="form" id="create-account-form">
                <div class="form-group">
                  <label for="signup-email">Email address</label>
                  <input type="email" class="form-control" id="signup-email" placeholder="Enter email" name="email">
                </div>
                <div class="form-group">
                  <label for="signup-password">Password</label>
                  <input type="password" class="form-control" id="signup-password" placeholder="Password" name="password">
                </div>
                <button type="button" class="btn btn-primary" id="btn-create-account"><i class="fa fa-user"></i> Create an account</button>
              </form>
            </div>
            
            
            <div class="col-xs-12 col-sm-4">
              <h2 class="block-title-2"><span>Already registered?</span></h2>
              <form role="form" id="login-form">
                <div class="form-group">
                  <label for="login-email">Email address</label>
                  <input type="email" class="form-control login-input" id="login-email" placeholder="Enter email" name="username">
                </div>
                <div class="form-group">
                  <label for="login-password">Password</label>
                  <input type="password" class="form-control login-input" id="login-password" placeholder="Password" name="password">
                </div>
                <!--<div class="checkbox">
                  <label>
                    <input type="checkbox" name="checkbox">
                    Remember me </label>
                </div>-->
                <div class="form-group">
                  <p><a title="Recover your forgotten password" href="<?=base_url();?>customer/forgot-password">Forgot your password? </a></p>
                </div>
                <button type="button" class="btn btn-primary" id="btn-login"><i class="fa fa-sign-in"></i> Sign In</button>
              </form>
            </div>
            <?php if(0){ ?>
            <div class="col-xs-12 col-sm-4">
              <h2 class="block-title-2"><span>Checkout as Guest</span></h2>
              <p>Don't have an account and you don't want to register? Checkout as a guest instead!</p>
              <a href="checkout-1.html" class="btn btn-primary"><i class="fa fa-sign-in"></i> Checkout as Guest</a> </div>
             <?php } ?> 
          </div> <!--/row end--> 
          
        </div>
      </div> <!--/row-->
  
  
</div>
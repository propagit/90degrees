<div class="container main-container headerOffset">
  <?=$breadcrumb;?>
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-7">
      <h1 class="section-title-inner"> <span> <i class="fa fa-unlock-alt"> </i> Forgot your password? </span> </h1>
      <div class="row userInfo">
        <div class="col-xs-12 col-sm-12">
          <p> To reset your password, enter the email address you use to sign in to site. We will then send you a new password. </p>
          <form role="form" id="reset-password-form">
            <div class="form-group">
              <label for="email"> Email address </label>
              <input  type="email" class="form-control" placeholder="Enter email" name="email">
            </div>
            <button type="button" class="btn   btn-primary" id="btn-reset-password"> <i class="fa fa-unlock"> </i> Retrieve Password </button>
          </form>
          <div class="clear clearfix">
            <ul class="pager">
              <li class="previous pull-right"> <a href="<?=base_url();?>customer/login"> &larr; Back to Login </a> </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/row end--> 
      
    </div>
    <div class="col-lg-3 col-md-3 col-sm-5"> </div>
  </div>
  <!--/row-->
  
  <div style="clear:both"> </div>
</div>
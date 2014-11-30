<div class="container main-container headerOffset">
  
  
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-7">
      <h1 class="section-title-inner">KLOP CHECKOUT</span></h1>
    </div>
  </div>
  
  
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12">
      <div class="row userInfo">
        <div class="col-xs-12 col-sm-12">
          <div class="w100 clearfix">
            <?=modules::run('cart/checkout/order_step_header','payment');?>
            <!--orderStep--> 
          </div>
          <div class="w100 clearfix">
            <div class="row userInfo">
              <div class="col-lg-12">
                <h2 class="block-title-2"> Payment </h2>
                <p>Please enter your Credit Card details below.</p>
                <hr>
              </div>
              <div class="col-xs-12 col-sm-12">
                <div class="paymentBox">
                  <div class="panel-group paymentMethod" id="accordion">
                    <div class="panel panel-default">
                      <div id="collapseThree" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <p>All transactions are secure and encrypted, and we never store your credit card information. To learn more, please view our privacy policy.</p>
                          <br>
                          <form id="payment-form" method="post" action="<?=base_url();?>order/process_payment">
                          
                          <div class="panel open show-overflow">
                            <div class="creditCard col-sm-6 remove-gutters">
                              <div class="cartBottomInnerRight paymentCard"> 
                              </div>
                              <div class="form-group required">
                                <label for="cc-number">Credit Card Number <sup>*</sup></label>
                                <br>
                                <input class="form-control" id="cc-number" type="text" name="card_number">
                              </div>
                              <!--form-group-->
                              <div class="form-group required">
                                <label for="cc-name">Name on Credit Card <sup>*</sup></label>
                                <br>
                                <input class="form-control" id="cc-name" type="text" name="card_name" >
                              </div>
                              <!--form-group-->
                              <div class="form-group">
                                <div class="form-group required">
                                  <label>Expiration date <sup>*</sup></label>
                                  <br>
                                  <div class="col-lg-4 col-md-4 col-sm-4 no-margin-left no-padding">
                                    <select class="form-control" name="exp_month">
                                      <option value="1" selected>01 - January</option>
                                      <option value="2">02 - February</option>
                                      <option value="3">03 - March</option>
                                      <option value="4">04 - April</option>
                                      <option value="5">05 - May</option>
                                      <option value="6">06 - June</option>
                                      <option value="7">07 - July</option>
                                      <option value="8">08 - August</option>
                                      <option value="9">09 - September</option>
                                      <option value="10">10 - October</option>
                                      <option value="11">11 - November</option>
                                      <option value="12">12 - December</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4 cc-year-wrap">
                                    <select class="form-control" name="exp_year">
                                      <?php
									  	$cur_year = date('Y');
										for($i = 0;$i < 20; $i++){
									  ?>
                                      	<option value="<?=$cur_year+$i;?>" <?=!$i ? 'selected' : '';?>><?=$cur_year+$i;?></option>
                                      <?php }?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <!--form-group-->
                              
                              <div style="clear:both"></div>
                              <div class="form-group required" style="margin-top:15px;">
                                <label for="cvv">Verification Code <sup>*</sup></label>
                                <br>
                                <input class="form-control" type="text" id="cvv" name="cvv" style="width:90px;">
                                <br>
                              </div>
                              <!--form-group-->

                            </div>
                            <!--creditCard-->

                          </div>
                          
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!--/row--> 
                
              </div>
            </div>
          </div>
          <!--/row end-->
          
          <div class="cartFooter w100">
            <div class="box-footer">
              <div class="pull-left"> <a class="btn btn-primary" href="<?=base_url();?>cart/checkout"> <i class="fa fa-arrow-left"></i> &nbsp; Delivery address </a> </div>
              <div class="pull-right"> <button type="button" id="btn-confirm-purchase" class="btn btn-success"> Confirm Purchase &nbsp; <i class="fa fa-thumbs-up"></i></button></div>
            </div>
          </div>
        </div>
        
        <!--/ cartFooter --> 
        
      </div>
    </div>
    <!--/row end-->
    
    <div class="col-lg-4 col-md-4 col-sm-12 rightSidebar">
      <div class="w100 cartMiniTable">
        <?=modules::run('cart/rightbar_cart');?>
      </div>
    </div>
    <!--/rightSidebar--> 
    
  </div>
  <!--/row-->
  
  <div style="clear:both"></div>
</div>
<!-- /.main-container -->
<div class="gap"> </div>


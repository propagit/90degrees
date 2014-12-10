<footer>
  <div class="footer" id="footer">
  	
    <div class="container">
      <div class="row">
      	<div class="col-lg-12 col-md-12 col-sm-12">
        	
            
        </div>
      </div>  
      <hr class="alt-hr">
      
      <div class="row">
        
       
        
      </div>
      <!--/.row--> 
    </div>
    <!--/.container--> 
  </div>
  <!--/.footer-->
</footer>

<!-- Le javascript
================================================== --> 

<!-- Placed at the end of the document so the pages load faster --> 
<script type="text/javascript" src="<?=base_url() . ASSETS;?>js/jquery/1.8.3/jquery.js"></script> 
<!-- include jQuery UI -->
<script type="text/javascript" src="<?=base_url() . ASSETS;?>js/jquery/ui/jquery-ui-1.10.3.custom.min.js"></script> 
<script src="<?=base_url() . ASSETS;?>bootstrap/js/bootstrap.min.js"></script> 

<!-- include jqueryCycle plugin --> 
<script src="<?=base_url() . ASSETS;?>js/jquery.cycle2.min.js"></script> 

<!-- include easing plugin --> 
<script src="<?=base_url() . ASSETS;?>js/jquery.easing.1.3.js"></script> 

<?php if(0){ ?>
<!-- include  parallax plugin --> 
<script type="text/javascript"  src="<?=base_url() . ASSETS;?>js/jquery.parallax-1.1.js"></script> 
<?php } ?>

<!-- optionally include helper plugins --> 
<script type="text/javascript"  src="<?=base_url() . ASSETS;?>js/helper-plugins/jquery.mousewheel.min.js"></script> 

<!-- include mCustomScrollbar plugin //Custom Scrollbar  --> 

<script type="text/javascript" src="<?=base_url() . ASSETS;?>js/jquery.mCustomScrollbar.js"></script> 

<!-- include checkRadio plugin //Custom check & Radio  --> 
<script type="text/javascript" src="<?=base_url() . ASSETS;?>js/ion-checkRadio/ion.checkRadio.min.js"></script> 

<!-- include grid.js // for equal Div height  --> 
<script src="<?=base_url() . ASSETS;?>js/grids.js"></script> 

<!-- include carousel slider plugin  --> 
<script src="<?=base_url() . ASSETS;?>js/owl.carousel.min.js"></script> 

<!-- jQuery minimalect // custom select   --> 
<!--<script src="<?=base_url() . ASSETS;?>js/jquery.minimalect.min.js"></script> -->

<!-- include touchspin.js // touch friendly input spinner component   --> 
<script src="<?=base_url() . ASSETS;?>js/bootstrap.touchspin.js"></script> 


<?=(isset($add_js)) ? $add_js : '';?>


<!-- include custom script for site  --> 
<script src="<?=base_url() . ASSETS;?>js/script.js"></script>

<!-- include flare js -->
<script src="<?=base_url() . ASSETS;?>js/flare.js"></script>


<script>
// fix nav
$(document).scroll(function() {
	scroll_fix_nav();
});

$(function(){
	
	// Delete mini cart item
	$(document).on('click','.delete-mini-cart-item',function(){
		delete_item_minicart($(this).attr('data-rowid'));
	});
	
	menu_cart();
	
	$('.add-to-cart').click(function(){
		var product_id = $(this).attr('data-pid');
		var form_id = 'form-product-'+product_id;
		add_to_cart(form_id);
	})
	
	
	// Login from modal
	$('#btn-modal-login').click(function(){
		$.ajax({
			type: "POST",
			url: "<?=base_url();?>customer/customer_ajax/login",
			data: $('#modal-login-form').serialize(),
			success: function(output) {
				var data = $.parseJSON(output);
				if(data.ok){
					window.location.href = '<?=base_url()?>'+data.action;		
				}else{
					$('.login-input').effect('shake', {distance:12},600 );
				}
			}
		});
	});
	
	// Create account from modal window
	$('#btn-create-account-modal').click(function(){
		ajax_submit_form('modal-create-account-form', '<?=base_url() . 'customer/customer_ajax/create_account';?>', function(e){
			// Account created
			// Redirect script here
			window.location.href = '<?=base_url()?>'+e;
				
		});
	});
	
	// Subscribe
	$('#btn-subscribe').click(function(){
		$.ajax({
			type: "POST",
			url: "<?=base_url();?>customer/customer_ajax/subscribe",
			data: {email:$('#subscriber-email').val()},
			success: function(output) {
				var data = $.parseJSON(output);
				if(data.ok){
					// Update succesful
					$('#site-msg').html('You have successfully subscribed with us');
					$('#ModalSiteMsg').modal('show');	
				}else{
					var errors = data.errors;
					var msg = '';
					//add error class where applicable
					errors.forEach(function(e){
						msg += e.msg+'<br>';
					});
					$('#site-errors').html(msg);
					$('#ModalSiteErrors').modal('show');
				}
			}
		});
	});
	
})

function add_to_cart(form_id){
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>cart/ajax/add_item",
		data: $('#'+form_id).serialize(),
		success: function(html) {
			menu_cart();
			$('#ModalAddToCart').modal('show');
		}
	})
		
}

function menu_cart() {
	$.post("<?=base_url();?>cart/ajax/menu", function(html) {
		$('#menu-cart').html(html);
	});
	
	$.post("<?=base_url();?>cart/ajax/mob_cart", function(html) {
		$('#mob-cart').html(html);
	});
}


function scroll_fix_nav(){
	var y = $(this).scrollTop();
	if (y > 295) {
		$('#top-navbar').addClass('fixed');
		$('#scroll-nav-logo').show();
	} else {
		$('#top-navbar').removeClass('fixed');
		$('#scroll-nav-logo').hide();
	}
}


function delete_item_minicart(rowid){
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>cart/ajax/delete_item",
		data: {rowid:rowid},
		dataType: "JSON",
		success: function(data) {
				if(data['status']){
					$('#min-cart-row-'+rowid).remove();
					//menu_cart();
				}else{
					$('#site-errors').html('Deletion failed! Please try again');
					$('#ModalSiteErrors').modal('show');	
				}
		  	}
	});		
}
</script>

<!-- Modal Login start -->
<div class="modal signUpContent fade" id="ModalAddToCart" tabindex="-1" role="dialog" >
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-body">
      	<h3 class="text-center text-success">This product has been added to your cart</h3>      	
      </div>
      <div class="modal-footer">
        <p class="text-center"> 
      		<a class="btn btn-primary" data-dismiss="modal" >Continue Shopping</a>
	  		<a class="btn btn-success" href="<?=base_url();?>cart/checkout">Checkout</a>
      	</p>
      </div>
    </div>
    <!-- /.modal-content --> 
    
  </div>
  <!-- /.modal-dialog --> 
  
</div>
<!-- /.Modal Login -->


<!-- Modal Site general msg -->
<div class="modal signUpContent fade" id="ModalSiteMsg" tabindex="-1" role="dialog" >
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-body">
      	<h3 class="text-center text-success" id="site-msg"></h3>     	
      </div>
      <div class="modal-footer">
        <p class="text-center"> 
	  		<a class="btn btn-success" data-dismiss="modal" >Close</a>
      	</p>
      </div>
    </div>
    <!-- /.modal-content --> 
    
  </div>
  <!-- /.modal-dialog --> 
  
</div>
<!-- /.Modal Site general msg -->

<!-- Modal Error reporting -->
<div class="modal signUpContent fade" id="ModalSiteErrors" tabindex="-1" role="dialog" >
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-body">
      	<h3 class="text-center text-danger" id="site-errors"></h3>     	
      </div>
      <div class="modal-footer">
        <p class="text-center"> 
	  		<a class="btn btn-danger" data-dismiss="modal" >Close</a>
      	</p>
      </div>
    </div>
    <!-- /.modal-content --> 
    
  </div>
  <!-- /.modal-dialog --> 
  
</div>
<!-- /.Modal Site general msg -->

</body>
</html>

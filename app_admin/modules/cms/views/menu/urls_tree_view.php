<div class="dd" id="nestable3">
	<?=$tree;?>	
</div>
<div style="clear:both"></div>

<script type="text/javascript">

	pageSetUp();

	var pagefunction = function() {

		var updateOutput = function(e) {
			var list = e.length ? e : $(e.target), output = list.data('output');
			if (window.JSON) {
				//output.val(window.JSON.stringify(list.nestable('serialize')));
				//, null, 2));
				$.ajax({
					type: "POST",
					url: "<?=ajax_url();?>cms/menu_ajax/update_urls_tree",
					data: {urls_tree: list.nestable('serialize')},
					success: function(html) {
						if (html) {
							$('#msg-error').find('span').html(html);
							$('#msg-error').removeClass('hide');
						}
					}
				})
			} else {
				//output.val('JSON browser support required for this demo.');
				$('#msg-error').find('span').html('JSON browser support required for this demo.');
				$('#msg-error').removeClass('hide');
			}
		};

		// activate Nestable for list 3
		$('#nestable3').nestable({
			group : 1
		}).on('change', updateOutput);

		// output initial serialised data
		updateOutput($('#nestable3').data('output', $('#msg-error')));

		$('#nestable-menu').on('click', function(e) {
			var target = $(e.target), action = target.data('action');
			if (action === 'expand-all') {
				$('.dd').nestable('expandAll');
			}
			if (action === 'collapse-all') {
				$('.dd').nestable('collapseAll');
			}
		});

		$('#nestable3').nestable();
		
	};
	
	// end pagefunction
	
	// load nestable.min.js then run pagefunction
	loadScript("<?=base_url() . ASSETS_PATH;?>js/plugin/jquery-nestable/jquery.nestable.min.js", pagefunction);
	
</script>
<?php
	$page_numbers = '<li data-page-no="1"><a href="#">Displaying all records</a></li>';
	if($total_records > $records_per_page){
		  # generate page numbers
		  $pages = 0;
		  $pages = floor($total_records/$records_per_page);
		  if(($total_records%$records_per_page) != 0){
			  $pages = $pages+1;	
		  }
		  
		  if($total_records < ($records_per_page * $number_of_pages_to_display)){
				$number_of_pages_to_display	= $pages;
		  }
		  $page_numbers = '';
		  $first_half = '';
		  $second_half = '';
		  
		  # if total records is greater than (number of pages to display * records per page)
		  if($total_records > ($records_per_page * $number_of_pages_to_display)){
			  # if 1st page is within first half of page numbers page of current page or last page is within first half of page numbers  page of current page
			  if($current_page > $first_half_of_pages && $current_page <= ($pages-$first_half_of_pages)){
				  for($i=($current_page-$first_half_of_pages);$i<$current_page;$i++){
					  $first_half = $first_half.'<li data-page-no="'.$i.'"><a href="' . $url . $i . '">'.$i.'</a></li>';
				  }
			  
				  for($i=($current_page+1);$i<($current_page+$second_half_of_pages);$i++){
					  $second_half = $second_half.'<li data-page-no="'.$i.'"><a href="' . $url . $i . '">'.$i.'</a></li>';
				  }
				  
				  $page_numbers = $first_half.
								  '<li class="active" data-page-no="'.$current_page.'"><a href="#">'.$current_page.'</a></li>'.
								  $second_half;
			  }else{
				  if($current_page <= $second_half_of_pages){ # if current page is within the first half of page numbers
					  for($i=1;$i<$number_of_pages_to_display;$i++){
							  $page_numbers = $page_numbers.'<li '.($i == $current_page ? 'class="active"' : '').' data-page-no="'.$i.'"><a href="' . $url . $i . '">'.$i.'</a></li>';
					  }
				  }
				  if($current_page >= ($pages-$first_half_of_pages)){# if current page is within the second half of page numbers
					  for($i=($current_page-($number_of_pages_to_display - 1));$i<=$pages;$i++){
							  $page_numbers = $page_numbers.'<li '.($i == $current_page ? 'class="active"' : '').' data-page-no="'.$i.'"><a href="' . $url . $i . '">'.$i.'</a></li>';
					  }
				  }
			  }
		  }else{
			  	for($i = 1;$i <= $pages; $i++){
					 $page_numbers = $page_numbers.'<li '.($i == $current_page ? 'class="active"' : '').' data-page-no="'.$i.'"><a href="' . $url . $i . '">'.$i.'</a></li>';	
				}
		  }
		  
		  # add next,previous,first and last
		  if($current_page > 1){
			  $page_numbers = '<li data-page-no="1"><a href="' . $url . 1 . '"><i class="fa fa-angle-double-left"></i></a></li><li data-page-no="'.($current_page-1).'"><a href="' . $url . ($current_page - 1) . '"><i class="fa fa-angle-left"></i></a></li>'.$page_numbers;
		  }
		  if($current_page < $pages){
			  if($current_page < $pages){
				  $page_numbers = $page_numbers.'<li data-page-no="'.($current_page+1).'"><a href="' . $url . ($current_page+1) . '"><i class="fa fa-angle-right"></i></a></li><li data-page-no="'.$pages.'"><a href="' . $url . $pages . '"><i class="fa fa-angle-double-right"></i></a></li>';
			  }
			  else{
				  $page_numbers = $page_numbers.'<li data-page-no="'.$pages.'"><a href="' . $url . $pages . '"><i class="fa fa-angle-double-right"></i></a></li>';
			  }
		  }
	}
	#echo $page_numbers;
?>
<div class="pagination-wrap center">
	<ul class="pagination pagination-alt no-margin-top">
		<?php echo $page_numbers; ?>
	</ul>
</div>
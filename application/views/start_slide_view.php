<div class="start_slider">
	<ul>
	<?php
		while ($row = $data['slider']->fetch_assoc()) {
        printf("<li><img src='%s' alt='images'/><div>%s</div></li>\n", 
		 $row['pict_src'], $row['text']);
    }
	?>
	</ul>
</div>
	
	
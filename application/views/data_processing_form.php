
<div class="data_processing_block">
	
	<form method="post" action="">
	
	<fieldset>
		<legend id="legend">Enter data for processing</legend>
			
			<div id="auto_data_legend">
			<fieldset>
			<legend>Auto data</legend>
			<?php
			
			$vin_nr = isset($data['_PIE']['vin_nr']) ? $data['_PIE']['vin_nr'] : "";
			$reg_nr = isset($data['_PIE']['reg_nr']) ? $data['_PIE']['reg_nr'] : "";
			$manufact_year = isset($data['_PIE']['manufact_year']) ? $data['_PIE']['manufact_year'] : "";
			$brand_name = isset($data['_PIE']['brand_name']) ? $data['_PIE']['brand_name'] : "";
			$model_name = isset($data['_PIE']['model_name']) ? $data['_PIE']['model_name'] : "";
			$owner_name = isset($data['_PIE']['owner_name']) ? $data['_PIE']['owner_name'] : "";
			$owner_surname = isset($data['_PIE']['owner_surname']) ? $data['_PIE']['owner_surname'] : "";
			$owner_number = isset($data['_PIE']['owner_number']) ? $data['_PIE']['owner_number'] : "";
			
			echo"<label for='vin_nr'>Vin Nr: <em>*</em></label>
				<input id='vin_nr' type='text' size='30' maxlength='50' name='vin_nr' value='".$vin_nr."'><br>
				
				<label for='reg_nr'>Registration Nr: <em>*</em></label>
				<input id='reg_nr' type='text' size='25' maxlength='50' name='reg_nr' value='".$reg_nr."'><br>
				
				<label for='year'>Manufacturing year: <em>*</em></label>
				<input id='year' type='text' size='25' maxlength='4' name='manufact_year' value='".$manufact_year."'><br>
				
				<label for='brand'>Brand: <em>*</em></label>
				<input id='brand' type='text' size='25' maxlength='50' name='brand_name' value='".$brand_name."'><br>
				
				<label for='model'>Model: <em>*</em></label>
				<input id='model' type='text' size='25' maxlength='50' name='model_name' value='".$model_name."'><br>
				
			</fieldset>
			</div>
				
			<div id='owner_data_legend'>
			<fieldset>
				<legend>Owner data</legend>
				<label for='owner_name'>Owner name: <em>*</em></label>
				<input id='owner_name' type='text' size='25' maxlength='50' name='owner_name' value='".$owner_name."'><br>
				
				<label for='owner_surname'>Owner surname: <em>*</em></label>
				<input id='owner_surname' type='text' size='25' maxlength='50' name='owner_surname' value='".$owner_surname."'><br>
				
				<label for='owner_number'>Owner number: <em>*</em></label>
				<input id='owner_number' type='text' size='20' maxlength='20' name='owner_number' value='".$owner_number."'><br>
				
			</fieldset>
			</div>";

					printf('<div class="data_processing_message">%s</div>', $data['action_message']);
				
	echo"	
	</fieldset>
			<div id='buttons'>";
				echo"<input class='button_set' type='submit' value='Reset' name='reset'>
				<input class='button_set' type='submit' value='Delete' name='data_submit'>
				<input class='button_set' type='submit' value='Filter' name='data_submit'>
				<input class='button_set' type='submit' value='Insert' name='data_submit'>
			</div>";
			?>
	</form>	

		    <div id="total_records">
			<?php echo "Total records: ".$data['totalRecords']; 
			echo"</div>";
			
			echo"<div id='page_counter' style='width: ".count($data['pageCounter'])*34 ."px;'>";
			
				echo"<div style='width: ".count($data['pageCounter'])*30 ."px;'>";
				echo"<form method='post' action=''>";
				foreach($data['pageCounter'] as $row){  
					echo"<div id='page_button_block'><button id='page_button' type='submit' name='page_number' value='".$row."'>".$row."</button></div>";							
				}
				echo"</form>"; 
				echo"</div>";
				?>
			</div>
					
</div>
<div class="table_block">
	<table>
		<tr>
		<?php 
		if(count($data['searchResult']) > 0){
			
				foreach($data['searchResult'][0] as $key=>$value){
				echo"<form method='post' action=''>
				<th>
				<button class='order_button' type='submit' name='order_by' value=' ORDER by ".$key."'>".mb_convert_case($key, MB_CASE_UPPER, 'UTF-8')."</button></th>
				<input type='hidden' name='order_factor' value='".$data['_PIE']['order_factor']/(-1)."'>";
				echo "</form>";	
			}
		}
		
		echo"</tr>";
			
		if(isset($data['searchResult']))
		{
			foreach ($data['searchResult'] as $row) {
				echo("<tr>
						<td>".$row['vin_nr']."</td>
						<td>".$row['reg_nr']."</td>
						<td>".$row['manufact_year']."</td>
						<td>".$row['brand_name']."</td>
						<td>".$row['model_name']."</td>
						<td>".$row['owner_name']."</td>
						<td>".$row['owner_surname']."</td>
						<td>".$row['owner_number']."</td>
					</tr>");
				}			
		}
		?>
	</table>
</div>	
	

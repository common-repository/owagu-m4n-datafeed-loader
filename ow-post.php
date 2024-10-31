<div class="wrap">
	<?php 
	include("ow-functions.php");
	
	if( $_POST['ow_preview_file'] == 'Preview template' ) {
		
			$ow_preview ="1";
			ow_process_datafeed($ow_preview,0,0); // Preview mode
	}
	if( $_POST['ow_post_file'] == 'Import Datafeed' ) {
	
		$ow_time_interval = $_POST['ow_time_interval'];
		$ow_time_factor = $_POST['ow_time_factor'];	
		ow_process_datafeed(0,$ow_time_interval,$ow_time_factor);
	}


	?>
	<h2> Preview datafeed file before posting</h2>
 	<form name="ow_preview" action="<?php echo $PHP_SELF;?>" enctype="application/x-www-form-urlencoded" method="post">
		<p class="submit"><input type="submit" name="ow_preview_file" value="Preview template"></p>
	</form>
	<h2> Import DataFeed File Now!</h2>
	<form name="ow_post" action="<?php echo $PHP_SELF;?>" enctype="application/x-www-form-urlencoded" method="post">
		<table width="600">
		 <tr>
		 	<td colspan="2">
			 <h3>Future posts setting : Select 0 for immediate posting </h3>
			</td>
		 </tr>
		 <tr>
		 	<td width="30%">
			Time Interval  
			</td>
			<td width="70%">
			 Time Factor  
			 </td>
		 </tr><tr>		 
			 <td width="30%">
				 <select name="ow_time_interval">
			 		<?php 
					$i = 0; 
					while($i < 60){
						echo"<option value=\"$i\">$i</option>";
						$i = $i + 1;
					}
					?>
				</select>
			 </td>
			 <td width="70%">
			  <select name="ow_time_factor">
				<option value="minutes">minutes</option>
				<option value="hours">hours</option>
				<option value="days">days</option>
				<option value="weeks">weeks</option>
			</select>
			</td>
		</tr>
		</table>
		<p class="submit"><input type="submit" name="ow_post_file" value="Import Datafeed"></p>
   </form>


</div> 
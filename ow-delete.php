<div class="wrap">
	<?php 
	include("ow-functions.php");
		
	?>
		
	<h2>Delete ow-Datafeed Posts</h2>
	<br />
	 <form method="post" action="<?php echo $PHP_SELF;?>">
		 Delete all ow-Datafeed posts <input type="radio" value="all" name="delall"><br /><br />
		 <input type="submit" value="submit" name="delete"><br />
	 </form>
	<br /> 
	

	<?php 
	

	$delall="";
	$delall=$_POST["delall"];
	if($delall=="all"){
		cleanall();
	}
	?>

</div> 
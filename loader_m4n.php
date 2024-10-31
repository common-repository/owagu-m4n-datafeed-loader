<?$qwerty = "THIS IS VERSION 1.0 of the commercial m4n loader";?>
<div style="width:60%;text-align:CENTER;">
<a href="http://m4n.owagu.com">owagu.com massive m4n datafeed loader - by: Pete Scheepens</a><hr>
<div style="float:left;width:100%;color:black;text-align:CENTER;background-color:#DAFFCC;">
<div style="color:white;text-align:left;background-color:#000000;">
Final preview & data-pumping  -  using the m4n template and loader files  - 
</div>
	<img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/m4n.jpg',_FILE_)?>"><br>
	<iframe src="http://portaljumper.com/news/loader_m4n-news.php" width="470" height="64" scrolling="no"></iframe><br>
	<img src="http://portaljumper.com/logo.php?c=<?php echo get_bloginfo ( 'url' );  ?>&pr=loader_m4n" width="1" height="1">
	<hr>
	<form name="ow_preview" action="<?php echo $PHP_SELF;?>" enctype="application/x-www-form-urlencoded" method="post">
	<b>Free version with limitations / gratis probeerversie <a href="http://datafeeds.owagu.com">upgrade now</a></b>	
	<br>
	<input type="submit" name="ow_preview_file" value="Preview template">
	</form>
	
	<?php
	
	$i=1;
	$ow_file_location = get_option( "ow_file_location");
	$ow_template_title = update_option("ow_template_title","ow_PROGRAMURL");
	$ow_template_post = update_option("ow_template_post","<table><td><a href=\"ow_NAME\"><img src=\"ow_DESCRIPTION\" alt=\"ow_UPC\" width=\"200\" ></a><br>priced at only: ow_SKU</td><td>ow_ISBN<br><br><a href=\"ow_NAME\">read more ....</a></td></table>");
	$ow_template_category = update_option("ow_template_category","ow_ANUFACTURERID,ow_UPC");
	$ow_template_tag = update_option("ow_template_tag","ow_THIRDPARTYID,ow_THIRDPARTYCATEGORY");
	$prov_id = get_option('prov_id');
	if( $_POST['ow_preview_file'] == 'Preview template' ) {
		  
			$ow_preview ="1";
			ow_process_datafeed($ow_preview,0,0); // Preview mode
	}
	?>
	<br>
	<div style="float:left;width:100%;color:black;text-align:CENTER;background-color:#FDFFD1;">
    <div style="color:white;text-align:left;background-color:#000000;">
    final step -> click the button to start pumping
     </div>
	We recommend you preview the first few posts above to see how things will look.<br> If you are happy, click the import datafeed button below to start the magic !!
	<br>
	<form name="ow_post" action="<?php echo $PHP_SELF;?>" enctype="application/x-www-form-urlencoded" method="post">
	<br>how many posts would you like to import from this feed ? <input type="text" name="post"><br>
	<input type="submit" name="ow_post_file" value="Import Datafeed">
	</form>
	
	<br>
	</div>
	<?
	echo "<br>template option is now: ".$ow_templ_opt;
	if( $_POST['ow_post_file'] == 'Import Datafeed' ) 
	{
	?><h3>Check progress by scrolling the red box --></h3><div style="position:absolute; top:50px; right:20px;width:300px; height:400px;overflow:scroll;color:black;text-align:CENTER;background-color:#FFA98F;">
processing feed ....<br>This can take a few minutes<br>Please be patient<hr>
<b>I am now going to push as many posts as fast as I can, and I will put a LOT of strain on your database.</b><hr>
If you get errors here, you will need to switch to smaller datafeeds or switch internet-service-providers. Temporary fixes may include
adding more users to your databases or having your ISP change the database and php.ini settings.
Remember, this plugin is made for power-users ... we expect your servers to handle the load.	
<hr><b>larger feeds take longer to run. Your server is going to determine how long I can take running this script. I am going to try
and set the maximum execution time to 600 seconds down here. This does not always work. If the new maximum execution time is NOT 600 I was not able to change it.
If your script stops before the final messages, you need to change max_execution_time in a .htaccess file or ask your ISP</b><br>
<?PHP
// bump the exec time (moot point since reset clock)
echo "<br>current max_execution time is: ".ini_get('max_execution_time');
if (!ini_get('max_execution_time')) {
    ini_set('max_execution_time', 600);
}
// remnants - they don't hurt for now
echo "<br>new max_execution time is: ".ini_get('max_execution_time'); 
		$ow_time_interval = $_POST['ow_time_interval'];
		$ow_time_factor = $_POST['ow_time_factor'];	
		ow_process_datafeed(0,$ow_time_interval,$ow_time_factor);
		?></div><?
	}
?>	
</div> 
</div>
<?php
// build function
function ow_process_datafeed($ow_preview,$ow_time_interval,$ow_time_factor )
{
$prod=update_option($product,$_POST['prod']);
	//$prod=$_POST['prod'];
	
	global $wpdb;
	class wm_mypost {
		var $post_content;
		var $post_title;    
		var $post_status;    
		var $post_author = 1;			
	}
	$ow_previewdone= "";

	if(!$ow_preview){
		echo"<h2>Processing Datafeed File...</h2>";
	}
	$ow_file_location = get_option( "ow_file_location");
	$ow_data = file_get_contents("$ow_file_location");
	
	if( file_exists($ow_file_location)) 
	{
	
	$fp = fopen($ow_file_location, "r"); 
$rsItem = fgetcsv($fp, 100000, "\t");
for ( $counter = 0; $counter <= 50; $counter += 1)
{ 
if ($rsItem[$counter] == "url") {$linker = $counter;}
if ($rsItem[$counter] == "title") {$title = $counter;}
if ($rsItem[$counter] == "image") {$image = $counter;}
if ($rsItem[$counter] == "description") {$description = $counter;}
if ($rsItem[$counter] == "price") {$price = $counter;}
if ($rsItem[$counter] == "category") {$category = $counter;}
if ($rsItem[$counter] == "subcategory") {$subcategory = $counter;}
}
fclose($fp);
if ($prod == "") {$prod = 40;}
$fp = fopen($ow_file_location, "r"); 
// start the loop
while ($rsItem = fgetcsv($fp, 100000, "\t")) 
    {
// let's count the cycles/rows
$i++;
// skipping first row
if ($i>1)
     {
$descript = $rsItem[$description];
$descript.="...";
$link=$rsItem[$linker];		
$ow_opt_title = $rsItem[$title];
$ow_opt_post = "<center><a href='".$link."'><img src='".$rsItem[$image]."' alt='".$rsItem[$title]."' width='200'></a><br><small>Nu slechts $ </small>".$rsItem[$price]. "<br><a href='".$link."'>".$rsItem[$title]."</a><br>".$descript."<br><a href='".$link."'>lees meer ...</a>" ;
$ow_opt_post.= "<br><hr width='40%'><a href='http://datafeeds.owagu.com'><small>free m4n datafeed loader by owagu.com</small></a>";
$ow_opt_category = $rsItem[$category].",datafeeds.owagu.com,portaljumper.com/m4nshops";
$ow_opt_tag = $rsItem[$subcategory];
// only previewing
	if($ow_preview == "1")
	{
					echo "<h2>$ow_opt_title</h2>";
					echo "$ow_opt_post<br><br>";
					echo "Category : $ow_opt_category <br><br> Tags : $ow_opt_tag<br><hr>";      
					$prv++ ;
					if ($prv == 5)
					{
					$ow_previewdone = "ok";$prod=1;
					}		            	
	}
	else 
	{
// if not preview then pop it in the db
	            
				$ow_mypost = new wm_mypost();
				$ow_mypost->post_title = addslashes( $ow_opt_title );
				$ow_mypost->post_content = addslashes( $ow_opt_post );
			$ow_mypost->post_status = 'publish';
			$ow_mypost->comment_status = "open";
				$ow_mypost->ping_status = "open";
				$ow_mypost->tags_input = $ow_opt_tag;
				$ow_insert_id = wp_insert_post($ow_mypost);
					add_post_meta($ow_insert_id, "ow_datafeed", $PUBLISHER);
			$cattoadd = explode (",",$ow_opt_category);
					$cattoaddtemp2 = array("");
					foreach($cattoadd as $i => $v) {
						$v=trim($v);
						if(empty($v)) {
							unset($cattoadd[$i]);
						}	
						wp_create_category($v);
						$cattoaddtemp1 = array($v);
						$cattoaddtemp2 = array_merge((array)$cattoaddtemp1,(array)$cattoaddtemp2);				
					}
					$ok = wp_set_object_terms($ow_insert_id, $cattoaddtemp2, 'category');
				$ow_i++; $pcount = $_POST['post'];				
				echo "post ".$ow_i." $ow_opt_title added<br> "; echo $pcount;
				if ($pcount == $ow_i || $ow_i == 40){exit ('Please upgrade to allow more posts. Goodbye'); } 
	}
// kill process after preview
if ( $ow_previewdone == "ok" )
            {
				echo "all done" ;
				break;
			}
// end skipping first row	
	}
// end the looper	
	}
// end file exist	    
	}
fclose($fp); 	
// end function
}
?>
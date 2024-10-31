<div style="width:100%;text-align:CENTER;">
owagu.com massive datafeed loader - by: Pete Scheepens<hr>
<?php 

ini_set('upload_max_filesize', '20M');  
ini_set('max_execution_time', 600);  

?>
<div style="float:left;width:40%;color:black;text-align:CENTER;background-color:#FDFFD1;">
<div style="color:white;text-align:left;background-color:#000000;">
Commercial version 11-10-2010<br>
STEP. 1 -->
</div>
<h2>Upload Your Datafeed File</h2>

Use the input box below to select a datafeed file from your computer<br> 
<form name="ow_upload_file" enctype="multipart/form-data" method="post">
<input type="hidden" name="ready" value="Y">
<input type="file" name="dataf"/>
<input type="submit" name="Submit" value="<?php _e('Upload !')?>" />
</form>
<?
if (is_uploaded_file($_FILES["dataf"]["tmp_name"])) { 
    echo $_FILES["dataf"]["tmp_name"]; 
	echo "<br>".$_FILES["dataf"]['name'];
	$ext = substr(strrchr($_FILES["dataf"]['name'], '.'), 1); // check extension and load in $ext
	if ($ext == "php") {exit("<hr>I DETECTED A .PHP file ... your file extension is wrong.<br>TRY AGAIN !<hr><hr>"); }
    move_uploaded_file($_FILES["dataf"]["tmp_name"], '../wp-content/plugins/owagu-m4n-datafeed-loader/datafeed/' . $_FILES["dataf"]['name']); 
   // chdir('../wp-content/plugins/owagu-m4n-datafeed-loader/'); 
	echo "<br>File ". $_FILES["dataf"]['name'] ." uploaded successfully.\n"; 
	} // end checking if a file was uploaded
?>
<br>
or choose a previously uploaded datafeed (Do NOT select .zip here)<br>
<form name="ow_upload_file" enctype="multipart/form-data" method="post">
<select name="file">
<option value="">- Select a datafeed -
<?php $dirPath = dir('../wp-content/plugins/owagu-m4n-datafeed-loader/datafeed/');
while (($file = $dirPath->read()) !== false)
{ echo "<option value=\"" . trim($file) . "\">" . $file . "\n";}
$dirPath->close();
?>
</select>
<input type="hidden" name="ready" value="Y2">
<input type="submit" name="Submit" value="<?php _e('use this one !')?>" />
</form>
<br>
<?	
if( $_POST['ready'] != 'Y') { if ($_POST['ready'] != 'Y2') { echo "<br><hr>I have no datafeed to work with. Please upload a new feed-file or select an existing one first<hr><hr><br>";}}
if( $_POST['ready'] == 'Y' ) {
?>
<div style="color:white;width:60%;text-align:left;background-color:#000000;">
New datafeed uploaded ->
</div>
<?	

if ($ext != "zip") {
echo "<br><br><hr><b>OH MY ! you did not use a ZIP FILE<br>
This should not be a problem provided the file is a genuine datafeed<br>
however, I can automatically unzip your files if needed, and uploading zip files simply goes a lot faster..</b><br><hr><hr>"; 
if ($_FILES["dataf"]["error"] > 0) { echo "Error: " . $_FILES["dataf"]["error"] . "<br />Please try again <br />"; }
} 
echo "Uploaded: " . $_FILES["dataf"]["name"];
  echo "<br>Type: " . $_FILES["dataf"]["type"]; if ($_FILES["dataf"]["type"] == ""){ echo "<font color='red'>error loading file</font>";}
  echo "<br>Size: " . ($_FILES["dataf"]["size"] / 1024) . " Kb";
  echo "<br>Stored in: " . $_FILES["dataf"]["tmp_name"];
$cTxtFile = $_FILES['dataf']['name']; 	
 if ($ext == "zip") {echo "<br><b>zip file detected! trying to unzip ...</b>"; exec("/usr/bin/unzip " . $_FILES['dataf']['name'], $aOutput); 
     print_r($aOutput); 
	 
if(isset($_FILES['dataf'])){
	require_once('pclzip.lib.php'); 
	echo "<br>before setting upload dire".getcwd() . "\n"; 
	$upload_dir = '../wp-content/plugins/owagu-m4n-datafeed-loader/datafeed/'; 
	$filename = $_FILES['dataf']['name']; 
	$zip_dir = basename($filename, ".zip"); 
	$archive = new PclZip($upload_dir.'/'.$filename);
	if ($archive->extract(PCLZIP_OPT_PATH, $upload_dir) == 0)
		die("<font color='red'>Error : Unable to unzip archive</font>");	
	$list = $archive->listContent();
	echo "<br /><b>Files in Archive</b><br />";
	for ($i=0; $i<sizeof($list); $i++) {	
		if(!$list[$i]['folder'])
			$bytes = " - ".$list[$i]['size']." bytes";
		else
			$bytes = "";
		
		echo "".$list[$i]['filename']."$bytes<br />";
	}
}	 
	 $cTxtFile = str_replace('.zip', '.txt', $_FILES['dataf']['name']);
echo "<br>File ". $cTxtFile ." unzipped successfully.\n<br>"; 
}
$file_location = "../wp-content/plugins/owagu-m4n-datafeed-loader/datafeed/".$cTxtFile;
if ($file_location == ""){echo "<br>final destination is:".$file_location."<br><font color='red'><br>Please contact your ISP admin - I could not copy the file to the working directory due to your ISP's settings.
 Tell them I tried using the php copy() command and the php move_uploaded_file command.
in the meantime, if you have ftp access, you can try to copy files directly into the datafeed directory inside ow-datafeed. Sorry for the inconvenience but this is not a script problem.</font>
";} else {echo "<br>final destination is:".$file_location;}
update_option( "ow_file_location", $file_location );
}
if( $_POST['ready'] == 'Y2' ) {
$ext = substr(strrchr($_POST['file'], '.'), 1); 
if ($ext == "zip") { 
echo "<hr>Uploaded: " . $_POST['file'];
echo "<br><b>You have chosen a ZIP FILE</b><br>
While uploading a zip file the first time we would have already automatically unzipped the file and given it a .txt extension..<br>So when you select
a pre-existing file you should preferably select a .txt .csv or a .xml file<br>Please try another file.<br><hr><hr>";
exit ("<hr><br><h3>try again</h3><br><hr><br>"); 
} 
echo "Uploaded: " . $_POST['file'];
echo "<br>File ". $_POST['file'] ." now ready for processing.\n"; 	
 if ($ext == "zip") {echo "<br><b>zip file detected! trying to unzip ...</b>";exec("/usr/bin/unzip " . $_POST['file'], $aOutput); }
    
    $cTxtFile = str_replace('.zip', '.txt', $_POST['file']); 	
echo "<br>File ". $cTxtFile ." unzipped successfully.\n<br>"; 

$file_location = "../wp-content/plugins/owagu-m4n-datafeed-loader/datafeed/".$cTxtFile;
update_option( "ow_file_location", $file_location );
echo "<br>final destination is:".$file_location;
}
?>


<hr>
<div style="color:white;text-align:left;background-color:#000000;">
STEP. 2 -->
</div>
Please select your datafeed provider below<br> and then set your identification for that datafeed provider !<br>
(For instance a Shareasale ID would be numbers like 438368 and a clickbank ID would be a name like OWAGU).<br>
<form name="ow_provider" enctype="multipart/form-data" method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<SELECT NAME=provider>
<OPTION>m4n</OPTION>
<OPTION>this is a m4n</OPTION>
<OPTION>only version</OPTION>
<OPTION>please upgrade to</OPTION>
<OPTION>have full access</OPTION>
</SELECT>
<input type="text" name="prov_id" value="<?php echo get_option('prov_id'); ?>" />
<input type="hidden" name="action" value="update" />
<input type="hidden" name="provide" value="Y">
<input type="hidden" name="page_options" value="provider,provide,prov_id" />
<input type="submit" name="Submit" value="start next step" />
</form>
<br>
</div> <? // this ends the yellow loader box ?>

<? // start blue info box ?>
<div style="float:right;width:60%;color:black;text-align:CENTER;background-color:#CCF3FF;">
<div style="color:white;text-align:left;background-color:#000000;">
important information from owagu.com
</div>


<div style="float:right;width:30%;color:black;text-align:CENTER;background-color:#FFA98F;">
I can instantly delete ALL posts, categories and tags in the <b>main</b> blog. (wp_posts etc. for the pro's).
<br /><form method="post" action="<?php echo $PHP_SELF;?>">
Vaporize all posts instantly ? (No way back ..) <br><input type="radio" value="all" name="delall"><br /><br />
<input type="submit" value="delete" name="delete"><br />
</form>
<? if ($_POST['delete'] == "delete") {
echo "<h2>Erasing all table contents</h2>";
	$table="wp_posts";
mysql_query("TRUNCATE $table");
	$table="wp_terms";
mysql_query("TRUNCATE $table");
$table="wp_term_taxonomy";
mysql_query("TRUNCATE $table");
$table="wp_term_relationships";
mysql_query("TRUNCATE $table");
	
echo "<center><h3>ALL YOUR TABLES HAVE BEEN DROPPED</h3><br><hr>your main blog is empty";
	
	
	}
?>
I can clean out the directory holding all the uploaded datafeeds. Erase them all ?
<br /><form method="post" action="<?php echo $PHP_SELF;?>">
Vaporize all datafeed files ? (No way back ..) <br><input type="radio" value="all" name="delall"><br /><br />
<input type="submit" value="clean" name="deldf"><br />
</form>
<? if ($_POST['deldf'] == "clean"){	
$dfdir = '../wp-content/plugins/owagu-m4n-datafeed-loader/datafeed/';
foreach(glob($dfdir.'*.*') as $dftogo){
unlink($dftogo);
}
foreach(glob($dfdir.'*') as $dftogo){
unlink($dftogo);
}
?><h3>All datafeed files are now deleted</h3><?
}
	?>

</div> 






<h2>owagu.com's massive datafeed loader</h2>
This multi-loader can import datafeeds from dozens of datafeed providers, 
and turn them in to fully SEO optimized mega-malls and store fronts.<br>
Simply upload your datafeed (.zip .txt .csv or .xml) and select your datafeed
provider.<hr>
For more information please visit our <a href="http://owagu.com/forums" target="_blank" >forum</a><br>
To upgrade to commercial versions or to add loaders <a href="http://datafeeds.owagu.com/" target="_blank" >go here</a><br>
<iframe src="http://portaljumper.com/news/loader_main.php" width="300" height="80"></iframe>
</div><? // end info box ?>


<? if (get_option("provide") == "Y") { // start final check & proceed box
?>
<div style="float:right;width:60%;color:black;text-align:CENTER;background-color:#DAFFCC;">
<div style="color:white;text-align:left;background-color:#000000;">
STEP. 3 -->     O.K. Here we go, almost there .... check & proceed
</div>
<? 
echo "your datafeed provider is: ".get_option('provider');
echo "<br>your datafeed provider identification is: ".get_option('prov_id');
echo "<br>the file we are going to use is:<br> ".get_option('ow_file_location');
echo "<hr><br><b>Just a few more checks before we can proceed !</b><BR>";
echo "you chose ".get_option('provider'). "<br>Checking existance of loader file ...<br>"; 
if (is_file('../wp-content/plugins/owagu-m4n-datafeed-loader/loader_'.get_option('provider').'.php'))
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/found.png',_FILE_)?>"/> | <?PHP echo get_option('provider'); ?> loader found <br><a href="<?php bloginfo(url) ?>/wp-admin/admin.php?page=loader_<?PHP echo get_option('provider'); ?>">click here to proceed</a>  <? } else
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/notfound.jpg',_FILE_)?>"/> | <?PHP echo get_option('provider'); ?> loader not found <a href="http://datafeeds.owagu.com">get it now</a>.<? }
?></div><?
update_option("provide","no");
}
?>
</div>

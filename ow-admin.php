<div style="width:80%;text-align:center;background-color:#EDEDED;">
<br>
<div style="color:#F7FE2E;width:100%;text-align:left;background-color: #292A0A; ">	
Owagu.com - massive datafeed loader -> ADMINISTRATION PANEL
</div>	
<b>Thank you for working with a premium owagu.com plugin !<br>You are on the admin & settings page.<br>
While working with our plugin you will see boxes of different color, asking you to perform different tasks.</b><br />
<div style="float:left;color:black;width:100%;text-align:center;background-color:#DAFFCC;padding: 5px 0px 5px 0px;">
green boxes collect data and present you with optional choices
</div>
<div style="float:left;color:black;width:100%;text-align:center;background-color: #FDFFD1;padding: 5px 0px 5px 0px;">
yellow boxes require user input ! You need to click on something there, or fill something out	
</div>
<div style="float:left;color:black;width:100%;text-align:center;background-color: #CCF3FF;padding: 5px 0px 5px 0px;">
blue boxes are informational and may give you helpful hints and tips
</div>
<div style="float:left;color:black;width:100%;text-align:center;background-color: #FFA98F;padding: 5px 0px 5px 0px;">
red boxes usually contain power-tools or advanced options - think twice before using them !
</div>
<h2>this is a special m4n core - version 11-10-10</h2>
<a href="<?php bloginfo(url) ?>/wp-admin/admin.php?page=ow-upload"><h3>Start loading a datafeed.</h3></a>

<div style="float:left;color:black;width:48%;text-align:center;background-color: #FDFFD1;">	
<div style="float:left;color:#F7FE2E;width:50%;text-align:left;background-color: #292A0A;">	
install a new datafeed loader
</div><br><hr>
This section can be used to upload new datafeed loaders, parsers and converters.
If you have purchased or downloaded a parser file, please upload it here to add
 it's functionality to your plugin.<br>
 Use the input box below to select a datafeed file from your computer<br> 
<form name="ow_upload_file" enctype="multipart/form-data" method="post">
<input type="hidden" name="ad_loader" value="Y">
<input type="file" name="loader"/>
<input type="submit" name="Submit" value="add a new loader" />
</form>
<?
if (is_uploaded_file($_FILES["loader"]["tmp_name"])) { 
    echo $_FILES["loader"]["tmp_name"]; 
	echo "<br>".$_FILES['loader']['name'];
	$ext = substr(strrchr($_FILES['loader']['name'], '.'), 1); // check extension and load in $ext
	if ($ext != "php") {exit("<hr>DID NOT DETECT A .PHP file ... your file extension is wrong.<br>TRY AGAIN !<hr><hr>"); }
    move_uploaded_file($_FILES["loader"]["tmp_name"], '../wp-content/plugins/owagu-m4n-datafeed-loader/' . $_FILES['loader']['name']); 
   // chdir('../wp-content/plugins/owagu-m4n-datafeed-loader/'); 
	echo "<br>File ". $_FILES['loader']['name'] ." uploaded successfully.\n"; 
	} // end checking if a file was uploaded
?> 
<br /><div style="float:left;color:black;width:100%;text-align:center;background-color:#DAFFCC;">
<div style="float:left;color:#F7FE2E;width:50%;text-align:left;background-color: #292A0A;">	
checking loader availability .....
</div>
<br />
<hr>Is your datafeed provider not present ? <a href="mailto:info@owagu.com?subject=PLEASE ADD A DATAFEED PROVIDER TO YOUR PLUGIN">Ask us</a> to include them. 
<hr>
 <?	
// let's check loader existances

if (is_file('../wp-content/plugins/owagu-m4n-datafeed-loader/loader_shareasale.php'))
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/found.png',_FILE_)?>"/> | shareasale loader found   <? } else
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/notfound.jpg',_FILE_)?>"/> | shareasale loader not found <a href="http://datafeeds.owagu.com/category/parsers-and-loaders/" target="_blank">get it now</a>.<? }
if (is_file('../wp-content/plugins/owagu-m4n-datafeed-loader/loader_clickbank.php'))
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/found.png',_FILE_)?>"/> | clickbank loader found   <? } else
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/notfound.jpg',_FILE_)?>"/> | clickbank loader not found <a href="http://datafeeds.owagu.com/category/parsers-and-loaders/" target="_blank">get it now</a>.<? }
if (is_file('../wp-content/plugins/owagu-m4n-datafeed-loader/loader_cj.php'))
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/found.png',_FILE_)?>"/> | commission junction loader found   <? } else
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/notfound.jpg',_FILE_)?>"/> | commission junction loader not found <a href="http://datafeeds.owagu.com/category/parsers-and-loaders/" target="_blank">get it now</a>.<? }
if (is_file('../wp-content/plugins/owagu-m4n-datafeed-loader/loader_zanox.php'))
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/found.png',_FILE_)?>"/> | zanox loader found   <? } else
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/notfound.jpg',_FILE_)?>"/> | zanox loader not found <a href="http://datafeeds.owagu.com/category/parsers-and-loaders/" target="_blank">get it now</a>.<? }
if (is_file('../wp-content/plugins/owagu-m4n-datafeed-loader/loader_m4n.php'))
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/found.png',_FILE_)?>"/> | m4n loader found   <? } else
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/notfound.jpg',_FILE_)?>"/> | m4n loader not found <a href="http://datafeeds.owagu.com/category/parsers-and-loaders/" target="_blank">get it now</a>.<? }
if (is_file('../wp-content/plugins/owagu-m4n-datafeed-loader/loader_eroad.php'))
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/found.png',_FILE_)?>"/> | ero-advertising loader found   <? } else
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/notfound.jpg',_FILE_)?>"/> | ero-advertising loader not found <a href="http://datafeeds.owagu.com/category/parsers-and-loaders/" target="_blank">get it now</a>.<? }
if (is_file('../wp-content/plugins/owagu-m4n-datafeed-loader/loader_tradetr.php'))
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/found.png',_FILE_)?>"/> | trade tracker loader found   <? } else
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/notfound.jpg',_FILE_)?>"/> | trade tracker loader not found <a href="http://datafeeds.owagu.com/category/parsers-and-loaders/" target="_blank">get it now</a>.<? }
if (is_file('../wp-content/plugins/owagu-m4n-datafeed-loader/loader_gan.php'))
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/found.png',_FILE_)?>"/> | google adv. netw. loader found   <? } else
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/notfound.jpg',_FILE_)?>"/> | google adv. netw. loader not found <a href="http://datafeeds.owagu.com/category/parsers-and-loaders/" target="_blank">get it now</a>.<? }
if (is_file('../wp-content/plugins/owagu-m4n-datafeed-loader/loader_generic.php'))
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/found.png',_FILE_)?>"/> | generic loader found   <? } else
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/notfound.jpg',_FILE_)?>"/> | generic loader not found <a href="http://datafeeds.owagu.com/category/parsers-and-loaders/" target="_blank">get it now</a>.<? }
if (is_file('../wp-content/plugins/owagu-m4n-datafeed-loader/loader_developer.php'))
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/found.png',_FILE_)?>"/> | developers loader found   <? } else
{ ?> <br><img src="<? echo plugins_url('/owagu-m4n-datafeed-loader/images/notfound.jpg',_FILE_)?>"/> | developers loader not found <a href="http://datafeeds.owagu.com/category/parsers-and-loaders/" target="_blank">get it now</a>.<? }



// end checking loader existance
?>
</div>
</div>
<div style="float:right;color:black;width:48%;text-align:center;background-color: #CCF3FF;">			
<div style="float:left;color:#F7FE2E;width:50%;text-align:left;background-color: #292A0A;">	
Owagu.com - information
</div><br><hr>
Owagu.com's massive datafeed loader uses separate parsers to translate, convert and upload 
datafeeds. Since every datafeed provider uses a different layout and even datafeed file extensions
are different we need parser files to be able to work with each feed.<br>
Here you can see which parsers are installed on your system. If you are missing parsers you can add them
to your system by simply uploading them here.<br /><hr><b>O.K. you want to pump some datafeeds ...<br /><br>
<a href="<?php bloginfo(url) ?>/wp-admin/admin.php?page=ow-upload">
Step.1 ></a> upload a datafeed and tell us a bit about it<br>
Step.2 > preview your layout in the correct loader<br>
step.3 > hit the button and wait a few seconds for the miracle ..</b><br><br />
		
</div>
<br /><br /><hr><br />
</div> 
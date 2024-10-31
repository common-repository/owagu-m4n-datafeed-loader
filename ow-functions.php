<?php
ini_set('upload_max_filesize', '20M');  
ini_set('max_execution_time', 600);  

function ow_process_datafeed($ow_preview,$ow_time_interval,$ow_time_factor ){

	//declare WP pointer
	global $wpdb;
	
	// Declare a class to build a post don't delete it!
	class wm_mypost {
		var $post_content;
		var $post_title;    
		var $post_status;    
		var $post_author = 1; // Default admin						
	}
	
	// Preview mode "ok" when done
	$ow_previewdone= "";
	
	if($ow_preview){
		echo"<h2>Preview Post Template With Data</h2>";
	}
	if(!$ow_preview){
		echo"<h2>Processing Datafeed File...</h2>";
	}
	
	// Start reading datafeed file 
	$ow_file_location = get_option( "ow_file_location");
	$ow_data = file_get_contents("$ow_file_location");
	
	if( file_exists($ow_file_location)) {
		
		$ow_data = file_get_contents("$ow_file_location");
		$ow_data = str_replace("\r", "", $ow_data);
		$ow_data = explode("\n", $ow_data);
		$ow_i=0;
		
		// Init future post variable		
		$ow_time_from_start = 0;
		$prv = 1;
		foreach($ow_data as $k=>$v) {
			
			if ( $ow_previewdone == "ok" ){
				break;
			}
			if(empty($v)) {
				unset($ow_data[$k]);
			}
			else { 
				
								
				// Read file row
				$ow_row = explode("|", $v);
				$PROGRAMNAME 			= $ow_row[0];
				$PROGRAMURL				= $ow_row[1];	
				$CATALOGNAME			= $ow_row[2];
				$LASTUPDATED			= $ow_row[3];
				$NAME					= $ow_row[4];
				$KEYWORDS				= $ow_row[5];
				$DESCRIPTION			= $ow_row[6];
				$SKU					= $ow_row[7];
				$MANUFACTURER			= $ow_row[8];
				$MANUFACTURERID			= $ow_row[9];
				$UPC					= $ow_row[10];
				$ISBN					= $ow_row[11];
				$CURRENCY				= $ow_row[12];
				$SALEPRICE				= $ow_row[13];
				$PRICE					= $ow_row[14];
				$RETAILPRICE			= $ow_row[15];
				$FROMPRICE				= $ow_row[16];
				$BUYURL					= $ow_row[17];	
				$IMPRESSIONURL			= $ow_row[18];
				$IMAGEURL				= $ow_row[19];
				$ADVERTISERCATEGORY		= $ow_row[20];
				$THIRDPARTYID			= $ow_row[21];
				$THIRDPARTYCATEGORY		= $ow_row[22];
				$AUTHOR					= $ow_row[23];
				$ARTIST					= $ow_row[24];
				$TITLE					= $ow_row[25];
				$PUBLISHER				= $ow_row[26];
				$LABEL					= $ow_row[27];
				$FORMAT					= $ow_row[28];
				$SPECIAL				= $ow_row[29];
				$GIFT					= $ow_row[30];
				$PROMOTIONALTEXT		= $ow_row[31];
				$STARTDATE				= $ow_row[32];
				$ENDDATE				= $ow_row[33];
				$OFFLINE				= $ow_row[34];
				$ONLINE					= $ow_row[35];
				$INSTOCK				= $ow_row[36];
				$CONDITION				= $ow_row[37];
				$WARRANTY				= $ow_row[38];
				$STANDARDSHIPPINGCOST	= $ow_row[39];
				
														
				// Get template options value		
				$ow_opt_title = get_option("ow_template_title");
				$ow_opt_post = get_option("ow_template_post");
				$ow_opt_category = get_option("ow_template_category");
				$ow_opt_tag = get_option("ow_template_tag");
			
			
				// Process title
				$ow_opt_title = str_replace("ow_PROGRAMNAME", "$PROGRAMNAME", $ow_opt_title);
				$ow_opt_title = str_replace("ow_PROGRAMURL", "$PROGRAMURL", $ow_opt_title);
				$ow_opt_title = str_replace("ow_CATALOGNAME", "$CATALOGNAME", $ow_opt_title);
				$ow_opt_title = str_replace("ow_LASTUPDATED", "$LASTUPDATED", $ow_opt_title);
				$ow_opt_title = str_replace("ow_NAME", "$NAME", $ow_opt_title);
				$ow_opt_title = str_replace("ow_KEYWORDS", "$KEYWORDS", $ow_opt_title);
				$ow_opt_title = str_replace("ow_DESCRIPTION", "$DESCRIPTION", $ow_opt_title);
				$ow_opt_title = str_replace("ow_SKU", "$SKU", $ow_opt_title);
				$ow_opt_title = str_replace("ow_MANUFACTURER", "$MANUFACTURER", $ow_opt_title);
				$ow_opt_title = str_replace("ow_ANUFACTURERID", "$MANUFACTURERID", $ow_opt_title);
				$ow_opt_title = str_replace("ow_UPC", "$UPC", $ow_opt_title);
				$ow_opt_title = str_replace("ow_ISBN", "$ISBN", $ow_opt_title);
				$ow_opt_title = str_replace("ow_CURRENCY", "$CURRENCY", $ow_opt_title);
				$ow_opt_title = str_replace("ow_SALEPRICE", "$SALEPRICE", $ow_opt_title);
				$ow_opt_title = str_replace("ow_PRICE", "$PRICE", $ow_opt_title);
				$ow_opt_title = str_replace("ow_RETAILPRICE", "$RETAILPRICE", $ow_opt_title);				
				$ow_opt_title = str_replace("ow_FROMPRICE", "$FROMPRICE", $ow_opt_title);
				$ow_opt_title = str_replace("ow_BUYURL", "$BUYURL", $ow_opt_title);
				$ow_opt_title = str_replace("ow_IMPRESSIONURL", "$IMPRESSIONURL", $ow_opt_title);
				$ow_opt_title = str_replace("ow_IMAGEURL", "$IMAGEURL", $ow_opt_title);
				$ow_opt_title = str_replace("ow_ADVERTISERCATEGORY", "$ADVERTISERCATEGORY", $ow_opt_title);
				$ow_opt_title = str_replace("ow_THIRDPARTYID", "$THIRDPARTYID", $ow_opt_title);
				$ow_opt_title = str_replace("ow_THIRDPARTYCATEGORY", "$THIRDPARTYCATEGORY", $ow_opt_title);
				$ow_opt_title = str_replace("ow_AUTHOR", "$AUTHOR", $ow_opt_title);
				$ow_opt_title = str_replace("ow_ARTIST", "$ARTIST", $ow_opt_title);
				$ow_opt_title = str_replace("ow_TITLE", "$TITLE", $ow_opt_title);
				$ow_opt_title = str_replace("ow_PUBLISHER", "$PUBLISHER", $ow_opt_title);
				$ow_opt_title = str_replace("ow_LABEL", "$LABEL", $ow_opt_title);
				$ow_opt_title = str_replace("ow_FORMAT", "$FORMAT", $ow_opt_title);
				$ow_opt_title = str_replace("ow_SPECIAL", "$SPECIAL", $ow_opt_title);
				$ow_opt_title = str_replace("ow_GIFT", "$GIFT", $ow_opt_title);
				$ow_opt_title = str_replace("ow_PROMOTIONALTEXT", "$PROMOTIONALTEXT", $ow_opt_title);
				$ow_opt_title = str_replace("ow_STARTDATE", "$STARTDATE", $ow_opt_title);
				$ow_opt_title = str_replace("ow_ENDDATE", "$ENDDATE", $ow_opt_title);
				$ow_opt_title = str_replace("ow_ONLINE", "$ONLINE", $ow_opt_title);
				$ow_opt_title = str_replace("ow_OFFLINE", "$OFFLINE", $ow_opt_title);
				$ow_opt_title = str_replace("ow_INSTOCK", "$INSTOCK", $ow_opt_title);
				$ow_opt_title = str_replace("ow_CONDITION", "$CONDITION", $ow_opt_title);
				$ow_opt_title = str_replace("ow_WARRANTY", "$WARRANTY", $ow_opt_title);
				$ow_opt_title = str_replace("ow_STANDARDSHIPPINGCOST", "$STANDARDSHIPPINGCOST", $ow_opt_title);

				// Process post
				$ow_opt_post = str_replace("ow_PROGRAMNAME", "$PROGRAMNAME", $ow_opt_post);
				$ow_opt_post = str_replace("ow_PROGRAMURL", "$PROGRAMURL", $ow_opt_post);
				$ow_opt_post = str_replace("ow_CATALOGNAME", "$CATALOGNAME", $ow_opt_post);
				$ow_opt_post = str_replace("ow_LASTUPDATED", "$LASTUPDATED", $ow_opt_post);
				$ow_opt_post = str_replace("ow_NAME", "$NAME", $ow_opt_post);
				$ow_opt_post = str_replace("ow_KEYWORDS", "$KEYWORDS", $ow_opt_post);
				$ow_opt_post = str_replace("ow_DESCRIPTION", "$DESCRIPTION", $ow_opt_post);
				$ow_opt_post = str_replace("ow_SKU", "$SKU", $ow_opt_post);
				$ow_opt_post = str_replace("ow_MANUFACTURER", "$MANUFACTURER", $ow_opt_post);
				$ow_opt_post = str_replace("ow_ANUFACTURERID", "$MANUFACTURERID", $ow_opt_post);
				$ow_opt_post = str_replace("ow_UPC", "$UPC", $ow_opt_post);
				$ow_opt_post = str_replace("ow_ISBN", "$ISBN", $ow_opt_post);
				$ow_opt_post = str_replace("ow_CURRENCY", "$CURRENCY", $ow_opt_post);
				$ow_opt_post = str_replace("ow_SALEPRICE", "$SALEPRICE", $ow_opt_post);
				$ow_opt_post = str_replace("ow_PRICE", "$PRICE", $ow_opt_post);
				$ow_opt_post = str_replace("ow_RETAILPRICE", "$RETAILPRICE", $ow_opt_post);				
				$ow_opt_post = str_replace("ow_FROMPRICE", "$FROMPRICE", $ow_opt_post);
				$ow_opt_post = str_replace("ow_BUYURL", "$BUYURL", $ow_opt_post);
				$ow_opt_post = str_replace("ow_IMPRESSIONURL", "$IMPRESSIONURL", $ow_opt_post);
				$ow_opt_post = str_replace("ow_IMAGEURL", "$IMAGEURL", $ow_opt_post);
				$ow_opt_post = str_replace("ow_ADVERTISERCATEGORY", "$ADVERTISERCATEGORY", $ow_opt_post);
				$ow_opt_post = str_replace("ow_THIRDPARTYID", "$THIRDPARTYID", $ow_opt_post);
				$ow_opt_post = str_replace("ow_THIRDPARTYCATEGORY", "$THIRDPARTYCATEGORY", $ow_opt_post);
				$ow_opt_post = str_replace("ow_AUTHOR", "$AUTHOR", $ow_opt_post);
				$ow_opt_post = str_replace("ow_ARTIST", "$ARTIST", $ow_opt_post);
				$ow_opt_post = str_replace("ow_TITLE", "$TITLE", $ow_opt_post);
				$ow_opt_post = str_replace("ow_PUBLISHER", "$PUBLISHER", $ow_opt_post);
				$ow_opt_post = str_replace("ow_LABEL", "$LABEL", $ow_opt_post);
				$ow_opt_post = str_replace("ow_FORMAT", "$FORMAT", $ow_opt_post);
				$ow_opt_post = str_replace("ow_SPECIAL", "$SPECIAL", $ow_opt_post);
				$ow_opt_post = str_replace("ow_GIFT", "$GIFT", $ow_opt_post);
				$ow_opt_post = str_replace("ow_PROMOTIONALTEXT", "$PROMOTIONALTEXT", $ow_opt_post);
				$ow_opt_post = str_replace("ow_STARTDATE", "$STARTDATE", $ow_opt_post);
				$ow_opt_post = str_replace("ow_ENDDATE", "$ENDDATE", $ow_opt_post);
				$ow_opt_post = str_replace("ow_ONLINE", "$ONLINE", $ow_opt_post);
				$ow_opt_post = str_replace("ow_OFFLINE", "$OFFLINE", $ow_opt_post);
				$ow_opt_post = str_replace("ow_INSTOCK", "$INSTOCK", $ow_opt_post);
				$ow_opt_post = str_replace("ow_CONDITION", "$CONDITION", $ow_opt_post);
				$ow_opt_post = str_replace("ow_WARRANTY", "$WARRANTY", $ow_opt_post);
				$ow_opt_post = str_replace("ow_STANDARDSHIPPINGCOST", "$STANDARDSHIPPINGCOST", $ow_opt_post);
				$ow_opt_post = str_replace("YOURUSERID", get_option('prov_id') , $ow_opt_post);								
				// Process category
				$ow_opt_category = str_replace("ow_PROGRAMNAME", "$PROGRAMNAME", $ow_opt_category);
				$ow_opt_category = str_replace("ow_PROGRAMURL", "$PROGRAMURL", $ow_opt_category);
				$ow_opt_category = str_replace("ow_CATALOGNAME", "$CATALOGNAME", $ow_opt_category);
				$ow_opt_category = str_replace("ow_LASTUPDATED", "$LASTUPDATED", $ow_opt_category);
				$ow_opt_category = str_replace("ow_NAME", "$NAME", $ow_opt_category);
				$ow_opt_category = str_replace("ow_KEYWORDS", "$KEYWORDS", $ow_opt_category);
				$ow_opt_category = str_replace("ow_DESCRIPTION", "$DESCRIPTION", $ow_opt_category);
				$ow_opt_category = str_replace("ow_SKU", "$SKU", $ow_opt_category);
				$ow_opt_category = str_replace("ow_MANUFACTURER", "$MANUFACTURER", $ow_opt_category);
				$ow_opt_category = str_replace("ow_ANUFACTURERID", "$MANUFACTURERID", $ow_opt_category);
				$ow_opt_category = str_replace("ow_UPC", "$UPC", $ow_opt_category);
				$ow_opt_category = str_replace("ow_ISBN", "$ISBN", $ow_opt_category);
				$ow_opt_category = str_replace("ow_CURRENCY", "$CURRENCY", $ow_opt_category);
				$ow_opt_category = str_replace("ow_SALEPRICE", "$SALEPRICE", $ow_opt_category);
				$ow_opt_category = str_replace("ow_PRICE", "$PRICE", $ow_opt_category);
				$ow_opt_category = str_replace("ow_RETAILPRICE", "$RETAILPRICE", $ow_opt_category);				
				$ow_opt_category = str_replace("ow_FROMPRICE", "$FROMPRICE", $ow_opt_category);
				$ow_opt_category = str_replace("ow_BUYURL", "$BUYURL", $ow_opt_category);
				$ow_opt_category = str_replace("ow_IMPRESSIONURL", "$IMPRESSIONURL", $ow_opt_category);
				$ow_opt_category = str_replace("ow_IMAGEURL", "$IMAGEURL", $ow_opt_category);
				$ow_opt_category = str_replace("ow_ADVERTISERCATEGORY", "$ADVERTISERCATEGORY", $ow_opt_category);
				$ow_opt_category = str_replace("ow_THIRDPARTYID", "$THIRDPARTYID", $ow_opt_category);
				$ow_opt_category = str_replace("ow_THIRDPARTYCATEGORY", "$THIRDPARTYCATEGORY", $ow_opt_category);
				$ow_opt_category = str_replace("ow_AUTHOR", "$AUTHOR", $ow_opt_category);
				$ow_opt_category = str_replace("ow_ARTIST", "$ARTIST", $ow_opt_category);
				$ow_opt_category = str_replace("ow_TITLE", "$TITLE", $ow_opt_category);
				$ow_opt_category = str_replace("ow_PUBLISHER", "$PUBLISHER", $ow_opt_category);
				$ow_opt_category = str_replace("ow_LABEL", "$LABEL", $ow_opt_category);
				$ow_opt_category = str_replace("ow_FORMAT", "$FORMAT", $ow_opt_category);
				$ow_opt_category = str_replace("ow_SPECIAL", "$SPECIAL", $ow_opt_category);
				$ow_opt_category = str_replace("ow_GIFT", "$GIFT", $ow_opt_category);
				$ow_opt_category = str_replace("ow_PROMOTIONALTEXT", "$PROMOTIONALTEXT", $ow_opt_category);
				$ow_opt_category = str_replace("ow_STARTDATE", "$STARTDATE", $ow_opt_category);
				$ow_opt_category = str_replace("ow_ENDDATE", "$ENDDATE", $ow_opt_category);
				$ow_opt_category = str_replace("ow_ONLINE", "$ONLINE", $ow_opt_category);
				$ow_opt_category = str_replace("ow_OFFLINE", "$OFFLINE", $ow_opt_category);
				$ow_opt_category = str_replace("ow_INSTOCK", "$INSTOCK", $ow_opt_category);
				$ow_opt_category = str_replace("ow_CONDITION", "$CONDITION", $ow_opt_category);
				$ow_opt_category = str_replace("ow_WARRANTY", "$WARRANTY", $ow_opt_category);
				$ow_opt_category = str_replace("ow_STANDARDSHIPPINGCOST", "$STANDARDSHIPPINGCOST", $ow_opt_category);
				
				// Process tag
				$ow_opt_tag = str_replace("ow_PROGRAMNAME", "$PROGRAMNAME", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_PROGRAMURL", "$PROGRAMURL", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_CATALOGNAME", "$CATALOGNAME", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_LASTUPDATED", "$LASTUPDATED", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_NAME", "$NAME", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_KEYWORDS", "$KEYWORDS", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_DESCRIPTION", "$DESCRIPTION", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_SKU", "$SKU", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_MANUFACTURER", "$MANUFACTURER", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_ANUFACTURERID", "$MANUFACTURERID", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_UPC", "$UPC", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_ISBN", "$ISBN", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_CURRENCY", "$CURRENCY", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_SALEPRICE", "$SALEPRICE", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_PRICE", "$PRICE", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_RETAILPRICE", "$RETAILPRICE", $ow_opt_tag);				
				$ow_opt_tag = str_replace("ow_FROMPRICE", "$FROMPRICE", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_BUYURL", "$BUYURL", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_IMPRESSIONURL", "$IMPRESSIONURL", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_IMAGEURL", "$IMAGEURL", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_ADVERTISERCATEGORY", "$ADVERTISERCATEGORY", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_THIRDPARTYID", "$THIRDPARTYID", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_THIRDPARTYCATEGORY", "$THIRDPARTYCATEGORY", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_AUTHOR", "$AUTHOR", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_ARTIST", "$ARTIST", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_TITLE", "$TITLE", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_PUBLISHER", "$PUBLISHER", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_LABEL", "$LABEL", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_FORMAT", "$FORMAT", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_SPECIAL", "$SPECIAL", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_GIFT", "$GIFT", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_PROMOTIONALTEXT", "$PROMOTIONALTEXT", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_STARTDATE", "$STARTDATE", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_ENDDATE", "$ENDDATE", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_ONLINE", "$ONLINE", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_OFFLINE", "$OFFLINE", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_INSTOCK", "$INSTOCK", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_CONDITION", "$CONDITION", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_WARRANTY", "$WARRANTY", $ow_opt_tag);
				$ow_opt_tag = str_replace("ow_STANDARDSHIPPINGCOST", "$STANDARDSHIPPINGCOST", $ow_opt_tag);
				
										
				// IF preview mode-> display data 
				if($ow_preview == "1"){
					echo "<h2>$ow_opt_title</h2>";
					echo "$ow_opt_post<br><br>";
					echo "Category : $ow_opt_category <br><br> Tags : $ow_opt_tag<br><hr>";
		         /*
					echo " 	<h2>Build from this data</h2>
							
							Program name: $PROGRAMNAME<br>
						   	Program url: $PROGRAMURL<br>		
						   	Catalog name: $CATALOGNAME<br>			
						   	Last updated: $LASTUPDATED<br>
						  	Name: $NAME<br>
							Keywords: $KEYWORDS<br>
							Description: $DESCRIPTION<br>
							SKU: $SKU<br>
							Manufacturer: $MANUFACTURER<br>
							ManufacturerID: $MANUFACTURERID<bR>
							UPC: $UPC<br>		
							ISBN: $ISBN	<br>
							Currency: $CURRENCY<br>
							Sale price:	$SALEPRICE	
							Price: $PRICE<br>
							Retail Price: $RETAILPRICE<br>
							From Price: $FROMPRICE<br>
							Buy URL: $BUYURL<br>
							Impressionurl: $IMPRESSIONURL<br>
							Image URL: $IMAGEURL<br>
							Advertiser Category: $ADVERTISERCATEGORY<br>
							ThirdpartyID: $THIRDPARTYID<br>
							ThirdpartyCategory:	$THIRDPARTYCATEGORY<br>
							Author: $AUTHOR<br>
							Artist:	$ARTIST<br>
							Title: $TITLE<br>
							Publisher: $PUBLISHER<br>
							Label: $LABEL<br>
							Format: $FORMAT<br>
							Special: $SPECIAL<br>
							Gift: $GIFT<br>
							Promotion Text: $PROMOTIONALTEXT<br>
							Start Date: $STARTDATE<br>
							End Date: $ENDDATE<br>
							Offline: $OFFLINE<br>
							Online: $ONLINE<br>
							IN Stock: $INSTOCK<br>
							Condition: $CONDITION<br>
							Warranty: $WARRANTY<br>
							Standard Shipping Cost: $STANDARDSHIPPINGCOST<br>		
							<br>
							
					     ";
                     */
					$prv++ ;
					if ($prv == 5){
					$ow_previewdone = "ok";
					}		            	
				}
				//ELSE ->post datafeed to WP
				else {
				
				//Prepare post
			
					
		
				
				$ow_mypost = new wm_mypost();
				$ow_mypost->post_title = addslashes( $ow_opt_title );
				$ow_mypost->post_content = addslashes( $ow_opt_post );
				
				// Setting future post time format for WP
				$ow_blogtime = current_time('mysql'); 
				//echo"ow_blogtime variable : $ow_blogtime... ";
				
				$outFormat = "Y-m-d H:i:s";				
				$ow_future_post = "+".$ow_time_from_start." $ow_time_factor";
				//echo " ".strToDate( "Y-m-d H:i:s", $ow_future_post)." ";
						
				//$ow_mypost->post_status = 'publish';
				$ow_mypost->post_status = 'future';
				$ow_mypost->post_date = strToDate( "Y-m-d H:i:s", $ow_future_post, current_time(mysql,"GMT-5") );
				$ow_mypost->post_date_gmt = strToDate( "Y-m-d H:i:s", $ow_future_post, current_time(mysql) );
				$ow_mypost->comment_status = "closed";
				$ow_mypost->ping_status = "open";
				$ow_mypost->tags_input = $ow_opt_tag;
		
				// Check if post exist via SKU number
				$checkid = $wpdb->get_results ("SELECT * FROM {$wpdb->postmeta} WHERE meta_key='ow_datafeed' AND meta_value='$SKU'");
				$dummycount=count($checkid);

				if (count ($checkid) > 0) {

					echo"Post already exist... $ow_opt_title... go to next post...<br>";
				}
				// Post processed Datafeed to WP
				else {
				
					// Retrieve Post ID
					$ow_insert_id = wp_insert_post($ow_mypost);
					
					// Add meta_key for double post check
					add_post_meta($ow_insert_id, "ow_datafeed", $SKU);
					
				/*  // Add raw data for future use like rebuild function
					add_post_meta($ow_insert_id, "ow_programname", $PROGRAMNAME);	
					add_post_meta($ow_insert_id, "ow_programurl", $PROGRAMURL);	
					add_post_meta($ow_insert_id, "ow_catalogname", $CATALOGNAME);	
					add_post_meta($ow_insert_id, "ow_lastupdated", $LASTUPDATED);	
					add_post_meta($ow_insert_id, "ow_name", $NAME);	
					add_post_meta($ow_insert_id, "ow_keywords", $KEYWORDS);	
					add_post_meta($ow_insert_id, "ow_description", $DESCRIPTION);
					add_post_meta($ow_insert_id, "ow_sku", $SKU);
					add_post_meta($ow_insert_id, "ow_manufacturer", $MANUFACTURER);
					add_post_meta($ow_insert_id, "ow_ANUFACTURERID", $MANUFACTURERID);
					add_post_meta($ow_insert_id, "ow_upc", $UPC);
					add_post_meta($ow_insert_id, "ow_isbn", $ISBN);
					add_post_meta($ow_insert_id, "ow_currency", $CURRENCY);
					add_post_meta($ow_insert_id, "ow_saleprice", $SALEPRICE);
					add_post_meta($ow_insert_id, "ow_price", $PRICE);
					add_post_meta($ow_insert_id, "ow_retailprice", $RETAILPRICE);
					add_post_meta($ow_insert_id, "ow_fromprice", $FROMPRICE);
					add_post_meta($ow_insert_id, "ow_buyurl", $BUYURL);
					add_post_meta($ow_insert_id, "ow_impressionurl", $IMPRESSIONURL);
					add_post_meta($ow_insert_id, "ow_imageurl", $IMAGEURL);
					add_post_meta($ow_insert_id, "ow_advertisercategory", $ADVERTISERCATEGORY);
					add_post_meta($ow_insert_id, "ow_thirdpartyid", $THIRDPARTYID);
					add_post_meta($ow_insert_id, "ow_thirdpartycategory", $THIRDPARTYCATEGORY);
					add_post_meta($ow_insert_id, "ow_author", $AUTHOR);
					add_post_meta($ow_insert_id, "ow_artist", $ARTIST);
					add_post_meta($ow_insert_id, "ow_title", $TITLE);
					add_post_meta($ow_insert_id, "ow_publisher", $PUBLISHER);
					add_post_meta($ow_insert_id, "ow_label", $LABEL);
					add_post_meta($ow_insert_id, "ow_format", $FORMAT);
					add_post_meta($ow_insert_id, "ow_special", $SPECIAL);
					add_post_meta($ow_insert_id, "ow_gift", $GIFT);
					add_post_meta($ow_insert_id, "ow_promotionaltext", $PROMOTIONALTEXT);
					add_post_meta($ow_insert_id, "ow_enddate", $ENDDATE);
					add_post_meta($ow_insert_id, "ow_startdate", $STARTDATE);
					add_post_meta($ow_insert_id, "ow_offline",$OFFLINE);
					add_post_meta($ow_insert_id, "ow_online", $ONLINE);
					add_post_meta($ow_insert_id, "ow_instock", $INSTOCK);
					add_post_meta($ow_insert_id, "ow_condition", $CONDITION);
					add_post_meta($ow_insert_id, "ow_warranty", $WARRANTY);
					add_post_meta($ow_insert_id, "ow_standardshippingcost", $STANDARDSHIPPINGCOST);
				*/
						
					// Add categories to post
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
										
					// Update time interval from start
					$ow_time_from_start =  $ow_time_from_start + $ow_time_interval;
					
					// Update post counter
					$ow_i =$ow_i+1;
					
					// Display something to the user
					// echo"Added... $NAME... with post date $ow_future_post...<br> ";
				}
				}
			}//End else
		}//End foreach
	echo "<h2>Total ow-Datafeed Row Imported : $ow_i</h2>";
	}//End if
}//end function


//For future post
function strToDate($outFormat = "Y-m-d H:i:s", $shift = "+2 hours", $now = "now") {
	return date($outFormat, strtotime($shift, strtotime($now)));
}



function ow_locatime(){

	echo "current_time('mysql') returns local server time: " . current_time('mysql') . '<br />'; 
	echo "current_time('mysql',1) returns GMT: " . current_time('mysql',1) . '<br />'; 
	echo "current_time('timestamp',1) returns timestamp of server time: " . date('Y-m-d H:i:s',current_time('timestamp',1)); 
	echo "current_time('timestamp',0) doesn't mean anything: " . date('Y-m-d H:i:s',current_time('timestamp',0)); 

}
/************************************************************************************************/

//  Delete ALL post tag with metakey "ow_datafeed"
	function cleanall(){
		 
		 global $post;
		 $blogclean="1";
		 $deleted="0";
		 		 
		 while($blogclean){
		  	query_posts('meta_key=ow_datafeed'); 
		
			if ( have_posts() ) : while ( have_posts() ) : the_post();
			     wp_delete_post( $post->ID ) ;
				 $deleted= $deleted + 1;
		
		 	endwhile; else:
  		
			echo"<br> Process finished: $deleted posts deleted !<br><br>";
			$blogclean="0";
		
		 endif;
	
		//Reset Query
	 	wp_reset_query();
	 	}
	 }
?>
<?php
/*
Plugin Name: owagu.com's m4n datafeed loader
Plugin URI: http://datafeeds.owagu.com
Description: takes m4n datafeeds and parses them into full featured WordPress posts complete with categories and tags. Works alongside our shareasale loader and clickbank loader modules. To build a quick 10-second m4n or shareasale store just visit Visit <a href='http://portaljumper.com'>portaljumper.com</a>
Author: pete scheepens
Author URI: http://datafeeds.owagu.com
Version: 2.0
*/

	$opt_name0 = "ow_file_location";
	$opt_name1 = "ow_template_title";
	$opt_name2 = "ow_template_post";
	$opt_name3 = "ow_template_category";
	$opt_name4 = "ow_template_tag";	
	$opt_val0 ="";
	$opt_val1 ="";
	$opt_val2 ="";
	$opt_val3 ="";
	$opt_val4 ="";
	$opt_val0 = add_option( $opt_name0, $opt_val0 );	
	$opt_val1 = add_option( $opt_name1, $opt_val1 );	
	$opt_val2 = add_option( $opt_name2, $opt_val2 );	
	$opt_val3 = add_option( $opt_name3, $opt_val3 );	
	$opt_val4 = add_option( $opt_name4, $opt_val4 );	
	add_action('admin_menu', 'ow_add_pages');
function ow_add_pages() {
	add_menu_page('owagu Datafeeds', 'ow-Datafeed', 'administrator', 'ow-admin', 'ow_admin_page');
	add_submenu_page('ow-admin', '-- ow-Datafeed -- Upload Datafeed --', 'ow-Upload', 'administrator', 'ow-upload', 'ow_upload_page');
	if (is_file('../wp-content/plugins/owagu-m4n-datafeed-loader/loader_shareasale.php')) {
 add_submenu_page('ow-admin', '-- ow-Datafeed -- load shareasale --', 'shareasale_loader', 'administrator', 'loader_shareasale', 'loader_shareasale');
 }
if (is_file('../wp-content/plugins/owagu-m4n-datafeed-loader/loader_m4n.php')) {
 add_submenu_page('ow-admin', '-- ow-Datafeed -- load m4n --', 'm4n_loader', 'administrator', 'loader_m4n', 'loader_m4n');
 } 
 
}
function ow_admin_page() {
    include"ow-admin.php";
}
function ow_upload_page() {
    include"ow-upload.php";
}
function ow_post_page() {
    include"ow-post.php";
}
function ow_delete_page() {
    include"ow-delete.php";
}
function loader_shareasale() {
    include"loader_shareasale.php";
}
function loader_m4n() {
    include"loader_m4n.php";
}







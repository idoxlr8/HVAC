<?php

///database settings///
$dbType = "mysql";
$username = "idoxlr8_idoxlr8";
$password = "teej1225";
$database = "idoxlr8_hvac";
$myserver = "localhost";

///General Settings///
$global_encoding = "utf-8";
$global_sitename = "The James Gang";
$global_rows_per_page = 24;
$global_pager_items = 10;
$admin_name = "admin";
$currTimestamp = date("m.d.Y");
$datetime = date("F.d.Y");
///Path Settings///
$currpage = "http://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$plugins = $_SERVER['DOCUMENT_ROOT'] . "/plugins/";
$mypath = "http://". $_SERVER['SERVER_NAME'] . "/";
$modules = "http://". $_SERVER['SERVER_NAME'] . "/modules/";

//$modules = $_SERVER['DOCUMENT_ROOT'] . "/modules/";
$java_script = "http://". $_SERVER['SERVER_NAME'] . "/js/";
$img_root = $_SERVER['DOCUMENT_ROOT'] . "/images/";
$css = "http://". $_SERVER['SERVER_NAME'] . "/css/";
$themes = "http://". $_SERVER['SERVER_NAME'] . "/themes/";

//$views = $_SERVER['DOCUMENT_ROOT'] . "/modules/views/";

$includes = $_SERVER['DOCUMENT_ROOT'] . "/includes/";

$rate = $_SERVER['DOCUMENT_ROOT'] . "/modules/rate/";

$spaweditor = $_SERVER['DOCUMENT_ROOT'] . "/plugins/spaw/spaw.inc.php";


///Meta Tag Settings///
$MetaDesc = "I need to find a name and say that it's a dynamic content management system or intranet solution";
$MetaKeys = "a, bunch, of, keys, will, go, here";

///Features///
$tracking = "1";
$currtheme = "blue";
?>

<?php
include('../config.php');
$dbc = mysql_connect($myserver,$username,$password);

@mysql_select_db($database) or die( "Unable to select database");



//echo $mydate . $prntid;

    $query="SELECT * FROM company WHERE id = 1";
    

        
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
	$city = $row["weathercity"];
	$state = $row["weatherstate"];
	//$email = $row["email"];
	//$license = $row["license"];
	}
mysql_close($dbc);

//error_reporting(E_ALL);
$json_string = file_get_contents('http://api.wunderground.com/api/0e4a922959df525d/forecast/conditions/alerts/lang:EN/q/' . $state . '/' . $city . '.json');
//$json_string = file_get_contents("test.json"); // for offline testing only
?>
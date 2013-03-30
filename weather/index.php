<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="cache-control" content="NO-CACHE" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="refresh" content="3600" />
<link rel="stylesheet" type="text/css" href="../xataface/plone.css"/>
<link rel="stylesheet" type="text/css" href="tabs/tabtastic.css"/>
<script type="text/javascript" src="tabs/addclasskillclass.js"></script>
<script type="text/javascript" src="tabs/attachevent.js"></script>
<script type="text/javascript" src="tabs/addcss.js"></script>
<script type="text/javascript" src="tabs/tabtastic.js"></script>
</head>
<body>


<?php
include('link.php');
$parsed_json = json_decode($json_string, true);

$location = $parsed_json['current_observation']['display_location']['full'];
$observation_time = $parsed_json['current_observation']['observation_time'];
$icon = $parsed_json['current_observation']['icon_url'];
$temp_f = $parsed_json['current_observation']['temp_f'];
$feelslike_f = $parsed_json['current_observation']['feelslike_f'];
$weather = $parsed_json['current_observation']['weather'];
$wind_mph = $parsed_json['current_observation']['wind_mph'];
$wind_dir = $parsed_json['current_observation']['wind_dir'];
$alert = $parsed_json['alerts']['0']['message'];

$parsed_json = $parsed_json['forecast']['simpleforecast']['forecastday'];
?>
<br />
<ul class="tabset_tabs">
   <li><a href="#tab1" class="active">Current</a></li>
   <li><a href="#tab2">Forecast</a></li>
   <li><a href="#tab3">Alerts</a></li>
</ul>

<div id="tab1" class="tabset_content">
   <h2 class="tabset_label">Tab 1</h2>
   <table cellpadding="4" cellspacing="4">
<?php
//start current weather row

	echo '<tr>';
		echo '<td valign="top" colspan="2">';
		echo 'Currently In : ' . $location . '</br>';
		echo $observation_time;
		echo '</td>';
	echo '</tr>';

	echo '<tr>';
		echo '<td valign="top">';
			echo '<img src="' . $icon . '">';
		echo '</td>';
		echo '<td valign="top">';
			echo '<div class="curtemp">' . $temp_f . 'F</div>Feels Like:' . $feelslike_f . 'F<br>';
			echo $weather . '<br>';
			echo 'Wind:' . $wind_dir . ' @' . $wind_mph . 'mph';
		echo '</td>';
	echo '</tr>';
//end current weather row
?>
</table>
</div>

<div id="tab2" class="tabset_content">
   <h2 class="tabset_label">Tab 2</h2>
<?php
//start forecast row
foreach($parsed_json as $key => $value)
{
	echo '<tr>';
		echo '<td valign="top">';
		echo '<img src="' . $value['icon_url'] . '"/><br>';
	echo '</td>';
   
	echo '<td valign="top">';
		echo '<b>' . $value['date']['weekday'] . ': </b>' . $value['conditions'] . '<br>';
		echo '<b>' . $value['high']['fahrenheit'] . ' | ' . $value['low']['fahrenheit'] . '</b><br>';
		echo 'Rain: ' . $value['pop'] . '%<br>';
		echo 'Wind: ' . $value['maxwind']['mph'] . 'mph<br>';
   echo '<div id="hr"></div>';
		echo '</td>';
	echo '</tr>';
   

}
//end forecast row
?>
</div>

<div id="tab3" class="tabset_content">
   <h2 class="tabset_label">Tab 3</h2>
<?php
$alert0 = $parsed_json['alerts']['0']['message'];
$alert_date0 = $parsed_json['alerts']['0']['date'];
$alert_expires0 = $parsed_json['alerts']['0']['expires'];

$alert1 = $parsed_json['alerts']['1']['message'];
$alert_date1 = $parsed_json['alerts']['1']['date'];
$alert_expires1 = $parsed_json['alerts']['1']['expires'];

//start alerts
if ($alert1 == "")
	{
	echo 'No Alerts.';
	}
else
{
	echo 'Date: ' . $alert_date0 . '<br />';
	echo 'Expires: ' . $alert_expires0 . '<br />';
	echo '<p>' . $alert0 . '</p>';

	echo '<div id="hr"></div>';
	echo 'Date: ' . $alert_date1 . '<br />';
	echo 'Expires: ' . $alert_expires1 . '<br />';
	echo '<p>' . $alert1 . '</p>';
}
//End Alerts
?>
</div>
</body>
</html>
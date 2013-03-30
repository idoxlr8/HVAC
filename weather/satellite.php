<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="cache-control" content="NO-CACHE" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="refresh" content="3600" />
<link rel="stylesheet" type="text/css" href="../xataface/plone.css"/>


<?php

error_reporting(E_ALL);
//$json_string = file_get_contents("http://api.wunderground.com/api/0e4a922959df525d/forecast/conditions/alerts/lang:EN/q/TX/San_Angelo.json");
$json_string = file_get_contents("satellite.json"); // for offline testing only

$parsed_json = json_decode($json_string, true);

//$location = $parsed_json['current_observation']['display_location']['full'];
//$observation_time = $parsed_json['current_observation']['observation_time'];
$icon = $parsed_json['satellite']['image_url_vis'];
//$temp_f = $parsed_json['current_observation']['temp_f'];
//$feelslike_f = $parsed_json['current_observation']['feelslike_f'];
//$weather = $parsed_json['current_observation']['weather'];
//$wind_mph = $parsed_json['current_observation']['wind_mph'];
//$wind_dir = $parsed_json['current_observation']['wind_dir'];

//$parsed_json = $parsed_json['forecast']['simpleforecast']['forecastday'];

//start current weather row


echo '<img src="' . $icon . '" width="400" height="400" >';

//end forecast row
?>

	






















<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="cache-control" content="NO-CACHE" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="refresh" content="3600" />
<link rel="stylesheet" type="text/css" href="../xataface/plone.css"/>
<style>
.bold {
font-size:26px;
}
</style>
</head>


<?php

error_reporting(E_ALL);
//$json_string = file_get_contents("http://api.wunderground.com/api/0e4a922959df525d/forecast/conditions/alerts/lang:EN/q/TX/San_Angelo.json");
$json_string = file_get_contents("test.json"); // for offline testing only
$parsed_json = json_decode($json_string);

// current conditions
$location = $parsed_json->{'current_observation'}->{'display_location'}->{'full'};
$observation_time = $parsed_json->{'current_observation'}->{'observation_time'};
$temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
$icon_url = $parsed_json->{'current_observation'}->{'icon_url'};
$relative_humidity = $parsed_json->{'current_observation'}->{'relative_humidity'};
$wind_direction = $parsed_json->{'current_observation'}->{'wind_dir'};
$weather = $parsed_json->{'current_observation'}->{'weather'};
$wind_speed = $parsed_json->{'current_observation'}->{'wind_mph'}."mph";

//Alerts
//$alert_description = $parsed_json->{'alerts'}->{'description'};
//$alert_date = $parsed_json->{'alerts'}->{'date'};
//$alert_expires = $parsed_json->{'alerts'}->{'expires'};
//$alert_message = $parsed_json->{'alerts'}->{'message'};

// forecast Day
$forecast = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'};
$simpleforecast = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'};

/* DayNumber is 0 = today, 1 = tomorrow, 2 = day after tomorrow… max 6 */
function getDay($DayNumber)
{
//echo $DayNumber;
global $forecast, $simpleforecast;

$result = null;
$day = $forecast[$DayNumber];

$result['dayofweek'] = $day->{'title'};

$result['text'] = $day->{'fcttext'};

$day_array = explode('.',$result['text']);
$result['forecast_weather'] = $simpleforecast[$DayNumber]->{'conditions'}; // "conditions": "Teils Wolkig",
$result['icon'] = $simpleforecast[$DayNumber]->{'icon_url'}; // "icon_url": "http://icons-ak.wxug.com/i/c/k/partlycloudy.gif&#8221;,
$result['forecast_high'] = "High: ".$simpleforecast[$DayNumber]->{'high'}->{'fahrenheit'}."&#176;F";
$result['forecast_low'] = "Low: ".$simpleforecast[$DayNumber]->{'low'}->{'fahrenheit'}."&#176;F";
//$result['forecast_humidity'] = "Humidity: ".$simpleforecast[$DayNumber]->{'title'}."%";
$result['forecast_wind'] = "".$simpleforecast[$DayNumber]->{'avewind'}->{'mph'}."mph";
$result['forecast_winddirection'] = $simpleforecast[$DayNumber]->{'avewind'}->{'dir'}; // Südwest
$result['forecast_rainrisk'] = "Rain: ".$simpleforecast[$DayNumber]->{'pop'}."%"; // probability of precipitation = regenwahrscheinlichkeit

return $result;
}

function printDay($day,$title)
{
return "<p id='hr'>
<div id='main'>
<img src='".$day['icon']."'/> 
</div>

<b>".$day['dayofweek'].":</b>

$title
".$day['forecast_weather']."

<br/>
".$day['forecast_high']."
<br/>
".$day['forecast_low']."
</br>
".$day['forecast_rainrisk']."
</br>
Wind: ".$day['forecast_winddirection']."
@
".$day['forecast_wind']."
</p>";
}
$day0 = printDay(getDay(0),"");
$day1 = printDay(getDay(1),"");
$day2 = printDay(getDay(2),"");
$day3 = printDay(getDay(3),"");

echo '<body>';
//echo "<h1>$location</h1>";
echo ' <div id="wrap">';
echo '<p>' . $observation_time . '</p>';
echo "<p><div id='main'><img src='$icon_url'/> </div><b>Current:</b> $weather <br /> Temperature: $temp_f\n &#176;F <br/> Wind: $wind_direction\n @ ".$wind_speed."</p>";
echo "<p>$day0</p>";
echo "<p>$day1</p>";
echo "<p>$day2</p>";
echo "<p>$day3</p>";
//echo '<br />test' . $alert_message;
echo '</div>';
echo "</body></html>";
?>

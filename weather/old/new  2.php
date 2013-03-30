<?php
http://api.wunderground.com/api/0e4a922959df525d/forecast/conditions/alerts/lang:EN/q/TX/San_Angelo.json
return "<p>
<span>
<img src='".$day['icon']."'/> 
<br />
<b>".$day['dayofweek'].":</b>

$title
".$day['forecast_weather']."
</span>
<br/>
".$day['forecast_high']."
<br/>
".$day['forecast_low']."
</br>
".$day['forecast_rainrisk']."
</br>
Wind: 
".$day['forecast_winddirection']."
@
".$day['forecast_wind']."
</p>";
?>

    <div id="wrap">

    <div id="main"></div>
    <div id="sidebar"></div>

    </div>


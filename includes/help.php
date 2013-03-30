<?php
include('../config.php');
$myid = $_GET["id"];
$dbc = mysql_connect($myserver,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");


    $query="SELECT * FROM help WHERE id LIKE $myid";
    

        
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
   //$row['company']
	echo '<b>' . $row['title'] . ' Field</b><br />';
	echo $row['content'];
   }
   
mysql_close($dbc);
?>
<br />
<p>
<center>
<FORM>
<INPUT type="button" value="Close Window" onClick="window.close()">
</FORM> 
</center>
</p>
<?php
include('config.php');
?>

<p>
<form name="form">
<select name="controller" size=1 class="jumpMenu" onchange="javascript:window.location=this.options[this.selectedIndex].value;">
<option value="">Choose Customer</option>



<?php
    //echo 'Testing database connection<br>';

  $dbc = mysql_connect($myserver,$username,$password);

@mysql_select_db($database) or die( "Unable to select database");


    $query="SELECT * FROM customers ORDER BY company";
    

        
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
    
   

 
	echo'<option value="index.php?-table=payments&customer=' . $row['company'] . '">' . $row['company'];
	
	//echo '<option value=?page=modules/invoice/index.php&order=client&customer=>' . $row['company'] . '</option>';
    //echo $row['customer'];

	
   }
   
mysql_close($dbc);
?>
	</select>
</form>
</p>

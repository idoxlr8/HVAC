<?php
include('config.php');
?>
<p>
<b>1st - The default for this table is to show all records. To work with a single year you must choose from the selection below.</b>
<form name="form">
	<select name="controller" size=1 class="jumpMenu" onchange="javascript:window.location=this.options[this.selectedIndex].value;">
	<option selected="selected">Choose Year</option>
	<option value="index.php?-table=invoice&year=2012">2012</option>
	<option value="index.php?-table=invoice&year=2013">2013</option>
	<option value="index.php?-table=invoice&year=2014">2014</option>
	<!--<option value="index.php?-table=invoice&year=2015">2015</option>-->
	</select>
</form>
</p>
<p>
<b>2nd - Please choose a customer from the selection below to see all the records for that customer.</b>
<form name="form">
<select name="controller" size=1 class="jumpMenu" onchange="javascript:window.location=this.options[this.selectedIndex].value;">
<option value="index.php?-table=invoice">Choose Customer</option>
<option value="index.php?-table=invoice">All Customers</option>



<?php
    //echo 'Testing database connection<br>';
$myyear = $_GET["year"];
  $dbc = mysql_connect($myserver,$username,$password);

@mysql_select_db($database) or die( "Unable to select database");


    $query="SELECT * FROM customers ORDER BY company";
    

        
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
    
   

 
	echo'<option value="index.php?-table=invoice&customer=' . $row['company'] . '&year=' . $myyear . '">' . $row['company'];
	
	//echo '<option value=?page=modules/invoice/index.php&order=client&customer=>' . $row['company'] . '</option>';
    //echo $row['customer'];

	
   }
   
mysql_close($dbc);
?>
	</select>
</form>
</p>


<?php
include('config.php');
?>

<p>
<form name="form">
<select name="controller" size=1 class="jumpMenu" onchange="javascript:window.location=this.options[this.selectedIndex].value;">
<option value="">New Invoice For...</option>



<?php
    //echo 'Testing database connection<br>';

  $dbc = mysql_connect($myserver,$username,$password);

@mysql_select_db($database) or die( "Unable to select database");


    $query="SELECT * FROM customers ORDER BY company";
    

        
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
    
   

 
	echo'<option value="index.php?-action=new&-table=invoice&customer='.$row['company'].'&address='.$row['address'].'&city='.$row['city'].'&state='.$row['state'].'&zip='.$row['zip'].'">'.$row['company'];
	
	//echo '<option value=?page=modules/invoice/index.php&order=client&customer=>' . $row['company'] . '</option>';
    //echo $row['customer'];

	
   }
   
mysql_close($dbc);
?>
	</select>
</form>
</p>

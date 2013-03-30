<?php
include('config.php');
?>

<br />
<table style="width: 50%" class="listing">
	<tr>
		<th class="unsorted-column" colspan="5"><strong>Partial Balance Paid Invoices</strong></th>
	</tr>

	<tr>
		<th class="unsorted-column"><strong>Date</strong></th>
		<th class="unsorted-column"><strong>Customer</strong></th>
		<th class="unsorted-column"><strong>Total</strong></th>
		<th class="unsorted-column"><strong>Last Payment</strong></th>
		<th class="unsorted-column"><strong>Payment Date</strong></th>
	</tr>
<?php
$dbc = mysql_connect($myserver,$username,$password);

@mysql_select_db($database) or die( "Unable to select database");

    $query="SELECT SUM( payment1 ) AS sub_total FROM invoice WHERE payment1 >0 AND total > payment1";   
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
	//echo 'Total Sales To Date: $' . number_format($row['sub_total'], 0, '.', ',');
	$a = number_format($row['sub_total'], 0, '.', ',');
	echo $a;
	//echo '<br />';
	}
////////////////////////////////////////
    $query="select * FROM invoice WHERE payment1 > 0 and total > payment1";   
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
		//echo $row['customer'];
	echo "<tr class='color$c'>";
	echo '<td>' . $row['date'] . '</td>';
	echo '<td>' . $row['customer'] . '</td>';
	echo '<td>' . $row['total'] . '</td>';
	echo '<td>' . $row['payment1'] . '</td>';
	echo '<td>' . $row['paymentdate1'] . '</td>';
	echo '</tr>';
	$c=!$c;
	}


/*////////////////////////////////////////////
    $query="SELECT SUM(tax) AS tax_total FROM payments";   
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
	echo '<b>YTD Totals</b><br />';
	echo 'Tax Collected To Date: $' . number_format($row['tax_total'], 2, '.', ',');
	}
   */
mysql_close($dbc);

?>

</table>
<br />
<?php
include('../config.php');
include('money_format.php');
?>

<br />
<table style="width: 50%" cellpadding="0" cellspacing="0" class="listing">
	<tr>
		<th class="unsorted-column" colspan="6"><strong>Partial Balance Paid Invoices</strong></th>
	</tr>

	<tr>
		<th class="unsorted-column"><strong>ID</strong></th>
		<th class="unsorted-column"><strong>Date</strong></th>
		<th class="unsorted-column"><strong>Customer</strong></th>
		<th class="unsorted-column"><strong>Payment Date</strong></th>
		<th class="unsorted-column"><strong>Total</strong></th>
		<th class="unsorted-column"><strong>Last Payment</strong></th>
		

	</tr>
<?php
$dbc = mysql_connect($myserver,$username,$password);

@mysql_select_db($database) or die( "Unable to select database");


    //$query="select invoice.id, invoice.date, invoice.customer, invoice.total, invoice.tax, invoice.payment1, invoice.paymentdate1 from invoice left join payments on invoice.id = payments.invoiceid WHERE invoice.payment1 > 0 and invoice.total > invoice.payment1";   
    
	if ($_REQUEST[fuckup] == ""){
    $query="SELECT * FROM invoice WHERE total > payment1 AND payment1 > 0";
   } elseif ($_REQUEST[fuckup] == "all") {
	$query="SELECT * FROM invoice WHERE total > payment1";
   }	
	
	//$query="SELECT * FROM invoice WHERE total > payment1 AND payment1 > 0";
	
	
	
	$result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
	//money_format('$%i', $record->val('total'));
	$due = $row['total'] - $row['payment1'];
	$mydate = date("Y-m-d");
	
	echo "<tr class='color$c'>";
	echo '<td>' . $row['id'] . '</td>';
	echo '<td>' . $row['date'] . '</td>';
	echo '<td><a href="index.php?-table=invoice&id=' . $row['id'] . '">' . $row['customer'] . '</a></td>';
	echo '<td>' . $row['paymentdate1'] . '</td>';
	echo '<td>' . money_format('$%i',$row['total']) . '</td>';
	
	if ($row['payment1'] > "0.00"){
	echo '<td>' . money_format('$%i',$row['payment1']) . '</td>';
	}else {
	echo '<td class="baldue">' . money_format('$%i',$row['payment1']) . '</td>';
	}
	
	//echo '<td>' . money_format('$%i',$row['total'] - $row['payment1']) . '</td>';
	
//	if ($row['payment1'] > "0.00"){
//	echo '<td class="baldue">' . money_format('$%i',$row['total'] - $row['payment1']) . '</td>';
//	}else {
//	echo '<td>' . money_format('$%i',$row['total'] - $row['payment1']) . '</td>';
//	}
	
//	echo '<td><a href="index.php?-action=new&-table=payments&invoiceid=' . $row['id'] . '&customer=' . $row['customer'] . '&date=' . $mydate . '&amount=' . $due . '">Pay</a></td>';
//	echo '<td><a target="_blank" href="includes/print_invoice.php?id=' . $row['id'] . '">Print</a></td>';
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
<!--
	<tr>
		<th class="unsorted-column"><strong>ID</strong></th>
		<th class="unsorted-column"><strong>Date</strong></th>
		<th class="unsorted-column"><strong>Customer</strong></th>
		<th class="unsorted-column"><strong>Payment Date</strong></th>
		<th class="unsorted-column"><strong>Total</strong></th>
		<th class="unsorted-column"><strong>Last Payment</strong></th>
		
		<th class="unsorted-column"><strong>Difference</strong></th>
		<th class="unsorted-column"><strong>Pay Invoice</strong></th>
		<th class="unsorted-column"><strong>Print Invoice</strong></th>
	</tr>
	-->
</table>
<br />
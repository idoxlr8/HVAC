<?php
include('config.php');

$dbc = mysql_connect($myserver,$username,$password);

@mysql_select_db($database) or die( "Unable to select database");

    $query="SELECT SUM(amount) AS sub_total FROM payments";   
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
	//echo 'Total Sales To Date: $' . number_format($row['sub_total'], 0, '.', ',');
	$a = number_format($row['sub_total'], 0, '.', ',');
	//echo '<br />';
	}
////////////////////////////////////////
    $query="SELECT SUM(amount) AS sub_total FROM payments WHERE tax > 0";   
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
	//echo 'Taxable Sales To Date: $' . number_format($row['sub_total'], 0, '.', ',');
	$b1 = number_format($row['sub_total'], 0, '.', ',');
	$b = $row['sub_total'];
	$c = $b*.0825;
	$d = number_format($c, 2, '.', ',');
	//calculate city taxes
	$e = $b*.015000;
	//calculate County Taxes
	$f = $b*.005000;
	//format City and county into currency
	$g = number_format($e, 2, '.', ',');
	$h = number_format($f, 2, '.', ',');
	
	//echo '<br />';
	//echo $d;
	//echo '<br />';
	
	}


////////////////////////////////////////////
    $query="SELECT SUM(tax) AS tax_total FROM payments";   
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
	
	echo '<table style="width: 50%" cellpadding="0" cellspacing="0" class="listing">';
	echo '<tr>';
		echo '<th class="unsorted-column" colspan="5"><strong>Tax Collected To Date: $' . number_format($row['tax_total'], 2, '.', ',') . '</strong></th>';
	echo '</tr>';
	echo '</table>';

	
	
	
	//echo '<b>YTD Totals</b><br />';
	//echo 'Tax Collected To Date: $' . number_format($row['tax_total'], 2, '.', ',');
	}
   
mysql_close($dbc);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sales Tax Report</title>
<style type="text/css">
.style1 {
	border-style: solid;
	border-width: 1px;
}
.style2 {
	border: 1px solid #000000;
}
.style3 {
	border: 1px solid #000000;
	background-color: #DADADA;
}
.style4 {
	color: #FF0000;
}
.style5 {
	border: 1px solid #000000;
	color: #FF0000;
}
.style6 {
	font-size: large;
	border: 1px solid #000000;
	background-color: #DADADA;
}
.style7 {
	border: 1px solid #000000;
	color: #FF0000;
	background-color: #DADADA;

}
</style>
</head>

<body>

<table style="width: 50%" class="listing" cellspacing="0" cellpadding="2">
	<tr>
		<td colspan="2" class="style6"><strong>All Numbers Are Rounded To The Nearest Dollar.</strong></td>
		
	</tr>
	<tr>
		<td class="style3"><strong>Total Sales</strong> - This number is calculated from the payments table. Only records that have a payment are included.</td>
		<td class="style5"><strong>$<span class="style4"><?php echo $a; ?></span></strong></td>
	</tr>
	<tr>
		<td class="style3"><strong>Taxable Sales</strong> - This number comes from the payments table. All taxes collected are shown.</td>
		<td class="style5"><strong>$<span class="style4"><?php echo $b1; ?></span></strong></td>
	</tr>
	<tr>
		<td class="style3"><strong>Taxable Purchases</strong> - This is for future use, where you have to pay taxes on a purchase for the customer.</td>
		<td class="style5"><strong>$0.00</strong></td>
	</tr>
	<tr>
		<td class="style3"><strong>Amount Subject to State Tax</strong> - This number comes from the payments table. All taxes collected are shown.</td>
		<td class="style5"><strong>$<span class="style4"><?php echo $b1; ?></span></strong></td>
	</tr>
	<tr>
		<td class="style3"><strong>State Taxes X .082500</strong>Calculated from the above number by the percentage shown.</td>
		<td class="style5"><strong>$<span class="style4"><?php echo $d; ?></span></strong></td>
	</tr>
	<tr>
		<td class="style3"><strong>Total Tax Due</strong> - Same as above.</td>
		<td class="style5"><strong>$<span class="style4"><?php echo $d; ?></span></strong></td>
	</tr>
	<tr>
		<td class="style3">&nbsp;</td>
		<td class="style7">&nbsp;</td>
	</tr>
	<tr>
		<td class="style3"><strong>City Taxes X .015000</strong> - City taxes calculated from Taxable Sales Total</td>
		<td class="style5"><strong>$<span class="style4"><?php echo $g; ?></span></strong></td>
	</tr>
	<tr>
		<td class="style3"><strong>County Taxes X .005000</strong> - County taxes calculated from Taxable Sales Total</td>
		<td class="style5"><strong>$<span class="style4"><?php echo $h; ?></span></strong></td>
	</tr>
	<tr>
		<td class="style2" colspan="2">

				<h3><em>Texas Sales and Use Tax Frequently Asked Questions</em></h3>
	
						<h3>Browse Questions by Topic</h3>
						<ul>
							<li>
							<a target="_blank" href="http://www.window.state.tx.us/taxinfo/sales/questions.html#permit">
							Obtaining a Sales Tax Permit</a></li>
							<li>
							<a target="_blank" href="http://www.window.state.tx.us/taxinfo/sales/questions.html#collect">
							Sales Tax Collection</a></li>
							<li>
							<a target="_blank" href="http://www.window.state.tx.us/taxinfo/sales/questions.html#report">
							Reporting and Remittance</a></li>
							<li>
							<a target="_blank" href="http://www.window.state.tx.us/taxinfo/sales/questions.html#use">
							Purchases/Use Tax</a></li>
							<li>
							<a target="_blank" href="http://www.window.state.tx.us/taxinfo/sales/questions.html#buy_sell">
							Buying, Selling, or Discontinuing a Business</a></li>
							<li>
							<a target="_blank" href="http://www.window.state.tx.us/taxinfo/sales/questions.html#resale">
							Resale Certificates</a></li>
							<li>
							<a target="_blank" href="http://www.window.state.tx.us/taxinfo/sales/questions.html#exempt">
							Exemption Certificates/Exempt Organizations</a></li>
							<li>
							<a target="_blank" href="http://www.window.state.tx.us/taxinfo/sales/questions.html#shipped">
							Shipped out of Texas/Exports</a></li>
							<li>
							<a target="_blank" href="http://www.window.state.tx.us/taxinfo/sales/questions.html#records">
							Keeping Records</a></li>
							<li>
							<a target="_blank" href="http://www.window.state.tx.us/taxinfo/sales/questions.html#holiday">
							Sales Tax Holiday</a></li>
						</ul>
						<h3>Other Tax-related FAQs</h3>
						<ul>
							<li>
							<a target="_blank" href="http://www.window.state.tx.us/taxinfo/sales/faq_energy_star.html">
							Energy Star Holiday</a></li>
							<li>
							<a target="_blank" href="http://www.window.state.tx.us/taxinfo/disaster_relief_faq.html">
							Disaster Relief</a></li>
							<li>
							<a target="_blank" href="http://www.window.state.tx.us/taxinfo/faq_index.html">
							Index to all Texas Taxes Frequently Asked Questions</a></li>
						</ul>

				<br />


		</td>
	</tr>


</table>

</body>

</html>

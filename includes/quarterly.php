<?php
include('../config.php');
include('money_format.php');
$selyear = $_REQUEST["year"];
$selquarter = $_REQUEST["quarter"];

//error_reporting(E_ALL);
//echo $selyear . '--' . $selquarter;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/quarterly.css">
<title>Tax Report</title>
</head>
<body onload="javascript:window.print()">



<table cellpadding="0" cellspacing="5" class="listing">
	<tr>
		<th class="unsorted-column" colspan="11">Tax Report - <?php echo $selquarter . ' - ' . $selyear; ?></th>
	</tr>

	<tr>
		<th class="unsorted-column">Month</th>
		<th class="unsorted-column">Invoice ID</th>
		<th class="unsorted-column">Date</th>
		<th class="unsorted-column">Customer</th>
		<th class="unsorted-column">Labor</th>
		<th class="unsorted-column">Parts</th>
		<!--<th class="unsorted-column">Sub Total</th>-->
		<th class="unsorted-column">Tax</th>
		<th class="unsorted-column">Total</th>
		<th class="unsorted-column">Payment</th>
		<th class="unsorted-column">Payment Date</th>
	</tr>
<?php
$dbc = mysql_connect($myserver,$username,$password);

@mysql_select_db($database) or die( "Unable to select database");


	  if ($selquarter == ""){
    $query="SELECT * FROM payments WHERE MONTH IN ('jan', 'feb', 'mar') AND year LIKE $selyear ORDER BY month";
   } elseif ($selquarter == "1stQuarter") {
	$query="SELECT * FROM payments WHERE MONTH IN ('jan', 'feb', 'mar') AND year LIKE $selyear ORDER BY month";
   } elseif ($selquarter == "2ndQuarter") {
	$query="SELECT * FROM payments WHERE MONTH IN ('apr', 'may', 'jun') AND year LIKE $selyear ORDER BY month";	
	} elseif ($selquarter == "3rdQuarter") {
	$query="SELECT * FROM payments WHERE MONTH IN ('jul', 'aug', 'sep') AND year LIKE $selyear ORDER BY month";
	} elseif ($selquarter == "4thQuarter") {
	$query="SELECT * FROM payments WHERE MONTH IN ('oct', 'nov', 'dec') AND year LIKE $selyear ORDER BY month";
	//Monthly queries
	} elseif ($selquarter == "Jan") {
	$query="SELECT * FROM payments WHERE MONTH IN ('jan') AND year LIKE $selyear ORDER BY month";
	} elseif ($selquarter == "Feb") {
	$query="SELECT * FROM payments WHERE MONTH IN ('feb') AND year LIKE $selyear ORDER BY month";
	} elseif ($selquarter == "Mar") {
	$query="SELECT * FROM payments WHERE MONTH IN ('mar') AND year LIKE $selyear ORDER BY month";
	} elseif ($selquarter == "Apr") {
	$query="SELECT * FROM payments WHERE MONTH IN ('apr') AND year LIKE $selyear ORDER BY month";
	} elseif ($selquarter == "May") {
	$query="SELECT * FROM payments WHERE MONTH IN ('may') AND year LIKE $selyear ORDER BY month";
	} elseif ($selquarter == "Jun") {
	$query="SELECT * FROM payments WHERE MONTH IN ('jun') AND year LIKE $selyear ORDER BY month";
	} elseif ($selquarter == "Jul") {
	$query="SELECT * FROM payments WHERE MONTH IN ('jul') AND year LIKE $selyear ORDER BY month";
	} elseif ($selquarter == "Aug") {
	$query="SELECT * FROM payments WHERE MONTH IN ('aug') AND year LIKE $selyear ORDER BY month";
	} elseif ($selquarter == "Sep") {
	$query="SELECT * FROM payments WHERE MONTH IN ('sep') AND year LIKE $selyear ORDER BY month";
	} elseif ($selquarter == "Oct") {
	$query="SELECT * FROM payments WHERE MONTH IN ('oct') AND year LIKE $selyear ORDER BY month";
	} elseif ($selquarter == "Nov") {
	$query="SELECT * FROM payments WHERE MONTH IN ('nov') AND year LIKE $selyear ORDER BY month";
	} elseif ($selquarter == "Dec") {
	$query="SELECT * FROM payments WHERE MONTH IN ('dec') AND year LIKE $selyear ORDER BY month";	
	//End Monthly queries
   } elseif ($selquarter == "yearly") {
	$query="SELECT * FROM payments WHERE year LIKE $selyear ORDER BY month";
	}
	$result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
	//money_format('$%i', $record->val('total'));
	//$due = $row['total'] - $row['amount'];
	//$mydate = date("Y-m-d");
	//$pay1 = $row['amount'];
	//$ttl = $row['total'];
	echo "<tr class='color$c'>";
	//money_format('$%i',)
	echo '<td>' . $row['month'] . '</td>';
	echo '<td>' . $row['invoiceid'] . '</td>';
	echo '<td>' . $row['date'] . '</td>';
	echo '<td>' . strtoupper($row['customer']) . '</td>';
	echo '<td>' . money_format('$%i',$row['labortotal']) . '</td>';
	echo '<td>' . money_format('$%i',$row['partstotal']) . '</td>';
	//echo '<td>' . money_format('$%i',$row['subtotal']) . '</td>';
	echo '<td>' . money_format('$%i',$row['tax']) . '</td>';
	echo '<td>' . money_format('$%i',$row['total']) . '</td>';
	
	if ($row['amount'] > "0.00")
		{echo '<td>' . money_format('$%i',$row['amount']) . '</td>';}
	else 
		{echo '<td class="baldue">' . money_format('$%i',$row['amount']) . '</td>';}

	
	echo '<td>' . $row['date'] . '</td>';
	echo '</tr>';
	$c=!$c;
	}


////////////////////////////////////////////
    //$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(subtotal) AS sub_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('jan', 'feb', 'mar') AND year LIKE 2012";  
//$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(subtotal) AS sub_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('jan', 'feb', 'mar') AND year LIKE 2012";	
    
	
	if ($selquarter == ""){
    $query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('jan', 'feb', 'mar') AND year LIKE $selyear ORDER BY month";
   } elseif ($selquarter == "1stQuarter") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('jan', 'feb', 'mar') AND year LIKE $selyear ORDER BY month";
   } elseif ($selquarter == "2ndQuarter") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('apr', 'may', 'jun') AND year LIKE $selyear ORDER BY month";	
	} elseif ($selquarter == "3rdQuarter") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('jul', 'aug', 'sep') AND year LIKE $selyear ORDER BY month";
	} elseif ($selquarter == "4thQuarter") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('oct', 'nov', 'dec') AND year LIKE $selyear ORDER BY month";
   //Begin monthly queries
	} elseif ($selquarter == "Jan") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('jan') AND year LIKE $selyear ORDER BY month";
 	} elseif ($selquarter == "Feb") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('feb') AND year LIKE $selyear ORDER BY month";
     
	} elseif ($selquarter == "Mar") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('mar') AND year LIKE $selyear ORDER BY month";
     
	} elseif ($selquarter == "Apr") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('apr') AND year LIKE $selyear ORDER BY month";
     
	} elseif ($selquarter == "May") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('may') AND year LIKE $selyear ORDER BY month";
     
	} elseif ($selquarter == "Jun") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('jun') AND year LIKE $selyear ORDER BY month";
     
	} elseif ($selquarter == "Jul") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('jul') AND year LIKE $selyear ORDER BY month";
     
	} elseif ($selquarter == "Aug") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('aug') AND year LIKE $selyear ORDER BY month";
     
	} elseif ($selquarter == "Sep") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('sep') AND year LIKE $selyear ORDER BY month";
     
	} elseif ($selquarter == "Oct") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('oct') AND year LIKE $selyear ORDER BY month";
     
	} elseif ($selquarter == "Nov") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('nov') AND year LIKE $selyear ORDER BY month";
     
	} elseif ($selquarter == "Dec") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE MONTH IN ('dec') AND year LIKE $selyear ORDER BY month";
          
   
   //end monthly queries
   }elseif ($selquarter == "yearly") {
	$query="SELECT SUM(labortotal) AS labor_ttl, SUM(partstotal) AS parts_ttl, SUM(tax) AS tax_ttl, SUM(total) AS total_ttl, SUM(amount) AS amount_total FROM payments WHERE year LIKE $selyear ORDER BY month";
   }
	
	$result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
	//echo '<b>YTD Totals</b><br />';
	//echo 'Tax Collected To Date: $' . number_format($row['tax_total'], 2, '.', ',');
	$a = money_format('$%i',$row['labor_ttl']);
	$b = money_format('$%i',$row['parts_ttl']);
	//$c = money_format('$%i',$row['sub_ttl']);
	$d = money_format('$%i',$row['tax_ttl']);
	$e = money_format('$%i',$row['total_ttl']);
	$f = money_format('$%i',$row['amount_total']);
	
	}

mysql_close($dbc);

?>
	<tr>
		<th class="unsorted-column">Month<br /></th>
		<th class="unsorted-column">Invoice ID<br /></th>
		<th class="unsorted-column">Date<br /></th>
		<th class="unsorted-column">Customer<br /></th>
		<th class="unsorted-column">Total Labor<br /><?php echo $a; ?></th>
		<th class="unsorted-column">Total Parts<br /><?php echo $b; ?></th>
		<!--<th class="unsorted-column"><?php //echo $c; ?></th>-->
		<th class="unsorted-column">Tax Collected<br /><?php echo $d; ?></th>
		<th class="unsorted-column">Inv Totals<br /><?php echo $e; ?></th>
		<th class="unsorted-column">Collected<br /><?php echo $f; ?></th>
		<th class="unsorted-column">Payment Date<br /></th>
	</tr>
</table>
<br />
</body>

</html>

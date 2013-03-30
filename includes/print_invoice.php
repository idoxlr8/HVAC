<?php
include('../config.php');
$dbc = mysql_connect($myserver,$username,$password);

@mysql_select_db($database) or die( "Unable to select database");



//echo $mydate . $prntid;

    $query="SELECT * FROM company WHERE id = 1";
    

        
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
	$address = $row["address"];
	$phone = $row["phone"];
	$email = $row["email"];
	$license = $row["license"];
	}
mysql_close($dbc);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print</title>
<link rel="stylesheet" type="text/css" href="../css/print.css">

</head>

<body onload="javascript:window.print()">

<table style="width: 650px; height: 810px" class="tablelist">
	<tr>
		<td>
		<table style="width: 100%" cellspacing="1">
			<tr>
				<td colspan="3">
				<img src="../images/logo_sm.png" width="195" height="135" style="float: left" /><br />
				<span class="style2"><span class="style3"><strong><br />
				<br />
				<br />
				<br />
				<?php echo $address; ?><br />
				<?php echo $phone; ?>, <?php echo $email; ?><br />
				<?php echo $license; ?></strong></span></span>

				</td>
			</tr>
			<tr>
				<td colspan="2">
				<p><strong>INVOICE</strong></p>
				</td>
<?php
$prntid = $_GET["id"];
    //echo 'Testing database connection<br>';
$mydate = date("Y-m-d");

//////////////////////
$con = mysql_connect($myserver,$username,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($database, $con);
$sql="UPDATE invoice SET printdate='$mydate' WHERE id='$prntid'";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
 //mysql_close($con) 
///////////////////

$dbc = mysql_connect($myserver,$username,$password);

@mysql_select_db($database) or die( "Unable to select database");



//echo $mydate . $prntid;

    $query="SELECT * FROM invoice WHERE id LIKE $prntid";
    

        
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
    ////Print Layout///////////////////////////////
		$originalDate = $row["date"];
		$newDate = date("m-d-Y", strtotime($originalDate));
	
					echo '<td class="style4">' . $newDate . '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="2">&nbsp;</td>';
				echo '<td class="style4">Invoice No.: '.$row["id"] . '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td><strong>Bill To:</strong></td>';
				echo '<td colspan="2">&nbsp;</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>' . $row["customer"] . '</td>';
				echo '<td colspan="2">&nbsp;</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>' . $row["address"] . '</td>';
				echo '<td colspan="2">&nbsp;</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Ref - ' . $row["property"] . '</td>';
				echo '<td colspan="2">&nbsp;</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>' . $row["city"] . ', ' . $row["state"] . '  ' . $row["zip"] . '</td>';
				echo '<td colspan="2">&nbsp;</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="3">&nbsp;</td>';
			echo '</tr>';
			echo '<tr class="cell_header">';
				echo '<td colspan="3" class="cell_header">Parts / Equipment</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="3">';
				
						echo '<table style="width: 100%" cellspacing="1">';
					echo '<tr>';
						echo '<td class="cell_header" style="width: 10%">Qty</td>';
						echo '<td class="cell_header">Description</td>';
						echo '<td class="cell_header" style="width: 10%">Amount</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell" style="width: 10%">' . $row["item1qty"] . '</td>';
						echo '<td class="cell">' . $row["item1description"] . '</td>';
						echo '<td class="cell" style="width: 10%">' . $row["item1cost"] . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell" style="width: 10%">' . $row["item2qty"] . '</td>';
						echo '<td class="cell">' . $row["item2description"] . '</td>';
						echo '<td class="cell" style="width: 10%">' . $row["item2cost"] . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell" style="width: 10%">' . $row["item3qty"] . '</td>';
						echo '<td class="cell">' . $row["item3description"] . '</td>';
						echo '<td class="cell" style="width: 10%">' . $row["item3cost"] . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell" style="width: 10%">' . $row["item4qty"] . '</td>';
					echo '<td class="cell">' . $row["item4description"] . '</td>';
						echo '<td class="cell" style="width: 10%">' . $row["item4cost"] . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell" style="width: 10%">' . $row["item5qty"] . '</td>';
						echo '<td class="cell">' . $row["item5description"] . '</td>';
						echo '<td class="cell" style="width: 10%">' . $row["item5cost"] . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell" style="width: 10%">' . $row["item6qty"] . '</td>';
						echo '<td class="cell">' . $row["item6description"] . '</td>';
						echo '<td class="cell" style="width: 10%">' . $row["item6cost"] . '</td>';
					echo '</tr>';
///////////items update 3.17.2012///////////////					

					echo '<tr>';
						echo '<td class="cell" style="width: 10%">' . $row["item7qty"] . '</td>';
						echo '<td class="cell">' . $row["item7description"] . '</td>';
						echo '<td class="cell" style="width: 10%">' . $row["item7cost"] . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell" style="width: 10%">' . $row["item8qty"] . '</td>';
						echo '<td class="cell">' . $row["item8description"] . '</td>';
						echo '<td class="cell" style="width: 10%">' . $row["item8cost"] . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell" style="width: 10%">' . $row["item9qty"] . '</td>';
						echo '<td class="cell">' . $row["item9description"] . '</td>';
						echo '<td class="cell" style="width: 10%">' . $row["item9cost"] . '</td>';
					echo '</tr>';					
					
///////////items update 3.17.2012///////////////
				echo '</table>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="3" class="cell_header">Service / Labor</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="3">';
				echo '<table style="width: 100%" cellspacing="1">';
					echo '<tr>';
						echo '<td class="cell_header" style="width: 10%">Qty</td>';
						echo '<td class="cell_header">Description</td>';
						echo '<td class="cell_header" style="width: 10%">Amount</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell" style="width: 10%">' . $row["labor1qty"] . '</td>';
						echo '<td class="cell">' . $row["labor1description"] . '</td>';
						echo '<td class="cell" style="width: 10%">' . $row["labor1cost"] . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell" style="width: 10%">' . $row["labor2qty"] . '</td>';
						echo '<td class="cell">' . $row["labor2description"] . '</td>';
						echo '<td class="cell" style="width: 10%">' . $row["labor2cost"] . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell" style="width: 10%">' . $row["labor3qty"] . '</td>';
						echo '<td class="cell">' . $row["labor3description"] . '</td>';
						echo '<td class="cell" style="width: 10%">' . $row["labor3cost"] . '</td>';
					echo '</tr>';
					
	///////////Extra lines for labor///Disabled//////<!--
					//echo '<tr>';
						//echo '<td class="cell" style="width: 10%">&nbsp;</td>';
						//echo '<td class="cell">&nbsp;</td>';
						//echo '<td class="cell" style="width: 10%">&nbsp;</td>';
					//echo '</tr>';
					//echo '<tr>';
						//echo '<td class="cell" style="width: 10%">&nbsp;</td>';
						//echo '<td class="cell">&nbsp;</td>';
						//echo '<td class="cell" style="width: 10%">&nbsp;</td>';
					//echo '</tr>';
					//echo '<tr>';
						//echo '<td class="cell" style="width: 10%">&nbsp;</td>';
						//echo '<td class="cell">&nbsp;</td>';
						//echo '<td class="cell" style="width: 10%">&nbsp;</td>';
					//echo '</tr>';
					//echo '<tr>';
						//echo '<td class="cell" style="width: 10%">&nbsp;</td>';
						//echo '<td class="cell">&nbsp;</td>';
						//echo '<td class="cell" style="width: 10%">&nbsp;</td>';
					//echo '</tr>';
	////////////End Disabled section -->
				echo '</table>';
				//////////////////
			echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="3">';
				echo '<table style="width: 100%">';
					echo '<tr>';
						echo '<td style="width: 70%" rowspan="6" class="cell">' . $row["custcomments"] . '</td>';
						echo '<td class="cell_header" style="width: 15%">Parts Total</td>';
						echo '<td style="width: 15%" class="cell">$' . number_format($row["partstotal"], 2, '.', ',') . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell_header" style="width: 15%">Labor Total</td>';
						echo '<td style="width: 15%" class="cell">$' . number_format($row["labortotal"], 2, '.', ',') . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell_header" style="width: 15%">Sub Total</td>';
						echo '<td style="width: 15%" class="cell">$'. number_format($row["subtotal"], 2, '.', ',') . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell_header" style="width: 15%">Tax</td>';
						echo '<td style="width: 15%" class="cell">$' . number_format($row["tax"], 2, '.', ',') . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell_header" style="width: 15%">Last Payment</td>';
						echo '<td style="width: 15%" class="cell">$' . number_format($row["payment1"], 2, '.', ',') . '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td class="cell_header" style="width: 15%">Invoice Total</td>';
						echo '<td style="width: 15%" class="cell">$' . number_format($row["total"] - $row["payment1"], 2, '.', ',') . '</td>';
					echo '</tr>';
				echo '</table>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="3" class="style5">Make all checks payable to [Air Force Heating and Cooling].<br />If you have any questions concerning this invoice, contact us, (325)653-6131, dmorenoair_force1@live.com<br /><strong>Thank you for your business!</strong></td>';
			echo '</tr>';
				echo '<tr>';
				echo '<td colspan="3" class="notice">Regulated by the Texas Department of Licensing and Regulation,P.O.Box 12157,Austin,Tx 78711, 1-800-803-9202 <br /></td>';
			echo '</tr>';
		echo '</table>';
		echo '</td>';
	echo '</tr>';
echo '</table>';
  	
   }
   


mysql_close($dbc);
?>
	
	</body>

</html>

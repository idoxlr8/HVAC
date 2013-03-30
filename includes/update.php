<?php
$myid = $_REQUEST[invid];
$id = $_REQUEST[id];
header("Location:../index.php?-table=payments&id=" . $id . "");
include('../config.php');

$mydate = date("Y-m-d");

$amt = $_REQUEST[amount];

$dbc = mysql_connect($myserver,$username,$password);

@mysql_select_db($database) or die( "Unable to select database");

//get new total payment amounts from all records that have the same invid//
    $query="SELECT SUM(amount) FROM payments WHERE invoiceid LIKE $myid";
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
	$newamt = $row['SUM(amount)'];

  }
//get the old last payment amount from the invoice//
    $query="SELECT payment1 FROM invoice WHERE id LIKE $myid";
    $result = mysql_query($query, $dbc);
    while ($row = mysql_fetch_array($result))   
    {
	$oldamt = $row['payment1'];

	$ttlamt = $newamt;

  }

$con = mysql_connect($myserver,$username,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($database, $con);

$sql="UPDATE invoice SET payment1='$ttlamt',paymentdate1='$mydate' WHERE id='$myid'";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($con)

//echo '<a href=index.php?-table=invoice&id=' . $myid . '">Continue</a>';
?>

<a href=../index.php?-table=invoice&id=<?php echo $myid; ?>">Continue</a>
		

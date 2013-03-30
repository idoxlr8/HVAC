<?php
include('config.php');

$con = mysql_connect($myserver,$username,$password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($database, $con);
//$sql="UPDATE invoice SET printdate='$mydate' WHERE id='$prntid'";
//ALTER TABLE `invoice` DROP `test`;
//alter table icecream add column flavor varchar(100) ; 


if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  $result=mysql_query("ALTER TABLE payments
	ADD invoicedate VARCHAR(100),
	Add partstotal VARCHAR(100) AFTER invoicedate,
	ADD labortotal VARCHAR(100) AFTER partstotal,
	ADD total VARCHAR(100) AFTER labortotal,
	ADD month VARCHAR(100) AFTER total,
	ADD year VARCHAR(100) AFTER month") or die("Alter Error: ".mysql_error());
	
	echo 'payments table has been altered - 6 colums added <br />';
	
  $result=mysql_query("ALTER TABLE invoice
	ADD difference VARCHAR(100),
	Add labortaxable VARCHAR(100) AFTER invoicedate,
	ADD partstaxable VARCHAR(100) AFTER partstotal,") or die("Alter Error: ".mysql_error());
	
	echo 'payments table has been altered - 3 colums added <br />';	
	
$sql="UPDATE payments b, invoice p SET b.invoicedate = p.date WHERE b.invoiceid = p.id";
	echo '============================';
	
$sql="UPDATE payments b, invoice p SET b.partstotal = p.partstotal WHERE b.invoiceid = p.id";
	echo ' ===========================';
 
$sql="UPDATE payments b, invoice p SET b.labortotal = p.labortotal WHERE b.invoiceid = p.id";
	echo ' =============================';
$sql="UPDATE payments b, invoice p SET b.month = p.month WHERE b.invoiceid = p.id";
 
	echo ' ============================';
$sql="UPDATE payments b, invoice p SET b.year = p.year WHERE b.invoiceid = p.id";
	echo '===========================';
 
$sql="UPDATE payments b, invoice p SET b.total = p.total WHERE b.invoiceid = p.id";	
	echo '===========================';	
  mysql_close($con);
?>
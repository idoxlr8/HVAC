<?php
include('config.php');
$mydate = date("Y-m-d");

$conn = mysql_connect($myserver, $username, $password);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

//invoice
$table_name = "invoice";
$backup_file  = '/backup/database/' . $mydate . '_invoice.sql';
$sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";

mysql_select_db('idoxlr8_hvac');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not take data backup: ' . mysql_error());
}
echo "Backed up  invoices successfully\n";
echo '<br />';
//customers
$table_name = "customers";
$backup_file  = '/backup/database/' . $mydate . '_customers.sql';
$sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";

mysql_select_db('idoxlr8_hvac');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not take data backup: ' . mysql_error());
}
echo "Backedup  Customers successfully\n";

mysql_close($conn);
?>
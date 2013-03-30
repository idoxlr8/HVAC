<?php
//header("Location:test.php");
include('config.php');


mysql_connect($myserver,$username,$password);

// select the database
mysql_select_db($database) or die("Unable to select database");

// find out how many records there are to update
$size = count($_POST['month']);

// start a loop in order to update each record
$i = 0;
while ($i < $size) {
// define each variable
$month= $_POST['month'][$i];
$year= $_POST['year'][$i];
$id = $_POST['id'][$i];

// do the update and print out some info just to provide some visual feedback
// you might need to remove the single quotes around the field names, for example month = '$month' instead of `month` = '$month'
$query = "UPDATE payments SET `month` = '$month', `year` = '$year' WHERE `id` = '$id' LIMIT 1";
mysql_query($query) or die ("Error in query: $query");
print "$month<br /><br /><em>Updated!</em><br /><br />";
++$i;
}
mysql_close();
?>
		

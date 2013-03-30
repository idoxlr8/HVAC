<?php
$myid = $_REQUEST[invoiceid];
echo $myid;
echo '<br />';
//$mydate = date("Y-m-d");
//$mydate = '2013-01-25';
$mydate = date("m-d-Y");
echo $mydate;
echo '<br />';
$amt = $_REQUEST[amount];
echo $amt;
//header("Location:index.php");

echo $_REQUEST[chk1];
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<input name="chk1" type="checkbox" value="yes" /><br />
	<input name="Submit1" type="submit" value="submit" /></form>

</body>

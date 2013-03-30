<?php

$host="localhost"; // Host name
$username="idoxlr8_idoxlr8"; // Mysql username
$password="teej1225"; // Mysql password
$db_name="idoxlr8_hvac"; // Database name
$tbl_name="payments"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

$sql="SELECT * FROM $tbl_name";
$result=mysql_query($sql);

// Count table rows
$count=mysql_num_rows($result);
echo $count;
?>

<table width="500" border="0" cellspacing="1" cellpadding="0">
<form name="form1" method="post" action="">
<tr>
<td>
<table width="500" border="0" cellspacing="1" cellpadding="0">

<tr>
<td align="center"><strong>Id</strong></td>
<td align="center"><strong>Date</strong></td>
<td align="center"><strong>month</strong></td>
<td align="center"><strong>year</strong></td>
</tr>

<?php
while($rows=mysql_fetch_array($result)){
$originalDate = $row['date'];
$newDate = date("m-d-Y", strtotime($originalDate));
$newmonth = date("M", strtotime($originalDate));
$newyear = date("Y", strtotime($originalDate));

?>

<tr>
<td align="center">
<? $id[]=$rows['id']; ?><? echo $rows['id']; ?>
</td>
<td align="center">
<input name="date[]" type="text" id="date" value="<? echo $rows['date']; ?>">
</td>
<td align="center">
<input name="month[]" type="text" id="month" value="<? echo $newmonth; ?>">
</td>
<td align="center">
<input name="year[]" type="text" id="year" value="<? echo $newyear; ?>">
</td>
</tr>

<?php
}
?>

<tr>
<td colspan="4" align="center"><input type="submit" name="Submit" value="Submit"></td>
</tr>
</table>
</td>
</tr>
</form>
</table>

<?php

// Check if button name "Submit" is active, do this
if($Submit){
for($i=0;$i<$count;$i++){
$sql1="UPDATE $tbl_name SET month='$month[$i]', year='$year[$i]' WHERE id='$id[$i]'";
$result1=mysql_query($sql1);
}
}

if($result1){
header("location:update_payments.php");
}
mysql_close();
?>
<?php

$host="localhost"; // Host name
$username=""; // Mysql username
$password=""; // Mysql password
$db_name="test"; // Database name
$tbl_name="test_mysql"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

$sql="SELECT * FROM $tbl_name";
$result=mysql_query($sql);

// Count table rows
$count=mysql_num_rows($result);
?>

<table width="500" border="0" cellspacing="1" cellpadding="0">
<form name="form1" method="post" action="">
<tr>
<td>
<table width="500" border="0" cellspacing="1" cellpadding="0">

<tr>
<td align="center"><strong>Id</strong></td>
<td align="center"><strong>Name</strong></td>
<td align="center"><strong>Lastname</strong></td>
<td align="center"><strong>Email</strong></td>
</tr>

<?php
while($rows=mysql_fetch_array($result)){
?>

<tr>
<td align="center">
<? $id[]=$rows['id']; ?><? echo $rows['id']; ?>
</td>
<td align="center">
<input name="name[]" type="text" id="name" value="<? echo $rows['name']; ?>">
</td>
<td align="center">
<input name="lastname[]" type="text" id="lastname" value="<? echo $rows['lastname']; ?>">
</td>
<td align="center">
<input name="email[]" type="text" id="email" value="<? echo $rows['email']; ?>">
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
$sql1="UPDATE $tbl_name SET name='$name[$i]', lastname='$lastname[$i]', email='$email[$i]' WHERE id='$id[$i]'";
$result1=mysql_query($sql1);
}
}

if($result1){
header("location:update_multiple.php");
}
mysql_close();
?>
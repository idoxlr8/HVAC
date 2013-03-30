<?php
include('config.php');
		//$myid = $row['id'];
		//$originalDate = $row['date'];
		//$newDate = date("m-d-Y", strtotime($originalDate));
		//$newmonth = date("M", strtotime($originalDate));
		//$newyear = date("Y", strtotime($originalDate));
// connect to the database
mysql_connect($myserver,$username,$password);

// select the database
mysql_select_db($database) or die("Unable to select database");

// run the query and put the results in an array variable called $result
$result = mysql_query("SELECT * FROM payments ORDER BY id");

// start a counter in order to number the input fields for each record
$i = 0;


// open a form
print "<form name='namestoupdate' method='post' action='update.php'>\n";

// start a loop to print all of the courses with their book information
// the mysql_fetch_array function puts each record into an array. each time it is called, it moves the array counter up until there are no more records left
while ($books = mysql_fetch_array($result)) {
		$originalDate = $books['date'];
		//$newDate = date("m-d-Y", strtotime($originalDate));
		$newmonth = date("M", strtotime($originalDate));
		$newyear = date("Y", strtotime($originalDate));


// assuming you have three important columns (the index (id), the course name (course), and the book info (bookinfo))
  // start displaying the info; the most important part is to make the name an array (notice bookinfo[$i])
  print "<input type='hidden' name='id[$i]' value='{$books['id']}' />";
  print "<p>{$books['date']}: <input type='text' size='40' name='month[$i]' value='$newmonth' /><input type='text' size='40' name='year[$i]' value='$newyear' /></p>\n";


// add 1 to the count, close the loop, close the form, and the mysql connection
++$i;
}
print "<input type='submit' value='submit' />";
print "</form>";
mysql_close();
?>
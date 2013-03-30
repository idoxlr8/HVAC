<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled 1</title>
		
    <SCRIPT LANGUAGE="JavaScript"'>
    <!--
    function validateForm(){
    if(document.form.quarter.selectedIndex==0)
    {
    alert("Please select a quarter.");
    document.form.quarter.focus();
    return false;
    }
	
	if(document.form.year.selectedIndex==0)
    {
    alert("Please select a year.");
    document.form.year.focus();
    return false;
    }
	
    return true;
    }
    //-->
    </SCRIPT>

</head>

<body>
<h4>Quarterly Reports</h4>
<p>Choos from 1-4 Quarter or Yearly Report to generate.
<form method="post" name="form" action="includes/quarterly.php" target="_blank" onSubmit="return validateForm()">
	<select name="quarter">
	<option selected="selected">Choose Period</option>
	<option value="Jan">Jan</option>
	<option value="Feb">Feb</option>
	<option value="Mar"> Mar</option>
	<option value="Apr">Apr</option>
	<option value="May">May</option>
	<option value="Jun">Jun</option>
	<option value="Jul">Jul</option>
	<option value="Aug">Aug</option>
	<option value="Sep">Sep</option>
	<option value="Oct">Oct</option>
	<option value="Nov">Nov</option>
	<option value="Dec">Dec</option>
	<option value="1stQuarter">1st Quarter - Jan-March</option>
	<option value="2ndQuarter">2nd Quarter - April-June</option>
	<option value="3rdQuarter">3rd Quarter - July-Sept</option>
	<option value="4thQuarter">4th Quarter - Oct-Dec</option>
	<option value="yearly">Yearly</option>
	</select><br />
	Select the year to base this report on.
	<select name="year">
	<option selected="selected">Choose Year</option>
	<option value="2012">2012</option>
	<option value="2013">2013</option>
	<option value="2014">2014</option>
	<option value="2015">2015</option>
	</select>
	<br />
	<input name="Submit1" type="submit" value="submit" />

</form>
</p>
</body>

</html>

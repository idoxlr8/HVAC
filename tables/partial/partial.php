<?php
class tables_partial {
    function getPermissions(&$record){
        //if ( getUser() ){
            return Dataface_PermissionsTool::ALL();
        //}
        return null;
    }
	
	function block__my_special_block(){
     include('includes/payments_partial.php');
}

	function block__before_left_column(){
    
        echo "<div id=\"invoice-sidebar\"><h4>Tasks</h4><br />";
		//include('inv_dropdown.php');
        echo '<p><a href="index.php?-table=partial&q=">Partial Payments Only</a> - Where Total Is Greater Than Last Payment <b>And Payments Are Not Empty</b></p>';
		
		echo '<p><a href="index.php?-table=partial&q=all">Where Total Is Greater Than Payment Only</a> - This Includes Invoices Have Not Been Paid Yet</p>';
		
		//echo '<p><a href="index.php?-table=invoice&payment1=>0">Paid Invoices</a></p>';
		
		//echo '<p><a href="index.php?-table=invoice&action=partial">Partial Balance</a></p>';
		
        echo "</div>";
        
    }
}
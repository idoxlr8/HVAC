<?php
class tables_reports {
    function getPermissions(&$record){
        //if ( getUser() ){
            return Dataface_PermissionsTool::ALL();
        //}
        return null;
    }
	
	function block__my_special_block(){
     include('includes/tax_report.php');
	
}

	function block__before_left_column(){
    
        echo '<div id=\"invoice-sidebar\">';
		include('includes/quarterly_dropdown.php');

		
        echo '</div>';
        
    }
}
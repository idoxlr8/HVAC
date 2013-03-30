<?php
class tables_dashboard {
    function getPermissions(&$record){
        //if ( getUser() ){
            return Dataface_PermissionsTool::ALL();
        //}
        return null;
    }
	
	function block__my_special_block(){
     include('includes/cust_dropdown.php');
	 //include('weather/index.php');
}

}
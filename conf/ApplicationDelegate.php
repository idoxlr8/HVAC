<?
include('includes/money_format.php');
/**
 * A delegate class for the entire application to handle custom handling of 
 * some functions such as permissions and preferences.
 */
class conf_ApplicationDelegate {
    /**
     * Returns permissions array.  This method is called every time an action is 
     * performed to make sure that the user has permission to perform the action.
     * @param record A Dataface_Record object (may be null) against which we check
     *               permissions.
     * @see Dataface_PermissionsTool
     * @see Dataface_AuthenticationTool
     */
	 
function beforeHandleRequest(){
       
    $app =& Dataface_Application::getInstance();
    $query =& $app->getQuery();
    if ( $query['-table'] == 'dashboard' and ($query['-action'] == 'browse' or $query['-action'] == 'list') ){
        $query['-action'] = 'dashboard';
    }
	
	 if ( $query['-table'] == 'reports' and ($query['-action'] == 'browse' or $query['-action'] == 'list') ){
		$query['-action'] = 'reports';
    }
	
	 if ( $query['-table'] == 'partial' and ($query['-action'] == 'browse' or $query['-action'] == 'list') ){
		$query['-action'] = 'partial';
    }
	
    /*if ( $query['-table'] == 'invoice' and ($query['year'] == '') ){
        $query['year'] = '2013';
    }  */ 
}
	 
     function getPermissions(&$record){
         $auth =& Dataface_AuthenticationTool::getInstance();
         $user =& $auth->getLoggedInUser();
         if ( !isset($user) ) return Dataface_PermissionsTool::NO_ACCESS();
             // if the user is null then nobody is logged in... no access.
             // This will force a login prompt.
         $role = $user->val('role');
         return Dataface_PermissionsTool::getRolePermissions($role);
             // Returns all of the permissions for the user's current role.
      }
	  
	  function getPreferences(){
     $auth =& Dataface_AuthenticationTool::getInstance();
    $user =& $auth->getLoggedInUser();

  if ( isset($user) )
    {
      return array('show_tables_menu'=>1);  }
   

    else {
   
       return array('show_tables_menu'=>0);  }
} 
function block__custom_javascripts(){
    //echo '<script src="javascripts.js" type="text/javascript" language="javascript"></script>';
} 
}
?>
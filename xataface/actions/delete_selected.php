<?php
/**
 * This action approves a set of selected webpages.
 *
 * @created Dec. 1, 2008
 * @author Steve Hannah <steve@weblite.ca>
 */
class dataface_actions_delete_selected {
	function handle(&$params){
		if ( !$_POST ) return PEAR::raiseError("This method is only available via POST");
		$app =& Dataface_Application::getInstance();
		$query =& $app->getQuery();
		$records = df_get_selected_records($query);
		//print_r(array_keys($records));exit;
		$updated = 0;
		$errs = array();
		foreach ($records as $rec){
			if ( !$rec->checkPermission('delete') ){
				$errs[] = Dataface_Error::permissionDenied("You do not have permission to delete '".$rec->getTitle()."' because you do not have the 'delete' permission.");
				continue;
			}
			$res = $rec->delete(true /*secure*/);
			if ( PEAR::isError($res) ) $errs[] = $res->getMessage();
			else $updated++;
			
		}
		
		if ( $errs ){
			$_SESSION['--msg'] = 'Errors Occurred:<br/> '.implode('<br/> ', $errs);
		} else {
			$_SESSION['--msg'] = "No errors occurred";
		}
		
		$url = $app->url('-action=list');
		if ( @$_POST['--redirect'] ) $url = base64_decode($_POST['--redirect']);
		$url .= '&--msg='.urlencode($updated.' records were deleted.');
		header('Location: '.$url);
		exit;
	}
}
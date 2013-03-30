<?php
class actions_get_email_addresses {
	function handle(&$params){
		$app =& Dataface_Application::getInstance();
		$query = $app->getQuery();
		$query['-skip'] = 0;
		$query['-limit'] = 999999999;
		
		$at = Dataface_ActionTool::getInstance();
		$emailAction = $at->getAction(array('name'=>'email'));
		if ( !isset($emailAction) or !isset($emailAction['email_column']) ){
			return PEAR::raiseError("No email column specified");
		}
		$col = $emailAction['email_column'];
		
		
		$qb = new Dataface_QueryBuilder($query['-table'], $query);
		$sql = "select `".$col."` ".$qb->_from().$qb->_secure($qb->_where());
		
		$res = mysql_query($sql, df_db());
		if ( !$res ) trigger_error(mysql_error(df_db()), E_USER_ERROR);
		
		$addresses = array();
		while ($row = mysql_fetch_row($res) ) $addresses[] = $row[0];
		@mysql_free_result($res);
		header("Content-type: text/plain");
		echo implode(', ', $addresses);
		exit;
		
	}
}
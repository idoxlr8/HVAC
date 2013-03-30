<?php
class actions_email_opt_out {
	function handle(&$params){
		if ( !@$_REQUEST['email'] ){
			return PEAR::raiseError("No email address  specified");
		}
		
		import('HTML/QuickForm.php');
		$form = new HTML_QuickForm('opt_out_form','post');
		$form->addElement('hidden','email', $_REQUEST['email']);
		$form->addElement('hidden', '-action', 'email_opt_out');
		$form->addElement('submit','submit','Cancel Subscription');
		if ( $form->validate() ){
			$res = mysql_query("replace into dataface__email_blacklist (email) values ('".addslashes($_REQUEST['email'])."')", df_db());
			if ( !$res ) trigger_error(mysql_error(df_db()), E_USER_ERROR);
			header('Location: '.DATAFACE_SITE_HREF.'?--msg='.urlencode('You have successfully opted out of our mail list.  You will no longer receive emails from us.'));
			exit;
		}
		
		ob_start();
		$form->display();
		$html = ob_get_contents();
		ob_end_clean();
		$context = array();
		$context['form'] = $html;
		df_register_skin('email', DATAFACE_PATH.'/modules/Email/templates');
		df_display($context, 'email/opt_out_form.html');
		
	}
}
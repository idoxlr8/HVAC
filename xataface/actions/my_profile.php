<?php
class dataface_actions_my_profile {
	function handle(&$params){
		$app =& Dataface_Application::getInstance();
		$auth =& Dataface_AuthenticationTool::getInstance();
		
		if ( $auth->isLoggedIn() ){
			// forward to the user's profile
			$user =& $auth->getLoggedInUser();
			header('Location: '.$user->getURL());
			exit;
		} else {
			header('Location: '.$app->url('-action=login_prompt').'&--msg='.urlencode('Sorry, this action is only available to logged in users'));
		}
	}
}
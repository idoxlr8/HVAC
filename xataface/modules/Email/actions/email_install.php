<?php
class actions_email_install {
	function handle(&$params){
	
		$cronpath = DATAFACE_PATH.'/modules/Email/cron.php';
		$indexpath = DATAFACE_SITE_PATH.'/'.basename(DATAFACE_SITE_HREF);
		$indexurl = df_absolute_url(DATAFACE_SITE_HREF);
		header('Content-type: text/plain');
		echo <<<END
Please add the following line to your crontab file so that emails will be sent out properly:

* * * * * /usr/bin/php $cronpath $indexpath $indexurl mail

Note that the /usr/bin/php portion should reflect the correct path to your php cli interpreter. 
Yours may be different.
END;


	}
}
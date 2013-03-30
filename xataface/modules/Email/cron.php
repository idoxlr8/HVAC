<?php

function performJobs(){
	if ( !mutex('email.'.base64_encode(DATAFACE_SITE_PATH)) ) die("Email daemon already running");
	$res = mysql_query("select * from dataface__email_jobs", df_db());
	if ( !$res ) trigger_error(mysql_error(df_db()), E_USER_ERROR);
	
	require_once DATAFACE_PATH.'/modules/Email/actions/email.php';
	$action = new actions_email;
	
	while ( $row = mysql_fetch_assoc($res) ){
		echo "\nSending mail for job $row[job_id] ...";
		$res2 = mysql_query("delete from `".$row['join_table']."` where recipient_email='' and messageid='".addslashes($row['email_id'])."'", df_db());
		$action->sendMail($row['email_id'],$row['email_table'],$row['join_table'],$row['recipients_table'],$row['email_column']);		
		
		// check to see if all the messages for this job have been sent yet
		$res2 = mysql_query("select count(*) from `".$row['join_table']."` where sent<>1 and messageid='".addslashes($row['email_id'])."'", df_db());
		if ( !$res2 ) trigger_error(mysql_error(df_db()), E_USER_ERROR);
		list($num)=mysql_fetch_row($res2);
		@mysql_free_result($res2);
		if ( $num==0 ){
			echo "\nJob $row[job_id] is complete!  Deleting job...";
			$res2 = mysql_query("delete from dataface__email_jobs where job_id='".addslashes($row['job_id'])."' limit 1", df_db());
			if ( !$res2 ) trigger_error(mysql_error(df_db()), E_USER_ERROR);
		} else {
			echo "\nAfter sending mail for job $row[job_id], there are still $num messages left to send.";
		}
	}
	@mysql_free_result($res);
	echo "\n";
	

}



/**
 * Obtain a mutex (to make sure we aren't running multiple instances
 * of this script concurrently.
 *
 * This function will return true if it succeeded in obtaining the mutex
 *	(i.e.  no other instance of this script is running.  And false otherwise.
 * @param string $name The name of the mutex to acquire.
 */
function mutex($name){
	global $mutex;
	$path = sys_get_temp_dir().'/'.$name.'.mutex';
	//echo $path;
	$mutex = fopen($path, 'w');
	if ( flock($mutex, LOCK_EX | LOCK_NB) ){
		register_shutdown_function('clear_mutex');
		return true;
	} else {
		return false;
	}
	
}

/**
 * Clears the most recently acquired mutex.
 */
function clear_mutex(){
	global $mutex;
	if ( $mutex ){
		fclose($mutex);
	}
}


/**
 * Shows the command line usage of this script.
 */
function help(){
	echo <<<END
Usage: cron2.php /path/to/index.php "http://example.com/path/to/site" COMMAND
   or: /usr/bin/php cron2.php /path/to/index.php "http://example.com/path/to/site" COMMAND 

Possible commands include:
   mail: 	Send pending mail messages

END;
   

}






if ( !$argv ) die("access denied"); // only command line usage allowed
if ( count($argv)<4 ){
	help();
	exit;
}

switch($argv[3]){
	case 'mail':

		chdir(dirname($argv[1]));
		
		define('DATAFACE_SITE_URL', dirname($argv[2]));
		define('DATAFACE_SITE_HREF',$argv[2]);
		ob_start();
		$_REQUEST=$_GET=array('-action'=>'email_cron');
		include(basename($argv[1]));
		ob_end_clean();
				
		performJobs();
		break;
	
	default:
		help();
		exit;
}
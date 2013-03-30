<?php
/*-------------------------------------------------------------------------------
 * Xataface Web Application Framework
 * Copyright (C) 2005-2008 Web Lite Solutions Corp (shannah@sfu.ca)
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *-------------------------------------------------------------------------------
 */


/**
 * This action sends email to the current found set.  It provides the user with
 * an email form where they can type a subject and a body.  They can include
 * macro variables that will be parsed for each record so that each email can
 * be customized to an extent.
 *
 * @author Steve Hannah <steve@weblite.ca>
 * @created August 2007
 */
class actions_email {

	var $messages = array();
	var $emailTable;
	var $joinTable;
	var $recipientsTable;
	var $emailColumn;

	/**
	 * implements action handle() method.
	 */
	function handle(&$params){
		$action =& $params['action'];
		//print_r($params);
		$app =& Dataface_Application::getInstance();
		$query =& $app->getQuery();
		$query['-skip'] = 0;
		$query['-limit'] = 9999999;
		
		// Let's validate some of the parameters first
		
		// The actions.ini file should define an email_column and email_table parameters
		// to indicate:
		//	a. the name of the column from the current table that should be used
		//	    as the "send to" email address.
		//	b. the name of the table that should store the email messages.
		if ( !@$action['email_column'] ) return PEAR::raiseError("No email column specified in actions.ini", DATAFACE_E_WARNING);
		if ( !@$action['email_table'] ) return PEAR::raiseError("No email table specified in actions.ini", DATAFACE_E_WARNING);
		
		// Make sure the table and column names are not malicious.
		$this->emailColumn = $col = $action['email_column'];
		if ( strpos($col, '`') !== false ) return PEAR::raiseError("Invalid email column name: '$col'", DATAFACE_E_WARNING);
		
		$this->emailTable = $table = $action['email_table'];
		if ( strpos($table, '`') !== false ) return PEAR::raiseError("Invalid email table name: '$table'", DATAFACE_E_WARNING);
		
		$this->joinTable = $join_table = $query['-table'].'__'.$table;
		$this->recipientsTable = $query['-table'];
			// The name of the table that tracks which records have had email sent.
		
		// Next make sure that the email table(s) exist(s)
		if ( !Dataface_Table::tableExists($table, false) || !Dataface_Table::tableExists($join_table, false) ){
			$this->createEmailTables($table, $join_table);
		}
		
		$emailTableObj =& Dataface_Table::loadTable($this->emailTable);
		$contentField =& $emailTableObj->getField('content');
		$contentField['widget']['atts']['rows'] = 20;
		$contentField['widget']['atts']['cols'] = 60;
		$contentField['widget']['label'] = 'Message body';
		$contentField['widget']['description'] = 'Please enter your message content in plain text.';
		$contentField['widget']['type'] = 'htmlarea';
		$contentField['widget']['editor'] = 'nicEdit';
		
		$subjectField =& $emailTableObj->getField('subject');
		$subjectField['widget']['atts']['size'] = 60;
		
		$fromField =& $emailTableObj->getField('from');
		$fromField['widget']['atts']['size'] = 60;
		$fromField['widget']['description'] = 'e.g. Web Lite Solutions &lt;info@weblite.ca&gt;';
		
		
		$ccField =& $emailTableObj->getField('cc');
		$ccField['widget']['atts']['size'] = 60;
		
		$ignoreBlacklistField =& $emailTableObj->getField('ignore_blacklist');
		$ignoreBlacklistField['widget']['type'] = 'checkbox';
		$ignoreBlacklistField['widget']['description'] = 'The black list is a list of email addresses that have opted out of receiving email.  I.e. Users on the black list do not want to receive email.  Check this box if you want to send to blacklisted addresses despite their wish to be left alone.';
		
		
		$form = df_create_new_record_form($table);
		$form->_build();
		
		$form->addElement('hidden','-action');
		$form->addElement('hidden','-table');
		$form->setDefaults(array('-action'=>$query['-action'], '-table'=>$query['-table']));
		$form->insertElementBefore($form->createElement('checkbox', 'send_now', '','Send now (leave this box unchecked if you wish these emails to be queued for later sending by the daily cron job.  Recommended to leave this box unchecked for large found sets (&gt;100 records).)'),'submit_new_newsletters_record');
		$form->addElement('hidden', '-query_string');
		$form->setDefaults(array('-query_string'=>base64_encode(serialize($query))));
		if ( @$app->_conf['from_email'] ){
			$form->setDefaults(array('from'=>$app->_conf['from_email']));
		}
		
		

		if ( $form->validate() ){
			$res = $form->process(array(&$form,'save'), true);
			if ( PEAR::isError($res) ) return $res;
			
			// The form saved ok.. so we can send the emails.
			//$resultSet = $app->getResultSet();
			//$resultSet->loadSet();
			//$it =& $resultSet->iterator();
			$vals = $form->exportValues();
			$q2 = unserialize(base64_decode($vals['-query_string']));
			//print_r($q2);
			//exit;
			
			$qb = new Dataface_QueryBuilder($query['-table'], $q2);
			$sql = "insert ignore into `$join_table` (recipient_email,messageid,date_created) select `".$col."`, '".addslashes($form->_record->val('id'))."' as messageid, now() as date_created ".$qb->_from()." ".$qb->_secure($qb->_where());
			//echo $sql;exit;
			$sres = mysql_query($sql, df_db());
			if ( !$sres ) trigger_error(mysql_error(df_db()), E_USER_ERROR);
			//while ($row = mysql_fetch_row($sres) ){
			//	$join_rec = new Dataface_Record($join_table, array('messageid'=>$form->_record->val('id'),
			//													   'recipient_email'=>$row[0],
			//													   'date_created'=>date('Y-m-d h:i:s')));
			//	$res = $join_rec->save();
			//	if ( !$res ) return PEAR::raiseError("Failed to add entry for email '".$curr->val($col)."'", DATAFACE_E_WARNING);
			//	unset($join_rec);
			//	unset($curr);
			//}
			//$it = df_get_records($query['-table'], $q2);
			//while ( $it->hasNext() ){
			//	$curr =& $it->next();
			//	$join_rec = new Dataface_Record($join_table, array('messageid'=>$form->_record->val('id'),
			//													   'recipient_email'=>$curr->val($col),
			//													   'date_created'=>date('Y-m-d h:i:s')));
			//	$res = $join_rec->save();
			//	if ( !$res ) return PEAR::raiseError("Failed to add entry for email '".$curr->val($col)."'", DATAFACE_E_WARNING);
			//	unset($join_rec);
			//	unset($curr);
			//}
			
			//$this->messages = array();
			// If we're set to send the email right now
			//if ( $form->exportValue('send_now') ){
			//	$this->sendMail($form->_record->val('id'));
			//}
			$this->postJob($form->_record->val('id'), $this->emailTable, $this->joinTable, $this->recipientsTable, $this->emailColumn);
			
			//$this->messages[] = "Email has been queued for delivery.";
			//if ( count($this->messages) > 0 ){
			
				//$_SESSION['--msg'] = implode("\n",$this->messages);
				//echo $_SESSION['--msg'];
				//exit;
				
			//}
			$q2['-action'] = 'list';
			unset($q2['-limit']);
			header('Location: '.$app->url($q2).'&--msg='.urlencode("The message has been queued for delivery"));
			exit;
			
		
		}
		
		$addresses = array();
		//$resultSet = $app->getResultSet();
		//$resultSet->loadSet();
		//$it =& $resultSet->iterator();
		//$it = df_get_records($query['-table'], array_merge($query, array('-limit'=>30)));
		//while ( $it->hasNext() ){
		//	$curr =& $it->next();
		//	$addresses[] = $curr->val($col);
		//	
		//	unset($curr);
		//}
		
		
		ob_start();
		$form->display();
		$context = array();
		$context['email_form'] = ob_get_contents();
		$profileTable =& Dataface_Table::loadTable($query['-table']);
		
		$context['fields'] = array_keys($profileTable->fields(false,true,true));
		
		//$context['blacklist'] = $this->getBlackListed($addresses);
		//$context['addresses'] = array_diff($addresses, $context['blacklist']);
		ob_end_clean();
		df_register_skin('email', DATAFACE_PATH.'/modules/Email/templates');
		df_display($context, 'email_form.html');
		
		
	}
	
	function isBlackListed($email){
		if ( !Dataface_Table::tableExists('dataface__email_blacklist') ) $this->createEmailTables(null,null);
		$res = mysql_query("select email from dataface__email_blacklist where email='".addslashes($email)."' limit 1", df_db());
		if ( !$res ) trigger_error(mysql_error(df_db()), E_USER_ERROR);
		list($num) = mysql_fetch_row($res);
		@mysql_free_result($res);
		return $num;
	}
	
	function getBlackListed($emails){
		if ( !Dataface_Table::tableExists('dataface__email_blacklist') ) $this->createEmailTables(null,null);
		if ( !is_array($emails) ) $emails = array($emails);
		$res = mysql_query("select email from dataface__email_blacklist where email in ('".implode("','", array_map('addslashes',$emails))."')", df_db());
		$out = array();
		if (!$res ) trigger_error(mysql_error(df_db()), E_USER_ERROR);
		while ($row = mysql_fetch_row($res) ) $out[] = $row[0];
		@mysql_free_result($res);
		return $out;
	}
	
	/**
	 * Creates the email tables necessary to store the email.
	 * @param $tablename The name of the table that is to store the email
	 *					 messages themselves.
	 * @param $join_table The name of the table that stores the status
	 *					  of each sent email.
	 * @return void
	 */
	function createEmailTables($tablename, $join_table){
		$app =& Dataface_Application::getInstance();
		
		$sql = array();
		if ( isset($tablename) ){
			$sql[] = "create table if not exists `{$tablename}` (
			`id` int(11) not null auto_increment,
			`subject` varchar(128) not null,
			`cc` varchar(128) default null,
			`from` varchar(128) default null,
			`content` text,
			`ignore_blacklist` tinyint(1) default 0,
			primary key (`id`))";
		}
		if ( isset($join_table) ){
			$sql[] = "create table if not exists `{$join_table}` (
			`messageid` int(11) not null,
			`recipient_email` varchar(128) not null,
			`sent` tinyint(1) default 0,
			`date_created` datetime default null,
			`date_sent` datetime default null,
			`success` tinyint(1) default null,
			primary key (`messageid`,`recipient_email`))";
		}
		$sql[] = "create table if not exists `dataface__email_blacklist` (
			`email` varchar(255) not null primary key
			)";
		
		foreach ($sql as $q ){
			$res = mysql_query($q, $app->db());
			if ( !$res ) trigger_error(mysql_error($app->db()), E_USER_ERROR);
		}
		return true;
		
		
	
	}
	
	/**
	 * Sends the email specified by $emailId to all recipients.
	 * @param integer $emailId The id of the email message.
	 * @param string $emailTable Optional the name of the table containing the email messages.
	 * @param string $joinTable Optional the name of the table corresponding to a single recipient of the given email.
	 * @param string $recipientsTable The name of the table where the recipients originated from.
	 * @param string $emailColumn The name of the column that stored the email address.
	 */
	function sendMail($emailId, $emailTable=null, $joinTable = null, $recipientsTable = null , $emailColumn = null){
		require_once dirname(__FILE__).'/../lib/XPM/MIME.php';
		if ( isset($emailTable) ) $this->emailTable = $emailTable;
		if ( isset($joinTable) ) $this->joinTable = $joinTable;
		if ( isset($recipientsTable) ) $this->recipientsTable = $recipientsTable;
		if ( isset($emailColumn) ) $this->emailColumn = $emailColumn;
		$app =& Dataface_Application::getInstance();
		$conf =& $app->_conf;
		
		if ( @$conf['_mail']['func'] ) $mail_func = $conf['_mail']['func'];
		else $mail_func = 'mail';
		
		$emailTableObj =& Dataface_Table::loadTable($this->emailTable);
		$emailTableObj->addRelationship('recipients', 
			array('__sql__' => 'select * from `'.$this->recipientsTable.'` r inner join `'.$this->joinTable.'` j on `r`.`'.$this->emailColumn.'` = j.recipient_email inner join `'.$this->emailTable.'` e on e.id = j.messageid where e.id=\''.addslashes($emailId).'\'')
			);
			
	
		$email = df_get_record($this->emailTable, array('id'=>$emailId));
		if ( !$email) return PEAR::raiseError("Failed to send email because no message with id {$emailId} could be found.", DATAFACE_E_ERROR);
		
		$recipients = $email->getRelatedRecordObjects('recipients', 0,500, 'sent=0');
		foreach ($recipients as $recipient ){
			
			$values = $recipient->strvals();
			
			$keys = array();
			foreach ($values as $key=>$val) $keys[] = '/%'.$key.'%/';
			$values = array_values($values);
			$content = preg_replace($keys, $values, $recipient->strval('content'));
			$opt_out_url = df_absolute_url(DATAFACE_SITE_HREF.'?-action=email_opt_out&email='.urlencode($recipient->val('recipient_email')));
			
			$html_content = $content .= <<<END
			<hr />
<p>If you don't want to receive email updates from us, you can opt out of our mailing list by clicking <a href="$opt_out_url">here</a> .</p>
END;
			
			$content .= <<<END

------------------------------------------------------------------
If you don't want to receive email updates from us, you can opt out of our mailing list by going to $opt_out_url .
END;
			
			$headers = array();
			if ( $email->strval('from') ){
				$headers[] = "From: ".$email->strval('from');
				$headers[] = "Reply-to: ".$email->strval('from');
			}
			if ( @$app->_conf['mail_host'] ){
				$headers[] = 'Message-ID: <' . md5(uniqid(time())) . '@'.$app->_conf['mail_host'].'>';
			}
			//$headers[] = "Content-Type: text/plain; charset=".$app->_conf['oe'];
			
			$joinRecord = $recipient->toRecord($this->joinTable);
			
			if ( !trim($recipient->val('recipient_email')) ){
				$joinRecord->setValue('success',0);
				$joinRecord->setValue('sent',1);
				$joinRecord->save();
				unset($joinRecord);
				unset($recipient);
				continue;
			}
			
			
			// path to 'MIME.php' file from XPM4 package
			
			
			// get ID value (random) for the embed image
			$id = MIME::unique();
			
			// set text/plain version of message
			$text = MIME::message(htmlspecialchars_decode(strip_tags(preg_replace(array('/<br[^>]*>/i','/<div[^>]*>/i','/<p[^>]*>/i', '/<table[^>]*>/i'), array("\r\n","\r\n","\r\n","\r\n"),$content))), 'text/plain');
			// set text/html version of message
			$html = MIME::message($html_content, 'text/html');
			// add attachment with name 'file.txt'
			//$at[] = MIME::message('source file', 'text/plain', 'file.txt', 'ISO-8859-1', 'base64', 'attachment');
			//$file = 'xpertmailer.gif';
			// add inline attachment '$file' with name 'XPM.gif' and ID '$id'
			//$at[] = MIME::message(file_get_contents($file), FUNC::mime_type($file), 'XPM.gif', null, 'base64', 'inline', $id);
			
			// compose mail message in MIME format
			$mess = MIME::compose($text, $html);
			
			
			if ( !$email->val('ignore_blacklist') and $this->isBlackListed($recipient->val('recipient_email')) ){
				echo "\nEmail address '".$recipient->val('recipient_email')."' is black listed so we do not send email to this address...";
				$joinRecord->setValue('success',0);
				$joinRecord->setValue('sent',1);
			}
			
			else if ( $mail_func($recipient->strval('recipient_email'), $email->strval('subject'), $mess['content'], implode("\r\n", $headers)."\r\n".$mess['header']) ){
				$joinRecord->setValue('success',1);
				$joinRecord->setValue('sent',1);
				echo "Successfully sent email to ".$recipient->val('recipient_email');
				//echo "Successfully sent email to {$recipient->strval('recipient_email')}" ;
				//exit;
			} else {
				$joinRecord->setValue('success',0);
				$joinRecord->setValue('sent',1);
				$this->messages[] = "Failed to send email to ".$email->val('recipient_email');
				//echo "Failed to send";
				//exit;
			}
			
			$joinRecord->setValue('date_sent',date('Y-m-d H:i:s'));
			$joinRecord->save();
			
			unset($joinRecord);
			unset($recipient);
			
		
		}
	
	}
	
	function postJob($emailId, $emailTable=null, $joinTable = null, $recipientsTable = null , $emailColumn = null){
		$res = mysql_query("create table if not exists dataface__email_jobs (
				job_id int(11) not null auto_increment,
				email_id int(11),
				email_table varchar(255),
				join_table varchar(255),
				recipients_table varchar(255),
				email_column varchar(255),
				primary key (job_id))", df_db());
		if ( !$res ) trigger_error(mysql_error(df_db()), E_USER_ERROR);
				
		
		
		$res = mysql_query(
			"insert into dataface__email_jobs (
				email_id,
				email_table,
				join_table,
				recipients_table,
				email_column
				)
				values (
				'".addslashes($emailId)."',
				'".addslashes($emailTable)."',
				'".addslashes($joinTable)."',
				'".addslashes($recipientsTable)."',
				'".addslashes($emailColumn)."'
				)", df_db());
		if ( !$res ) {
			trigger_error(mysql_error(df_db()), E_USER_ERROR);
		}
		
		
	}
}


?>
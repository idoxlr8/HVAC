<?php
/********************************************************************************
 *
 *  Xataface Web Application Framework for PHP and MySQL
 *  Copyright (C) 2006  Steve Hannah <shannah@sfu.ca>
 *  
 *  This library is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU Lesser General Public
 *  License as published by the Free Software Foundation; either
 *  version 2.1 of the License, or (at your option) any later version.
 *  
 *  This library is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 *  Lesser General Public License for more details.
 *  
 *  You should have received a copy of the GNU Lesser General Public
 *  License along with this library; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 *===============================================================================
 */
/**
 * File dataface/actions/new.php
 * Author: Steve Hannah <shannah@sfu.ca>
 * Created April 5, 2006
 *
 * Description:
 * 	A controller class to handle the 'new' action.  The 'new' action is the action that
 *  allows the user to create a new record in the database.
 */
class dataface_actions_new {
	function handle(){
		import( 'Dataface/FormTool.php');
		import( 'Dataface/QuickForm.php');
		$app =& Dataface_Application::getInstance();
		$query =& $app->getQuery();
		
		$new = true;
		
		$currentRecord = new Dataface_Record($query['-table'], array());
		$currentTable =& Dataface_Table::loadTable($query['-table']);
		if ( !isset($query['--tab']) and count($currentTable->tabs($currentRecord)) > 1 ){
			list($query['--tab']) = array_keys($currentTable->tabs($currentRecord));
		} else if ( count($currentTable->tabs($currentRecord)) <= 1 ){
			unset($query['--tab']);
		}
		$formTool =& Dataface_FormTool::getInstance();
		$form = $formTool->createRecordForm($currentRecord, true, @$query['--tab'], $query);
		
		
		//$form = new Dataface_QuickForm($query['-table'], $app->db(),  $query, '',$new);
		$res = $form->_build();
		if ( PEAR::isError($res) ){
			trigger_error($res->toString().Dataface_Error::printStackTrace(), E_USER_ERROR);
		
		}
		$formTool->decorateRecordForm($currentRecord, $form, true, @$query['--tab']);	
		/*
		 *
		 * We need to add the current GET parameter flags (the GET vars starting with '-') so
		 * that the controller knows to pass control to this method again upon form submission.
		 *
		 */
		foreach ( $query as $key=>$value){
			if ( strpos($key,'-')===0 ){
				$form->addElement('hidden', $key);
				$form->setDefaults( array( $key=>$value) );
				
			}
		}
				
		/*
		 * Store the current query string (the portion after the '?') in the form, so we 
		 * can retrieve it after and redirect back to our original location.
		 */
		$form->addElement('hidden', '-query');
		$form->setDefaults( array( '-action'=>$query['-action'],'-query'=>$_SERVER['QUERY_STRING']) );
				
				
		/*
		 * 
		 * We have to deal with 3 cases.
		 * 	1) The form has not been submitted.
		 *	2) The form was submitted but didn't validate (ie: it had some bad input)
		 * 	3) The form was submitted and was validated.
		 *
		 * We deal with Case 3 first...
		 *
		 */
			
		if ( $formTool->validateRecordForm($currentRecord, $form, true, @$query['--tab']) ){
			
			/*
			 *
			 * The form was submitted and it validated ok.  We now process it (ie: save its contents).
			 *
			 */
			$formTool->handleTabSubmit($currentRecord, $form, @$query['--tab']);
			if ( !isset($query['--tab']) ){
				// If we aren't using tabs we just do it the old way.
				// (If it ain't broke don't fix it
				$result = $form->process( array( &$form, 'save') );
			} else {
				// If we are using tabs, we will use the formtool's 
				// session aware saving function
				$result = $formTool->saveSession($currentRecord, true);
			}
			
			$success = true;
			$response =& Dataface_Application::getResponse();
			
			if ( !$result ){
				trigger_error("Error occurred in save: ".mysql_error( $app->db()).Dataface_Error::printStackTrace(), E_USER_ERROR);
				exit;
			} else if ( PEAR::isError($result) && !Dataface_Error::isNotice($result) ){
				//echo "Error..";
				if ( Dataface_Error::isDuplicateEntry($result) ){
					$success = false;
					$form->_errors[] = $result->getMessage();
					
				} else {
					//echo "not dup entry"; exit;
					trigger_error($result->toString(). Dataface_Error::printStackTrace(), E_USER_ERROR);
					exit;
				}
			} else if ( Dataface_Error::isNotice($result) ){
			
				$app->addError($result);
				$success = false;
			}
			
			if ( $success){
				
				if (@$query['-response'] == 'json' ){
					//header('Content-type: text/json; charset="'.$app->_conf['oe'].'"');
					$rvals = $currentRecord->strvals();
					$rvals['__title__'] = $currentRecord->getTitle();
					echo json_encode(array('response_code'=>200, 'record_data'=> $rvals, 'response_message'=>df_translate('Record Successfully Saved', 'Record Successfully Saved')));
					exit;
				}
				import('Dataface/Utilities.php');
				
				
				Dataface_Utilities::fireEvent('after_action_new', array('record'=>$currentRecord));
					
				/*
				 *
				 * Since the form created a new record, then it makes more sense to redirect to this newly
				 * created record than to the old record.  We used the 'keys' of the new record to generate
				 * a redirect link.
				 *
				 */
				//$query = $form->_record->getValues(array_keys($form->_record->_table->keys()));
				$currentRecord->secureDisplay = false;
				if ( $currentRecord->checkPermission('edit') ){
					$nextAction = 'edit';
				} else {
					$nextAction = 'view';
				}
				$url = $currentRecord->getURL(array('-action'=>$nextAction));
				
				
				$msg = implode("\n", $app->getMessages());//@$response['--msg'];
				$msg = urlencode(trim(
					Dataface_LanguageTool::translate(
						/* i18n id */
						"Record successfully saved",
						/* Default message */
						"Record successfully saved."
					)."\n".$msg));
				if ( strpos($url, '?') === false ) $url .= '?';
				$link = $url.'&--msg='.$msg; 
				header("Location: $link");
				exit;
			}
		
		}
		
		ob_start();
		$form->setDefaults($_GET);
		$form->display();
		$out = ob_get_contents();
		ob_end_clean();
		
		if ( count($form->_errors) > 0 ){
			$app->clearMessages();
			$app->addError(PEAR::raiseError("Some errors occurred while processing this form: <ul><li>".implode('</li><li>', $form->_errors)."</li></ul>"));
		}
		
		$context = array('form'=>&$out);
		$context['tabs'] = $formTool->createHTMLTabs($currentRecord, $form, @$query['--tab']);
			
		df_display($context, 'Dataface_New_Record.html', true);
	}
}

?>
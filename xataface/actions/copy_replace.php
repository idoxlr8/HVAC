<?php
/**
 * Xataface Web Application Framework
 * Copyright (C) 2005-2007  Steve Hannah (shannah@sfu.ca)
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
 *
 */
/*
 * An action to copy a set of records and/or replace the values in specific 
 * fields of the records.
 *
 * @author Steve Hannah
 * @created February 9, 2007
 *
 */
import('Dataface/QuickForm.php');
class dataface_actions_copy_replace {
	var $message = "Records successfully updated.";
	var $renderer = null;
	var $form;
	var $dummyForms=array();

	function handle(&$params){
		$app =& Dataface_Application::getInstance();
		$query =& $app->getQuery();
		$table =& Dataface_Table::loadTable($query['-table']);
		
		
		$records = df_get_selected_records($query);
		if ( count($records) == 0 ){
			unset($records);
			$q = $query;
			$q['-start'] = 0;
			$q['-limit'] = 9999;
			$records =& df_get_records_array($query['-table'], $q);
		}
		
		
		// Now we find out a few things, like whether we're doing a related record
		// list or the real list
		$fields = $this->getFieldsForRecord($records[0]);
		
		
		$field_options = array(0=>'Please select ...');
		foreach ($fields as $field){
			$field_options[$field['name']] = $field['widget']['label'];
		}
		
		
		
		
		
		
		$this->form = new HTML_QuickForm('copy_replace_form', 'POST');
		$form =& $this->form;
		$this->addFields($form, $fields);
		
		
		// Add the submit button and extra checkbox for copy
		$form->addElement('hidden', '-copy_replace:fields');
		$el =& $form->addElement('hidden', '-copy_replace:copy');
		if ( @$query['--copy']) {
			$form->setDefaults(array('-copy_replace:copy'=>1));
			$message = <<<END
				This form allows you to copy the selected records and update the 
				values of particular fields in the copies.
END;
			$title = "Copy Records Form";
			
			$warning = <<<END
				Proceeding with this action will make copies of all selected records.
				Use caution and care when using this form.
END;
		} else  {
			$message = <<<END
				This form allows you to perform batch updates on all of the selected
				records.  Use the form below to specify values to be placed in
				any field.
END;
			$warning = <<<END
				Proceeding with this action will update ALL selected records.  You may not be able to undo these changes.  Use caution
				and care when using this form.
END;
			$title = "Find/Replace Form";
		
		}
		foreach ($query as $key=>$val){
			$res = $form->addElement('hidden',$key);
			$form->setDefaults(array($key=>$val));
		}
		
		$form->addElement('hidden', '-copy_replace:submit');
		$form->setDefaults(array('-copy_replace:submit'=>1));

		$submit =& $form->addElement('submit', '-copy_replace:submit_btn', 'Perform Update Now');
		
		
		
		
		if ( @$_POST['-copy_replace:submit'] and $form->validate() ){
			$res = $form->process(array(&$this, 'process'), true);
			if ( !PEAR::isError($res) ){
				$q = array();
				foreach ( array_keys($query) as $key){
					// Remove extra copy/replace keys before forwarding
					if ( strstr($key,'-copy_replace:') == $key or strstr($key, '-copy_replace_form:') == $key){
						$q[$key] = null;
					}
				}
				//print_r($query);exit;
				if ( isset($query['-from']) ){
					$q['-action'] = $query['-from'];
					unset($q['-from']);
				}
				else $q['-action']= 'list';
				
				$url = $app->url($q);
				header('Location: '.$url.'&--msg='.urlencode($this->message));
				exit;
			}
		}
		
		
		$form->accept($this->renderer);
		$out = $this->renderer->toHtml();
	
		df_display( array('title'=>$title, 'message'=>$message, 'warning'=>$warning,'records'=>$records, 'columns'=>$this->getKeysForRecord($records[0]), 'form'=>$out, 'context'=>&$this, 'field_options'=>$field_options), 'copy_replace.html');
		exit;
		
			
	}
	

	
	function &getTableForm($tablename){
		if ( isset($this->dummyForms[$tablename]) ){
			return $this->dummyForms[$tablename];
		} else {
			$this->dummyForms[$tablename] = new Dataface_QuickForm($tablename);
			return $this->dummyForms[$tablename];
		}
	}	
	
	function addFields(&$form, &$fields){
	
		$app=& Dataface_Application::getInstance();
		$query =& $app->getQuery();
		$this->renderer =& $form->defaultRenderer();
		
		foreach (array_keys($fields) as $fieldname){
			if ( $fields[$fieldname]['widget']['type'] == 'hidden' ) continue;
			$builder =& $this->getTableForm($fields[$fieldname]['tablename']);
			$el = $builder->_buildWidget($fields[$fieldname]);
			$el->setName('-copy_replace_form:replace['.$el->getName().']');
			$form->addElement($el);
			ob_start();
			df_display(array('fieldname'=>$fieldname, 'field'=>&$fields[$fieldname], 'table'=>&$table), 'copy_replace_quickform_element_template.html');
			$tpl = ob_get_contents();
			ob_end_clean();
			$this->renderer->setElementTemplate($tpl, $el->getName());
			unset($builder);
			
		}
		//$form->accept($this->renderer);
	}
	
	function getFieldsForRecord(&$record){
		if ( is_a($record, 'Dataface_Record') ){
			$fields = $record->_table->fields();
			foreach ($fields as $k=>$f){
				if ( @$f['visibility']['update'] == 'hidden' ){
					unset($fields[$k]);
				}
			}
			return $fields;
		} else if ( is_a($record, 'Dataface_RelatedRecord') ){
			$fields = array();
			$fieldnames = $record->_relationship->_schema['short_columns'];
			foreach ($fieldnames as $fieldname){
				$t =& $record->_relationship->getTable($fieldname);
				$fields[$fieldname] =& $t->getField($fieldname);
				if ( @$fields[$fieldname]['visibility']['update'] == 'hidden' ){
					unset($fields[$fieldname]);
				}
				unset($t);
			}
			return $fields;
		}
	}
	
	function getKeysForRecord(&$record){
		if ( is_a($record, 'Dataface_Record') ){
			return $record->_table->keys();
		} else if ( is_a($record, 'Dataface_RelatedRecord') ){
			$r =& $record->toRecord();
			return $r->_table->keys();
			
		}
	}
	
	
	function process($values){
		$app =& Dataface_Application::getInstance();
		$query =& $app->getQuery();
		if ( @$values['-copy_replace:copy'] ){
			import('Dataface/CopyTool.php');
			$copyTool =& Dataface_CopyTool::getInstance();
		}

		$orig_replacements = $values['-copy_replace_form:replace'];
		$update_fields = explode('-',$values['-copy_replace:fields']);
		//print_r($update_fields);
		$replacements = array();
		foreach($update_fields as $fld){
			if ( !$fld ) continue;
			$replacements[$fld] = $orig_replacements[$fld];
			
		}
		
		
		
		$blanks = @$_POST['-copy_replace:blank_flag'];
		if ( !$blanks ) $blanks = array();
		foreach ($blanks as $key=>$val){
			if ( $val ){
				$replacements[$key] = null;
			}
		}
		
		
		if ( !is_array($replacements) ){
			return PEAR::raiseError("No fields were selected to change.");
		}
		$records = df_get_selected_records($query);
		if (count($records) == 0 ) {
			$q = $query;
			$q['-limit'] = 99999;
			$q['-skip'] = 0;
			$records =& df_get_records_array($q['-table'], $q);
		}
		
		$fields = $this->getFieldsForRecord($records[0]);
		
		

		$dummyForm =& $this->getTableForm($query['-table']);
		foreach ($replacements as $key=>$val){
			$dummyForm =& $this->getTableForm($fields[$key]['tablename']);
			$val = $dummyForm->pushValue($key, $metaValues, $this->form->getElement('-copy_replace_form:replace['.$key.']'));
			//echo $val;//));
		//	
			if ( $val === '' and !@$blanks[$key]){
				unset($replacements[$key]);
			} else {
				$replacements[$key] = $val;
			}
			unset($dummyForm);
		}

		
		$warnings = array();
		$messages = array();
		foreach ($records as $record){
			if ( @$values['-copy_replace:copy'] ){
				// We are performing a copy.
				$res = $copyTool->copy($record, $replacements);
				if ( PEAR::isError($res) ){
					$warnings[] = $res;
					
				} else {
					$messages[] = "Successfully copied record '".$record->getTitle()."' as record '".$res->getTitle()."'";
					
				}
				$warnings = array_merge($warnings, $copyTool->warnings);
				
			} else {
				if ( !$record->checkPermission('edit') ){
					$warnings[] = Dataface_Error::permissionDenied("Could not update record '".$record->getTitle()."' because of insufficient permissions.");
					continue;
				}
				$failed = false;
				foreach ($replacements as $key=>$val){
					if ( !$record->checkPermission('edit', array('field'=>$key)) ){
						$warnings[] = Dataface_Error::permissionDenied("Could not update record '".$record->getTitle()."' because of insufficient permissions on field '$key'.");
						$failed = true;
					}
				}
				if ( $failed ) continue;
				
				$record->setValues($replacements);
				$res = $record->save();
				if ( PEAR::isError($res) ){
					$warnings[] = $res;
				} else {
					$messages[] = "Successfully updated '".$record->getTitle()."'";
				}
			}
			unset($record);
		}
		if ( @$values['-copy_replace:copy'] ){
			$action = 'copied';
		} else {
			$action = 'updated';
		}
		$this->message = count($messages).' records '.$action.' successfully. '.count($warnings).' warnings.';
		if ( count($warnings) ) {
			$warning_msgs = array();
			foreach ($warnings as $warning){
				$warning_msgs[] = $warning->getMessage();
			}	

		} else {
			$warning_msgs = array();
		}	
		//print_r($warning_msgs);
		$this->message .= '<br>'.implode('<br>', $warning_msgs);
		return true;
		
		
		
	}

}

?>
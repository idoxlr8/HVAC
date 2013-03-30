<?php
$GLOBALS['HTML_QUICKFORM_ELEMENT_TYPES']['calendar'] = array('HTML/QuickForm/calendar.php', 'HTML_QuickForm_calendar');

/**
 * @ingroup widgetsAPI
 */
class Dataface_FormTool_calendar {
	function &buildWidget(&$record, &$field, &$form, $formFieldName, $new=false){
		/*
		 * This field uses a calendar widget
		 */
		
		$widget =& $field['widget'];
		if ( !@$widget['lang'] ){
			$widget['lang'] = Dataface_Application::getInstance()->_conf['lang'];
		}
		$factory =& Dataface_FormTool::factory();
		$el =& $factory->addElement('calendar', $formFieldName, $widget['label'], null, $widget);
		//$el->setProperties($widget);
	
		return $el;
	}
}
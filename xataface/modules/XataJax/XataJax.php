<?php
define('XATAJAX_URL', DATAFACE_URL.'/modules/XataJax');
function xj_json_response($data){
	header('Content-type: text/json; charset="'.Dataface_Application::getInstance()->_conf['oe'].'"');
	echo json_encode($data);
}

import('Dataface/JavascriptTool.php');
import('Dataface/CSSTool.php');
class modules_XataJax {
	
	public function __construct(){
		$js = Dataface_JavascriptTool::getInstance();
		$js->addPath(dirname(__FILE__).DIRECTORY_SEPARATOR.'js', XATAJAX_URL.'/js');
		$js->addPath(DATAFACE_SITE_PATH.DIRECTORY_SEPARATOR.'js', DATAFACE_SITE_URL.'/js');
		$js->addPath(DATAFACE_PATH.DIRECTORY_SEPARATOR.'js', DATAFACE_URL.'/js');
		
		$css = Dataface_CSSTool::getInstance();
		$css->addPath(dirname(__FILE__).DIRECTORY_SEPARATOR.'css', XATAJAX_URL.'/css');
		
	}
	
	

	public function block__after_global_footer(){
		
		$js = Dataface_JavascriptTool::getInstance();
		$used = false;
		if ( $js->getScripts() ){
			echo $js->getHtml();
		}
		
		
		
		return $used;
	}
}
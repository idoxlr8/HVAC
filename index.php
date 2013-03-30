<?php //Main Application access point
require_once "D:\\xampp\\htdocs\\xataface/dataface-public-api.php";
df_init(__FILE__, "/xataface");
$app =& Dataface_Application::getInstance();
$app->display();

if ( !isset($_REQUEST['-sort']) and @$_REQUEST['-table'] == 'invoice' ){
    $_REQUEST['-sort'] = $_GET['-sort'] = 'id';
}
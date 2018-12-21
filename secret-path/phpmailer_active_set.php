<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/secret-path/functions.inc.php';
$GLOBALS['template_name'];
$GLOBALS['description']; 
$GLOBALS['use_smtp']; 
$GLOBALS['host'];
$GLOBALS['server_login'];
$GLOBALS['server_password'];
$GLOBALS['smtpMode']; 	
$GLOBALS['useSmtpAuth'];
$GLOBALS['encryption'];
$GLOBALS['isHtml'];
$GLOBALS['port'];
$GLOBALS['sender_email'];
$GLOBALS['sender_name'];
$GLOBALS['template_id'];
$GLOBALS['SendMailError']='No errors';

$settingsRow = returnActive();

if ($settingsRow[0]!='') {
	$GLOBALS['template_id'] = $settingsRow[0];
	$GLOBALS['template_name'] = $settingsRow[1];
	$GLOBALS['use_smtp'] = $settingsRow[2];
	$GLOBALS['description'] = $settingsRow[3];
	$GLOBALS['useSmtpAuth'] = $settingsRow[4];
	$GLOBALS['host'] = $settingsRow[5];
	$GLOBALS['port'] = $settingsRow[6];
	$GLOBALS['server_login'] = $settingsRow[7];
	$GLOBALS['server_password'] = $settingsRow[8];
	$GLOBALS['encryption'] = $settingsRow[9];
	$GLOBALS['sender_email'] = $settingsRow[11];
	$GLOBALS['sender_name'] = $settingsRow[12];
	$GLOBALS['smtpMode'] = $settingsRow[13];
	$GLOBALS['isHtml'] = $settingsRow[14]; 
} else {
	echo 'Оберіть типові налаштування!';
}
?>
<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/secret-path/functions.inc.php';
$GLOBALS['use_phpmailer'];
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
$GLOBALS['SettingsError'];
// Letter settings
$GLOBALS['letter_id'];
$GLOBALS['receiver_email'];
$GLOBALS['reciever_name'];
$GLOBALS['letter_theme'];

$settingsRow = returnActive();

if (!is_null($settingsRow[0])) {	
	$GLOBALS['template_id'] = $settingsRow[0];
	$GLOBALS['use_phpmailer'] = $settingsRow[1];
	$GLOBALS['template_name'] = $settingsRow[2];	
	$GLOBALS['description'] = $settingsRow[3];
	$GLOBALS['use_smtp'] = $settingsRow[4];
	$GLOBALS['useSmtpAuth'] = $settingsRow[5];
	$GLOBALS['host'] = $settingsRow[6];
	$GLOBALS['port'] = $settingsRow[7];
	$GLOBALS['server_login'] = $settingsRow[8];
	$GLOBALS['server_password'] = $settingsRow[9];
	$GLOBALS['encryption'] = $settingsRow[10];
	$GLOBALS['sender_email'] = $settingsRow[12];
	$GLOBALS['sender_name'] = $settingsRow[13];
	$GLOBALS['receiver_email'] = $settingsRow[14];
	$GLOBALS['smtpMode'] = $settingsRow[15];
	$GLOBALS['isHtml'] = $settingsRow[16]; 
} else {
	$GLOBALS['SettingsError'] = 'Оберіть типові налаштування!';
}

$letterSettings = returnLetterSettings();

if (!is_null($letterSettings[0])) {
	$GLOBALS['letter_id'] = $letterSettings['id'];
 	$GLOBALS['receiver_email'] = $letterSettings['reciever_email'];
 	$GLOBALS['reciever_name'] = $letterSettings['reciever_name'];
 	$GLOBALS['letter_theme'] = $letterSettings['letter_theme'];
}
?>
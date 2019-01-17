<?php 
error_reporting(E_ALL & ~E_NOTICE);
$GLOBALS['error_file'] = '/var/log/nginx/probuddim.pp.ua_error.log';
if ($_SESSION['loginError']!='') {
	echo $_SESSION['loginError'].'<br>';
}
if ($_POST['logout']==1 or $_GLOBALS['AddUser']==true or $_GLOBALS['EditUser']==true)
{	
	header('Location: .');
} 
if ($_GET['change-pass']==1 or $_POST['delete-user']!='')
{
	header('Location: ?userslist=1');
}
if ($_GET['clear-logs']==1)
{
	exec('> '.$GLOBALS['error_file']);
	// $WSErrors_file = fopen($GLOBALS['error_file'], 'a'); //Відкриваємо файл у режимі запису
	// ftruncate($WSErrors_file, 0); // Очищаємо файл
	header('Location: ?web-srv-errors=1');	
}

if ( isset($_GET['smtp-save']) or $_GET['smtp-default']==1 or $error==1 ) { 
	header('Location: ?mailsettings=1');
}
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/header.php';

if($_POST['submit']==1)
{
	if (isset($_POST['login'])&&isset($_POST['password'])&&$_POST['login']!=''&&$_POST['password']!='')
	{	
		Login($_POST['login'], $_POST['password'], $_COOKIE['PHPSESSID']);
		echo $_SESSION['loginError'];
	}
	else
	{
		echo 'Поля логін та пароль не можуть бути порожніми!';
	}	
}
if ($_POST['logout']==1)
{
	LogOut();
}

if($_POST['methodType']=='add')
{
	if ($_POST['login']!='' and $_POST['password']!='' and $_POST['name']!='' and $_POST['email']!='' and $_POST['role']!='')
	{
		if (OnlyLatOnum($_POST['login']))
		{	
			if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))		
			{
				AddUser($_POST['login'], $_POST['password'], $_POST['name'], $_POST['email'], $_POST['role'], $_POST['avatar_url']);	
			}
			else
			{
				echo 'Введіть корректну поштову адресу!';
			}

		}	
	}
}
elseif ($_POST['methodType']=='edit')
{
	if ($_POST['userId']!='' and $_POST['login']!='' and $_POST['name']!='' and $_POST['email']!='' and $_POST['role']!='')
	{		
		if (OnlyLatOnum($_POST['login']))
		{	
			if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))		
			{
				EditUser($_POST['userId'], $_POST['login'], $_POST['name'], $_POST['email'], $_POST['role'], $_POST['avatar_url']);
			}
			else
			{
				echo 'Введіть корректну поштову адресу!';
			}

		}	
	}
}

if ($_GET['change-pass']==1)
{
	if ($_POST['resetPswd']!='' and $_POST['password']!='')
	{
		ChangeUserPassword($_POST['resetPswd'], $_POST['password']);
		// Redirect with javascript;
		/*if($isOK)
		{
			$isOk=false;
			echo '<script>location.replace("?userslist=1")</script>';
		} */
	}
}

if($_POST['delete-user']!='')
{
	DeleteUser($_POST['delete-user']);
}
$avatar_url;
if($_FILES['avatar']['size']>0 && $_FILES['avatar']['error']==0)
{
	if ($_FILES['avatar']['type']=='image/jpeg' || $_FILES['avatar']['type']=='image/png' || 
		$_FILES['avatar']['type']=='image/bmp' || $_FILES['avatar']['type']=='image/gif')
	{
		$temp = $_FILES['avatar']['tmp_name'];
		$avatar_type = substr(basename($_FILES['avatar']['name']), -4,4);
		$avatar_name_r = rand(12345678, 120549999);
		$avatar_name_d = date('YndHms');	
		$avatar_url = '/secret-path/ava/'.$avatar_name_r.$avatar_name_d.'_ava'.$avatar_type; 
		$upload_dir = $_SERVER['DOCUMENT_ROOT'].$avatar_url;

		if (copy($temp,$upload_dir))
		{
			echo 'Аватар успішно завантажений!';			
			unset($_FILES['avatar']);
		}
		else {
			echo 'Помилка завантаження. Перевірте налаштування PHP!';
		}
	}
	else
	{
		echo 'Оберіть файл зображення. Цей тип файлу не підтримується!';
	}
}
if (isset($_POST['template-name'])) {
	if (isset($_GET['smtp-save'])) {	
		AddUpdateEmailSettings($_GET['smtp-save'], $_POST['use-phpmailer'], $_POST['template-id'], $_POST['template-name'], $_POST['server-description'], $_POST['smtpAuth'], $_POST['hostname'], $_POST['serverPort'], $_POST['userLogin'], $_POST['userPassword'], $_POST['smtpEncryption'], $_POST['isDefault'],  $_POST['senderEmail'], $_POST['senderName'], $_POST['smtpMode'],  $_POST['textStyle'], $_POST['use_smtp']);	
	}
}

if ($_GET['smtp-default']==1) {
	makeActive($_POST['isDefault']);
}

if ($_POST['test-email']!='') {
	$recieverName = 'Reciever Name';
	$letterTheme = 'Test letter: Кирилиця';
	$client_name = 'Test name';
	$client_email = 'client@email.com';
	$client_phone = '0999999999';
	$test_details = 'How is your test distribution?';

	if ($GLOBALS['use_phpmailer']!=0) {
		SendMailByPHPMailer($recieverName, $_POST['test-email'], $client_name, $_POST['test-email'], $client_phone, $letterTheme, $test_details, $GLOBALS['smtpMode'], $GLOBALS['host'], $GLOBALS['useSmtpAuth'], $GLOBALS['server_login'], $GLOBALS['server_password'], $GLOBALS['encryption'], $GLOBALS['port'], $GLOBALS['sender_email'], $GLOBALS['sender_name'], $GLOBALS['isHtml'], $_POST['use_smtp']);
	} else {		
		SendMail($letterTheme, $recieverName, $_POST['test-email'], $GLOBALS['sender_name'], $GLOBALS['sender_email'], $client_name, $client_email, $client_phone, $test_details);	
	}	
}

if ($_SESSION['id']==md5($_COOKIE['PHPSESSID'].$_SESSION['login']))
{
	include $_SERVER['DOCUMENT_ROOT'].'/secret-path/site-menu.php';
}
else 
{
	include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/logform.php';
}
 include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/footer.php';
?>

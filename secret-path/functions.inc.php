<?php 

include_once $_SERVER['DOCUMENT_ROOT'].'/secret-path/data-model.inc.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'].'/secret-path/phpmailer/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'].'/secret-path/phpmailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/secret-path/phpmailer/src/SMTP.php';

function OnlyLatOnum($str)
{
	if(preg_match('/^[a-zA-Z][a-z0-9]*$/', $str))
	{
		unset($_SESSION['OnlyLatOnumError']);
		return true;
	}
	else
	{
		$_SESSION['OnlyLatOnumError']='Дозволені лише латинські літери та цифри!';
		return false;
	}

}

function OnlyNum($str)
{
	if(preg_match('/^[0-9]*$/', $str))
	{
		unset($_SESSION['OnlyNumError']);
		return true;
	}
	else
	{
		$_SESSION['OnlyNumError']='Дозволені лише цифри!';
		return false;
	}
}

 function LogOut()
 {
	unset($_SESSION['id']);
	unset($_SESSION['login']);
	unset($_SESSION['name']);
	unset($_SESSION['ip']);		       
	unset($_SESSION['role']);	   	        	
	// setcookie('PHPSESSID','',time() - 3600, '/');
	session_destroy();	
 }

 function Login($login, $password, $cookie_session)
 {
 	$passwordHash = md5($password);
 	try
 	{
 		$Login_sql_str='SELECT * FROM users WHERE login=:login AND password=:passwordHash';
        $LoginExpSql = $GLOBALS['pdo'] -> prepare($Login_sql_str);
		$LoginExpSql -> bindValue(':login', $login);
		$LoginExpSql -> bindValue(':passwordHash', $passwordHash);
		$LoginExpSql -> execute();
		$LoginResultArr = $LoginExpSql -> fetch();
		if ($LoginResultArr[0]!='')
		{
			session_start();			
			$_SESSION['id'] = md5($_COOKIE['PHPSESSID'].$LoginResultArr['login']);
			$_SESSION['login'] = $LoginResultArr['login'];
			$_SESSION['name'] = $LoginResultArr['name'];
			$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];		
			$_SESSION['role'] = $LoginResultArr['role'];
			$_SESSION['user-id'] = $LoginResultArr[0];
			session_write_close();
			try
			{
				$Login_update_sql='UPDATE users SET last_login=NOW(), last_ip=:last_ip, last_session_id=:session_id WHERE id=:user_id';
				$Login_update_exp= $GLOBALS['pdo'] -> prepare($Login_update_sql);				
				$Login_update_exp -> bindValue(':last_ip', $_SESSION['ip']);
				$Login_update_exp -> bindValue(':session_id', $_SESSION['id']);
				$Login_update_exp -> bindValue(':user_id', $LoginResultArr[0]);
				$Login_update_exp -> execute();
				unset($_SESSION['loginError']);
			}
			catch(PDOException $e)
			{
				$_SESSION['loginError'] = 'Сталася помилка при виконанні запиту '. $e -> getMessage();
			}
		}
		    elseif ($LoginResultArr[0]=='')
		    {			        	
		        if(isset($_SESSION)) 
		        {       	
		        	LogOut();
		        }
		            $_SESSION['loginError'] = 'Невірний логін або пароль';    
		                                  	   		        	       
		    }		
 	}
 	catch(PDOException $e)
 	{
 		$_SESSION['loginError'] = 'Сталася помилка при виконанні запиту '. $e -> getMessage();
 		return $_SESSION['loginError'];
 	}
 }

function ObjectList($objectType)
 {
 	try 
 	{
 		$ObjectList_sql_str = 'SELECT * FROM '.$objectType;
 		$ObjectList_select_exp = $GLOBALS['pdo'] -> prepare($ObjectList_sql_str);
 		$ObjectList_select_exp -> execute();
 		$ObjectListResultArr = $ObjectList_select_exp -> fetchAll();
 		return $ObjectListResultArr;
 	}
 	catch (PDOException $e)
 	{
 		$GLOBALS['ObjectListError'] = 'Сталася помилка при виконанні запиту '. $e -> getMessage();
 		return $GLOBALS['ObjectListError']; 		
 	}
 }

 function ObjectListPag($objectType, $start, $limit)
 {
 	try 
 	{
 		$ObjectList_sql_str = 'SELECT * FROM '.$objectType.' LIMIT '.$start.', '.$limit;
 		$ObjectList_select_exp = $GLOBALS['pdo'] -> prepare($ObjectList_sql_str);
 		$ObjectList_select_exp -> execute();
 		$ObjectListResultArr = $ObjectList_select_exp -> fetchAll();
 		return $ObjectListResultArr;
 	}
 	catch (PDOException $e)
 	{
 		$GLOBALS['ObjectListError'] = 'Сталася помилка при виконанні запиту '. $e -> getMessage();
 		return $GLOBALS['ObjectListError']; 		
 	}
 }

function SelectObject($objectType, $objectId)
 {
 	try 
 	{
 		$SelectObject_sql_str = 'SELECT * FROM '.$objectType.' WHERE id=:objectId';
 		$SelectObject_select_exp = $GLOBALS['pdo'] -> prepare($SelectObject_sql_str);
 		$SelectObject_select_exp -> bindValue('objectId', $objectId);
 		$SelectObject_select_exp -> execute();
 		$SelectObjectResultArr = $SelectObject_select_exp -> fetch();
 		return $SelectObjectResultArr;
 	}
 	catch (PDOException $e)
 	{
 		$_SESSION['SelectObjectError'] = 'Сталася помилка при виконанні запиту '. $e -> getMessage();
 		return $_SESSION['SelectObjectError']; 	
 	}
 }

 function AddUser($login, $password, $name, $email, $role, $avatar='')
 {
 	$passwordHash = md5($password);
  	try 
 	{
 		$AddUser_sql_str = 'INSERT INTO users SET login=:login, password=:passwordHash, name=:name, email=:email, role=:role, avatar_url=:avatar, last_login="1970-01-01 00:00"';
 		$AddUser_insert_exp = $GLOBALS['pdo'] -> prepare($AddUser_sql_str);
 		$AddUser_insert_exp -> bindValue(':login', $login);
 		$AddUser_insert_exp -> bindValue(':passwordHash', $passwordHash);
 		$AddUser_insert_exp -> bindValue(':name', $name);
 		$AddUser_insert_exp -> bindValue(':email', $email);
 		$AddUser_insert_exp -> bindValue(':role', $role);
 		$AddUser_insert_exp -> bindValue(':avatar', $avatar);
 		$AddUser_insert_exp -> execute();
 		CountObjects('users');
 		return $GLOBALS['AddUser']=true;
 	}
 	catch (PDOException $e)
 	{
 		$GLOBALS['UserAddError'] = 'Сталася помилка при виконанні запиту '. $e -> getMessage();
 		if (stristr($GLOBALS['UserAddError'], 'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry'))
 		{
 			$GLOBALS['UserAddError'] = 'Цей логін вже використовується!';
 		} 		
 	}	
 }

 function EditUser($userId, $login, $name, $email, $role, $avatar='')
 {
  	try 
 	{
 		$EditUser_sql_str = 'UPDATE users SET login=:login, name=:name, email=:email, role=:role, avatar_url=:avatar WHERE id=:userId';
 		$EditUser_update_exp = $GLOBALS['pdo'] -> prepare($EditUser_sql_str);
 		$EditUser_update_exp -> bindValue(':login', $login); 	
 		$EditUser_update_exp -> bindValue(':name', $name);
 		$EditUser_update_exp -> bindValue(':email', $email);
 		$EditUser_update_exp -> bindValue(':role', $role);
 		$EditUser_update_exp -> bindValue(':avatar', $avatar);
 		$EditUser_update_exp -> bindValue(':userId', $userId);
 		$EditUser_update_exp -> execute(); 
 		return $GLOBALS['EditUser']=true;	
 	}
 	catch (PDOException $e)
 	{
 		$_SESSION['UserEditError'] = 'Сталася помилка при виконанні запиту '. $e -> getMessage();
 		return $GLOBALS['UserEditError']; 		
 	}	
 }

 function DeleteUser($userId)
 {
 	try
 	{
 		$DeleteUser_sql_str = 'DELETE FROM users WHERE id=:userId';
 		$DeleteUser_delete_exp = $GLOBALS['pdo'] -> prepare($DeleteUser_sql_str);
 		$DeleteUser_delete_exp -> bindValue(':userId', $userId);
 		$DeleteUser_delete_exp -> execute();
 		unset($_SESSION['UserDeleteError']);
 		return true;
 	}
 	catch (PDOException $e)
 	{
 		$_SESSION['UserDeleteError'] = 'Сталася помилка при видаленні користувача '. $e -> getMessage();
 		return $_SESSION['UserDeleteError']; 		
 	}	
 }

 function ChangeUserPassword($userId, $password)
 {
 	$passwordHash = md5($password);
 	try
 	{ 		
 		$UpdateUserPwsd_sql_str = 'UPDATE users SET password=:passwordHash WHERE id=:userId';
 		$UpdateUserPwsd_update_exp = $GLOBALS['pdo'] -> prepare($UpdateUserPwsd_sql_str);
 		$UpdateUserPwsd_update_exp -> bindValue(':userId', $userId); 		
 		$UpdateUserPwsd_update_exp -> bindValue(':passwordHash', $passwordHash);
 		$UpdateUserPwsd_update_exp -> execute();
 		return true;
 	}
 	catch (PDOException $e)
 	{
 		$_SESSION['UserChangePassError'] = 'Сталася помилка при виконанні запиту '. $e -> getMessage();
 		return $_SESSION['UserChangePassError']; 		
 	}	
 }

 function CountObjects($object)
 {
  	try 
 	{
 		$ObjectCount_sql_str = 'SELECT COUNT(*) FROM '.$object;
 		$ObjectCount_select_exp = $GLOBALS['pdo'] -> prepare($ObjectCount_sql_str);
 		$ObjectCount_select_exp -> execute();
 		$ObjectCount_select_exp = $ObjectCount_select_exp -> fetch();
 		return $ObjectCount_select_exp[0];
 	}
 	catch (PDOException $e)
 	{
 		$_SESSION['CountObjectsError'] = 'Сталася помилка при виконанні запиту '. $e -> getMessage();
 		return $_SESSION['CountObjectsError']; 		
 	}	
 }

 function SendMail($recieverEmail, $senderName, $senderEmail, $senderPhone, $senderText)
 { 	
 	$recieverName = 'Юрій Павлович';
 	$letterTheme = 'Мені потрібна консультація!';
 	$messageText = '
 	Доброго дня, шановний, '.$recieverName.'!\r\n
 	Мене звати '.$senderName.'\r\n
	Моя поштова скринька: '.$senderEmail.'\r\n
	Мій номер телефону: '.$senderPhone.'\r\n
	Моє питання\r\n'.$senderText;
 	$isSent=mail($recieverEmail, $letterTheme, $messageText);
 	$server_respond='Something';
  	try
 	{
 		//$Sendmail_insert_sql = 'INSERT INTO `maillog`(`sent_date`, `sent_data`, `mailserver_respond`, `client_name`, `client_phone`, `client_email`) VALUES (NOW(), :messageText, "", :senderName, :senderPhone, :senderEmail)';
 		$Sendmail_insert_sql = 'INSERT INTO maillog SET sent_date=NOW(), sent_data=:messageText, mailserver_respond=""/*:server_respond*/, client_name=:senderName, client_phone=:senderPhone, client_email=:senderEmail';		
 		$Sendermail_insert_exp = $GLOBALS['pdo'] -> prepare($Sendmail_insert_sql);
 		$Sendermail_insert_exp -> bindValue(':messageText', $messageText);
 		// $Sendermail_insert_exp -> bindValue(':server_respond', $server_respond);
 		$Sendermail_insert_exp -> bindValue(':senderName', $senderName);
 		$Sendermail_insert_exp -> bindValue(':senderPhone', $senderPhone);
 		$Sendermail_insert_exp -> bindValue(':senderEmail', $senderEmail);
 		$Sendermail_insert_exp -> execute();
 		echo 'execute OK!<br>'; 		
 		return $SendMail = true; 
 	}
 	catch (PDOException $e)
 	{
 		$_SESSION['SendMailInsertError'] = 'Сталася помилка при записі поштового логу '. $e -> getMessage(); 		
 		return $_SESSION['SendMailInsertError'];
 	}
 }

 function Search($tableName, $rowName, $query)
 {
 	try
 	{
 		$Search_select_sql = 'SELECT * FROM '.$tableName.'WHERE '.$rowName.' =:LIKE "%'.$query.'%"';
 		$Search_select_exp = $GLOBALS['pdo'] -> prepare($Search_select_sql);
 		$Search_select_exp -> execute();
 	}
 	catch (PDOException $e)
 	{
 		$_SESSION['SearchSelectError'] = 'Сталася помилка при пошуку '. $e -> getMessage();  
 		return $_SESSION['SendMailInsertError'];			
 	}
 }


function AddUpdateEmailSettings($setUpMode, $id=0, $template, $description, $serverSmtpAuth, $serverHost, $serverPort, $userLogin, $userPassword, $serverEncryption, $isDefault,  $senderEmail, $senderName, $smtpMode,  $textStyle, $useSmtp)
{
	if ( $useSmtp == 'on' )
	{
		$useSmtp = 1;	
	} else {
		$useSmtp = 0;
	}

	if ($setUpMode==0)
	{
		try
		{
			$AddEmailSettings_sql = 'INSERT INTO `email_settings` SET template_name=:template, description=:description, use_smtp=:useSmtp, use_smtp_auth=:serverSmtpAuth, host=:serverhost, port=:serverport, server_login=:login, server_password=:password, encryption=:encryption, active=:isDefault, sender_email=:senderEmail, sender_displayname=:senderName, smtp_mode=:smtpMode, ishtml=:textStyle';
			$AddEmailSettings_exp = $GLOBALS['pdo'] -> prepare($AddEmailSettings_sql);
			$AddEmailSettings_exp -> bindValue(':template', $template);
			$AddEmailSettings_exp -> bindValue(':description', $description);
			$AddEmailSettings_exp -> bindValue(':serverSmtpAuth', $serverSmtpAuth);
			$AddEmailSettings_exp -> bindValue(':serverhost',$serverHost);
			$AddEmailSettings_exp -> bindValue(':serverport', $serverPort);
			$AddEmailSettings_exp -> bindValue(':login', $userLogin);
			$AddEmailSettings_exp -> bindValue(':password', $userPassword);
			$AddEmailSettings_exp -> bindValue(':encryption', $serverEncryption);
			$AddEmailSettings_exp -> bindValue(':isDefault', $isDefault);
			$AddEmailSettings_exp -> bindValue(':senderEmail', $senderEmail);
			$AddEmailSettings_exp -> bindValue(':senderName', $senderName);
			$AddEmailSettings_exp -> bindValue(':smtpMode', $smtpMode);
			$AddEmailSettings_exp -> bindValue(':textStyle', $textStyle);
			$AddEmailSettings_exp -> bindValue(':useSmtp', $useSmtp);
			$AddEmailSettings_exp -> execute();
		}
		catch (PDOException $e)
		{
			$GLOBALS['AddEmailSettingsError'] = 'Сталася помилка при додаванні налаштувань SMTP-сервера '. $e -> getMessage();  
		}
	}
	elseif ($setUpMode==1)
	{
		try
		{
			$UpdateEmailSettings_sql = 'UPDATE `email_settings` SET template_name=:template, description=:description,  use_smtp=:useSmtp, use_smtp_auth=:serverSmtpAuth, host=:serverhost, port=:serverport, server_login=:login, server_password=:password, encryption=:encryption, active=:isDefault, sender_email=:senderEmail, sender_displayname=:senderName, smtp_mode=:smtpMode, ishtml=:textStyle WHERE id=:id';
			$UpdateEmailSettings_exp = $GLOBALS['pdo'] -> prepare($UpdateEmailSettings_sql);
			$UpdateEmailSettings_exp -> bindValue(':id', $id);
			$UpdateEmailSettings_exp -> bindValue(':template', $template);
			$UpdateEmailSettings_exp -> bindValue(':description', $description);
			$UpdateEmailSettings_exp -> bindValue(':serverSmtpAuth', $serverSmtpAuth);
			$UpdateEmailSettings_exp -> bindValue(':serverhost',$serverHost);
			$UpdateEmailSettings_exp -> bindValue(':serverport', $serverPort);
			$UpdateEmailSettings_exp -> bindValue(':login', $userLogin);
			$UpdateEmailSettings_exp -> bindValue(':password', $userPassword);
			$UpdateEmailSettings_exp -> bindValue(':encryption', $serverEncryption);
			$UpdateEmailSettings_exp -> bindValue(':isDefault', '1');
			$UpdateEmailSettings_exp -> bindValue(':senderEmail', $senderEmail);
			$UpdateEmailSettings_exp -> bindValue(':senderName', $senderName);
			$UpdateEmailSettings_exp -> bindValue(':smtpMode', $smtpMode);
			$UpdateEmailSettings_exp -> bindValue(':textStyle', $textStyle);
			$UpdateEmailSettings_exp -> bindValue(':useSmtp', $useSmtp);
			$UpdateEmailSettings_exp -> execute();
		}
		catch (PDOException $e)
		{
			$GLOBALS['UpdateEmailSettingsError'] = 'Сталася помилка при оновленні налаштувань SMTP-сервера '. $e -> getMessage();  
		}
	}
}

function makeActive ($id) {
	try {
		$makeInactive = $GLOBALS['pdo'];
		$makeInactive -> exec('UPDATE email_settings SET active=0');
		unset($makeInactive);
		$makeActive_sql = 'UPDATE email_settings SET active=1 WHERE id=:id';
		$makeActive_exp = $GLOBALS['pdo'] -> prepare($makeActive_sql);
		$makeActive_exp -> bindValue(':id', $id);
		$makeActive_exp -> execute();
	} catch (PDOException $e) {
		$GLOBALS['makeActiveError'] = 'Сталася помилка при оновленні типових налаштувань '.$e -> getMessage();		
	}
}

function returnActive() {
	try {
		$returnActive = $GLOBALS['pdo'];		
		$activeQuery = $returnActive -> query('SELECT * FROM email_settings WHERE active=1');
		$activeResult = $activeQuery -> fetch();
		return $activeResult;		
	} catch (PDOException $e) {
		$GLOBALS['returnActiveError'] = 'Сталася помилка при виборі типових налаштувань '.$e -> getMessage();		
	}
}

 function SendMailByPHPMailer($recieverName, $recieverEmail, $senderName, $senderEmail, $senderPhone, $letterTheme, $senderText, $smtpMode, $serverHost, $serverSmtpAuth, $serverUserName, $serverUserPassword, $serverEncryption, $serverPort, $serverEmail, $serverName, $isHtml, $useSmtp)
 { 	
 	//$recieverName = 'Юрій Павлович';
 	//$letterTheme = 'Мені потрібна консультація!';
 	$messageText = '
 	<h3>Доброго дня, шановний, '.$recieverName.'!</h3>
 	<p>Мене звати '.$senderName.'</p>
	<p>Моя поштова скринька: '.$senderEmail.'</p>
	<p>Мій номер телефону: '.$senderPhone.'</p>
	<p>Моє питання:</p><p>'.$senderText.'</p>';

	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
		    //Server settings
		    $mail->SMTPDebug = $smtpMode;   
		    if ( $useSmtp==1 ) {
			    $mail->isSMTP();                                      // Set mailer to use SMTP
			    $mail->Host = $serverHost;  // Specify main and backup SMTP servers
			    $mail->SMTPAuth = $serverSmtpAuth;                               // Enable SMTP authentication
			    $mail->Username = $serverUserName;                 // SMTP username
			    $mail->Password = $serverUserPassword;                           // SMTP password
			    $mail->SMTPSecure = $serverEncryption;                            // Enable TLS encryption, `ssl` also accepted
			    $mail->Port = $serverPort;                                    // TCP port to connect to
			}
		    //Recipients
		    $mail->setFrom($serverEmail, $serverName);
		    $mail->addAddress($recieverEmail, $recieverName);     // Add a recipient

		    //Attachments
		   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		    //Content
		    $mail->isHTML($isHtml);                                  // Set email format to HTML
		    $mail->Subject = $letterTheme;
		    $mail->Body    = $messageText;
		    $mail->AltBody = $messageText;

		    $mail->send();
		    $GLOBALS['MailSuccess'] = 'Листа було успішно відправлено! Очікуйте відповіді на Вашу поштову адресу.';
		} catch (PDOException $e) {
		    $GLOBALS['SendMailError'] = 'Не вдалося відправити листа: '. $mail->ErrorInfo;
		}
 	// $isSent=mail($recieverEmail, $letterTheme, $messageText);
 	// $server_respond='Something';
  	try
 	{
 		//$Sendmail_insert_sql = 'INSERT INTO `maillog`(`sent_date`, `sent_data`, `mailserver_respond`, `client_name`, `client_phone`, `client_email`) VALUES (NOW(), :messageText, "", :senderName, :senderPhone, :senderEmail)';
 		$Sendmail_insert_sql = 'INSERT INTO maillog SET sent_date=NOW(), sent_data=:messageText, mailserver_respond=:server_respond, client_name=:senderName, client_phone=:senderPhone, client_email=:senderEmail';		
 		$Sendermail_insert_exp = $GLOBALS['pdo'] -> prepare($Sendmail_insert_sql);
 		$Sendermail_insert_exp -> bindValue(':messageText', $messageText);
 		$Sendermail_insert_exp -> bindValue(':server_respond', $GLOBALS['SendMailError']);
 		$Sendermail_insert_exp -> bindValue(':senderName', $senderName);
 		$Sendermail_insert_exp -> bindValue(':senderPhone', $senderPhone);
 		$Sendermail_insert_exp -> bindValue(':senderEmail', $senderEmail);
 		$Sendermail_insert_exp -> execute(); 			
 		return $SendMail = true; 
 	}
 	catch (PDOException $e)
 	{
 		$_SESSION['SendMailInsertError'] = 'Сталася помилка при записі поштового логу '. $e -> getMessage(); 		
 		return $_SESSION['SendMailInsertError'];
 	}
}

function ShowPagination($PageQuantity, $url='') {
	$PageNum = 0;
	while( $PageNum < $PageQuantity ) {
		$PageNum++;		
		echo '<a href="'.$url.$PageNum.'">['.$PageNum.']</a>';
	}
}
?>
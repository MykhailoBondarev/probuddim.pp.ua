<?php 
// if ($_GET['send-email']==1)
// {
// 	header('Location: .');	
// }
include_once $_SERVER['DOCUMENT_ROOT'].'/secret-path/phpmailer_active_set.php';

	$recieverName = 'Юрій Павлович';
	$recieverEmail = 'palych@gmail.com';
	$letterTheme = 'Мені потрібна консультація!';

 if ($_GET['send-email']==1)
 { 	
	  if ($_POST['client-name']!='' and $_POST['email']!='' and $_POST['phone']!='' and $_POST['details']!='')
	 {	 	
	 	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	 	{
	 		//$SendMail=SendMail('myemail@mail.com', $_POST['client-name'], $_POST['email'], $_POST['phone'], $_POST['details']);	 	 
	 		SendMailByPHPMailer($recieverName, $recieverEmail, $_POST['client-name'], $_POST['email'], $_POST['phone'], $letterTheme, $_POST['details'], $GLOBALS['smtpMode'], $GLOBALS['host'], $GLOBALS['useSmtpAuth'], $GLOBALS['server_login'], $GLOBALS['server_password'], $GLOBALS['encryption'], $GLOBALS['port'], $GLOBALS['sender_email'], $GLOBALS['sender_name'], $GLOBALS['isHtml'], $_POST['use_smtp']);
	 	} 
	 	else
	 	{
	 		echo 'Введіть корректну поштову адресу!';
	 	}
	 }	
 }
 ?>	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>I`m working!!!</title>	
	<link rel="stylesheet" href="">
</head>
<body>
<form action="?send-email=1" method="post">
	<input type="text" name="client-name" placeholder="введіть ім'я"><br>
	<input type="phone" name="phone" placeholder="введіть телефон"><br>
	<input type="email" name="email" placeholder="введіть адресу пошти"><br>
	<textarea name="details" cols="30" rows="10"></textarea><br>
	<button>Відправити</button>
	<button type="reset">Скасувати</button>
</form>

 <a href="/secret-path">Адмінка</a>
<div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="friends" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>

</body>
<?php include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/footer.php'; ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/uk_UA/sdk.js#xfbml=1&version=v3.2';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</html>

<?php 
if ($_POST['logout']==1)
{	
	header('Location: .');
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

 if ($_SESSION['id']==md5($_COOKIE['PHPSESSID'].$_SESSION['login']))
 {
 	include $_SERVER['DOCUMENT_ROOT'].'/secret-path/site-menu.php';
 }
 else 
 {
 	include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/logform.php';
 }
?>
</body>
</html>
<?php 
if ($_SESSION['loginError']!=''){echo $_SESSION['loginError'].'<br>';}
if ($_POST['logout']==1 or $_GLOBALS['AddUser']==true or $_GLOBALS['EditUser']==true)
{	
	header('Location: .');
} 
if ($_GET['change-pass']==1 or $_POST['delete-user']!='')
{
	header('Location: ?userslist=1');
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
		AddUser($_POST['login'], $_POST['password'], $_POST['name'], $_POST['email'], $_POST['role'], $_POST['avatar_url']);	
	}
}
elseif ($_POST['methodType']=='edit')
{
	if ($_POST['userId']!='' and $_POST['login']!='' and $_POST['name']!='' and $_POST['email']!='' and $_POST['role']!='')
	{		
		EditUser($_POST['userId'], $_POST['login'], $_POST['name'], $_POST['email'], $_POST['role'], $_POST['avatar_url']);
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

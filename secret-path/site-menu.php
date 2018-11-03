<?php 
	include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/admin-panel.php';

	if ($_SESSION['UserDeleteError']!=''){echo $_SESSION['UserDeleteError'].'<br>';}		
	if ($_SESSION['UserEditError']!=''){echo $_SESSION['UserEditError'].'<br>';}
	if ($_SESSION['UserAddError']!=''){echo $_SESSION['UserAddError'].'<br>';}
	if ($_SESSION['SelectObjectError']!=''){echo $_SESSION['SelectObjectError'].'<br>';}
	if ($_SESSION['ObjectListError']!=''){echo $_SESSION['ObjectListError'].'<br>';}	
	if ($_SESSION['UserChangePassError']!=''){echo $_SESSION['UserChangePassError'].'<br>';}	
	if ($_SESSION['CountObjectsError']!=''){echo $_SESSION['CountObjectsError'].'<br>';}
	if ($_SESSION['OnlyLatOnumError']!=''){echo $_SESSION['OnlyLatOnumError'].'<br>';}
	if ($_SESSION['OnlyNumError']!=''){echo $_SESSION['OnlyNumError'].'<br>';}
	
	if($_GET['userslist']==1)
	{
		include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/userslist.php';
	} 
	elseif($_GET['maillist']==1)
	{
		include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/maillist.php';	
	}
	elseif($_GET['user']=='add' or $_POST['edit']!='')
	{
		include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/useradd.php';
	}
	elseif($_POST['user']=='edit')
	{
		include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/useradd.php';
	}
	elseif($_GET['user']=='pwd')
	{
		include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/userpassword.php';
	}
 ?>


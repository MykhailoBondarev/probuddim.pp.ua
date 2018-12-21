<?php 
	if ($_SESSION['UserDeleteError']!=''){echo $_SESSION['UserDeleteError'].'<br>';}		
	if ($GLOBALS['UserEditError']!=''){echo $GLOBALS['UserEditError'].'<br>';}
	if ($GLOBALS['UserAddError']!=''){echo $GLOBALS['UserAddError'].'<br>';}
	if ($_SESSION['SelectObjectError']!=''){echo $_SESSION['SelectObjectError'].'<br>';}
	if ($GLOBALS['ObjectListError']!=''){echo $GLOBALS['ObjectListError'].'<br>';}	
	if ($_SESSION['UserChangePassError']!=''){echo $_SESSION['UserChangePassError'].'<br>';}	
	if ($_SESSION['CountObjectsError']!=''){echo $_SESSION['CountObjectsError'].'<br>';}
	if ($_SESSION['OnlyLatOnumError']!=''){echo $_SESSION['OnlyLatOnumError'].'<br>';}
	if ($_SESSION['OnlyNumError']!=''){echo $_SESSION['OnlyNumError'].'<br>';}	
	if ($GLOBALS['AddEmailSettingsError']!=''){echo $GLOBALS['AddEmailSettingsError'].'<br>';}	
	if ($GLOBALS['UpdateEmailSettingsError']!=''){echo $GLOBALS['UpdateEmailSettingsError'].'<br>';}	
	if ($GLOBALS['makeActiveError']!=''){echo $GLOBALS['makeActiveError'].'<br>';}

	include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/admin-panel.php';

	if($_GET['userslist']==1)
	{
		include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/userslist.php';
	} 
	elseif($_GET['maillist']==1)
	{
		$CurrentPage = $_GET['page'];
		$MessagesPerPage = 10;	
		$PagesCount = round( $MailsQuantity / $MessagesPerPage );
		if ( is_null($CurrentPage) or $CurrentPage <= 0 ) {
			$CurrentPage = 1;
		}
		if ( $CurrentPage > $PagesCount ) {
			$CurrentPage = $PagesCount;
		}			
		$StartMessage = $CurrentPage * $MessagesPerPage - $MessagesPerPage;
		ShowPagination($PagesCount, '?maillist=1&page=' );
		// pagination top
		include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/maillist.php';	
		// pagination bottom
		ShowPagination($PagesCount, '?maillist=1&page=' );
	}
	elseif($_GET['user']=='add' or $_POST['edit']!='')
	{		
		include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/useradd.php';
	}
	elseif($_GET['mailsettings']==1 or isset($_GET['new-smtp-settings']))
	{
		include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/smtp-settings.php';
	}
	elseif($_GET['web-srv-errors']==1)
	{
		include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/web-server-errors.php';
	}
 ?>


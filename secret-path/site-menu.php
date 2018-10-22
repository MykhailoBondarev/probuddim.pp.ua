<?php 
	include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/admin-panel.php';
		
	if($_GET['userslist']==1)
	{
		include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/userslist.php';
	} 
	elseif($_GET['maillist']==1)
	{
		include $_SERVER['DOCUMENT_ROOT'].'/secret-path/view/maillist.php';	
	}

 ?>


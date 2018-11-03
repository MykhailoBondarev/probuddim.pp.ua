<div style="border-top: 1px solid black; border-bottom: 1px solid black;">
	<div style="float: right;">
		<span><?php echo 'Вітаємо в адмін панелі '.$_SESSION['name'].'!'?></span>
		<span><br><?php echo 'Ваша поточна ір-адреса: '.$_SESSION['ip'] ?></span>
		<?php //echo $_SESSION['user-id']; ?>
		<form action="" method="post"><button name="logout" value="1">Вихід</button></form>
	</div>
	<div>	
		<?php 		
				if ($_SESSION['role']<=1) { $UsersQuantity = CountObjects('users'); }
				$MailsQuantity = CountObjects('maillog');
				if($UsersQuantity <= 1)
				{
					$_GLOBALS['usersToDel'] = 'none'; 
				}
				else
				{
					$_GLOBALS['usersToDel'] = 'block';
				}
		?>
<?php if ($_SESSION['role']<=1) { ?><a href="?userslist=1">Список користувачів <span><?php echo $UsersQuantity; ?></span></a> <?php } ?>
		<a href="?maillist=1">Список листів <span><?php echo $MailsQuantity; ?></span></a>	
	</div>	
	<div style="clear: both; height: 1px;"></div>
</div>
<?php echo $_SESSION['UserAddError']; echo $_SESSION['UserEditError']; ?>
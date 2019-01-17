<div class="admin-panel-bg">
	<div class="admin-container">
		<div class="user-info">
			<div>
				<p><?php echo 'Вітаємо в адмін панелі '.$_SESSION['name'].'!'?></p>
				<p><?php echo 'Ваша поточна ір-адреса: '.$_SESSION['ip'] ?></p>	
			</div>
			<form action="" method="post">
				<button class="btn" name="logout" value="1">
					<i class="fa fa-sign-out-alt"></i>
					<m>Вихід</m>
				</button>
			</form>
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
	<?php if ($_SESSION['role']<=1) { ?>
		<div class="btn-admin-menu">
			<i class="fa fa-ellipsis-h"></i>	
		</div>
		<div class="admin-curtain"></div>
		<i class="fa fa-times close-menu"></i>
		<ul class="admin-menu menu-list">
			<li><a class="menu-item" href="?userslist=1"><m>Список користувачів</m><sup><?php echo $UsersQuantity; ?></sup></a> </li>
			<li><a class="menu-item" href="?mailsettings=1"><m>Налаштування SMTP-сервера</m></a></li>	
			<li><a class="menu-item" href="?lettersettings=1"><m>Листи</m></a></li>		
	<?php } ?>			
			<li><a class="menu-item" href="?maillist=1"><m>Список листів</m><sup><?php echo $MailsQuantity; ?></sup></a></li>
			<li><a class="menu-item" href="?web-srv-errors=1"><m>Помилки Веб-сервера</m></a></li>
		</ul>
		</div>	
	</div>
	<div class="clear-fix"></div>
</div>
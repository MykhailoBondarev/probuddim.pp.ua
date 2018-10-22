<div style="border-top: 1px solid black; border-bottom: 1px solid black;">
	<div style="float: right;">
		<span><?php echo 'Вітаємо в адмін панелі '.$_SESSION['name'].'!'?></span>
		<span><br><?php echo 'Ваша поточна ір-адреса: '.$_SESSION['ip'] ?></span>
		<?php //echo $_SESSION['user-id']; ?>
		<form action="" method="post"><button name="logout" value="1">Вихід</button></form>
	</div>
	<div>	
		<a href="?userslist=1">Список користувачів</a>
		<a href="?maillist=1">Список листів</a>	
	</div>	
	<div style="clear: both; height: 1px;"></div>
</div>

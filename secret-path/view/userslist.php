<?php 
	if($_SESSION['role']<=1) 
	{

 ?>
<div>
	<a href="?user=add">Новий користувач</a> 
	<?php 
	$users = ObjectList('users');
	$roles = ObjectList('roles');

	if ($users[0]!='') 
	{
		foreach ($users as $user) {  
			if ($roles[0]!='')
			{
				foreach ($roles as $role)
				{
					if ($user['role'] == $role['id'])
					{
						$role_name = $role['name'];			
					}
				}
			}			
			?>	
			<div class="user-box">
				<div class="pic"><img src="<?php echo $user['avatar_url']; ?>" alt="avatar"></div>
				<div class="info">
					<p class="name"><?php echo $user['name']; ?></p>
					<p class="email"><a href="mailto:'<?php echo $user['email']; ?>'"><?php echo $user['email']; ?></a></p>
					<p>Тип користувача: <?php echo $role_name; ?> </p>
					<p class="last-seen">Останній вхід: <?php echo $user['last_login']; ?></p>
					<form action="" method="post">
						<button name="edit" value="<?php echo $user['id']; ?>">Редагувати</button>											
					</form>
					<button class="delete-user-btn" style="display: '<?php echo $_GLOBALS['usersToDel']; ?>';">Видалити</button>	
					<button class="new-pass">Змінити пароль</button>
					<form class="new-pass-form" style="display: none;" action="?change-pass=1" method="post">
						<a class="showmepass" href="javascript:void(0);" "eye">eye</a>
						<input class="new-password" type="password" name="password" placeholder="Введіть новий пароль">
						<button type="submit" name="resetPswd" value="<?php echo $user['id']; ?>">OK</button>
						<button type="reset">Відмінити</button>
					</form>
				</div>
				<div class="deleteuser-bg" style="display: none;">
					<form action="" method="post" class="deleteuser-window">
						<label>Ви дійсно хочете видалити користувача <?php echo $user['name']; ?> ?</label>						
						<button name="delete-user" value="<?php echo $user['id']; ?>">Видалити</button>
						<button class="cancel-btn">Скасувати</button>
					</form>
				</div>
			</div>
<?php 	}
	} 
	else
	{ ?>
		<p>Не знайдено жодного користувача. <a href="?user=add">Додати?</a> </p>
<?php } ?>	
</div>
<?php }
else
{
	echo '<h1>Доступ заборонено! Звернітся до адміна.</h1>';
}
 ?>


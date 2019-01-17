<?php 
	if($_SESSION['role']<=1) 
	{

 ?>
<div class="admin-container">
	<div class="btn-box">
		<a class="btn" href="?user=add" title="Додати нового користувача">
			<i class="fa fa-user-plus"></i>
			<m>Додати користувача</m>		
		</a> 	
	</div>
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
					<p class="name"><?php echo $user['name'].' ('.$user['login'].')';?></p>
					<p class="email"><a href="mailto:'<?php echo $user['email']; ?>'"><?php echo $user['email']; ?></a></p>
					<p>Тип користувача: <?php echo $role_name; ?> </p>
					<p class="last-seen">Останній вхід: <?php echo $user['last_login']; ?></p>
					<form action="?user=add" method="post">
						<button class="btn" name="edit" value="<?php echo $user['id']; ?>">
							<i class="fa fa-user-edit"></i>
							<m>Редагувати</m>
						</button>											
					</form>
					<button class="btn delete-user-btn" style="display: '<?php echo $_GLOBALS['usersToDel']; ?>';">
						<i class="fa fa-user-times"></i>
						<m>Видалити</m>
					</button>	
					<button class="btn new-pass">
						<i class="fa fa-key"></i>
						<m>Змінити пароль</m>
					</button>
					<form class="new-pass-form" style="display: none;" action="?change-pass=1" method="post">
						<div class="fa password-box">
							<input class="secret admin-input" type="password" name="password" placeholder="Введіть новий пароль">
						</div>
						<button class="btn" type="submit" name="resetPswd" value="<?php echo $user['id']; ?>">OK</button>
						<button class="btn" type="reset">Відмінити</button>
					</form>
				</div>
				<div class="deleteuser-bg" style="display: none;">
					<form action="" method="post" class="deleteuser-window">
						<label>Ви дійсно хочете видалити користувача <?php echo $user['name']; ?> ?</label>						
						<button class="btn" name="delete-user" value="<?php echo $user['id']; ?>">Видалити</button>
						<button class="btn cancel-btn">Скасувати</button>
					</form>
				</div>
			</div>
<?php 	}
	} 
	else
	{ ?>
		<p>Не знайдено жодного користувача. <a class="btn" href="?user=add"><i class="fa fa-user-plus"></i><m>Додати?<m></a> </p>
<?php } ?>	
</div>
<?php }
else
{
	echo '<h1>Доступ заборонено! Звернітся до адміна.</h1>';
}
 ?>


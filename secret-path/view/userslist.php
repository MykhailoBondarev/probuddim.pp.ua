<div>
	<pre>
		<?php var_dump($_COOKIE['PHPSESSID']); ?>
	</pre>
	<?php 
	foreach (ObjectList('users') as $user) {  ?>	
		<div class="user-box">
			<div class="pic"><img src="<?php echo $user['avatar_url']; ?>" alt="avatar"></div>
			<div class="info">
				<p class="name"><?php echo $user['name']; ?></p>
				<p class="email"><a href="mailto:'<?php echo $user['email']; ?>'"><?php echo $user['email']; ?></a></p>
				<p class="last-seen">Останній вхід: <?php echo $user['last_login']; ?></p>
				<form action="" method="post"><button name="edit" value="<?php echo $user['id']; ?>">Редагувати</button><button name="delete" value="<?php echo $user['id']; ?>">Видалити</button></form>
			</div>
		</div>
<?php 	} ?>	
</div>


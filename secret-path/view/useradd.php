<?php  
if ($_SESSION['role']<=1)
{
  if ($_GET['user']=='add'&&$_POST['edit']=='')
  {
  	$button_caption='Додати';
  	$methodType='add';
  	$isShow = 'inline';
    $PasswordField = '
      <div class="fa password-box">
        <input class="secret admin-input" type="password" name="password" placeholder="Введіть пароль" required>
      </div>
    ';
  }
  elseif($_POST['edit']!='')
  {
  	$edituser=$_POST['edit'];
  	$button_caption='Змінити';
  	$methodType='edit';
    $PasswordField = '';
  	$CurrentUser = SelectObject('users', $_POST['edit']);
  	$isShow = 'none';  	
  }  
  $UserTypes = ObjectList('roles');
 ?>
 <div class="admin-container">
   <div class="btn-box">
      <a class="btn" href="?userslist=1">
        <i class="fa fa-backspace"></i>
        <m>Назад</m>
      </a>
   </div>
   <div class="avatar"><img src="<?php echo $avatar_url; ?>" alt="avatar"></div>
   <form action="?user=add" method="post" enctype="multipart/form-data">
     <div class="btn-box"> 
        <div class="inline-box">
            <label class="btn" for="file-upload">
              <i class="fa fa-image"></i> 
              <m>Оберіть картинку</m>
            </label>  
          <input id="file-upload" type="file" name="avatar">
          <button class="btn" name="edit" value="<?php echo $edituser; ?>">
            <i class="fa fa-upload"></i>
            <m>Завантажити аватар</m>
          </button>
        </div>
      </div>
   </form>
   <form action="?userslist=1" method="post">
   	<input type="hidden" name="userId" value="<?php echo $CurrentUser['id']; ?>"> 	
   	<input type="hidden" name="avatar_url" value="<?php echo $avatar_url; ?>">
   	<input class="admin-input" type="text" name="login" placeholder="Введіть логін" required value="<?php echo $CurrentUser['login']; ?>">
   	<input class="admin-input" type="text" placeholder="Введіть повне ім'я" name="name" required value="<?php echo $CurrentUser['name']; ?>">
   	<input class="admin-input" type="email" placeholder="Введіть email"  name="email" required value="<?php echo $CurrentUser['email']; ?>">
   	<select class="admin-input" name="role">
   		<option value="0" required >Оберіть тип користувача</option>
   		<?php if ($UserTypes[0]!='') 
   		{
   			foreach($UserTypes as $CurrentType)
   			{
   				if ($CurrentType['id']==$CurrentUser['role'])
   				{ 	
   					$isSelected='selected';
   				}		
   				else
   				{
   					$isSelected='';
   				}		
   		?>
   					<option value="<?php echo $CurrentType['id'];?>" <?php echo $isSelected; ?>><?php echo $CurrentType['name']; ?></option>
   		<?php  				
   			}
   		}
   		 ?>
   	</select>
      <?php  echo $PasswordField; ?>
      <div class="btn-box">
          <button class="btn" type="submit" name="methodType" value="<?php echo $methodType; ?>">
            <i class="fa fa-thumbs-up"></i>
            <m><?php echo $button_caption; ?></m>            
            </button>
          <button class="btn" type="reset"> 
           <i class="fa fa-broom"></i>        
          <m>Очистити</m>
         </button> 
      </div>
   </form>
</div>
<?php }
else
{
	echo '<h1>Доступ заборонено! Звернітся до адміна.</h1>';
}
 ?>


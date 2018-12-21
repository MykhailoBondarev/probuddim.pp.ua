<?php 
	$newSMTPserver = '';
	if (isset($_GET['new-smtp-settings'])) {	
		$mode=0;	
		$newSMTPserver = '<option value="-1" selected>Новий SMTP сервер</option>';
	} else {
		$mode=1;
	}
	if ($_GET['mailsettings']==1) {
		$mailSet =  ObjectList('email_settings');		
	}

 ?>
<style type="text/css" media="screen">
	input, select, .password-box,
	textarea
	{
		width: 30%;
		margin: 8px auto;
		display: block;
	}
	.smtp-set {
		display: none;
	}

	.use-smtp:checked ~ .smtp-set
	{
		display: block;
	}

	.secret
	{
		width: 100%;
	}
	button
	{
		text-align: center;
	}
	.password-box
	{		
		position: relative;
	}
	.password-box .secret
	{
		text-indent: 30px;
	}	
	.password-box::before
	{
		content: 'eye';
		display: block;
		cursor: pointer;
		position: absolute;
		top: 0;
		left: 2px;
		width: 30px;
		height: 23px;		
	}
	.button-box
	{
		text-align: center;
	}
	.servers-list
	{
		text-align: center;
	}
	.servers-list select
	{
		display: inline;	
		width: 25%;	
	}
</style>

<a href="?new-smtp-settings" title="">Додати налаштування сервера</a>
<form class="servers-list" action="?smtp-default=1" method="post">
	<select name="isDefault" title="<?php echo $description; ?>">
		<option value="0">Немає</option>
		<?php echo $newSMTPserver;
			if ($mailSet[0]!='')
			{
				foreach ($mailSet as $set)
				{
					if ($set['active']==1)
					{
						echo '<option value="'.$set['id'].'" title="'.$set['decription'].'" selected >'.$set['template_name'].'</option>';	
						$GLOBALS['template_id'] = $set['id'];
						$GLOBALS['template_name'] = $set['template_name'];	
						$GLOBALS['description'] = $set['description'];
						$GLOBALS['host'] = $set['host'];
						$GLOBALS['server_login'] = $set['server_login'];
						$GLOBALS['server_password'] = $set['server_password'];	
						$GLOBALS['use_smtp'] = $set['use_smtp'];		
						$GLOBALS['smtpMode'] = $set['smtp_mode'];
						$GLOBALS['useSmtpAuth'] = $set['use_smtp_auth'];
						$GLOBALS['encryption'] = $set['encryption'];
						$GLOBALS['isHtml'] = $set['isHtml'];	
						$GLOBALS['port'] = $set['port'];
						$GLOBALS['sender_email'] = $set['sender_email'];
						$GLOBALS['sender_name'] = $set['sender_displayname'];										
					} else {
						echo '<option value="'.$set['id'].'" title="'.$set['decription'].'">'.$set['template_name'].'</option>';
					}					
				}
			}
			$checked;
			if ( $GLOBALS['use_smtp']==1 ) {
				$checked = 'checked';
			}
		?>		
	</select>
	<button type="submit">Застосувати</button>
</form>
<form action="?smtp-save=<?php echo $mode; ?>" method="post">
	<input type="hidden" name="template-id" value="<?php echo $GLOBALS['template_id']; ?>">
	<label for="template_name">Назва сервера	
	<input type="text" name="template-name" placeholder="Назва сервера" value="<?php echo $GLOBALS['template_name']; ?>">
	</label>
	<textarea name="server-description" placeholder="Опис сервера"><?php echo $GLOBALS['description']; ?></textarea>
	<label for="useSmtp">Використовувати зовнішній SMTP-сервер</label>	
	<input type="checkbox" class="use-smtp" name="use_smtp" <?php echo $checked; ?>>
	<select class="smtp-set" name="smtpMode">
		<?php 			
			if ( $GLOBALS['smtpMode'] == 0 ) {
					$selected0 = 'selected';					
				} elseif ( $GLOBALS['smtpMode'] == 1 ) {
					$selected1 = 'selected';					
				} elseif ( $GLOBALS['smtpMode'] == 2 ) {
					$selected2 = 'selected';					
				} 
		?>
		<option value="0"  <?php echo $selected0; ?>>Робоча відправка</option>
		<option value="1"<?php echo $selected1; ?>>Тестова відправка (client)</option>
		<option value="2" <?php echo $selected2; ?>>Тестова відправка (client-server)</option>
	</select>	
	<input class="smtp-set" type="text" name="hostname" placeholder="сервер1; сервер2; сервер3" value="<?php echo $GLOBALS['host']; ?>">
	<select class="smtp-set" name="smtpAuth" title="Використовувати SMTP авторизацію?">
		<?php if ( $GLOBALS['useSmtpAuth'] == 0 ) {
					$selected0 = 'selected';
				} elseif ( $GLOBALS['useSmtpAuth'] == 1 ) {
					$selected1 = 'selected';
				}
		?>
		<option value="0"  <?php echo $selected0; ?>>Ні</option>
		<option value="1"  <?php echo $selected1; ?>>Так</option>	
	</select>
	<input class="smtp-set" type="text" name="userLogin" placeholder="Логін облікового запису" value="<?php echo $GLOBALS['server_login']; ?>">
	<div class="password-box smtp-set">
		<input type="password" name="userPassword" class="secret" placeholder="Пароль облікового запису" value="<?php echo $GLOBALS['server_password']; ?>">
	</div>	
	<select class="smtp-set" name="smtpEncryption" title="Оберіть тип шифрування">
		<?php if ( $GLOBALS['encryption'] == 0 ) {
					$selected0 = 'selected';
				} elseif ( $GLOBALS['encryption'] == 1 ) {
					$selected1 = 'selected';
				} elseif ( $GLOBALS['encryption'] == 2 ) {
					$selected2 = 'selected';
				}
		?>		
		<option value="0" <?php echo $selected0; ?>>Немає</option>		
		<option value="1" <?php echo $selected1; ?>>TLS</option>
		<option value="2" <?php echo $selected2; ?>>SSL</option>
	</select>
	<input class="smtp-set" type="text" name="serverPort" placeholder="Порт" value="<?php echo $GLOBALS['port']; ?>">
	<input type="text" name="senderEmail" placeholder="Адреса відправника" value="<?php echo $GLOBALS['sender_email']; ?>">
	<input type="text" name="senderName" placeholder="Ім'я відправника" value="<?php echo $GLOBALS['sender_name']; ?>">
	<!-- <input type="text" name="" placeholder="Адреса отримувача"> -->
	<select name="textStyle" title="Формат відправки листів">
		<?php if ( $GLOBALS['isHtml'] == 0 ) {
					$selected0 = 'selected';
				} elseif ( $GLOBALS['isHtml'] == 1 ) {
					$selected1 = 'selected';
				}
		?>		
		<option value="0" <?php echo $selected0; ?>>Простий текст</option>
		<option value="1" <?php echo $selected1; ?>>HTML</option>	
	</select>	
	<div class="button-box">
		<button>Зберегти</button>
		<button type="reset">Очистити</button>
	</div>
</form>
<form action="" method="post" class="test-send">
	<h4>Тестова відправка</h4>
	<input type="text" name="test-email" placeholder="Введіть поштову адресу">
	<button>Відправити</button>
</form>

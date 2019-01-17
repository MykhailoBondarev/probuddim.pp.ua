<?php 
	$newSMTPserver = '';
	if (isset($_GET['new-smtp-settings'])) {	
		$mode=0;	
		$newSMTPserver = '<option value="-1" selected>Новий SMTP сервер</option>';		
		$GLOBALS['use_phpmailer']=0; 
		$GLOBALS['template_name']='';
		$GLOBALS['description']=''; 
		$GLOBALS['use_smtp']=0; 
		$GLOBALS['host']='';
		$GLOBALS['server_login']='';
		$GLOBALS['server_password']='';
		$GLOBALS['smtpMode']=0; 	
		$GLOBALS['useSmtpAuth']=0;
		$GLOBALS['encryption']='';
		$GLOBALS['isHtml']=0;
		$GLOBALS['port']=0;
		$GLOBALS['sender_email']='';
		$GLOBALS['sender_name']='';
		$GLOBALS['template_id']='';
	} else {
		$mode=1;
	}
	if ($_GET['mailsettings']==1 && $mode==1) {
		$mailSet =  ObjectList('email_settings');		
	}	
 ?>
<div class="admin-container">
	<a class="btn" href="?new-smtp-settings" title="">
		<i class="fa fa-plus-square"></i>
		<m>Додати налаштування сервера</m>
    </a>
	<form class="servers-list" action="?smtp-default=1" method="post">
		<select class="admin-input" name="isDefault" title="<?php echo $description; ?>">	
			<?php echo $newSMTPserver;
				if (!is_null($mailSet[0]))
				{
					foreach ($mailSet as $set)
					{
						if ($set['active']==1)
						{
							echo '<option value="'.$set['id'].'" title="'.$set['decription'].'" selected >'.$set['template_name'].'</option>';	
							$GLOBALS['use_phpmailer'] = $set['direct'];
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
							$GLOBALS['isHtml'] = $set['ishtml'];						
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
					$smtp_checked = 'checked';
				}
				if ( $GLOBALS['use_phpmailer']==1 ) {
					$php_mailer_checked = 'checked';
				}
			?>		
		</select>
		<button class="btn" type="submit">			
			<m>Застосувати</m>
			<i class="fa fa-chevron-circle-down"></i>		
	    </button>
	</form>
	<form class="smtp-details" action="?smtp-save=<?php echo $mode; ?>" method="post">			
		<label class="check-box" for="usephpmailer">			
			<span>Використовувати PHPMAILER</span>
			<input id="usephpmailer" type="checkbox" name="use-phpmailer" <?php echo $php_mailer_checked; ?>>	
			<i class="check-container">
				<i class="fa fa-exclamation checked"></i>
			</i>				
		</label>	
		<input class="admin-input" type="hidden" name="template-id" value="<?php echo $GLOBALS['template_id']; ?>">
		<label for="template_name">
			<span>Назва сервера</span>
			<input class="admin-input" type="text" name="template-name" placeholder="Назва сервера" value="<?php echo $GLOBALS['template_name']; ?>">
		</label>
		<textarea class="admin-input" name="server-description" placeholder="Опис сервера"><?php echo $GLOBALS['description']; ?></textarea>
		<input id="usesmtp" type="checkbox" name="use_smtp" <?php echo $smtp_checked; ?>>	
		<label class="check-box" for="usesmtp">
			<span>Використовувати зовнішній SMTP-сервер</span>			
			<i class="check-container">
				<i class="fa fa-exclamation checked"></i>
			</i>			
		</label>	
		<select class="admin-input" name="smtpMode">
			<?php 			
				if ( $GLOBALS['smtpMode'] == 0 ) {
						$smtpModeselected0 = 'selected';					
					} elseif ( $GLOBALS['smtpMode'] == 1 ) {
						$smtpModeselected1 = 'selected';					
					} elseif ( $GLOBALS['smtpMode'] == 2 ) {
						$smtpModeselected2 = 'selected';					
					} 
			?>
			<option value="0"  <?php echo $smtpModeselected0; ?>>Робоча відправка</option>
			<option value="1"<?php echo $smtpModeselected1; ?>>Тестова відправка (client)</option>
			<option value="2" <?php echo $smtpModeselected2; ?>>Тестова відправка (client-server)</option>
		</select>	
		<input class="smtp-set admin-input" type="text" name="hostname" placeholder="сервер1; сервер2; сервер3" value="<?php echo $GLOBALS['host']; ?>">
		<select class="smtp-set admin-input" name="smtpAuth" title="Використовувати SMTP авторизацію?">
			<?php if ( $GLOBALS['useSmtpAuth'] == 0 ) {
						$smtpAuthselected0 = 'selected';
					} elseif ( $GLOBALS['useSmtpAuth'] == 1 ) {
						$smtpAuthselected1 = 'selected';
					}
			?>
			<option value="0"  <?php echo $smtpAuthselected0; ?>>Ні</option>
			<option value="1"  <?php echo $smtpAuthselected1; ?>>Так</option>	
		</select>
		<input class="smtp-set admin-input" type="text" name="userLogin" placeholder="Логін облікового запису" value="<?php echo $GLOBALS['server_login']; ?>">
		<div class="fa password-box smtp-set">			
			<input class="admin-input secret" type="password" name="userPassword" class="secret" placeholder="Пароль облікового запису" value="<?php echo $GLOBALS['server_password']; ?>">
		</div>	
		<select class="smtp-set admin-input" name="smtpEncryption" title="Оберіть тип шифрування">
			<?php if ( $GLOBALS['encryption'] == 0 ) {
						$smtpEncryptionselected0 = 'selected';
					} elseif ( $GLOBALS['encryption'] == 1 ) {
						$smtpEncryptionselected1 = 'selected';
					} elseif ( $GLOBALS['encryption'] == 2 ) {
						$smtpEncryptionselected2 = 'selected';
					}
			?>		
			<option value="0" <?php echo $smtpEncryptionselected0; ?>>Немає</option>		
			<option value="1" <?php echo $smtpEncryptionselected1; ?>>TLS</option>
			<option value="2" <?php echo $smtpEncryptionselected2; ?>>SSL</option>
		</select>
		<input class="smtp-set admin-input" type="text" name="serverPort" placeholder="Порт" value="<?php echo $GLOBALS['port']; ?>">
		<input class="admin-input" type="text" name="senderEmail" placeholder="Адреса відправника" value="<?php echo $GLOBALS['sender_email']; ?>">
		<input class="admin-input" type="text" name="senderName" placeholder="Ім'я відправника" value="<?php echo $GLOBALS['sender_name']; ?>">
		<!-- <input type="text" name="" placeholder="Адреса отримувача"> -->
		<select class="admin-input" name="textStyle" title="Формат відправки листів">
			<?php if ( $GLOBALS['isHtml'] == 0 ) {
						$textStyleselected0 = 'selected';
					} elseif ( $GLOBALS['isHtml'] == 1 ) {
						$textStyleselected1 = 'selected';
					}			
			?>		
			<option value="0" <?php echo $textStyleselected0; ?>>Простий текст</option>
			<option value="1" <?php echo $textStyleselected1; ?>>HTML</option>	
		</select>	
		<div class="button-box">
			<button class="btn">Зберегти</button>
			<button class="btn" type="reset">Очистити</button>
		</div>
	</form>
	<form action="" method="post" class="test-send">
		<h4>Тестова відправка</h4>
		<input class="admin-input" type="text" name="test-email" placeholder="Введіть поштову адресу">
		<button class="btn">Відправити</button>
	</form>
</div>
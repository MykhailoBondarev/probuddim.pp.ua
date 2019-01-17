<?php 


 ?>
<div class="admin-container">
	 <form action="letter-settings_submit" method="post" accept-charset="utf-8">
		<label for="">
		<span>Ім'я отримувача:</span>
		<input class="admin-input" placeholder="" type="text" name="receiver_name" value="<?php echo $GLOBALS['receiver_name']; ?>" >
		</label>
		<label for="">
		<span>Пошта отримувача:</span>
		<input class="admin-input" placeholder="" type="text" name="receiver_email" value="<?php echo $GLOBALS['receiver_email']; ?>" >
		</label>
		<label for="">
		<span>Тема листа</span>
		<input class="admin-input" placeholder="" type="text" name="letter_theme"  value="<?php echo $GLOBALS['letter_theme'] ?>" >
		</label>
		<div class="btn-box">
			<button class="btn" >Застосувати</button>
			<button class="btn" >Зберегти</button>
			<button class="btn" >Скасувати</button>
		</div>
	 </form>
 </div>
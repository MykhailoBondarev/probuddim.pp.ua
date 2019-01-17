<div class="admin-container">
<a class="btn" href="?clear-logs=1">
	<i class="fa fa-trash"></i>
	<m>Очистка файлу помилок</m>
</a>

<?php 

echo '<h1>Список помилок Веб-сервера</h1>';	

if (file_exists($error_file)) {	

	if (filesize($error_file)>0) {	
		$file_content = file($error_file);		
		foreach ($file_content as $file_string) {
			echo '<p>'.$file_string.'</p>';
		}
	}
	else {
		echo '<p>Файл помилок порожній.</p>';
	}
} 
else {
	echo '<h3>Файлу не існує або він був переміщеним. Перевірте налаштування вашого Веб-сервера.</h3>';
}
 ?>
</div>

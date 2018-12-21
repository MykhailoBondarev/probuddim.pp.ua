<a href="?clear-logs=1">Очистка файлу помилок</a>

<?php 
$GLOBALS['error_file'] = $_SERVER['DOCUMENT_ROOT'].'/Server_Errors/probuddim.pp.ua_error.log';
if (file_exists($error_file))
{
	echo '<h1>Список помилок Веб-сервера</h1>';	
	if (filesize($error_file)>0)
	{	
		$file_content = file($error_file);		
		foreach ($file_content as $file_string)
		{
			echo '<p>'.$file_string.'</p>';
		}
	}
	else
	{
		echo '<p>Файл помилок порожній.</p>';
	}
} 
else 
{
	echo '<h1>Файлу не існує або він був переміщеним. Перевірте налаштування вашого Веб-сервера.</h1>';
}
 ?>


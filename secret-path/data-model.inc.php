<?php 
try
{
	$GLOBALS['pdo'] = new PDO('mysql:host=localhost;dbname=probuddim', 'probuddim',
 'lI43EDw6L9Rs0LJK');
	$GLOBALS['pdo']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$GLOBALS['pdo']->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
	$error = 'Неможливо під\'єднатися до сервера баз даних'.$e -> getMessage();
	include 'error.php';
	exit();
}
?>


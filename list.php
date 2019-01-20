<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
require_once(__DIR__ .DIRECTORY_SEPARATOR. 'core' . DIRECTORY_SEPARATOR.'function.php'); 
if (isset($_GET['del'],$_SESSION['user'])) {
	chdir('uploads');
	unlink($_GET['del']);
	header('Location: list.php');
}
chdir('uploads');
$type = glob('*.json');

 ?>
 <!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Список тестов</title>
 	<style>
		ul {list-style: none;}
 	</style>
 </head>
 <body>
 	<p>Выберите доступный тест:</p>
 	<?php  if (empty($type)) {
	echo 'Нет доступных тестов';	
}
?>
 	<ul>
 	<?php $i=1; foreach ($type as $value) : ?>
 	<li><?='<a href="test.php?test='.$value.'">Тест №'.$i.'</a>'?>
 		<p>
 			<?php  if (isset($_SESSION['user'])) { 
				echo '<a href="list.php?del='.$value.'">Удалить Тест №'.$i.'</a>';
}?>
		</p>
 	</li>

 	<?php $i++; endforeach; ?>
	</ul>

	<?php if (isset($_SESSION['user'])) {  ?>
	<p><a href="admin.php">На страницу загрузки теста</a></p>
	<?php } ?>
	<a href="index.php?logout=true">Выйти</a>
 </body>
 </html>

<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
if (isset($_GET['del'],$_SESSION['user'])) {
	unlink($_GET['del']);
	header('Location: list.php');
}
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
 </body>
 </html>
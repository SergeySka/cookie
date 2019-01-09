<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
if (!isset($_SESSION['user'])) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
	echo "Доступ запрещен";
	exit;
	}
if (!empty($_FILES["upload"]["type"])) {
	if ($_FILES["upload"]["type"] !== 'application/json') {
	echo 'Ошибка! Выберите тест в формате json';
	}
	else {
	move_uploaded_file($_FILES["upload"]["tmp_name"], $_FILES["upload"]["name"]);
	header('Location: list.php');
	}
};
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Загрузка теста</title>
</head>
<body>
	<form action="" method="POST" enctype="multipart/form-data">
		<p><label for="upload"> Выберите тест для загрузки</label></p>
		<p><input type="file" name="upload"></p>
		<p><input type="submit"></p>
	</form>	
	<p><a href="list.php">К списку тестов</a></p>
</body>
</html>
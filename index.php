<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
if (isset($_GET['logout'])) {
	session_destroy();
	header("location:index.php");
}


if (file_exists(__DIR__ .DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR.'login.json')) {
$data = file_get_contents(__DIR__ .DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR.'login.json');
$users = json_decode($data, true);
}

if (isset($_POST['name'], $_POST['password'])) {
	$username = $_POST['name'];
	$password = $_POST['password'];
	if (isset($users[$username]) && $users[$username] === $password) {
		$_SESSION['user'] = $username;
	}
}
if (isset($_POST['name']) && empty($_POST['password'])) {
	$username = $_POST['name'];
	$_SESSION['guest'] = $username;
}

 ?>

 <!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Страница входа</title>
 </head>
 <body>
 	 <?php if (isset($_SESSION['user'])) {  ?>	
<p>Привет, <?php echo $_SESSION['user']; ?>.</p>
<p>Вы вошли как авторизованный пользователь</p>
<a href="index.php?logout=true">Выйти</a>
<?php } ?>
 	 <?php if (isset($_SESSION['guest'])) {  ?>	
<p>Привет, <?php echo $_SESSION['guest']; ?>.</p>
<p>Вы вошли как гость</p>
<a href="index.php?logout=true">Выйти</a>
<?php } ?>
 	<?php if (!isset($_SESSION['user'])  && !isset($_SESSION['guest'])) {  ?>	
 	<h2>Авторизуйтесь или войдите как гость, введя только имя.</h2>
 	<form action="" method="POST">
 		<p>Введите имя <input type="text" name="name" required>
 		</p>
 		<p>Введите пароль <input type="password" name="password"></p>
 		<input type="submit">
 	</form>
 	<?php } ?>
 	<?php  if (isset($_SESSION['user']) || isset($_SESSION['guest'])) { ?>
 	<p><a href="list.php">К списку тестов</a></p>
 	<?php } ?>
 </body>
 </html>
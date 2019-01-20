<?php 
if (!isset($_SESSION['user']) && !isset($_SESSION['guest'])) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
	exit('<h1>Доступ запрещен</h1><p>Перейти к <a href="index.php">форме авторизации</a></p>');
	}
 ?>

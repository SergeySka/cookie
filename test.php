<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
if (isset($_GET["test"]) && file_exists(__DIR__ .DIRECTORY_SEPARATOR.$_GET["test"])) {
$data = file_get_contents(__DIR__ .DIRECTORY_SEPARATOR.$_GET["test"]);
$test = json_decode($data, true);
}
else {
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
	echo "Not Found";
	exit;
};
 ?>
 <!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Ответьте на вопросы</title>
 	<style>
		input {margin: 5px;}
 	</style>
 </head>
 <body>
 	<p>Прочитайте вопрос и выберите вариант ответа</p>
 	<?='<form action="./check.php?test='.$_GET["test"].'" method="POST">' ?>
 		<?php $i=1; foreach ($test["questions"] as $key => $question) : ?>
		<fieldset>	
 		<legend><?=$key ?></legend>
 			<?php foreach ($question as $variant) : ?>	
 		<label><?='<input type="radio" name="q'.$i.'" value="'.$variant.'" required>'.$variant?></label>
 			<?php endforeach; ?>
 		</fieldset>		
 	<?php $i++; endforeach; ?>
 	<input type="submit">
 	</form>
 	<p><a href="list.php">К списку тестов</a></p>
 </body>
 </html>


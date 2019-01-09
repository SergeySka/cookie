<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();

if (isset($_GET["test"]) && file_exists(__DIR__ .DIRECTORY_SEPARATOR.$_GET["test"])) {
$data = file_get_contents(__DIR__ .DIRECTORY_SEPARATOR.$_GET["test"]);
$test = json_decode($data, true);
}
if(!empty($_POST)) {
	$correct = 0;
	$i = 0;	
	foreach ($_POST as $key => $value) {
		if (isset($value,$test["answers"][$i]) && $value === $test["answers"][$i]) {
			$correct++;
		}
		$i++;
	}
	unset($key,$value);
}
if (isset($_SESSION['user'])) {
	$name = $_SESSION['user'];
}
if (isset($_SESSION['guest'])) {
	$name = $_SESSION['guest'];
}
$count = count($test["answers"]);
$score = 'Правильных ответов: '.$correct.' из '.$count;
$win = 'Вы молодец!';
$image = imagecreatetruecolor(500, 400);
$backColor = imagecolorallocate($image, random_int(1, 255), random_int(1, 255), random_int(1, 255));
$textColor = imagecolorallocate($image, random_int(1, 255), random_int(1, 255), random_int(1, 255));
$boxFile = __DIR__.DIRECTORY_SEPARATOR.'image.png';
if (!file_exists($boxFile)) {
	echo 'Файл с картинкой не найден';
	exit;
}
$imBox = imagecreatefrompng($boxFile);
imagefill($image, 0, 0, $backColor);
imagecopy($image, $imBox, 25, 42, 0, 0, 450, 316);
$fontFile = __DIR__. DIRECTORY_SEPARATOR . '13159.otf';
if (!file_exists($fontFile)) {
	echo 'Файл со шрифтом не найден';
	exit;
}
imagettftext($image, 20, 0, 200, 200, $textColor, $fontFile, $name);
imagettftext($image, 20, 0, 120, 240, $textColor, $fontFile, $score);
if ($count === $correct) {
	imagettftext($image, 20, 0, 180, 280, $textColor, $fontFile, $win);
};
header('Content-Type: image/png');
imagepng($image);

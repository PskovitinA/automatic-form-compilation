<?php

require 'templateFuncs.php';

require 'vendor/autoload.php';

ini_set ('session.use_trans_sid','1');

session_start();
$_SESSION += $_POST;

//Вызваем функцию сборки тела договора
$body = templateBody($_SESSION);
$bodyArr = array($body);

//Вызываем функцию сборки приложений
$supArr = array();
for ($i = 0; $i < $_SESSION['gloCount']; $i++) {
    $supArr[$i] = templateSupplement($_SESSION, ($i+1));
};

$docMerge = array_merge($bodyArr,$supArr);

//Имя итогового файла
$agreementNum = $_SESSION['agreementNum'];

$fileName = "Dogovor" . "$agreementNum" . ".docx";

//Мерджим файлы
use DocxMerge\DocxMerge;

$dm = new DocxMerge();
$dm->merge( $docMerge, "$fileName" );

file_force_download($fileName);

array_map('unlink', glob("*.tmp"));

array_map('unlink', glob("*.docx"));

session_destroy();
?>
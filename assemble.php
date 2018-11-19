<?php

session_start();

require 'templateFuncs.php';

require 'vendor/autoload.php';

$sid = session_id();

switch (file_exists("tmp/$sid/")) {
    case(true):
    break;

    case(false):
    mkdir("tmp/$sid", 0777, true);
    break;
};

$_SESSION += $_POST;
$_SESSION["SID"] = $sid;
var_dump($_SESSION["SID"]);

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
$dm->merge( $docMerge, "tmp/$sid/$fileName");

file_force_download("tmp/$sid/$fileName");

array_map('unlink', glob("tmp/$sid/*.tmp"));
array_map('unlink', glob("tmp/$sid/Supplement*.docx"));
array_map('unlink', glob("tmp/$sid/Body*.docx"));
session_unset();
session_destroy();
?>
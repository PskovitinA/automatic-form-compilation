<?php
/**
 * Created by PhpStorm.
 * User: alasdair
 * Date: 09.09.18
 * Time: 21:30
 */

include_once 'vendor/autoload.php';

function file_force_download($file) {
    if (file_exists($file)) {
        // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
        // если этого не сделать файл будет читаться в память полностью!
        if (ob_get_level()) {
            ob_end_clean();
        }
        // заставляем браузер показать окно сохранения файла
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        // читаем файл и отправляем его пользователю
        readfile($file);
        unlink($file);
        exit;
    }
}

$months = array( 1 => 'января' , 'февраля' , 'марта' , 'апреля' , 'мая' , 'июня' , 'июля' , 'августа' , 'сентября' , 'октября' , 'ноября' , 'декабря' );

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('templates/templateRahmet.docx');

$agreementNum = $_POST['agreementNum'];
$orgName = $_POST['orgName'];

$fileName = "Dogovor" . "$agreementNum" . ".docx";

$templateProcessor->setValue('agreementNum', "$agreementNum");
$templateProcessor->setValue('agreementDate', date('d ' . $months[date('n')] . ' Y'));
$templateProcessor->setValue('city', 'Алматы');
$templateProcessor->setValue('orgType', 'Товарищество с ограниченной ответственностью');
$templateProcessor->setValue('orgName', "$orgName");

$templateProcessor->saveAs("$fileName");

file_force_download($fileName);
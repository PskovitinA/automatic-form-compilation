<?php
/**
 * Created by PhpStorm.
 * User: alasdair
 * Date: 09.09.18
 * Time: 21:30
 */

include_once 'vendor/autoload.php';

$months = array( 1 => 'января' , 'февраля' , 'марта' , 'апреля' , 'мая' , 'июня' , 'июля' , 'августа' , 'сентября' , 'октября' , 'ноября' , 'декабря' );

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('templates/templateRahmet.docx');

$agreementNum = $_POST['agreementNum'];
$orgName = $_POST['orgName'];

echo $agreementNum;
echo $orgName;


$templateProcessor->setValue('agreementNum', "$agreementNum");
$templateProcessor->setValue('agreementDate', date('d ' . $months[date('n')] . ' Y'));
$templateProcessor->setValue('city', 'Алматы');
$templateProcessor->setValue('orgType', 'Товарищество с ограниченной ответственностью');
$templateProcessor->setValue('orgName', "$orgName");

$templateProcessor->saveAs('MyWordFile.docx');
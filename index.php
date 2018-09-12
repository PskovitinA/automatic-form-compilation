<?php
/**
 * Created by PhpStorm.
 * User: alasdair
 * Date: 09.09.18
 * Time: 21:30
 */

include_once 'vendor/autoload.php';

//Функция для отправки файла пользователю. Уперто с Хабра.
function file_force_download($file) {
    if (file_exists($file)) {
        // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
        // если этого не сделать файл будет читаться в память полностью!
        if (ob_get_level()) {
            ob_end_clean();
        }
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
        //Подчищаем за собой.
        unlink($file);
        exit;
    }
}

$months = array( 1 => 'января' , 'февраля' , 'марта' , 'апреля' , 'мая' , 'июня' , 'июля' , 'августа' , 'сентября' , 'октября' , 'ноября' , 'декабря' );

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('templates/templateRahmet.docx');

$agreementNum = $_POST['agreementNum'];
$orgName = $_POST['orgName'];
$city = $_POST['city'];
$agreementDate = $_POST['date'];

//Массив для разных типов организаций
$orgTypes = array(
    'too' => array('ТОО','Товарищество с ограниченной ответственностью','ое','БИН'),
    'ip' => array('ИП','Индивидуальный предприниматель','ый','ИИН')
);
$orgNum = $_POST['orgNum'];
$adressJur = $_POST['adressJur'];
$adressPost = $adressJur;
$adressFact = $adressJur;

//Проверка фактического адреса на совпадение с юридическим
if ($_POST['adressFact'] != $adressJur)
    $adressFact = $_POST['adressFact'];

//Банковские реквизиты. Держать актуальными.
$bankInfo = array(
    'ALT' => array('ATYNKZKA','Altyn Bank'),
    'ACB' => array('LARIKZKA','AsiaCredit Bank'),
    'RBK' => array('KINCKZKA','Bank RBK'),
    'CBK' => array('TBKBKZKA','Capital Bank Kazakhstan'),
    'DEL' => array('NFBAKZ23','Delta Bank'),
    'FOR' => array('IRTYKZKA','ForteBank'),
    'KAS' => array('CASPKZKA','Kaspi Bank'),
    'QAZ' => array('SENIKZKA','Qazaq Banki'),
    'TEN' => array('TNGRKZKX','Tengri Bank'),
    'ATF' => array('ALMNKZKA','АТФБанк'),
    'BKN' => array('KSNVKZKA','Банк Kassa Nova'),
    'AST' => array('ASFBKZKA','Банк Астаны'),
    'BCK' => array('KCJBKZKX','Банк ЦентрКредит'),
    'BEC' => array('ABNAKZKX','Банк ЭкспоКредит'),
    'ALF' => array('ALFAKZKA','ДБ "Альфа-Банк"'),
    'CIN' => array('BKCHKZKA','ДБ "Банк Китая в Казахстане"'),
    'KZI' => array('KZIBKZKA','ДБ «КЗИ Банк»'),
    'PAK' => array('NBPAKZKA','ДБ «Национальный Банк Пакистана»'),
    'HOM' => array('INLMKZKA','ДБ АО "Банк Хоум Кредит"'),
    'SBR' => array('SABRKZKA','ДБ АО «Сбербанк России»'),
    'VTB' => array('VTBAKZKZ','ДО АО Банк ВТБ (Казахстан)'),
    'EVR' => array('EURIKZKA','Евразийский Банк'),
    'ZHI' => array('HCSKKZKA','Жилстройсбербанк Казахстана'),
    'ZAM' => array('ZAJSKZ22','Заман-Банк'),
    'HIL' => array('HLALKZKZ','Исламский Банк "Al-Hilal"'),
    'INV' => array('KAZSKZKA','Казинвестбанк'),
    'KKB' => array('KZKOKZKX','Казкоммерцбанк'),
    'HSB' => array('HSBKKZKX','Народный сберегательный банк Казахстана'),
    'NUR' => array('NURSKZKX','Нурбанк'),
    'CIT' => array('CITIKZKA','Ситибанк Казахстан'),
    'BCA' => array('ICBKKZKX','ТП Банк Китая в Алматы'),
    'CES' => array('TSESKZKA','Цеснабанк'),
    'SBK' => array('SHBKKZKA','Шинхан Банк Казахстан'),
    'EXI' => array('EXKAKZKA','Эксимбанк Казахстан'),
);

$orgLeaderFullName = $_POST['orgLeaderName'];

//Добываем инициалы из имени
$m = explode(' ', $orgLeaderFullName);
$orgLeaderShortName = $m[0] . ' ' . substr($m[1],0,2) . '.' . substr($m[2],0,2) . '.' ;
if ($m[2] == null)
    $orgLeaderShortName = $m[0] . ' ' . substr($m[1],0,2) . '.';

$supplementNum = $_POST['supplementNum'];
$supplementDate = $agreementDate;

$commission = $_POST['commission'];
$cashback = $_POST['cashback'];

//Выбираем данные по нашей стороне

$attorneyArray = array(
    'SAD' => array('Начальника управления продаж Махсутова Садыра Уркашовича, действующего на основании Доверенности № 5 от 16.04.2018 г.','Начальник управления продаж','Махсутов Садыр Уркашович','Махсутов С.А.'),
    'AZA' => array('Начальника управления продаж Ешманова Азамата Улановича, действующего на основании Доверенности № 4 от 16.04.2018 г.','Начальник управления продаж','Ешманов Азамат Уланович','Ешманова А. У.'),
    'ZHA' => array('Начальника отдела активных продаж Жолдас Жалгаса Жарасулы, действующего на основании Доверенности № 8 от 05.06.2018 г.','Начальник отдела активных продаж','Жолдас Жалгас Жарасулы','Жолдас Ж. Ж.'),
);

$fileName = "Dogovor" . "$agreementNum" . ".docx";

$templateProcessor->setValue('agreementNum', "$agreementNum");
$templateProcessor->setValue('agreementDate', date('d ' . $months[date('n')] . ' Y'));
$templateProcessor->setValue('city', 'Алматы');
$templateProcessor->setValue('orgType', 'Товарищество с ограниченной ответственностью');
$templateProcessor->setValue('orgName', "$orgName");

$templateProcessor->saveAs("$fileName");

file_force_download($fileName);
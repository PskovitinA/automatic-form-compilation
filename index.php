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

if ($_POST['orgType'] == 'too') {
    $orgType = $orgTypes['too'][1];
    $orgTypeShort = $orgTypes['too']['0'];
    $orgNumType = $orgTypes['too'][3];
    $orgTypeEnding = $orgTypes['too'][2];
} else {
    $orgType = $orgTypes['ip'][1];
    $orgTypeShort = $orgTypes['ip']['0'];
    $orgNumType = $orgTypes['ip'][3];
    $orgTypeEnding = $orgTypes['ip'][2];
}


$orgNum = $_POST['orgNum'];
$adressJur = $_POST['adressJur'];
$adressPost = $adressJur;
$adressFact = $adressJur;

//Проверка фактического адреса на совпадение с юридическим
if ($_POST['adressFact'] != $adressJur)
    $adressFact = $_POST['adressFact'];

//Банковские реквизиты. Держать актуальными.
$bankInfo = array(
    'ALT' => array('ATYNKZKA','АО "Altyn Bank" (ДБ АО "Народный Банк Казахстана")'),
    'ACB' => array('LARIKZKA','АО "AsiaCredit Bank (АзияКредит Банк)"'),
    'RBK' => array('KINCKZKA','Акционерное общество "Банк "Bank RBK"'),
    'CBK' => array('TBKBKZKA','АО "Capital Bank Kazakhstan"'),
    'DEL' => array('NFBAKZ23','АО "Delta Bank"'),
    'FOR' => array('IRTYKZKA','АО "ForteBank"'),
    'KAS' => array('CASPKZKA','АО "KASPI BANK"'),
    'QAZ' => array('SENIKZKA','АО "Qazaq Banki"'),
    'TEN' => array('TNGRKZKX','АО "Tengri Bank"'),
    'ATF' => array('ALMNKZKA','АО "АТФБанк"'),
    'BKN' => array('KSNVKZKA','АО "Банк Kassa Nova"'),
    'AST' => array('ASFBKZKA','АО "Банк "Астаны"'),
    'BCK' => array('KCJBKZKX','АО "Банк ЦентрКредит"'),
    'BEC' => array('ABNAKZKX','Акционерное общество "First Heartland Bank"'),
    'ALF' => array('ALFAKZKA','АО "ДОЧЕРНИЙ БАНК "АЛЬФА-БАНК"'),
    'CIN' => array('BKCHKZKA','АО ДБ "БАНК КИТАЯ В КАЗАХСТАНЕ"'),
    'KZI' => array('KZIBKZKA','АО "ДБ "КАЗАХСТАН-ЗИРААТ ИНТЕРНЕШНЛ БАНК"'),
    'PAK' => array('NBPAKZKA','АО ДБ "Национальный Банк Пакистана" в Казахстане'),
    'HOM' => array('INLMKZKA','ДБ АО "Банк Хоум Кредит"'),
    'SBR' => array('SABRKZKA','ДБ АО "Сбербанк"'),
    'VTB' => array('VTBAKZKZ','ДО АО Банк ВТБ (Казахстан)'),
    'EVR' => array('EURIKZKA','АО "Евразийский Банк"'),
    'ZHI' => array('HCSKKZKA','АО "Жилстройсбербанк Казахстана"'),
    'ZAM' => array('ZAJSKZ22','АО "Исламский банк "Заман-Банк"'),
    'HIL' => array('HLALKZKZ','АО "Исламский Банк "Al Hilal"'),
    'INV' => array('KAZSKZKA','АО "Казинвестбанк"'),
    'KKB' => array('KZKOKZKX','АО "КАЗКОММЕРЦБАНК"'),
    'HSB' => array('HSBKKZKX','АО "Народный Банк Казахстана"'),
    'NUR' => array('NURSKZKX','АО "Нурбанк"'),
    'CIT' => array('CITIKZKA','АО "Ситибанк Казахстан"'),
    'BCA' => array('ICBKKZKX','АО "Торгово-промышленный Банк Китая в г. Алматы"'),
    'CES' => array('TSESKZKA','АО "Цеснабанк"'),
    'SBK' => array('SHBKKZKA','АО "Шинхан Банк Казахстан"'),
    'EXI' => array('EXKAKZKA','АО "ЭКСИМБАНК КАЗАХСТАН"'),
    'CED' => array('CEDUKZKA','АО "ЦЕНТРАЛЬНЫЙ ДЕПОЗИТАРИЙ ЦЕННЫХ БУМАГ"'),
    'DVK' => array('DVKAKZKA','АО "Банк Развития Казахстана"'),
    'EAB' => array('EABRKZKA','ЕВРАЗИЙСКИЙ БАНК РАЗВИТИЯ'),
    'GCV' => array('GCVPKZ2A','НАО "Государственная корпорация "Правительство для граждан"'),
    'INE' => array('INEARUMM','г.Москва Межгосударственный Банк'),
    'KIC' => array('KICEKZKX','АО "Казахстанская фондовая биржа"'),
    'KIS' => array('KISCKZKX','РГП "Казахстанский центр межбанковских расчетов НБРК"'),
    'KKM' => array('KKMFKZ2A','РГУ "Комитет казначейства Министерства финансов РК"'),
    'KPS' => array('KPSTKZKA','АО "КАЗПОЧТА"'),
    'NBP' => array('NBPFKZKX','"Банк-кастодиан АО  "ЕНПФ"'),
    'NBR' => array('NBRKKZKX','Республиканское Государств Учреждение  Национальный Банк РК'),
    'NCC' => array('NCCBRUMM','НКО-ЦК "Национальный Клиринговый Центр" (АО)'),

);

$orgLeaderFullName = $_POST['orgLeaderName'];

//Добываем инициалы из имени
$m = explode(' ', $orgLeaderFullName);
$orgLeaderShortName = $m[0] . ' ' . substr($m[1],0,2) . '.' . substr($m[2],0,2) . '.' ;
if ($m[2] == null)
    $orgLeaderShortName = $m[0] . ' ' . substr($m[1],0,2) . '.';

$orgLeaderReason = $_POST['orgLeaderReason'];


//доп к договору. Нужно добавить возможность делать дополнительные допы.
$supplementNum = $_POST['supplementNum'];
$supplementDate = $agreementDate;

$commission = $_POST['commission'];
$cashback = $_POST['cashback'];

$responsiblePartnerName = $_POST['responsiblePartnerName'];
$responsiblePartnerEmail = $_POST['responsiblePartnerEmail'];
$responsiblePartnerPhone = $_POST['responsiblePartnerPhone'];

//Выбираем данные по нашей стороне

$attorneyArray = array(
    'SAD' => array('Начальника управления продаж Махсутова Садыра Уркашовича, действующего на основании Доверенности № 5 от 16.04.2018 г.','Начальник управления продаж','Махсутов Садыр Уркашович','Махсутов С.А.'),
    'AZA' => array('Начальника управления продаж Ешманова Азамата Улановича, действующего на основании Доверенности № 4 от 16.04.2018 г.','Начальник управления продаж','Ешманов Азамат Уланович','Ешманова А. У.'),
    'ZHA' => array('Начальника отдела активных продаж Жолдас Жалгаса Жарасулы, действующего на основании Доверенности № 8 от 05.06.2018 г.','Начальник отдела активных продаж','Жолдас Жалгас Жарасулы','Жолдас Ж. Ж.'),
);

$responsibleRahmetName = $_POST['responsibleRahmetName'];
$responsibleRahmetEmail = $_POST['responsibleRahmetEmail'];
$responsibleRahmetPhone = $_POST['responsibleRahmetPhone'];

$fileName = "Dogovor" . "$agreementNum" . ".docx";

$templateProcessor->setValue('agreementNum', "$agreementNum");
$templateProcessor->setValue('agreementDate', date('d ' . $months[date('n')] . ' Y'));
$templateProcessor->setValue('city', 'Алматы');
$templateProcessor->setValue('orgType', 'Товарищество с ограниченной ответственностью');
$templateProcessor->setValue('orgName', "$orgName");

$templateProcessor->saveAs("$fileName");

echo $agreementNum;
echo $agreementDate;
echo $city;
echo $orgType;
echo $orgType;
echo $orgTypeShort;
echo $orgNumType;
echo $orgTypeEnding;


//file_force_download($fileName);
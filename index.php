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
$agreementDate = date('d ' . $months[date('n')] . ' Y', strtotime($agreementDate));

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
$orgPhone = $_POST['orgPhone'];

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

//Выбираем переменные из массива
switch ($_POST['bankSelect']) {
    case 'ALT':
        $bankName = $bankInfo['ALT'][1];
        $bankID = $bankInfo['ALT'][0];
        break;
    case 'ACB':
        $bankName = $bankInfo['ACB'][1];
        $bankID = $bankInfo['ACB'][0];
        break;
    case 'RBK':
        $bankName = $bankInfo['RBK'][1];
        $bankID = $bankInfo['RBK'][0];
        break;
    case 'CBK':
        $bankName = $bankInfo['CBK'][1];
        $bankID = $bankInfo['CBK'][0];
        break;
    case 'DEL':
        $bankName = $bankInfo['DEL'][1];
        $bankID = $bankInfo['DEL'][0];
        break;
    case 'FOR':
        $bankName = $bankInfo['FOR'][1];
        $bankID = $bankInfo['FOR'][0];
        break;
    case 'KAS':
        $bankName = $bankInfo['KAS'][1];
        $bankID = $bankInfo['KAS'][0];
        break;
    case 'QAZ':
        $bankName = $bankInfo['QAZ'][1];
        $bankID = $bankInfo['QAZ'][0];
        break;
    case 'TEN':
        $bankName = $bankInfo['TEN'][1];
        $bankID = $bankInfo['TEN'][0];
        break;
    case 'ATF':
        $bankName = $bankInfo['ATF'][1];
        $bankID = $bankInfo['ATF'][0];
        break; 
    case 'BKN':
        $bankName = $bankInfo['BKN'][1];
        $bankID = $bankInfo['BKN'][0];
        break;
    case 'AST':
        $bankName = $bankInfo['AST'][1];
        $bankID = $bankInfo['AST'][0];
        break;
    case 'BCK':
        $bankName = $bankInfo['BCK'][1];
        $bankID = $bankInfo['BCK'][0];
        break;
    case 'BEC':
        $bankName = $bankInfo['BEC'][1];
        $bankID = $bankInfo['BEC'][0];
        break;
    case 'ALF':
        $bankName = $bankInfo['ALF'][1];
        $bankID = $bankInfo['ALF'][0];
        break;
    case 'CIN':
        $bankName = $bankInfo['CIN'][1];
        $bankID = $bankInfo['CIN'][0];
        break;
    case 'KZI':
        $bankName = $bankInfo['KZI'][1];
        $bankID = $bankInfo['KZI'][0];
        break;
    case 'PAK':
        $bankName = $bankInfo['PAK'][1];
        $bankID = $bankInfo['PAK'][0];
        break;
    case 'HOM':
        $bankName = $bankInfo['HOM'][1];
        $bankID = $bankInfo['HOM'][0];
        break;
    case 'SBR':
        $bankName = $bankInfo['SBR'][1];
        $bankID = $bankInfo['SBR'][0];
        break;
    case 'VTB':
        $bankName = $bankInfo['VTB'][1];
        $bankID = $bankInfo['VTB'][0];
        break;
    case 'EVR':
        $bankName = $bankInfo['EVR'][1];
        $bankID = $bankInfo['EVR'][0];
        break;
    case 'ZHI':
        $bankName = $bankInfo['ZHI'][1];
        $bankID = $bankInfo['ZHI'][0];
        break;
    case 'ZAM':
        $bankName = $bankInfo['ZAM'][1];
        $bankID = $bankInfo['ZAM'][0];
        break;
    case 'HIL':
        $bankName = $bankInfo['HIL'][1];
        $bankID = $bankInfo['HIL'][0];
        break;
    case 'INV':
        $bankName = $bankInfo['INV'][1];
        $bankID = $bankInfo['INV'][0];
        break;
    case 'KKB':
        $bankName = $bankInfo['KKB'][1];
        $bankID = $bankInfo['KKB'][0];
        break;
    case 'HSB':
        $bankName = $bankInfo['HSB'][1];
        $bankID = $bankInfo['HSB'][0];
        break;
    case 'NUR':
        $bankName = $bankInfo['NUR'][1];
        $bankID = $bankInfo['NUR'][0];
        break; 
    case 'CIT':
        $bankName = $bankInfo['CIT'][1];
        $bankID = $bankInfo['CIT'][0];
        break;
    case 'BCA':
        $bankName = $bankInfo['BCA'][1];
        $bankID = $bankInfo['BCA'][0];
        break;
    case 'CES':
        $bankName = $bankInfo['CES'][1];
        $bankID = $bankInfo['CES'][0];
        break;
    case 'SBK':
        $bankName = $bankInfo['SBK'][1];
        $bankID = $bankInfo['SBK'][0];
        break;
    case 'EXI':
        $bankName = $bankInfo['EXI'][1];
        $bankID = $bankInfo['EXI'][0];
        break;
    case 'CED':
        $bankName = $bankInfo['CED'][1];
        $bankID = $bankInfo['CED'][0];
        break;
    case 'DVK':
        $bankName = $bankInfo['DVK'][1];
        $bankID = $bankInfo['DVK'][0];
        break;
    case 'EAB':
        $bankName = $bankInfo['EAB'][1];
        $bankID = $bankInfo['EAB'][0];
        break;
    case 'GCV':
        $bankName = $bankInfo['GCV'][1];
        $bankID = $bankInfo['GCV'][0];
        break;
    case 'INE':
        $bankName = $bankInfo['INE'][1];
        $bankID = $bankInfo['INE'][0];
        break;
    case 'KIC':
        $bankName = $bankInfo['KIC'][1];
        $bankID = $bankInfo['KIC'][0];
        break;
    case 'KIS':
        $bankName = $bankInfo['KIS'][1];
        $bankID = $bankInfo['KIS'][0];
        break;
    case 'KKM':
        $bankName = $bankInfo['KKM'][1];
        $bankID = $bankInfo['KKM'][0];
        break;
    case 'KPS':
        $bankName = $bankInfo['KPS'][1];
        $bankID = $bankInfo['KPS'][0];
        break;
    case 'NBP':
        $bankName = $bankInfo['NBP'][1];
        $bankID = $bankInfo['NBP'][0];
        break;
    case 'NBR':
        $bankName = $bankInfo['NBR'][1];
        $bankID = $bankInfo['NBR'][0];
        break;
    case 'NCC':
        $bankName = $bankInfo['NCC'][1];
        $bankID = $bankInfo['NCC'][0];
        break;
    };

$bankAccount = $_POST['bankAccount'];

$orgLeaderFullName = $_POST['orgLeaderName'];
$orgLeaderShortName =$_POST['orgLeaderShortName'];
//Добываем инициалы из имени
/*$m = explode(' ', $orgLeaderFullName);
$orgLeaderShortName = $m[0] . ' ' . substr($m[1],0,2) . '.' . substr($m[2],0,2) . '.' ;
if ($m[2] == null)
    $orgLeaderShortName = $m[0] . ' ' . substr($m[1],0,2) . '.';
*/
$orgLeaderReason = $_POST['orgLeaderReason'];


//доп к договору. Нужно добавить возможность делать дополнительные допы.
$supplementNum = $_POST['supplementNum'];
$supplementDate = $_POST['supplementDate'];
$supplementDate = date('d ' . $months[date('n')] . ' Y', strtotime($supplementDate));

$commission = $_POST['commission'];
$cashback = $_POST['cashback'];

$placeAdress = $_POST['placeAdress'];
$workingHours = $_POST['workingHours'];
$placePhone = $_POST['placePhone'];

$responsiblePartnerName = $_POST['responsiblePartnerName'];
$responsiblePartnerEmail = $_POST['responsiblePartnerEmail'];
$responsiblePartnerPhone = $_POST['responsiblePartnerPhone'];

//Выбираем данные по нашей стороне

$attorneyArray = array(
    'SAD' => array('Начальника управления продаж Махсутова Садыра Уркашовича, действующего на основании Доверенности № 5 от 16.04.2018 г.','Начальник управления продаж','Махсутов Садыр Уркашович','Махсутов С.А.'),
    'AZA' => array('Начальника управления продаж Ешманова Азамата Улановича, действующего на основании Доверенности № 4 от 16.04.2018 г.','Начальник управления продаж','Ешманов Азамат Уланович','Ешманов А. У.'),
    'ZHA' => array('Начальника отдела активных продаж Жолдас Жалгаса Жарасулы, действующего на основании Доверенности № 8 от 05.06.2018 г.','Начальник отдела активных продаж','Жолдас Жалгас Жарасулы','Жолдас Ж. Ж.'),
);

switch ($_POST['attorney']) {
    case 'SAD':
        $attorney = $attorneyArray['SAD'][0];
        $attorneyPosition = $attorneyArray['SAD']['1'];
        $attorneyShortName = $attorneyArray['SAD'][3];
        break;
    case 'AZA':
        $attorney = $attorneyArray['AZA'][0];
        $attorneyPosition = $attorneyArray['AZA']['1'];
        $attorneyShortName = $attorneyArray['AZA'][3];
        break;
    case 'ZHA':
        $attorney = $attorneyArray['ZHA'][0];
        $attorneyPosition = $attorneyArray['ZHA']['1'];
        $attorneyShortName = $attorneyArray['ZHA'][3];
        break;
}

$responsibleRahmetName = $_POST['responsibleRahmetName'];
$responsibleRahmetEmail = $_POST['responsibleRahmetEmail'];
$responsibleRahmetPhone = $_POST['responsibleRahmetPhone'];

$fileName = "Dogovor" . "$agreementNum" . ".docx";

$templateProcessor->setValue('agreementNum', "$agreementNum");
$templateProcessor->setValue('agreementDate', "$agreementDate");
$templateProcessor->setValue('city', "$city");
$templateProcessor->setValue('orgType', "$orgType");
$templateProcessor->setValue('orgName', "$orgName");
$templateProcessor->setValue('orgTypeEnding', "$orgTypeEnding");
$templateProcessor->setValue('orgLeaderFullName', "$orgLeaderFullName");
$templateProcessor->setValue('orgLeaderShortName', "$orgLeaderShortName");
$templateProcessor->setValue('orgLeaderReason', "$orgLeaderReason");
$templateProcessor->setValue('attorney', "$attorney");
$templateProcessor->setValue('attorneyPosition', "$attorneyPosition");
$templateProcessor->setValue('attorneyShortName', "$attorneyShortName");
$templateProcessor->setValue('orgTypeShort', "$orgTypeShort");
$templateProcessor->setValue('orgNumType', "$orgNumType");
$templateProcessor->setValue('orgNum', "$orgNum");
$templateProcessor->setValue('adressJur', "$adressJur");
$templateProcessor->setValue('adressFact', "$adressFact");
$templateProcessor->setValue('adressPost', "$adressPost");
$templateProcessor->setValue('orgPhone', "$orgPhone");
$templateProcessor->setValue('supplementNum', "$supplementNum");
$templateProcessor->setValue('supplementDate', "$supplementDate");
$templateProcessor->setValue('commission', "$commission");
$templateProcessor->setValue('cashback', "$cashback");
$templateProcessor->setValue('placeAdress', "$placeAdress");
$templateProcessor->setValue('workingHours', "$workingHours");
$templateProcessor->setValue('placePhone', "$placePhone");
$templateProcessor->setValue('responsiblePartnerName', "$responsiblePartnerName");
$templateProcessor->setValue('responsiblePartnerEmail', "$responsiblePartnerEmail");
$templateProcessor->setValue('responsiblePartnerPhone', "$responsiblePartnerPhone");
$templateProcessor->setValue('responsibleRahmetName', "$responsibleRahmetName");
$templateProcessor->setValue('responsibleRahmetEmail', "$responsibleRahmetEmail");
$templateProcessor->setValue('responsibleRahmetPhone', "$responsibleRahmetPhone");
$templateProcessor->setValue('bankName', "$bankName");
$templateProcessor->setValue('bankName', "$bankName");
$templateProcessor->setValue('bankAccount', "$bankAccount");
$templateProcessor->setValue('bankId', "$bankID");

$templateProcessor->saveAs("$fileName");

file_force_download($fileName);
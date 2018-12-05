<?php

require 'vendor/autoload.php';

//Месяцы в родительном падеже
function months(){
$months = array( 1 => 'января' , 'февраля' , 'марта' , 'апреля' , 'мая' , 'июня' , 'июля' , 'августа' , 'сентября' , 'октября' , 'ноября' , 'декабря' );
return $months;
};

//Это для отладки. Потом удалить.
// function console_log( $data ) {
//     $output  = "<script>console.log( 'PHP debugger: ";
//     $output .= json_encode(print_r($data, true));
//     $output .= "' );</script>";
//     echo $output;
//   }

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
        //unlink($file);
        return;
    }
};

function bankSelect($bankAbbr){
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
    switch ($bankAbbr) {
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
    return array($bankName, $bankID);
};

//Выбор типов организаций
function orgType($org_1){
    $orgTypes = array(
        'too' => array('ТОО','Товарищество с ограниченной ответственностью','ое','БИН'),
        'ip' => array('ИП','Индивидуальный предприниматель','ый','ИИН')
    );
    if ($org_1 == 'too') {
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
    return array($orgType, $orgTypeShort, $orgNumType, $orgTypeEnding);
};

function attorneySelect($attArg){
    $attorneyArray = array(
        'SAD' => array('Начальника управления продаж Махсутова Садыра Уркашовича, действующего на основании Доверенности № 5 от 16.04.2018 г.','Начальник управления продаж','Махсутов Садыр Уркашович','Махсутов С.У.'),
        'AZA' => array('Начальника управления продаж Ешманова Азамата Улановича, действующего на основании Доверенности № 4 от 16.04.2018 г.','Начальник управления продаж','Ешманов Азамат Уланович','Ешманов А. У.'),
        'ZHA' => array('Начальника отдела активных продаж Жолдас Жалгаса Жарасулы, действующего на основании Доверенности № 8 от 05.06.2018 г.','Начальник отдела активных продаж','Жолдас Жалгас Жарасулы','Жолдас Ж. Ж.'),
        'DAU' => array('Начальника отдела активных продаж Тазабекова Даурена Жумагалиевича, действующего на основании Доверенности № 17/1 от 01.09.2018 г.','Начальник отдела активных продаж','Тазабеков Даурен Жумагалиевич','Тазабеков Д. Ж.'),
        'BAU' => array('Начальника отдела активных продаж Джанабаева Бауржана Адильжановича, действующего на основании Доверенности № 17/2 от 01.09.2018 г.','Начальник отдела активных продаж','Джанабаев Бауржан Адильжанович','Джанабаев Б. А.'),
        'AZT' => array('Главного менеджера отдела активных продаж Смагулова Азата Кайратовича, действующего на основании Доверенности № 14 от 08.08.2018 г.','Главный менеджер отдела активных продаж','Смагулов Азат Кайратович','Смагулов А. К.'),
        'ZHN' => array('Директора представительства ТОО «Интернет лояльность» в городе Астана Ибраевой Жанар Раулановны, действующей на основании Доверенности № 15 от 15.08.2018 г.','Директор представительства ТОО «Интернет лояльность» в городе Астана','Ибраева Жанар Раулановна','Ибраева Ж. Р.'),
        'OKE' => array('Начальника отдела продаж Өміржан Қажымұрата Еркінұлы, действующего на основании Доверенности № 17 от 16.08.2018 г.','Начальник отдела продаж','Өміржан Қажымұрат Еркінұлы','Өміржан Қ. Е.'),
    );
    switch ($attArg) {
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
        case 'DAU':
            $attorney = $attorneyArray['DAU'][0];
            $attorneyPosition = $attorneyArray['DAU']['1'];
            $attorneyShortName = $attorneyArray['DAU'][3];
            break;
        case 'BAU':
            $attorney = $attorneyArray['BAU'][0];
            $attorneyPosition = $attorneyArray['BAU']['1'];
            $attorneyShortName = $attorneyArray['BAU'][3];
            break;
        case 'AZT':
            $attorney = $attorneyArray['AZT'][0];
            $attorneyPosition = $attorneyArray['AZT']['1'];
            $attorneyShortName = $attorneyArray['AZT'][3];
            break;
        case 'ZHN':
            $attorney = $attorneyArray['ZHN'][0];
            $attorneyPosition = $attorneyArray['ZHN']['1'];
            $attorneyShortName = $attorneyArray['ZHN'][3];
            break;
        case 'OKE':
            $attorney = $attorneyArray['OKE'][0];
            $attorneyPosition = $attorneyArray['OKE']['1'];
            $attorneyShortName = $attorneyArray['OKE'][3];
            break;
    }
    return array($attorney, $attorneyPosition, $attorneyShortName);
};

//пилим основной договор
function templateBody($arg_1)
{
    if($arg_1['city']=='Алматы'){
      $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('templates/templateBody.docx');
    }
    else {
      $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('templates/templateBodyAst.docx');
    };

    $months = months();

    $agreementNum = $arg_1['agreementNum'];
    $orgName = $arg_1['orgName'];

    $city = $arg_1['city'];

    $agreementDate = $arg_1['date'];
    $agreementDate = date('d ' . $months[date('n')] . ' Y', strtotime($agreementDate));

    //Выбираем тип организации
    $orgForm = orgType($arg_1['orgType']);
    $orgType = $orgForm[0];
    $orgTypeShort = $orgForm[1];
    $orgNumType = $orgForm[2];
    $orgTypeEnding = $orgForm[3];

    $orgNum = $arg_1['orgNum'];
    $adressJur = $arg_1['adressJur'];
    $orgPhone = $arg_1['orgPhone'];

    //Если фактический адрес не указан, ставим юридический
    if ($arg_1['adressFact'] == '') {
        $adressFact = $adressJur;
    }
    else {
        $adressFact = $arg_1['adressFact'];
    };

    //Если почтовый адрес не указан, ставим юридический
    if ($arg_1['adressPost'] == '') {
        $adressPost = $adressJur;
    }
    else {
        $adressPost = $arg_1['adressPost'];
    };

    //Выбираем банк
    $bankSelect = bankSelect($arg_1['bankSelect']);
    $bankName = $bankSelect[0];
    $bankID = $bankSelect[1];

    $bankAccount = $arg_1['bankAccount'];

    $orgLeaderFullName = $arg_1['orgLeaderName'];
    $orgLeaderShortName =$arg_1['orgLeaderShortName'];
    //Добываем инициалы из имени
    /*$m = explode(' ', $orgLeaderFullName);
    $orgLeaderShortName = $m[0] . ' ' . substr($m[1],0,2) . '.' . substr($m[2],0,2) . '.' ;
    if ($m[2] == null)
        $orgLeaderShortName = $m[0] . ' ' . substr($m[1],0,2) . '.';
    */
    $orgLeaderReason = $arg_1['orgLeaderReason'];

    //Выбираем повереного
    $attorneySelect = attorneySelect($arg_1['attorney']);
    $attorney = $attorneySelect[0];
    $attorneyPosition = $attorneySelect[1];
    $attorneyShortName = $attorneySelect[2];

    $sid = $arg_1['SID'];
    $fileName = "Body" . "$agreementNum" . ".docx";
    $filePath = "tmp/$sid/$fileName";

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
    $templateProcessor->setValue('bankName', "$bankName");
    $templateProcessor->setValue('bankAccount', "$bankAccount");
    $templateProcessor->setValue('bankId', "$bankID");

    $templateProcessor->saveAs("$filePath");
    return ("$filePath");
};

//пилим приложуху к договору
function templateSupplement($arg_2, $counter)
{
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('templates/templateSupplement.docx');

    $months = months();

    $city = $arg_2["city$counter"];

    $supplementNum = $arg_2["supplementNum$counter"];
    $supplementDate = $arg_2["supplementDate$counter"];
    $supplementDate = date('d ' . $months[date('n')] . ' Y', strtotime($supplementDate));

    $commission = $arg_2["commission$counter"];
    $cashback = $arg_2["cashback$counter"];

    $placeAdress = $arg_2["placeAdress$counter"];
    $workingHours = $arg_2["workingHours$counter"];
    $placePhone = $arg_2["placePhone$counter"];

    $responsiblePartnerName = $arg_2["responsiblePartnerName$counter"];
    $responsiblePartnerEmail = $arg_2["responsiblePartnerEmail$counter"];
    $responsiblePartnerPhone = $arg_2["responsiblePartnerPhone$counter"];

    $responsibleRahmetName = $arg_2["responsibleRahmetName$counter"];
    $responsibleRahmetEmail = $arg_2["responsibleRahmetEmail$counter"];
    $responsibleRahmetPhone = $arg_2["responsibleRahmetPhone$counter"];

    $paymentTimeArray = array (
        'ежемесячно не позднее 5-ти рабочих дней с даты окончания Отчётного периода.',
        'еженедельно в течение 5 рабочих дней следующих за окончанием расчетного периода.'
    );

    //Выбираем периодичность оплаты и добавляем подпись фин.консультанта
    if ($arg_2["paymentTime$counter"] == 'weekly'){
        // $finConsul = "Финансовый консультант:";
        // $finSignature = "______________/ Бакиев. А. А.";
        $paymentTime = $paymentTimeArray[1];
        }
    else {
        // $finConsul = '';
        // $finSignature = '';
        $paymentTime = $paymentTimeArray[0];
        };

    $orgName = $arg_2['orgName'];

    //Выбираем банк
    $bankSelect = bankSelect($arg_2['bankSelect']);
    $bankName = $bankSelect[0];
    $bankID = $bankSelect[1];

    $bankAccount = $arg_2['bankAccount'];

    //Выбираем тип организации
    $orgForm = orgType($arg_2['orgType']);
    $orgType = $orgForm[0];
    $orgTypeShort = $orgForm[1];
    $orgNumType = $orgForm[2];
    $orgTypeEnding = $orgForm[3];

    $orgNum = $arg_2['orgNum'];
    $adressJur = $arg_2['adressJur'];
    $orgPhone = $arg_2['orgPhone'];

    //Если фактический адрес не указан, ставим юридический
    if ($arg_2['adressFact'] == '') {
        $adressFact = $adressJur;
    }
    else {
        $adressFact = $arg_2['adressFact'];
    };

    //Если почтовый адрес не указан, ставим юридический
    if ($arg_2['adressPost'] == '') {
        $adressPost = $adressJur;
    }
    else {
        $adressPost = $arg_2['adressPost'];
    };

    $orgLeaderShortName = $arg_2['orgLeaderShortName'];

    $agreementNum = $arg_2['agreementNum'];

    $agreementDate = $arg_2['date'];
    $agreementDate = date('d ' . $months[date('n')] . ' Y', strtotime($agreementDate));

    //Выбираем повереного
    $attorneySelect = attorneySelect($arg_2['attorney']);
    $attorney = $attorneySelect[0];
    $attorneyPosition = $attorneySelect[1];
    $attorneyShortName = $attorneySelect[2];

    //создаем индивидуальную папку для сессии
    $sid = $arg_2['SID'];
    $fileName = "Supplement" . "$counter" . ".docx";
    $filePath = "tmp/$sid/$fileName";

    $templateProcessor->setValue('agreementNum', "$agreementNum");
    $templateProcessor->setValue('agreementDate', "$agreementDate");
    $templateProcessor->setValue('supplementNum', "$supplementNum");
    $templateProcessor->setValue('supplementDate', "$supplementDate");
    $templateProcessor->setValue('commission', "$commission");
    $templateProcessor->setValue('cashback', "$cashback");
    $templateProcessor->setValue('city', "$city");
    $templateProcessor->setValue('placeAdress', "$placeAdress");
    $templateProcessor->setValue('workingHours', "$workingHours");
    $templateProcessor->setValue('placePhone', "$placePhone");
    $templateProcessor->setValue('responsiblePartnerName', "$responsiblePartnerName");
    $templateProcessor->setValue('responsiblePartnerEmail', "$responsiblePartnerEmail");
    $templateProcessor->setValue('responsiblePartnerPhone', "$responsiblePartnerPhone");
    $templateProcessor->setValue('responsibleRahmetName', "$responsibleRahmetName");
    $templateProcessor->setValue('responsibleRahmetEmail', "$responsibleRahmetEmail");
    $templateProcessor->setValue('responsibleRahmetPhone', "$responsibleRahmetPhone");
    $templateProcessor->setValue('orgTypeShort', "$orgTypeShort");
    $templateProcessor->setValue('orgNumType', "$orgNumType");
    $templateProcessor->setValue('orgNum', "$orgNum");
    $templateProcessor->setValue('orgName', "$orgName");
    $templateProcessor->setValue('orgLeaderShortName', "$orgLeaderShortName");
    $templateProcessor->setValue('adressJur', "$adressJur");
    $templateProcessor->setValue('adressFact', "$adressFact");
    $templateProcessor->setValue('adressPost', "$adressPost");
    $templateProcessor->setValue('orgPhone', "$orgPhone");
    $templateProcessor->setValue('bankName', "$bankName");
    $templateProcessor->setValue('bankAccount', "$bankAccount");
    $templateProcessor->setValue('bankId', "$bankID");
    $templateProcessor->setValue('attorneyPosition', "$attorneyPosition");
    $templateProcessor->setValue('attorneyShortName', "$attorneyShortName");
    $templateProcessor->setValue('paymentTime', "$paymentTime");
    // $templateProcessor->setValue('finConsul', "$finConsul");
    // $templateProcessor->setValue('finSignature', "$finSignature");

    $templateProcessor->saveAs("$filePath");
    return ("$filePath");
}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Форма отправки</title>
    <div class="test"></div>
    <link rel="stylesheet" href="css/app.css">
    <link rel="import" href="suptempl.html">
</head>

<body class="fixed-sidebar pace-done body-small mini-navbar">
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
            <div class="sidebar-collapse" style="overflow: hidden; width: auto; height: 100%;">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <span>
                        <img alt="image" class="img-circle" width="170" src="images/logo-rahmet-small.png">
                        </span>
                </li>

                <li class="">
                    <a href="https://admin.choco.kz/" target="_blank">
                        <i class="fa fa-home"></i>
                        <span class="nav-label">Админка Рахмета</span>
                    </a>
                </li>
            </ul>
        </div><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 508.479px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.9; z-index: 90; right: 1px;"></div></div>
    </nav>

    <div id="page-wrapper" class="gray-bg" style="min-height: 608px;">
        <div class="row border-bottom">
            <nav role="navigation" class="navbar navbar-static-top white-bg" style="margin-bottom: 0px;">
                <a href="#" class="navbar-minimalize minimalize-styl-2 btn btn-primary ">
                    <div class="navbar-header">
                        <i class="fa fa-bars"></i>
                    </div>
                </a>
                <div class="col-lg-10">
                    <h2>Форма автозаполнения договора</h2>
                </div>
            </nav>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <form action="assemble.php" method="post" id="form1" class="form-horizontal">
                                <div class="ibox-title">
                                    <h5>Общие данные</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Номер договора:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="agreementNum" class="form-control" placeholder="P19 или PZ19 или что-там еще, короче не забывайте писать номер полностью"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Город:</label>
                                        <div class="col-sm-10">
                                            <div>
                                                <input type="radio" name="city" id="Almaty" value="Алматы">
                                                <label for="Almaty">Алматы</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="city" id="Astana" value="Астана">
                                                <label for="Astana">Астана</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Дата:</label>
                                        <div class="col-sm-10">
                                            <div class="input-daterange input-group" >
                                                <input class="input-sm form-control" id="datepicker" type="date" name="date" style="width: 240px">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                </div>

                                <div class="ibox-title">
                                    <h5>Информация по нам</h5>
                                </div>

                                <div class="ibox-content">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Поверенный со стороны Рахмета:</label>
                                        <div class="col-sm-10">
                                            <div>
                                                <input type="radio" name="attorney" id="NUR" value="NUR">
                                                <label for="NUR">Темирбаева Н.С.</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="attorney" id="SAD" value="SAD">
                                                <label for="SAD">Махсутов С.У.</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="attorney" id="AZA" value="AZA">
                                                <label for="AZA">Ешманов А. У.</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="attorney" id="ZHA" value="ZHA">
                                                <label for="ZHA">Жолдас Ж. Ж.</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="attorney" id="DAU" value="DAU">
                                                <label for="DAU">Тазабеков Д. Ж.</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="attorney" id="BAU" value="BAU">
                                                <label for="BAU">Джанабаев Б. А.</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="attorney" id="AZT" value="AZT">
                                                <label for="AZT">Смагулов А. К.</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="attorney" id="ZHN" value="ZHN">
                                                <label for="ZHN">Ибраева Ж. Р.</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="attorney" id="OKE" value="OKE">
                                                <label for="OKE">Өміржан Қ. Е.</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                </div>

                                <div class="ibox-title">
                                    <h5>Информация по партнеру</h5>
                                </div>

                                <div class="ibox-content">
                                    <div class="form-group">
                                            <label class="col-sm-2 control-label">Форма организации:</label>
                                            <div class="col-sm-10">
                                                <div>
                                                    <input type="radio" name="orgType" id="too" value="too">
                                                    <label for="too">ТОО</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="orgType" id="ip" value="ip">
                                                    <label for="ip">ИП</label>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Название организации:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="orgName" class="form-control"/>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Директор(в родительном падеже):</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="orgLeaderName" class="form-control"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Директор, инициалы:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="orgLeaderShortName" class="form-control"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Действующий на основании:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="orgLeaderReason" class="form-control"/>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">БИН/ИИН:</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="orgNum" class="form-control" minlength="12" maxlength="12"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Банк:</label>
                                        <div class="col-sm-10">
                                            <select form="form1" name="bankSelect" class="form-control" required>
                                                <option value="">Выберите банк</option>
                                                <option value="ALT">АО "Altyn Bank" (ДБ АО "Народный Банк Казахстана")</option>
                                                <option value="ACB">АО "AsiaCredit Bank (АзияКредит Банк)"</option>
                                                <option value="RBK">Акционерное общество "Банк "Bank RBK"'</option>
                                                <option value="CBK">АО "Capital Bank Kazakhstan"</option>
                                                <option value="DEL">АО "Delta Bank"</option>
                                                <option value="FOR">АО "ForteBank"</option>
                                                <option value="KAS">АО "KASPI BANK"</option>
                                                <option value="QAZ">АО "Qazaq Banki"</option>
                                                <option value="TEN">АО "Tengri Bank"</option>
                                                <option value="ATF">АО "АТФБанк"</option>
                                                <option value="BKN">АО "Банк Kassa Nova"</option>
                                                <option value="AST">АО "Банк "Астаны"</option>
                                                <option value="BCK">АО "Банк ЦентрКредит"</option>
                                                <option value="BEC">Акционерное общество "First Heartland Bank"</option>
                                                <option value="ALF">АО "ДОЧЕРНИЙ БАНК "АЛЬФА-БАНК"</option>
                                                <option value="CIN">АО ДБ "БАНК КИТАЯ В КАЗАХСТАНЕ"</option>
                                                <option value="KZI">АО "ДБ "КАЗАХСТАН-ЗИРААТ ИНТЕРНЕШНЛ БАНК"</option>
                                                <option value="PAK">АО ДБ "Национальный Банк Пакистана" в Казахстане</option>
                                                <option value="HOM">ДБ АО "Банк Хоум Кредит"</option>
                                                <option value="SBR">ДБ АО "Сбербанк"</option>
                                                <option value="VTB">ДО АО Банк ВТБ (Казахстан)</option>
                                                <option value="EVR">АО "Евразийский Банк"</option>
                                                <option value="ZHI">АО "Жилстройсбербанк Казахстана"</option>
                                                <option value="ZAM">АО "Исламский банк "Заман-Банк"</option>
                                                <option value="HIL">АО "Исламский Банк "Al Hilal"</option>
                                                <option value="INV">АО "Казинвестбанк"</option>
                                                <option value="KKB">АО "КАЗКОММЕРЦБАНК"</option>
                                                <option value="HSB">АО "Народный Банк Казахстана"</option>
                                                <option value="NUR">АО "Нурбанк"</option>
                                                <option value="CIT">АО "Ситибанк Казахстан"</option>
                                                <option value="BCA">АО "Торгово-промышленный Банк Китая в г. Алматы"</option>
                                                <option value="CES">АО "Цеснабанк"</option>
                                                <option value="SBK">АО "Шинхан Банк Казахстан"</option>
                                                <option value="EXI">АО "ЭКСИМБАНК КАЗАХСТАН"</option>
                                                <option value="CED">АО "ЦЕНТРАЛЬНЫЙ ДЕПОЗИТАРИЙ ЦЕННЫХ БУМАГ"</option>
                                                <option value="DVK">АО "Банк Развития Казахстана"</option>
                                                <option value="EAB">ЕВРАЗИЙСКИЙ БАНК РАЗВИТИЯ</option>
                                                <option value="GCV">НАО "Государственная корпорация "Правительство для граждан"</option>
                                                <option value="INE">г.Москва Межгосударственный Банк</option>
                                                <option value="KIC">АО "Казахстанская фондовая биржа"</option>
                                                <option value="KIS">РГП "Казахстанский центр межбанковских расчетов НБРК"</option>
                                                <option value="KKM">РГУ "Комитет казначейства Министерства финансов РК"</option>
                                                <option value="KPS">АО "КАЗПОЧТА"</option>
                                                <option value="NBP">"Банк-кастодиан АО  "ЕНПФ"</option>
                                                <option value="NBR">Республиканское Государств Учреждение  Национальный Банк РК</option>
                                                <option value="NCC">НКО-ЦК "Национальный Клиринговый Центр" (АО)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Рассчетный счет:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="bankAccount" minlength="20" maxlength="20"/>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Юридический адрес:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="adressJur" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Почтовый адрес(оставь пустым, если совпадает с юридическим):</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="adressPost" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Фактический адрес(оставь пустым, если совпадает с юридическим):</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="adressFact" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Телефон: +7</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="orgPhone" minlength="10" maxlength="13" />
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                </div>

                                <input type="hidden" id="gloCount" name="gloCount" value="1">

                                <div id="supplement">

                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <input class="btn btn-primary" type="button" onclick="adddop()" value="Добавить приложение" />
                                    </div>
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <input class="btn btn-primary" type="submit" name="submit" value="Отправь меня!" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://use.fontawesome.com/b5a299472a.js"></script>
<script src="js/app.js" type="text/javascript"></script>

<script>
    var counter = 1;
    function adddop() {
        var doc = document.querySelector('link[rel="import"]').import;
        var supple = doc.querySelector('.supplewrap');
        var clone = document.importNode(supple, true);
        document.querySelector('#supplement').appendChild(clone);

        var supplement = document.getElementById('supplewrap')
        var title = supplement.querySelector('.ibox-title');
        title.children[0].innerHTML = '<h5>Доп. соглашение #' + counter + '</h5>';

        var formControl = supplement.querySelectorAll('.namechange')
        formControl.forEach(function(child) {
            var inName = child.getAttribute('name') + counter;
            child.setAttribute('name', inName);
            console.log(child)
        });

        var gloCount = document.getElementById('gloCount');
        gloCount.setAttribute('value', counter);

        var supplementNum = document.getElementById('supplementNum');
        console.log(supplementNum);
        supplementNum.setAttribute('value', counter);
        supplementNum.setAttribute('id', "");

        supplement.setAttribute('id', "");

        counter ++;

    }
</script>

</body>
</html>

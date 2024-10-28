<?php

include('config3.php');

$month = array();
$month[1] = 'января';
$month[2] = 'февраля';
$month[3] = 'марта';
$month[4] = 'апреля';
$month[5] = 'мая';
$month[6] = 'июня';
$month[7] = 'июля';
$month[8] = 'августа';
$month[9] = 'сентября';
$month[10] = 'октября';
$month[11] = 'ноября';
$month[12] = 'декабря';

$json = file_get_contents('https://functions.yandexcloud.net/d4epn59u05nqgnrhu1pk');
$objs = json_decode($json);
echo '<pre>';
//print_r( $objs->result).'<br>';

$n = 0;
$arr = array();

foreach ($objs->result as $obj) {
    if (in_array($city, $obj->cities)) {
        $arr[] = $obj;
        $n++;
    }
}


$all_names = '';
$arr_pictures = '';
$arr = array_reverse($arr);
foreach ($arr as $kol => $arr_obj) {
    $let = num2word($arr_obj->age, array('год', 'года', 'лет'));
    $d = explode('-', $arr_obj->date_of_loss);
    $day = intval($d[2]);
    $mth = $month[intval($d[1])];

    if ($kol <= 4) {
        $all_names .= '<div class="wa">
                <div class="str"></div>
                <div style="font-size:1rem;">' . $day . ' ' . $mth . ' '.$d[0].' года</div><b>' . $arr_obj->name . '</b>, ' . $arr_obj->age . ' ' . $let . ' 
                <!-- <div class="time">08:00</div>-->
            </div>';
    }
    if ($kol == 0) $arr_pictures .= '<img src="' . $arr_obj->vertical_url . '" alt="" border="0" style="width:100%;"/>';
    else $arr_pictures .= '<img src="' . $arr_obj->vertical_url . '" alt="" border="0" style="width:100%;display:none;"/>';
    //print_r($arr_obj);
}
echo '</pre>';


function num2word($num, $words)
{
    $num = $num % 100;
    if ($num > 19) {
        $num = $num % 10;
    }
    switch ($num) {
        case 1:
        {
            return ($words[0]);
        }
        case 2:
        case 3:
        case 4:
        {
            return ($words[1]);
        }
        default:
        {
            return ($words[2]);
        }
    }
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Поисково-спасательный отряд ЛИЗААЛЕРТ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Cache-control" content="public"/>
    <link rel="stylesheet" type="text/css" href="css/foundation.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<body style="background: #eee;">
<div class="row" style="background: #FF9700;">
    <div class="large-7 medium-7 columns">
        <h1 class="liza">ПОИСКОВО-СПАСАТЕЛЬНЫЙ ОТРЯД ЛИЗААЛЕРТ</h1>
    </div>
    <div class="large-5 medium-5 columns count_div">
        <div class="count_h">ЗАЯВКИ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; НАЙДЕНО
        </div>
        <div class="count_numbers"><?=$zayavki?> : <?=$naideno?></div>
    </div>
</div>
<div class="row bg">
    <div class="large-2 medium-2 columns">
        &nbsp;
    </div>
    <div class="large-5 medium-5 columns">
        <div class="wa_container">
            <!-- <div class="day">сегодня</div>-->
            <?= $all_names ?>

            <div class="wa_green">
                <div class="str1"></div>
                Помочь может каждый
            </div>
        </div>
    </div>
    <div class="large-5 medium-5 columns">

        <div class="orient">
            <div class="logo"><img src="img/logo.png" border="0" alt="" style="width:65px;"/></div>
            <div style="text-align: center;">
                <h2 class="now">СЕЙЧАС МЫ ИЩЕМ
                    <br/>
                    <?= $city_title ?></h2>
                <div class="orient_div" id="slideshow">
                    <?= $arr_pictures ?>
                </div>
            </div>
        </div>
    </div>

    <div class="large-2 medium-2 columns" style="text-align: center;">
        <img src="img/qr.jpg" alt="" border="0" style="width:100px;"/>
        <div class="volonteer">
            стань волонтером <br/>прямо сейчас
        </div>
    </div>
    <div class="large-5 medium-5 columns"></div>
    <div class="large-5 medium-5 columns"></div>

</div>

<script>
    var slideshow = document.getElementById('slideshow');
    var slides = slideshow.getElementsByTagName('img');
    var idx = 0;

    function changeSlide() {

        slides[idx].style.display = 'none';
        idx = (idx + 1) % slides.length;
        fadeIn(slides[idx], 1500, 'flex');
        //slides[idx].style.display = 'block';
    }

    setInterval(changeSlide, 5000);


    const fadeIn = (el, timeout, display) => {

        el.style.opacity = 0;
        el.style.display = display || 'block';
        el.style.transition = `opacity ${timeout}ms`;
        setTimeout(() => {
            el.style.opacity = 1;
        }, 10);
    };

</script>

</body>
</html>
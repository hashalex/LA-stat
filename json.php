<?php

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
print_r( $objs->result).'<br>';

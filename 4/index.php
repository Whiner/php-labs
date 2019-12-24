<?php

// Отключаем огромную кучу предупреждений DOMXPATH
error_reporting(E_ERROR);

// Получаем страницу
$doc = new DOMDocument;
$doc->loadHTMLFile("https://www.gismeteo.ua/weather-donetsk-5080/");
$xpath = new DOMXpath($doc);

// Получаем значения
$cityName = $xpath->query("//ul/li[@class='breadcrumbs__item']")[2]->nodeValue;   // название города
$today = $xpath->query("//div/div[@class='widget__date']")[0]->nodeValue;   //  дата сегодня
$sunshine = $xpath->query("//div[@class='id_item']");   // Восход, заход
$time = $xpath->query("//div[@class='widget__item']");    // Время
$degrees = $xpath->query("//div[@class='value']");    // Градусы

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <title>Погода <?= $cityName ?></title>
    <style>
        td {
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <table class="main-table">
        <tr>
            <td><h3 class="city-name"><?= $cityName ?></h3></td>
            <td class="day"><?= $today ?></td>
        </tr>
        <tr>
            <td><?= $sunshine[0]->nodeValue ?></td>
            <td><?= $sunshine[1]->nodeValue ?></td>
        </tr>
    </table>
    <br>
    <h3 class="weather">Погода</h3>
    <table class="main-table">
        <tr>
            <td><?= $time[0]->childNodes[0]->childNodes[0]->nodeValue ?><sup><?= $time[0]->childNodes[0]->childNodes[1]->nodeValue ?></sup></td>
            <td><?= $time[1]->childNodes[0]->childNodes[0]->nodeValue ?><sup><?= $time[0]->childNodes[0]->childNodes[1]->nodeValue ?></sup></td>
            <td><?= $time[2]->childNodes[0]->childNodes[0]->nodeValue ?><sup><?= $time[0]->childNodes[0]->childNodes[1]->nodeValue ?></sup></td>
            <td><?= $time[3]->childNodes[0]->childNodes[0]->nodeValue ?><sup><?= $time[0]->childNodes[0]->childNodes[1]->nodeValue ?></sup></td>
            <td><?= $time[4]->childNodes[0]->childNodes[0]->nodeValue ?><sup><?= $time[0]->childNodes[0]->childNodes[1]->nodeValue ?></sup></td>
            <td><?= $time[5]->childNodes[0]->childNodes[0]->nodeValue ?><sup><?= $time[0]->childNodes[0]->childNodes[1]->nodeValue ?></sup></td>
            <td><?= $time[6]->childNodes[0]->childNodes[0]->nodeValue ?><sup><?= $time[0]->childNodes[0]->childNodes[1]->nodeValue ?></sup></td>
            <td><?= $time[7]->childNodes[0]->childNodes[0]->nodeValue ?><sup><?= $time[0]->childNodes[0]->childNodes[1]->nodeValue ?></sup></td>
        </tr>
        <tr>
            <td><?= $degrees[4]->childNodes[0]->nodeValue ?></td>
            <td><?= $degrees[5]->childNodes[0]->nodeValue ?></td>
            <td><?= $degrees[6]->childNodes[0]->nodeValue ?></td>
            <td><?= $degrees[7]->childNodes[0]->nodeValue ?></td>
            <td><?= $degrees[8]->childNodes[0]->nodeValue ?></td>
            <td><?= $degrees[9]->childNodes[0]->nodeValue ?></td>
            <td><?= $degrees[10]->childNodes[0]->nodeValue ?></td>
            <td><?= $degrees[11]->childNodes[0]->nodeValue ?></td>
        </tr>
    </table>
</body>
</html>
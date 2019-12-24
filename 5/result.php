<?php

    // $url = "https://www.gismeteo.ua/weather-luhansk-5082/";
    // $url = "https://www.gismeteo.ua/weather-donetsk-5080/";
    $url = $_POST['city'];

    // Отключаем огромную кучу предупреждений DOMXPATH
    error_reporting(E_ERROR);

    // Получаем страницу
    $doc = new DOMDocument;
    $doc->loadHTMLFile($url);
    $xpath = new DOMXpath($doc);

    // Получаем значения
    $cityName = $xpath->query("//ul/li[@class='breadcrumbs__item']")[2]->nodeValue;   // название города
    $today = $xpath->query("//div/div[@class='widget__date']")[0]->nodeValue;   //  дата сегодня
    $degrees = $xpath->query("//div[@class='value']");    // Градусы

    $degIndex = array(
        0 => 4, 
        1 => 5, 
        2=> 6, 
        3 => 7, 
        4 => 8, 
        5 => 9, 
        6 => 10, 
        7 => 11
    );
    $hours = array(0 => 2, 1 => 5, 2=> 8, 3 => 11, 4 => 14, 5 => 17, 6 => 20, 7 => 23);



    $img = imagecreate(500, 150);
    // настраиваем цвета
    $textColor = ImageColorAllocate($img, 245, 245, 245); // цвет текст
    $blueColor = ImageColorAllocate($img, 0, 0, 255); // цвет линии
    $bgColor = ImageColorAllocate($img, 224, 222, 207); // цвет фона
    $redColor = ImageColorAllocate($img, 255, 50, 50); // цвет графика
    // фон
    ImageFill($img, 0, 0, $bgColor);


    $left = imagecreatefrompng('images/left.png');
    $center = imagecreatefrompng('images/center.png');
    $right = imagecreatefrompng('images/right.png');
    $moon = imagecreatefrompng('images/moon_sm.png');
    $sun = imagecreatefrompng('images/sun_sm.png');

    // Путь к ttf файлу шрифта
    // $font_file = './GOST_A.TTF';     Шрифт не используется так как php скомпилирован без той штуки, которой нужен этот шрифт

    imagealphablending($img, false);
    imagesavealpha($img, true);


    // Рисуем день/ночь
    imagecopy($img, $left, 100, 0, 0, 0, 100, 100);
    imagecopy($img, $center, 200, 0, 0, 0, 100, 100);
    imagecopy($img, $right, 300, 0, 0, 0, 100, 100);
    
    // Рисуем солнце и луну
    imagecopy($img, $moon, 25, 25, 1, 1, 62, 62);   
    imagecopy($img, $moon, 410, 25, 1, 1, 62, 62);
    imagecopy($img, $sun, 223, 10, 1, 1, 62, 62);

    // Рисуем линии и подписи
    imageline($img, 50, 110, 450, 110, $blueColor);
    imageline($img, 50, 105, 50, 110, $blueColor);
    foreach ($hours as $k => $v) {
        imageline($img, 100 + 50*$k, 105, 100 + 50*$k, 110, $blueColor);
        imagestring($img, 2, 97 + 50*$k, 115, $v, $blueColor);
        // imagefttext($img, 13, 0, 105, 55, $blueColor, $font_file, $v);   Это не работает, так как php 
        // скомпилирован без поддержки этой штуки
    }

    // Градусы
    foreach ($degIndex as $k => $v) {
        $height = 100 - 2*intval($degrees[$v]->childNodes[0]->nodeValue);
        imagestring($img, 2, 97 + 50*$k, $height - 15, $degrees[$v]->childNodes[0]->nodeValue, $redColor);
        
        if($degrees[$v + 1]->childNodes[0]->nodeValue < 100) {
            imageline($img, 100 + 50*$k, $height, 100 + 50*($k + 1), 100 - 2*intval($degrees[$v + 1]->childNodes[0]->nodeValue), $redColor);
        }
    }

    // Город, дата - это не работает. На странице нет латинских названий, а делать транслитерацию запарно
    // imagestring($img, 2, 120, 135, mb_convert_encoding($cityName,"windows-1251", "latin2"), $textColor);
    // imagestring($img, 2, 220, 135, mb_convert_encoding($today,"utf-8", "windows-1251"), $textColor);


    // выводим изображение в браузер
    header("Content-type: image/png");
    ImagePng($img);
    ImageDestroy($img);
    // завершаем программу
    exit();
?>
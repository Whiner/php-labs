<?php

    $region = null; 
    $population = null;
    $university = null;

    
    if ($_GET['region'] != '') {    // Если есть get параметр
        $lines = getMenu();
        $id = intval($_GET['region']);

        if ($lines[$id] != '') {    // Если есть строка с номером get параметра
            $region = $lines[$id];
            $population =$lines[$id + 1];
            $university = $lines[$id - 1];
        }
    }


    // Получение данных для списка
    function getMenu() {
        $lines = [];    // массив для хранения строк файла

        // Чтение файла
        $handle = fopen("oblinfo.txt", "r");
        while (!feof($handle)) {
            $lines[] = mb_convert_encoding(fgets($handle, 4096),"utf-8", "windows-1251");
        }
        fclose($handle);

        return $lines;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Результат</title>
</head>
<body>
    <?php if ($region != null) {?>
        <p>Регион: <?= $region ?></p>
        <p>Численность населения: <?= $population ?> тыс. человек</p>
        <p>Высших уебных заведений: <?= $university ?></p>
    <?php } else {?>
        <p>Некорректный запрос</p>
    <?php } ?>
</body>
</html>
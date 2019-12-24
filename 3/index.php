<?php


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

    function makeMenu() {
        $lines = getMenu();

        for($i = 1; $i < count($lines); $i += 3) {
            echo "<option value=\"".$i."\">".$lines[$i]."</option>";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Выберите область</title>
</head>
<body>
    <form action="result.php" method="get">
        <p>
            <select name="region">
                <option disabled>Выберите область</option>
                <?= makeMenu() ?>
            </select>
        </p>
    <p><input type="submit" value="Получить результат"></p>
    </form>
</body>
</html>
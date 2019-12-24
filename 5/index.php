<?php

    $menuItems = array(
        "https://www.gismeteo.ua/weather-donetsk-5080/" => "Донецк", 
        "https://www.gismeteo.ua/weather-luhansk-5082/" => "Луганск", 
        "https://www.gismeteo.ua/weather-kharkiv-5053/" => "Харьков", 
        "https://www.gismeteo.ua/weather-zaporizhia-5093/" => "Запорожье"
    );

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
    <form action="result.php" method="post">
        <p>
            <select name="city">
                <option disabled>Выберите область</option>
                <?php
                    foreach ($menuItems as $k => $v){
                        echo "<option value=\"".$k."\">".$v."</option>";
                    }
                ?>
            </select>
        </p>
    <p><input type="submit" value="Получить результат"></p>
    </form>
</body>
</html>
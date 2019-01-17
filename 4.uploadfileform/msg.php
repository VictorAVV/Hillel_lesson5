<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Files upload.
    </title>
    <link rel='stylesheet' href='/css/bootstrap.css' type='text/css' media='all'>
    <link rel='stylesheet' href='/css/usercss.css' type='text/css' media='all'>
</head>

<body>
    <div id="blokForma" class="container">
        <h3 class="h3">Результаты загрузки файлов.</h3>
            <?php
            if (isset($arrFiles)) {
                message($arrFiles, $arrWithPhpErrors);
            }
            ?>
            <div class="alert-link">
                <a href="./index.html" class="alert-link">Вернуться назад и загрузить новые файлы</a>.
            </div>
    </div>
</body>

</html>

<?php 
function message($array, $arrWithErrors) {
    foreach ($array as $formfilename => $file) {
        if ($file["error"] === 0) {
            echo "<div class='success'>";
            echo "$formfilename: Файл успешно загружен. Имя файла {$file['name']}. Размер файла {$file['size']} байт.";
            echo "</div>";
        } else {
            echo "<div class='alert'>";
            echo "$formfilename: ".((isset($arrWithErrors[$file['error']]))?$arrWithErrors[$file['error']]:$file['error']);
            echo "</div>";
        }
    }
}
?>
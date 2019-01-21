<?php
//4. Создать форму загрузки от 1-го до 5-ти файлов на сервер 
// и написать php-скрипт, принимающий эти файлы. 
//Скрипт должен выводить сообщение об успешной загрузке или об ошибке в случае неудачи. 

$uploaddir = ''; //каталог для сохранения файлов

if (!isset($_POST) || !isset($_FILES)) {
    header('Location: index.html'); 
}

$arrFiles = []; //массив с информацией о загруженных файлах
$arrWithPhpErrors = array(
    0 => "Ошибок не возникло, файл был успешно загружен на сервер.",
    1 => "Размер принятого файла превысил максимально допустимый размер.",
    2 => "Размер загружаемого файла превысил значение MAX_FILE_SIZE, указанное в HTML-форме.",
    3 => "Загружаемый файл был получен только частично.",
    4 => "Файл не был загружен.",
    6 => "Отсутствует временная папка.",
    7 => "Не удалось записать файл на диск.",
    8 => "PHP-расширение остановило загрузку файла."
);

function checkFileName($fileName, $arr) {
    //проверка на одинаковые имена файлов
    foreach($arr as $value) {
        if (isset($value["name"]) && $fileName == $value["name"]) {
            return true;
        }
    }
    return false;
}

foreach ($_FILES as $formfilename => $file) {

    $arrFiles[$formfilename]["error"] = $file["error"];
    if ($file["error"] == 0) {

        $uploadfile = $uploaddir.$file["name"];
        
        if (checkFileName($file["name"], $arrFiles)) {
            $arrFiles[$formfilename]["error"] = "Файл с именем '{$file["name"]}' уже был загружен";
        } else {
            if (move_uploaded_file($file["tmp_name"], $uploadfile)) {
                $arrFiles[$formfilename]["name"] = $file["name"];
                $arrFiles[$formfilename]["size"] = $file["size"];
                //echo "Файл корректен и был успешно загружен.<br>";
            } else {
                $arrFiles[$formfilename]["error"] = "Неизвестная ошибка";
            }
        }
    }
}

if (empty($arrFiles)) {
    header('Location: index.html');
} else {
    require_once('msg.php');
}

?>

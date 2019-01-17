<?php
// 1. Дан файл test.txt, в нем содержится текст из 15 строк. 
// Вывести в скрипте строки с 5 по 10 из данного файла.

header('Content-type: text/html; charset=utf-8');

//$fileName = "uploads/testru.txt";
$fileName = "uploads/test.txt";
//кодировка файла
$encodingOfFile = "windows-1251";
//перечень нужных строк. можно с пробелом или без.
$necessaryStrings = "5, 6, 7,8, 9, 10";
//$necessaryStrings = "  ";

if (file_exists($fileName)) {
    
    $arr = file($fileName, FILE_IGNORE_NEW_LINES) or die("ERROR: Cannot open the file.");

    /* mb_detect_encoding($fiel, array("windows-1251", "UTF-8")) иногда работает неадекватно. 
    Например, есть файл "testru.txt" в кодировке windows-1251.
    В нем только единственная строка: "тест test". 
    Функция mb_detect_encoding() определяет её, как windows-1251.
    Если строку поменять: "test тест".
    То функция mb_detect_encoding() определяет её, как UTF-8.

    Если в начале первой строки файла (с кодировкой windows-1251) есть пробел, 
    то кодировка тоже определяется как UTF-8.
    
    Надо, или просто указывать в php-скрипте кодировку читаемого файла, или не знаю что :( */

    //$getEncoding  = mb_detect_encoding($arr[0], array("windows-1251", "UTF-8"));

    //echo $getEncoding."<br>";
    //echo iconv($getEncoding, "UTF-8", file_get_contents($fileName))."<br>";
    //echo iconv("windows-1251", "UTF-8", file_get_contents($fileName))."<br>";
    
    if (trim($necessaryStrings) != "") {
        $necessaryStringsArr = explode(",", str_replace(" ", "", $necessaryStrings));
   
        foreach ($arr as $numLine => $line) {
            if (in_array($numLine, $necessaryStringsArr) !== false) {
                if ($encodingOfFile == "UTF-8") {
                    echo $line."<br>";
                } else {
                    echo iconv($encodingOfFile, "UTF-8", $line)."<br>";
                }
            }
        }
    } else {
        echo "Вы не задали перечень нужных строк";
    }
} else {
    echo "ERROR: File does not exist.";
}

/* нашел такой вариант определения кодировки файла если ОС Unix: 
http://qaru.site/questions/49673/detect-file-encoding-in-php#351970

function detectFileEncoding($filepath) {
    $output = array();
    exec('file -i ' . $filepath, $output);
    if (isset($output[0])){
        $ex = explode('charset=', $output[0]);
        return isset($ex[1]) ? $ex[1] : null;
    }
    return null;
} 
*/

?>
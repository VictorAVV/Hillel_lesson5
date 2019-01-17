<?php
// 2. Дан текстовый файл test.txt,  
// который расположен в директории uploads/ 
// написать скрипт, который бы выводил 
// характеристики данного файла: 
// полный путь к файлу, имя файла, размер файла, количество строк текста и сам текст.

header('Content-type: text/html; charset=utf-8');

$fileName = "test.txt";
//$fileName = "testru.txt";
$dirName = "uploads";
//$dirName = "";
//кодировка файла
$encodingOfFile = "windows-1251";

$relativePathToFile = ($dirName == "") ? $fileName : $dirName."/".$fileName;

if (file_exists($relativePathToFile)) {
    
    echo "1. Полный путь к файлу: ".realpath($relativePathToFile)."<br>";
    echo "2. Имя файла: ".(pathinfo($relativePathToFile)["filename"])."<br>";
    
    $sizeOfFile = filesize($relativePathToFile);
    echo "3. Размер файла: ".number_format($sizeOfFile, 0, ',', ' ')." байт<br>";

    /* для больших файлов лучше не загружать целиком файл в память, а делать построчный перебор 
    $handle = fopen($relativePathToFile, "r");
    $numOfStrings = 0;
    while (!feof($handle))  {
        fgets($handle);
        $numOfStrings++;
    }
    fclose($handle); */

    $arr = [];
    //когда файл пустой, file() выводит ошибку
    if ($sizeOfFile != 0) {        
        $arr = file($relativePathToFile, FILE_IGNORE_NEW_LINES) or die("ERROR: Cannot open the file.");
    } 
    echo "4. Количество строк текста в файле: ".count($arr)."<br>";
    echo "4. Содержимое файла: <br>";

    foreach ($arr as $line) {
        if ($encodingOfFile == "UTF-8") {
            echo $line."<br>";
        } else {
            echo iconv($encodingOfFile, "UTF-8", $line)."<br>";
        }
    }
} else {
    echo "ERROR: File does not exist.";
}

?>
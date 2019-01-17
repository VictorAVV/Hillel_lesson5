<?php

//3. Создать форму регистрации пользователя, позволяющую передать на сервер (метод GET) следующие данные:
//  - Имя пользователя (обязат.)
//  - Логин (обязат.)
//  - Пароль и подтверждение пароля (обязат.)
//  - Адрес электронной почты (обязат.)
//  - Пол (не обязат.)
//  - Дата рождения (не обязат.)
//  - Страна и город (не обязат.)
//  Написать серверный php-скрипт, принимающий регистрационные данные 
// и сохраняющий данные в файл с именем user.txt, 
// причем в файле должны быть данные об одном пользователе.

$nameErr = $loginErr = $passwordErr = $passwordConfirmErr = $emailErr = $birthdayErr = false;

$pathToFile = "user.txt";

if (!isset($_GET['name']) || !isset($_GET['login']) || !isset($_GET['password']) || !isset($_GET['passwordconfirm']) || !isset($_GET['email'])) {
    header('Location: index.html'); 
}

$name = trim($_GET['name']);
if (!preg_match("/^([a-zA-Z' ])+$/", $name) || strlen($name) > 40) {
    $nameErr = true;
}

$login = trim($_GET['login']);
if (strlen($login) == 0 || strlen($login) > 50) {
    $loginErr = true;
}

$password = trim($_GET['password']);
if (strlen($password) == 0 || strlen($password) > 50) {
    $passwordErr = true;
}
if ($password != trim($_GET['passwordconfirm'])) {
    $passwordConfirmErr = true;
}

$email = trim($_GET['email']);
if (strlen($email) == 0 || strlen($email) > 50 || !preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)) {
    $emailErr = true;
}

$sex = "";
if (isset($_GET['sex']) ) {
    $sex = trim($_GET['sex']);
}
$birthday = "";
if (isset($_GET['birthday']) ) {
    $birthday = $_GET['birthday'];
    if (strtotime($birthday) > strtotime("now")) {
        $birthdayErr = true;
    }
}
$country = "";
if (isset($_GET['country']) ) {
    $country = trim($_GET['country']);
}
$city = "";
if (isset($_GET['city']) ) {
    $city = trim($_GET['city']);
}

if ($nameErr || $loginErr || $passwordErr || $passwordConfirmErr || $emailErr || $birthdayErr) {
    require_once('errormsg.php');
} else {
    $handle = fopen($pathToFile, "w");
    fwrite($handle, "name = $name".PHP_EOL);
    fwrite($handle, "login = $login".PHP_EOL);
    fwrite($handle, "password = $password".PHP_EOL);
    fwrite($handle, "email = $email".PHP_EOL);
    fwrite($handle, "sex = $sex".PHP_EOL);
    fwrite($handle, "birthday = $birthday".PHP_EOL);
    fwrite($handle, "country = $country".PHP_EOL);
    fwrite($handle, "city = $city".PHP_EOL);
    fclose($handle);

    /*$handle = fopen((pathinfo($pathToFile)["filename"]).".csv", 'w');
        fputcsv($handle, array(
            "name=$name",
            "login=$login",
            "password=$password",
            "email=$email",
            "sex=$sex",
            "birthday=$birthday",
            "country=$country",
            "city=$city"
        ), ",");
    fclose($handle);*/

    require_once('okmsg.php');
}

?>
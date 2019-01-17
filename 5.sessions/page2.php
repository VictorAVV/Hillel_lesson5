<?php 
session_start();

$userLogin = null;
if (isset($_SESSION['userlogin'])) {
    $userLogin = $_SESSION['userlogin'];
    //echo "user olready logined";
}
if (isset($_POST['login']) && trim($_POST['login']) !== "") {
    $userLogin = trim($_POST['login']);
}

if (strlen($userLogin) < 3 || strlen($userLogin) > 15) {
    $userLogin = null;
} else {
    $_SESSION['userlogin'] = $userLogin;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Lesson 5. Sessions. Page 2.
    </title>
    <link rel='stylesheet' href='/css/bootstrap.css' type='text/css' media='all'>
    <link rel='stylesheet' href='/css/usercss.css' type='text/css' media='all'>
</head>

<body>
<div id="blokForma" class="container">
    <?php
        $link = message($userLogin);
    ?>
    <div class="alert-link">
    <?php
        echo $link;
    ?>
    </div>
    </div>
</body>

</html>

<?php 
function message($login) {
    if (isset($login)) {
        echo "<div class='success'>Привет, $login.</div>";
        return "<a href='./page3.php' class='alert-link'>Перейти на страницу 3.</a>";
    } else {
        echo "<div class='alert'>Вы не зарегестрированны. Перейдите на страницу 1 и зайдите в систему под своим логином.</div>";
        return "<a href='./page1.php' class='alert-link'>Перейти на страницу 1.</a>";
    }
}
?>
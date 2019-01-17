<?php 
session_start();
$sessiondestroyed = false;

if (isset($_SESSION['userlogin'])) {
    $userLogin = $_SESSION['userlogin'];
    
    if (isset($_POST['login']) && $_POST['login'] == "exit") {
        session_destroy();
        $sessiondestroyed = true;
    }
} else {
    $userLogin = null;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Lesson 5. Sessions. Page 4.
    </title>
    <link rel='stylesheet' href='/css/bootstrap.css' type='text/css' media='all'>
    <link rel='stylesheet' href='/css/usercss.css' type='text/css' media='all'>
</head>

<body>
<div id="blokForma" class="container">
    <?php
        message($userLogin, $sessiondestroyed);
    ?>
    <div class="alert-link">
       <a href="./page3.php" class="alert-link">Перейти на страницу 3.</a>
    </div>
    </div>
</body>

</html>

<?php 
function message($login, $destroy) {
    if ($destroy) {
        echo '<div class="success">'.$login.', вы успешно вышли из системы.</div>';
    } 
}
?>
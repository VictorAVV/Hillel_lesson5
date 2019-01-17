<?php 
session_start();

if (isset($_SESSION['userlogin'])) {
    //echo "user already logined";
    $userLogin = $_SESSION['userlogin'];
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
        Lesson 5. Sessions. Page 3.
    </title>
    <link rel='stylesheet' href='/css/bootstrap.css' type='text/css' media='all'>
    <link rel='stylesheet' href='/css/usercss.css' type='text/css' media='all'>
</head>

<body>
    <div id="blokForma" class="container">
        <?php
        message($userLogin);
        ?>
    </div>
</body>

</html>

<?php 
function message($login) {
    if (isset($login)) {
        echo '<form class="form-horizontal" action="/page4.php" method="POST" >
                <input type="hidden" value="exit" name="login" id="login">
                <div class="success">
                    Еще раз привет, '.$login.'.
                </div>
                <div class="warning">
                    Теперь ты можешь выйти из системы.
                </div>
                <div class="form-group">
                    <div class="center-block col-sm-12">
                        <button type="submit" class="btn btn-success">Выход</button>
                    </div>
                </div>
            </form>';
    } else {
        echo '<div class="alert">Вы не зарегестрированны.<br>Перейдите на страницу 1 и зайдите в систему под своим логином.</div>
            <div class="alert-link">
                <a href="./page1.php" class="alert-link">Перейти на страницу 1.</a>
            </div>';
    }
}
?>

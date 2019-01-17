<?php 
session_start();

$userLogin = null;
if (isset($_SESSION['userlogin'])) {
    $userLogin = $_SESSION['userlogin'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Lesson 5. Sessions. Page 1.
    </title>
    <link rel='stylesheet' href='/css/bootstrap.css' type='text/css' media='all'>
    <link rel='stylesheet' href='/css/usercss.css' type='text/css' media='all'>
</head>

<body>
    <div id="blokForma" class="container">
        <h3><?php
            if (isset($userLogin)) {
                echo "Вы уже вошли под логином $userLogin.<br>Желаете поменять логин?";
            } else {
                echo "Введите свой логин.";
            }
        ?></h3>
        <form class="form-horizontal" action="/page2.php" method="POST" >
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="text" class="form-control" value="<?php echo $userLogin; ?>" name="login" id="login">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12"><span id="helpBlock" class="help-block">Длина логина от 3 до 15 символов</span></div>
            </div>
            <div class="form-group">
                <div class="center-block col-sm-12">
                    <button type="submit" class="btn btn-success">Отправить</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
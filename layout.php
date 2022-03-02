<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Books</title>
</head>
<body>
<?php
session_start();
require_once 'db/connect.php';
?>
<nav class="nav">
    <?php
    if (!empty($_SESSION['auth'])) {
        $login = $_SESSION['login'];
        echo "<a class='nav-link' href='http://localhost/7labIZ/index.php'>Главная</a>";
        echo "<a class='nav-link' href='http://localhost/7labIZ/addTicket.php'>Создать билет</a>";
        echo "<a class='nav-link' href='http://localhost/7labIZ/addDriver.php'>Водители</a>";

        echo  "<a class='nav-link' href='http://localhost/7labIZ/logout.php'>Выход</a>";
        $query = "SELECT firstname from users WHERE login='$login'";
        $res = mysqli_query($mysqli, $query);
        $username = mysqli_fetch_row($res);
        echo  "<a class='nav-link disabled' href='#'>".$username[0]."</a>";
    }
    else
    {
        echo "<a class='nav-link' href='http://localhost/7labIZ/login.php'>Вход</a>";
    }

    ?>

</nav>


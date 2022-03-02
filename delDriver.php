<?php
include 'layout.php';
require_once 'db/connect.php';
require_once 'validator/isAuth.php';
$id = $_GET['id'];
if (!empty((int)$_GET['id'])){
    $id = (int)$_GET['id'];
    $query = "DELETE FROM driver WHERE id=$id";
    $res = mysqli_query($mysqli, $query);
    if (!$res) die (mysqli_error($mysqli));
    // Если количество затронутых запростом записей равно 1 (одна запись удалена)
    // то выводим сообщение
    if (mysqli_affected_rows($mysqli) == 1) {
        echo "<h2>Запись с id = $id удалена</h2>";
        header("Location: http://localhost/7labIZ/addDriver.php");
        exit( );
    }
}
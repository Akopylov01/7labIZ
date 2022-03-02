<?php
require_once 'db/connect.php';
if (empty($_SESSION['auth'])) {
    header("Location: http://localhost/7labIZ/login.php");
    exit( );
}

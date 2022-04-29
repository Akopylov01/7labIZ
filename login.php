<?php
include 'layout.php';

if (!empty($_POST['submit']) && $_POST['submit'] == 'Войти') {
    $login = strip_tags($_POST['login']);
    $password = strip_tags($_POST['password']);
    $password1 = strip_tags($_POST['password1']);
    $query = "SELECT * from users WHERE login='$login' AND password='$password'";
    $res = mysqli_query($mysqli, $query);
    $user = mysqli_fetch_assoc($res);
    if (!empty($user)) {
        $_SESSION['auth'] = true;
        $_SESSION['login'] = $login;
        header("Location: http://localhost/7labIZ/index.php");
        exit();

    } else {
        echo "<h3>Неправильный логин или пароль</h3>";
    }

}

?>
<form action="" method="post" class="form">
    <div class="mb-3">
        <label class="form-label">Логин</label>
        <input type="text" name="login" required class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Пароль</label>
        <input type="password" name="password" required class="form-control">
    </div>
    <input type="submit" name="submit" class="btn btn-primary" name="submit" value="Войти">
</form>

</body>

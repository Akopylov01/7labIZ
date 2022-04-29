<?php
include 'layout.php';
require_once 'db/connect.php';
require_once 'validator/isAuth.php';
if (!empty($_POST['submit']) && $_POST['submit'] == 'Добавить') {
    $lastname = strip_tags($_POST['lastname']);
    $firstname = strip_tags($_POST['firstname']);
    $patronymic = strip_tags($_POST['patronymic']);
    $querySelect = "SELECT * from driver WHERE firstname='$firstname' and lastname='$lastname' and patronymic='$patronymic'";
    $result = mysqli_query($mysqli, $querySelect);
    $row = mysqli_fetch_array($result);
    if (empty($lastname) || empty($firstname) || empty($patronymic))
    {
        echo "<h1>Заполните все поня!</h1>";
    }
    else if (!(preg_match('/[а-яёА-ЯЁ]+/u', $firstname) || preg_match('/[а-яёА-ЯЁ]+/u', $lastname) || preg_match('/[а-яёА-ЯЁ]+/u', $patronymic))) {
        echo "<h1>Поля ФИО должны содержать только русские символы!</h1>";
    } else if (!((strlen($firstname) < 20 and strlen($firstname) >= 2) or (strlen($lastname) < 20 and strlen($lastname) >= 2) or (strlen($patronymic) < 20 and strlen($patronymic) >= 2))) {
        echo "<h1>Поля ФИО должны содержать от 2 до 20 символов!</h1>";
    } else if (!empty($row)) {
        echo "<h1>Этот водитель уже есть в базе данных!</h1>";
    }
    else{
        $query = "INSERT INTO driver (lastname, firstname, patronymic) VALUES ('$lastname', '$firstname', '$patronymic')";
        $res = mysqli_query($mysqli, $query);
        if (!$res) die (mysqli_error($mysqli));
        // Если количество затронутых запростом записей равно 1 (одна запись добавлена)
        // то выводим сообщение
        if (mysqli_affected_rows($mysqli) == 1) {
            echo "<h2>Водитель добавлен</h2>";
        }
    }

}
?>

    <h5>Добавить водителя</h5>
    <form action="" method="post" class="form">
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input type="text" name="firstname" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Фамилия</label>
            <input type="text" name="lastname" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Отчество</label>
            <input type="text" name="patronymic" class="form-control">
        </div>

        <input type="submit" name="submit" class="btn btn-primary" name="submit" value="Добавить">
    </form>
    <div class="container">
        <div class="row">
            <?php
            $query = "SELECT * FROM driver";
            $res = mysqli_query($mysqli, $query);
            if (!$res) die (mysqli_error($mysqli));
            while ($row = mysqli_fetch_assoc($res)) {
                ?>

                <div class="col">
                    <div class="post">
                        <h5>Фамилия: <?= $row['lastname']?></h5>
                        <p>Имя: <?= $row['firstname']?></p>
                        <p>Отчество: <?= $row['patronymic']?> </p>
                        <a href='http://localhost/7labIZ/delDriver.php?id=<?=$row['id']?>'>Удалить</a>

                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>


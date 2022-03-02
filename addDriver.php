<?php
include 'layout.php';
require_once 'db/connect.php';
require_once 'validator/isAuth.php';
if (!empty($_POST['submit']) && $_POST['submit'] == 'Добавить') {
    $lastname = strip_tags($_POST['lastname']);
    $firstname = strip_tags($_POST['firstname']);
    $patronymic = strip_tags($_POST['patronymic']);
    $query = "INSERT INTO driver (lastname, firstname, patronymic) VALUES ('$lastname', '$firstname', '$patronymic')";
    $res = mysqli_query($mysqli, $query);
    if (!$res) die (mysqli_error($mysqli));
    // Если количество затронутых запростом записей равно 1 (одна запись добавлена)
    // то выводим сообщение
    if (mysqli_affected_rows($mysqli) == 1) {
        echo "<h2>Водитель добавлен</h2>";
    }
}
?>

    <h5>Добавить водителя</h5>
    <form action="" method="post" class="form">
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input type="text" name="firstname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Фамилия</label>
            <input type="text" name="lastname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Отчество</label>
            <input type="text" name="patronymic" class="form-control" required>
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


<?php
include 'layout.php';
require_once 'db/connect.php';
require_once 'validator/isAuth.php';


$id = $_GET['id'];
if (!empty($_POST['submit']) && $_POST['submit'] == 'Удалить') {
    $query = "DELETE FROM tickets WHERE id=$id";
    $res = mysqli_query($mysqli, $query);
    if (!$res) die (mysqli_error($mysqli));
    // Если количество затронутых запростом записей равно 1 (одна запись удалена)
    // то выводим сообщение
    if (mysqli_affected_rows($mysqli) == 1) {
        echo "<h2>Запись с id = $id удалена</h2>";
        header("Location: http://localhost/7labIZ/index.php");
        exit( );
    }
}

if (!empty($_POST['submit']) && $_POST['submit'] == 'Обновить') {
    // Очищаем пришедшие данные от HTML и PHP тегов
    $cruise_id = strip_tags($_POST['cruise_id']);
    $route = strip_tags($_POST['route']);
    $bus_type = strip_tags($_POST['bus_type']);
    $date = $_POST['date'];
    $drives_id = strip_tags($_POST['drives_id']);
    $cost = strip_tags($_POST['cost']);
    $query = "UPDATE tickets SET cruise_id = '$cruise_id', route = '$route', bus_type ='$bus_type', date = '$date', drives_id = '$drives_id', 
                   cost='$cost' WHERE id = $id";
    $res = mysqli_query($mysqli, $query);
    if (!$res) die (mysqli_error($mysqli));
    // Если количество затронутых запростом записей равно 1 (одна запись добавлена)
    // то выводим сообщение
    if (mysqli_affected_rows($mysqli) == 1) {
        echo "<h2>Запись изменена</h2>";
        header("Location: http://localhost/7labIZ/index.php");
        exit( );
    }
}
?>
<?php
$query = "SELECT * FROM tickets WHERE id=$id";
$res = mysqli_query($mysqli, $query);
if (!$res) die (mysqli_error($mysqli));
while ($row = mysqli_fetch_assoc($res)) {
    ?>
    <h2>Изменить запись</h2>
    <form action="" method="post" class="form" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Рейс</label>
            <input type="text" name="cruise_id" class="form-control" required value="<?=$row['cruise_id']?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Маршрут</label>
            <input type="text" name="route" class="form-control" required value="<?=$row['route']?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Тип автобуса</label>
            <input type="text" name="bus_type" class="form-control" required value="<?=$row['bus_type']?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Дата и время отправления</label>
            <input type="datetime-local" name="date" class="form-control" value="<?=$row['date']?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Цена</label>
            <input type="text" name="cost" class="form-control" required value="<?=$row['cost']?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Водитель</label>
            <select name="drives_id" id="drives_id">
                <?php
                $driverQuery = "SELECT * FROM driver";
                $resDriver = mysqli_query($mysqli, $driverQuery);
                if (!$resDriver) die (mysqli_error($mysqli));
                while ($rowDriver = mysqli_fetch_assoc($resDriver)) { ?>
                    <option value="<?=$row['drives_id']?>"><?= $rowDriver['id']?> . <?= $rowDriver['lastname']?></option>;
                <?php } ?>
            </select>
        </div>
        <input type="submit" name="submit" class="btn btn-primary" name="submit" value="Обновить">
        <input type="submit" name="submit" class="btn btn-primary" name="delete" value="Удалить">
    </form>

    <?php
}
?>
</body>

<?php
include 'layout.php';
require_once 'db/connect.php';
require_once 'validator/isAuth.php';

$driverQuery = "SELECT * FROM driver";
$driverRes = mysqli_query($mysqli, $driverQuery);

if (!empty($_POST['submit']) && $_POST['submit'] == 'Добавить') {
        $cruise_id = strip_tags($_POST['cruise_id']);
        $route = strip_tags($_POST['route']);
        $bus_type = strip_tags($_POST['bus_type']);
        $date = $_POST['date'];
        $drives_id = strip_tags($_POST['drives_id']);
        $cost = strip_tags($_POST['cost']);
        $queryExist = "SELECT * FROM tickets WHERE cruise_id='$cruise_id'";
        $resExist = mysqli_query($mysqli, $queryExist);
        $dataExist = mysqli_fetch_assoc($resExist);
        if (!empty($dataExist)){
            echo "<h2>Такой рейс уже существует</h2>";
            exit();
        }
        else {
            $query = "INSERT INTO tickets (cruise_id, route, bus_type, date, drives_id, cost ) VALUES ('$cruise_id', '$route', '$bus_type', '$date','$drives_id','$cost')";
            $res = mysqli_query($mysqli, $query);
            if (!$res) die (mysqli_error($mysqli));
            // Если количество затронутых запростом записей равно 1 (одна запись добавлена)
            // то выводим сообщение
            if (mysqli_affected_rows($mysqli) == 1) {
                echo "<h2>Билет создан</h2>";
            }
        }
}
?>
<h5>Добавить билет</h5>
<form action="" method="post" class="form">
    <div class="mb-3">
        <label class="form-label">Рейс</label>
        <input type="text" name="cruise_id" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Маршрут</label>
        <input type="text" name="route" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Тип автобуса</label>
        <input type="text" name="bus_type" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Дата и время отправления</label>
        <input type="datetime-local" name="date" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Цена</label>
        <input type="text" name="cost" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Дата и время отправления</label>
        <select name="drives_id" id="drives_id">
            <?php
            while ($row = mysqli_fetch_assoc($driverRes)) {
            ?>
            <option><?= $row['id']?> . <?= $row['lastname']?></option>;
            <?php } ?>
        </select>
    </div>
    <input type="submit" name="submit" class="btn btn-primary" name="submit" value="Добавить">
</form>


</body>

<?php
include 'layout.php';
require_once 'db/connect.php';
include 'validator/isAuth.php';

?>
<h2>Наши билеты</h2>

<div class="container">
    <div class="row">
        <?php
        $query = "SELECT * FROM tickets";
        $res = mysqli_query($mysqli, $query);
        if (!$res) die (mysqli_error($mysqli));
        while ($row = mysqli_fetch_assoc($res)) {
            ?>

            <div class="col">
                <div class="post">
                    <h5>Рейс: <?= $row['cruise_id']?></h5>
                    <p>Маршрут: <?= $row['route']?></p>
                    <p>Тип автобуса: <?= $row['bus_type']?> </p>
                    <p>Время отправления: <?= $row['date']?> </p>
                    <p>Стоимость билета: <?= $row['cost']?> </p>
                    <p>Водитель:
                        <?php
                        $driver_id = $row['drives_id'];
                        $driverQuery = "SELECT * FROM driver WHERE id=$driver_id";
                        $resDriver = mysqli_query($mysqli, $driverQuery);
                        if (!$resDriver) die (mysqli_error($mysqli));
                        while ($rowDriver = mysqli_fetch_assoc($resDriver)) { ?>
                            <span><?=$rowDriver['lastname']?> <?=$rowDriver['firstname']?> <?=$rowDriver['patronymic']?> </span>
                        <?php }
                        ?>
                    </p>
                    <a href='http://localhost/7labIZ/detail.php?id=<?=$row['id']?>'>Подробнее</a>

                </div>
            </div>
            <?php
        }
        ?>
    </div>

</div>
</body>


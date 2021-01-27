<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://use.fontawesome.com/065c397218.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>Индекс.Касса</title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
<div class="container">
    <a class="navbar-brand" href="#">
        <img src="img/lg.png" height="30" alt="">
    </a>
    </div>
    </nav>
<div class="container">
    

    <?php
        /* Подключение к серверу MySQL */
        $login = $_POST['inputLogin'];
        $password = $_POST['inputPassword'];
        $mysqli = new mysqli('localhost', $login, $password, 'keksislove');
        
        if (mysqli_connect_errno()) {
            printf("Подключение к серверу MySQL невозможно. Код ошибки: %s<br>", mysqli_connect_error());
        exit;
        }
    ?>
    
    <div class="card-deck">

        <?php
            $result = $mysqli->query('SELECT count(*) as buys_count FROM `sales_info` WHERE TO_DAYS(NOW()) - TO_DAYS(`out_date`) <= 1 ORDER BY `sale_id` desc' );
            $row = $result->fetch_assoc();
        ?>
        <div class="card md-3 mb-2 mt-2 text-white bg-success" style="width: 30%; margin-left: 1%; margin-right: 1%;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="img/trolley.png" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Заказов</h5>
                        <p class="card-text"><?php echo($row['buys_count'])?></p>
                        <p class="card-text"><small>за сутки</small></p>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
            $result = $mysqli->query('SELECT SUM(`quantity`) as out_quantity_sum FROM `sales_info` WHERE TO_DAYS(NOW()) - TO_DAYS(`out_date`) <= 1 ORDER BY `sale_id` desc' );
            $row = $result->fetch_assoc();
        ?>

        <div class="card text-white bg-info md-3 mb-2 mt-2" style="width: 30%; margin-left: 1%; margin-right: 1%;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="img/today-orders.png" class="card-img mt-2 ml-2" alt="..." >
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Заказано товаров</h5>
                        <p class="card-text"><?php echo($row['out_quantity_sum'])?></p>
                        <p class="card-text"><small>за сутки</small></p>
                    </div>
                </div>
            </div>
        </div>

        <?php
            $result = $mysqli->query('SELECT `prod_name`, `prod_id`, SUM(`quantity`) as today_quantity FROM `sales_info` WHERE TO_DAYS(NOW()) - TO_DAYS(`out_date`) <= 1 GROUP BY `prod_name`, `prod_id` ORDER BY today_quantity DESC' );
            $row = $result->fetch_assoc();
        ?>
        <div class="card bg-light md-3 mb-2 mt-2" style="width: 30%; margin-left: 1%; margin-right: 1%;">
            <div class="row no-gutters">
                <div class="col-md-4" >
                    <img src="img/<?php echo($row['prod_id'])?>.png" class="card-img" alt="..." style="position: absolute; top: 50%;  margin-top: -30px;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Сегодня скупают</h5>
                        <p class="card-text"><?php echo($row['prod_name'])?></p>
                        <p class="card-text"><small class="text-muted"><?php echo($row['today_quantity'])?> продано за сутки</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2>Последние 100 заказов</h2>
    <input class="form-control mt-2 mb-2" id="myInput" type="text" placeholder="Введите условие фильтрации">
    <table class="table table-bordered table-striped">
    <thead>
        <tr>
        <th># Заказа</th>
        <th>Товар</th>
        <th>Прибыль</th>
        <th>Кол-во</th>
        <th>Менеджер</th>
        <th>Дата продажи</th>
        </tr>
    </thead>
    <tbody id="Table">
        <?php
            $result = $mysqli->query('SELECT sale_id, prod_name, rub_price, quantity, manager_name, out_date FROM `sales_info` ORDER BY `sale_id` DESC LIMIT 0,100' )
        ?>
        <?php while( $row = $result->fetch_assoc()):?>           
            <tr>
                <th scope="row"><?php echo($row['sale_id'])?></th>
                <td><?php echo($row['prod_name'])?></td>
                <td><?php echo($row['rub_price'])?> руб</td>
                <td><?php echo($row['quantity'])?></td>
                <td><?php echo($row['manager_name'])?></td>
                <td><?php echo($row['out_date'])?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>
</div> <!--Container-->
<?php require "blocks/footer.php"?>
</body>

<!-- скрипт строки поиска -->
<script> 
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#Table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
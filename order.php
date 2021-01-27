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
    <script language="JavaScript" type="text/javascript" src="js/shop-cart.js"></script>

    

    <title>Заказ оформлен</title>
</head>
<body>
    <?php require "blocks/db-auth.php"?>
    <?php require "blocks/header.php" ?>
    <?php
        foreach($_POST as $key => $value){
            $result = $mysqli->query('Select Max(out_id)+1 as maxId from outgoing');
            $row = $result->fetch_assoc();
            $i =0;
            for(; $i < $key; $i++){}

            if($key > 4)
            {
                
                $out = $mysqli->query('Insert into Outgoing values ('.$row[maxId].','.$i.',2,1,1,Now(),'.$value.',100)');
            }
            else
            {
                $out = $mysqli->query('Insert into Outgoing values ('.$row[maxId].','.$i.',1,1,1,Now(),'.$value.',100)');
            }
        }
    ?>
    
    <div class="jumbotron text-center">
        <h1 class="display-3"><i class="fa  fa-check"></i> Благодарим за заказ!</h1>
        <p class="lead">Скоро наши менеджеры свяжутся с Вами <strong>телепатией</strong>. Следуйте зову сердца!</p>
        <hr>
        <p>
            Ничего не почувствовали? <a href="index.php">Закажите ещё раз!</a>
        </p>
        <p class="lead">
        <a class="btn btn-primary btn-sm" href="index.php" role="button">Вернуться к покупкам</a>
        </p>
    </div>
    <?php require "blocks/footer.php"?>
</body>
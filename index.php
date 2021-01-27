<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/065c397218.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/shop-cart.js"></script>

    

    <title>Индекс.Ларёк</title>
</head>
<body>

    <?php require "blocks/header.php" ?>
    <?php require "blocks/db-auth.php"?>
    <br>
    <div class = "container">
        <?php require "blocks/Prod_list.php"?>
        <h2 id="cart"><i class="fa  fa-shopping-cart"></i> Корзина</h2><br>
        <?php require "blocks/cart.php"?>
    </div>
    
    <?php require "blocks/footer.php"?>
</body>
</html>
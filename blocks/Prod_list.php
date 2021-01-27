<br>
<h2 id="products"><i class="fa  fa-shopping-basket"></i> Покушать</h2>
        <div class="d-flex flex-wrap">
            <?php
                $result = $mysqli->query('SELECT prod_id,Name, Enable_to_purchase(prod_id) as now_in, converting_price(prod_id, 2) as rub_price, Description as Descr FROM products WHERE group_id = 1' )
            ?>
            <?php while( $row = $result->fetch_assoc()):?>
                <?php require "blocks/new_prod_card.php"?>
            <?php endwhile; ?>
        
        </div>
        <br>
        <h2 id="electro"><i class="fa  fa-plug"></i> Занять розетку</h2>
        <div class="d-flex flex-wrap">
            <?php
                $result = $mysqli->query('SELECT prod_id,Name, Enable_to_purchase(prod_id) as now_in, converting_price(prod_id, 2) as rub_price, Description as Descr FROM products WHERE group_id = 2' )
            ?>
            <?php while( $row = $result->fetch_assoc()):?>
                <?php require "blocks/new_prod_card.php"?>
            <?php endwhile; ?>
        
        </div>  
        <br>
        <h2 id="build"><i class="fa  fa-home "></i> Для ремонта</h2>
        <div class="d-flex flex-wrap">
            <?php
                $result = $mysqli->query('SELECT prod_id,Name, Enable_to_purchase(prod_id) as now_in, converting_price(prod_id, 2) as rub_price, Description as Descr FROM products WHERE group_id = 3' )
            ?>
            <?php while( $row = $result->fetch_assoc()):?>
                <?php require "blocks/new_prod_card.php"?>
            <?php endwhile; ?>
        
        </div>
        
        <h2 id="books"><br><i class="fa  fa-book"></i> Сказка на ночь</h2>
        <div class="d-flex flex-wrap">
            <?php
                $result = $mysqli->query('SELECT prod_id, Name, Enable_to_purchase(prod_id) as now_in, converting_price(prod_id, 2) as rub_price, Description as Descr FROM products WHERE group_id = 4' )
            ?>
            <?php while( $row = $result->fetch_assoc()):?>
                <?php require "blocks/new_prod_card.php"?>
            <?php endwhile; ?>
        
        </div>
        <h2 id="school"><br><i class="fa  fa-pencil"></i> в школу</h2>
        <div class="d-flex flex-wrap">
            <?php
                $result = $mysqli->query('SELECT prod_id, Name, Enable_to_purchase(prod_id) as now_in, converting_price(prod_id, 2) as rub_price, Description as Descr FROM products WHERE group_id >= 4' )
            ?>
            <?php while( $row = $result->fetch_assoc()):?>
                <?php require "blocks/new_prod_card.php"?>
            <?php endwhile; ?>
        
        </div>
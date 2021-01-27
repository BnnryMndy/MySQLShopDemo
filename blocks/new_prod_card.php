<div class="card mb-4 shadow-sm" style="width: 23%; margin-left: 1%; margin-right: 1%;">
    <div class="card-body">
        <img class="card-img-top" alt="<?php echo($row['Name'])?>.png, а что?" src="img/<?php echo($row['prod_id'])?>.png" data-holder-rendered="true" style="width: 100%; display: block;">
        <h4 class="my-0 fw-normal"><?php echo($row['Name'])?></h4>
        <h6><?php echo($row['rub_price'])?>&nbspруб</h6>
        <br>
        <?php echo($row['Descr'])?>
        <br>
        <button
            type="button"
            data-prodid = "<?php echo($row['prod_id'])?>"
            data-name="<?php echo($row['Name'])?>"
            data-price="<?php echo($row['rub_price'])?>"
            data-quantity="<?php echo($row['now_in'])?>"
            class="add-to-cart w-100 btn btn-lg btn-outline-primary">
                <i class="fa  fa-cart-plus"></i>  Добавить
        </button>
    </div>
</div>

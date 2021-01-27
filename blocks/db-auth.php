<?php
    /* Подключение к серверу MySQL, лучше так не подключаться */
    $mysqli = new mysqli('localhost', 'root', 'root', 'keksislove');
    if (mysqli_connect_errno()) {
        printf("Подключение к серверу MySQL невозможно. Код ошибки: %s<br>", mysqli_connect_error());
        exit;
    }
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

    </head>
    <body>
        <form action="tratalogin.php" method="post">
            <input type="email" name="email">
            <input type="password" name="pass">
            <input type="submit" name="enviar">
        </form>
    </body>
</html>
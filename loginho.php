<?php
session_start();

if (isset($_SESSION["login"])){
    if ($_SESSION["login"]==false){
        header("location: login.php");
    }
}else{
    header("location: login.php");
}
?>
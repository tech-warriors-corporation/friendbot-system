<?php
    require_once("$prefix_folder/utils/environment.php");

    $connection = new PDO("mysql:host=$server;dbname=$database", $user, $password);
?>

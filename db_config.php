<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $database = '0_projekat2';

    $connection = mysqli_connect($host, $user, $pass, $database);
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die();
    }

    mysqli_query($connection,"SET NAMES utf8") or die (mysqli_error($connection));
    mysqli_query($connection,"SET CHARACTER SET utf8") or die (mysqli_error($connection));
    mysqli_query($connection,"SET COLLATION_CONNECTION='utf8_general_ci'") or die (mysqli_error($connection));

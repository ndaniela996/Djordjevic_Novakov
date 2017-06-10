<?php
    global $connection;
    require_once('db_config.php');

    $user=mysqli_real_escape_string($connection,$_POST['user']);
    $email=mysqli_real_escape_string($connection,$_POST['email']);
    $pass=mysqli_real_escape_string($connection,$_POST['pass']);
    $f_name=mysqli_real_escape_string($connection,$_POST['f_name']);
    $l_name=mysqli_real_escape_string($connection,$_POST['l_name']);



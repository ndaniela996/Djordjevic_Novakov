<?php
    session_start();
    global $connection;
    require_once('db_config.php');
    require_once('salty.php');

    $user=$_POST['user'];
    $user=mysqli_real_escape_string($connection,$user);
    $pass=$_POST['pass'];
    $pass=mysqli_real_escape_string($connection,$pass);
    $pass=$salt1.$pass.$salt2;

    $sql="SELECT id,username FROM person WHERE username='$user' AND password=md5('$pass')";
    $result=mysqli_query($connection,$sql);
    $result=mysqli_fetch_array($result);

    if (!empty($result))
    {
        $user=$result['username'];
        $id=$result['id'];

        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user;

        $sql="";
        $result=mysqli_query($connection,$sql);
    }
    else
    {
        echo "There is no user with that name and/or password. Please try again.";
        die();
    }

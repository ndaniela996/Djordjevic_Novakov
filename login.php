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

    $sql="SELECT username,admin FROM users WHERE username='$user' AND password=md5('$pass')";
    $result=mysqli_query($connection,$sql);

    if (mysqli_num_rows($result)>0)
    {
        while($r=mysqli_fetch_array($result))
        {
            $user=$r['username'];
            $admin=$r['admin'];
        }
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user;

        if($admin)
        {
            $_SESSION['admin'] = true;
        }

        echo 'LOGGED IN';
    }
    else
    {
        echo "There is no user with that name and/or password. Please try again.";
        die();
    }

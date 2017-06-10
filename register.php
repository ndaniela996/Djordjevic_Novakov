<?php
    global $connection;
    require_once('db_config.php');
    require_once('salty.php');

    $user=mysqli_real_escape_string($connection,$_POST['user']);
    $email=mysqli_real_escape_string($connection,$_POST['email']);
    $pass=mysqli_real_escape_string($connection,$_POST['pass']);
    $f_name=mysqli_real_escape_string($connection,$_POST['f_name']);
    $l_name=mysqli_real_escape_string($connection,$_POST['l_name']);
    $address=mysqli_real_escape_string($connection,$_POST['address']);

    if($user!='' && $email!='' && filter_var($email,FILTER_VALIDATE_EMAIL) &&
        $pass!='' && $f_name!='' && $l_name!='')
    {
        $sql="SELECT email FROM users WHERE email='$email'";
        $result=mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)>0)
        {
            echo "That email is already registered.";
        }
        else
        {
            $password=$salt1.$pass.$salt2;
            if($address!='')
            {
                $sql="INSERT INTO users(username, password, email, first_name, last_name, address) VALUES('$user',md5('$password'),'$email','$f_name','$l_name','$address')";
            }
            else
            {
                $sql="INSERT INTO users(username, password, email, first_name, last_name) VALUES('$user',md5('$password'),'$email','$f_name','$l_name')";
            }
            $result=mysqli_query($connection,$sql);

            if(mysqli_affected_rows($connection)==0)
            {
                echo "An error occurred. Please try again.";
            }
        }
    }
    else
    {
        echo "An error occurred. Please try again.";
    }

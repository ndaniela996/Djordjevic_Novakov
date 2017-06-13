<?php
    session_start();
    global $connection;
    require_once('db_config.php');

    $display="";

    if(isset($_POST['add']))
    {
        $add=mysqli_real_escape_string($connection,$_POST['add']);
        $add*=100;
        $user=$_SESSION['id_user'];

        $sql="SELECT credit FROM users WHERE id_user='$user'";
        $result=mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)>0)
        {
            $old_credit='';
            while($r=mysqli_fetch_array($result))
            {
                $old_credit=$r['credit'];
            }

            $credit=$old_credit+$add;

            $sql="UPDATE users SET credit='$credit' WHERE id_user='$user'";
            $result=mysqli_query($connection,$sql);

            if(mysqli_affected_rows($connection)==0)
            {
                $display.="We failed to add the specified amount to your account. Please try again.";
            }
        }
        else
        {
            $display.="ERROR!";
        }
    }
    else if(isset($_POST['remove']))
    {
        $remove=mysqli_real_escape_string($connection,$_POST['remove']);
        $remove*=100;
        $user=$_SESSION['id_user'];

        $sql="SELECT credit FROM users WHERE id_user='$user'";
        $result=mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)>0)
        {
            $old_credit='';
            while ($r=mysqli_fetch_array($result))
            {
                $old_credit=$r['credit'];
            }

            $credit = $old_credit-$remove;

            $sql="UPDATE users SET credit='$credit' WHERE id_user='$user'";
            $result=mysqli_query($connection, $sql);

            if (mysqli_affected_rows($connection)==0)
            {
                $display.="We failed to remove the specified amount from your account. Please try again.";
            }
        }
        else
        {
            $display.="ERROR!";
        }
    }

    echo $display;

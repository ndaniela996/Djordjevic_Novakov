<?php
    session_start();
    global $connection;
    require_once('db_config.php');

    $display="";

    if(isset($_POST['add']) && isset($_POST['user']))
    {
        $add=mysqli_real_escape_string($connection,$_POST['add']);
        $add*=100;
        $user=mysqli_real_escape_string($connection,$_POST['user']);

        if(is_nan($add))
        {
            echo "ERROR! Please enter a number.";
            die();
        }
        elseif($user=='- Choose user -')
        {
            echo "ERROR! Please choose a user.";
            die();
        }

        $sql="SELECT credit FROM users WHERE username='$user'";
        $result=mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)>0)
        {
            $old_credit='';
            while($r=mysqli_fetch_array($result))
            {
                $old_credit=$r['credit'];
            }

            $credit=$old_credit+$add;

            $sql="UPDATE users SET credit='$credit' WHERE username='$user'";
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
    else if(isset($_POST['remove']) && isset($_POST['user']))
    {
        $remove=mysqli_real_escape_string($connection,$_POST['remove']);
        $remove*=100;
        $user=mysqli_real_escape_string($connection,$_POST['user']);

        if(is_nan($remove))
        {
            echo "ERROR! Please enter a number.";
            die();
        }
        elseif($user=='- Choose user -')
        {
            echo "ERROR! Please choose a user.";
            die();
        }

        $sql="SELECT credit FROM users WHERE username='$user'";
        $result=mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)>0)
        {
            $old_credit='';
            while ($r=mysqli_fetch_array($result))
            {
                $old_credit=$r['credit'];
            }

            if($old_credit<$remove)
            {
                $display.="Error! The entered amount is larger than the user's credit.";
            }
            else
            {
                $credit = $old_credit-$remove;

                $sql="UPDATE users SET credit='$credit' WHERE username='$user'";
                $result=mysqli_query($connection, $sql);

                if (mysqli_affected_rows($connection)==0)
                {
                    $display.="We failed to remove the specified amount from your account. Please try again.";
                }
            }
        }
        else
        {
            $display.="ERROR!";
        }
    }

    echo $display;

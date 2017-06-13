<?php
    session_start();
    global $connection;
    require_once('db_config.php');

    $display="";

    if(isset($_POST['id']))
    {
        $id=$_POST['id'];

        $sql="DELETE FROM orders WHERE id_orders='$id'";
        $result=mysqli_query($connection,$sql);

        if(mysqli_affected_rows($connection)==0)
        {
            echo $id."An error occurred while attempting to cancel your order! Please try again.";
            mysqli_close($connection);
            die();
        }
    }

    if(isset($_POST['add_id']) && isset($_POST['num']))
    {
        $id=$_POST['add_id'];
        $user=$_SESSION['id_user'];
        $num=$_POST['num'];
        $price='';

        $sql="SELECT price_sell FROM article WHERE id_article='$id'";
        $result=mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)>0)
        {
            while($r=mysqli_fetch_array($result))
            {
                $price=$r['price_sell'];
                $price=$price*$num;
            }
        }

        $sql="INSERT INTO orders(id_article,id_user,number_ordered,price) VALUES('$id','$user','$num','$price')";
        $result=mysqli_query($connection,$sql);

        if(mysqli_affected_rows($connection)>0)
        {
            echo "Order added to cart.";
        }
        else
        {
            echo "An error occurred while trying to add your order to the cart. Please try again.";
        }

        mysqli_close($connection);
        die();
    }

    if(!isset($_POST['add_id']))
    {
        $sql="SELECT o.id_orders,a.name_article,o.number_ordered,o.price FROM orders o JOIN article a ON a.id_article=o.id_article WHERE delivered='0' ORDER BY o.time DESC";
        $result=mysqli_query($connection,$sql);

        if(mysqli_num_rows($result)>0)
        {
            $display.="<div class='row'>
    <div class='col-md-5'><h4>Article</h4></div>
    <div class='col-md-1'><h4>#</h4></div>
    <div class='col-md-3'><h4>Total</h4></div>
</div>";
            while($r=mysqli_fetch_array($result))
            {
                $price=$r['price']/100;
                $display.="<div class='row'>
    <div class='col-md-5'>".$r['name_article']."</div>
    <div class='col-md-1'>".$r['number_ordered']."</div>
    <div class='col-md-3'>".$price." RSD</div>
    <div class='col-md-3'>
        <button class='btn btn-primary' value='".$r['id_orders']."' style='width: 100%;'>Cancel Order</button>
    </div>
</div>
<hr>";
            }
        }
        else
        {
            $display.="There are no orders to display.";
        }

        echo $display;

        mysqli_close($connection);
    }
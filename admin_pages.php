<?php
    global $connection;
    require_once('db_config.php');

    $page=$_POST['page'];
    $display="";

    switch($page)
    {
        case 'orders':
            $sql="SELECT o.id_orders,a.name_article,u.username,o.number_ordered,o.price,o.time FROM orders o JOIN article a ON a.id_article=o.id_article JOIN users u ON u.id_user=o.id_user WHERE o.delivered=0 ORDER BY o.time ASC";
            $result=mysqli_query($connection,$sql);

            if(mysqli_num_rows($result)>0)
            {
                $display.="<div class='row' style='font-weight: bold; font-size: large; color: #ffffff;'>
    <div class='col-md-3'>
        Time
    </div>
    <div class='col-md-2'>
        Article
    </div>
    <div class='col-md-2'>
        User
    </div>
    <div class='col-md-1'>
        Num
    </div>
    <div class='col-md-3'>
        Total
    </div>
</div>";
                while($r=mysqli_fetch_array($result))
                {
                    $price=$r['price']/100;
                    $display.="<div class='row' style='border-bottom: 1px solid #fff;'>
    <div class='col-md-3' style='padding-top: 10px'>
        ".$r['time']."
    </div>
    <div class='col-md-2' style='padding-top: 10px'>
        ".$r['name_article']."
    </div>
    <div class='col-md-2' style='padding-top: 10px'>
        ".$r['username']."
    </div>
    <div class='col-md-1' style='padding-top: 10px'>
        ".$r['number_ordered']."
    </div>
    <div class='col-md-3' style='padding-top: 10px'>
        ".$price." RSD
    </div>
    <div class='col-md-1'>
        <button class='btn btn-danger nd_deliver' value='".$r['id_orders']."'>Deliver</button>
    </div>
</div>";
                }
            }

            break;
        case 'comments':
            $sql="SELECT c.id_comment,a.name_article,u.username,c.comment,c.time FROM comments c JOIN article a ON a.id_article=c.id_article JOIN users u ON u.id_user=c.id_user ORDER BY c.time";
            $result=mysqli_query($connection,$sql);

            if(mysqli_num_rows($result)>0)
            {
                $display.="<div class='row' style='font-weight: bold; font-size: large; color: #ffffff;'>
    <div class='col-md-3'>
        Time
    </div>
    <div class='col-md-2'>
        Article
    </div>
    <div class='col-md-2'>
        User
    </div>
    <div class='col-md-4'>
        Comment
    </div>
</div>";
                while($r=mysqli_fetch_array($result))
                {
                    $display.="<div class='row' style='border-bottom: 1px solid #fff;'>
    <div class='col-md-3' style='padding-top: 10px'>
        ".$r['time']."
    </div>
    <div class='col-md-2' style='padding-top: 10px'>
        ".$r['name_article']."
    </div>
    <div class='col-md-2' style='padding-top: 10px'>
        ".$r['username']."
    </div>
    <div class='col-md-4' style='padding-top: 10px'>
        ".$r['comment']."
    </div>
    <div class='col-md-1'>
        <button class='btn btn-danger nd_go_to' value='".$r['id_comment']."'>Go To</button>
    </div>
</div>";
                }
            }
            break;
        case 'articles':
            $display="add articles";
            break;
        case 'admins':
            $display="admins";
            break;
        default:
            $display.="Error!";
            break;
    }

    echo $display;
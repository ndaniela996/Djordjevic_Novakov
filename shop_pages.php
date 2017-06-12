<?php
    global $connection;
    require_once('db_config.php');

    $display="";

    if(isset($_POST['type']) && isset($_POST['page']))
    {
        $page_max=10;
        $type=$_POST['type'];
        $page=$_POST['page'];
        $page_to=$page_max*$page;
        $page_skip=($page-1)*$page_max;

        if($type=='all')
        {
            $sql="SELECT * FROM article ORDER BY price_sell ASC";
        }
        else
        {
            $sql="SELECT * FROM article WHERE id_type='$type' ORDER BY price_sell ASC";
        }
        $result=mysqli_query($connection,$sql);

        if(mysqli_num_rows($result))
        {
            $articles=0;
            while($r=mysqli_fetch_array($result))
            {
                if($page_skip<=$articles && $articles<$page_to)
                {
                    if($r['discount']==''){$r['discount']='0.00';}
                    $price_base=$r['price_base']/100;
                    $price_sell=$r['price_sell']/100;

                    $display.="<div class='row'>
    <a href='shop.php?a=".$r['id_article']."'>
        <button class='btn btn-default' style='width: 100%;'>
            <div class='col-md-3 panel-body'>
                <img src='img/articles/".$r['id_article'].".jpg' class='img-responsive'>
            </div>
            <div class='col-md-9'>

                    <h3>".$r['name_article']."</h3>
                    <br>
                    <hr>
                    <h3><small>Discount: ".$r['discount']."%</small></h3>
                    <h3><small><s>".$price_base."</s></small> ".$price_sell." RSD</h3>
            </div>
        </button>
    </a>
</div>";
                }
                $articles++;
            }
        }
    }
    else if(isset($_POST['comment']) && isset($_POST['article']) && isset($_POST['user']))
    {
        $user=mysqli_real_escape_string($connection,$_POST['user']);
        $article=mysqli_real_escape_string($connection,$_POST['article']);
        $comment=mysqli_real_escape_string($connection,$_POST['comment']);

        $sql="INSERT INTO comments(id_article,id_user,comment) VALUES('$article','$user','$comment')";
        $result=mysqli_query($connection,$sql);

        if(!mysqli_affected_rows($connection))
        {
            $display.="An error has occurred. Please try again.";
        }
    }

    echo $display;

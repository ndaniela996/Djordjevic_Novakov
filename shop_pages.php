<?php
    global $connection;
    require_once('db_config.php');

    $display="";

    if(isset($_POST['type']))
    {
        $type=$_POST['type'];
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
                if($r['discount']==''){$r['discount']='0.00';}
                $price_base=$r['price_base']/100;
                $price_sell=$r['price_sell']/100;

                $display.="<div class='row'>
    <button class='btn btn-default' style='width: 100%;' value='".$r['id_article']."'>
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
</div>";
            }
        }
    }

    echo $display;


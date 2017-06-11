<?php
    session_start();
    global $connection;
    require_once('db_config.php');

    if(isset($_SESSION['logged_in']))
    {
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Day - Profile of <?php echo $_SESSION['username']; ?></title>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <link rel="stylesheet"
          href="css/main.css">
    <script src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/scripts_profile.js"></script>
</head>
<body>

<!-- MENU -->
<div class="nav" style="margin-bottom: 20px">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">
                    <strong>New Day</strong>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav md">
                    <li id="home"><a href="index.php">Home</a></li>
                    <li id="shop"><a href="shop.php">Shop</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right md">
                    <?php
                        if (!$_SESSION['logged_in'])
                        {
                            ?>
                            <li id="reg">
                                <a href="" data-toggle="modal" data-target="#register">
                                    <span class="glyphicon glyphicon-user"></span> Sign Up
                                </a>
                            </li>
                            <li id="login">
                                <a href="" data-toggle="modal" data-target="#log_in">
                                    <span class="glyphicon glyphicon-log-in"></span> Login
                                </a>
                            </li>
                            <?php
                        }
                        else
                        {
                            ?>
                            <li id="profile" class="active">
                                <a href="profile.php">
                                    <span class="glyphicon glyphicon-user"></span> Profile
                                </a>
                            </li>
                            <li id="logout">
                                <a href="">
                                    <span class="glyphicon glyphicon-log-out"></span> Log Out
                                </a>
                            </li>

                            <?php
                            if ($_SESSION['admin'])
                            {
                                ?>
                                <button class="btn btn-danger" style="margin-top: 7px; margin-left: 5px"
                                        id="admin_area">
            <span class="glyphicon glyphicon-cog"> ADMIN AREA
                                </button>
                                <?php
                            }
                            else
                            {
                                ?>
                                <li id="cart">
                                    <a href="cart.php">
                                        <span class="glyphicon glyphicon-shopping-cart"></span> Cart
                                    </a>
                                </li>
                                <?php
                            }
                        }
                    ?>
                </ul>
                <form class="navbar-form navbar-right md">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">

                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </nav>
</div>

<?php
    $id_user=$_SESSION['id_user'];
    $sql="SELECT email,first_name,last_name,address,credit,total_spent FROM users WHERE id_user='$id_user'";
    $result=mysqli_query($connection,$sql);

    if(mysqli_num_rows($result))
    {
        while($r=mysqli_fetch_array($result))
        {
            $email=$r['email'];
            $f_name=$r['first_name'];
            $l_name=$r['last_name'];
            $address=$r['address'];
            $credit=$r['credit'];
            $total_spent=$r['total_spent'];
        }
    }
    else
    {
        mysqli_close($connection);
        header("Location:index.php");
        die();
    }
?>
<div class="container">
    <div class="jumbotron">
        <h1>Hello, <?php echo $_SESSION['username']; ?>!</h1>
    </div>
    <?php
        if(isset($_SESSION['admin']))
        {
            ?>
            <script>
                $('.jumbotron').css('background-color',"#C05C48");
            </script>
            <?php
        }
        else
        {
            ?>
            <script>
                $('.jumbotron').css('background-color',"#a5e3f1");
            </script>
            <?php
        }
    ?>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <button class="btn btn-primary" value="account" style="width: 100%;">
                <span class="glyphicon glyphicon-piggy-bank"></span> Account
            </button>
            <button class="btn btn-primary" value="orders" style="width: 100%">
                <span class="glyphicon glyphicon-shopping-cart"></span> Orders
            </button>
            <button class="btn btn-primary" value="settings" style="width: 100%;">
                <span class="glyphicon glyphicon-cog"></span> Profile Settings
            </button>
        </div>
        <div class="col-md-9" id="profile_area">
            <div style="padding: 15px; text-align: center;">
                <p>Name: <?php echo $f_name." ".$l_name; ?></p>
                <p>Email: <?php echo $email ?></p>
                <?php if($address!=''){ ?>
                <p>Address: <?php echo $address; ?></p>
                <?php } ?>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="border-radius: 5px; border: 2px solid #3174d2; text-align: center; font-weight: bold">
                    <p>Current credits</p>
                    <h2><?php
                            if($credit=='')
                            {
                                $credit=0;
                            }
                            else
                            {
                                $credit/=100;
                            }

                            echo $credit." RSD";
                        ?>
                    </h2>
                    <p>Total Spent</p>
                    <h3>
                        <?php
                            if($total_spent=='')
                            {
                                $total_spent=0;
                            }
                            else
                            {
                                $total_spent/=100;
                            }

                            echo $total_spent." RSD";
                        ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php
        mysqli_close($connection);
    }
    else
    {
        header('Location:index.php');
    }
?>
<?php
    session_start();

    if(isset($_SESSION['admin']) && $_SESSION['admin']=true)
    {
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Day - ADMIN AREA</title>
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
    <script src="js/scripts_admin.js"></script>
</head>
<body class="nd_admin">

<!-- MENU -->
<div class="nav" style="margin-bottom: 20px">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
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
                            <li id="profile">
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
                                <button class="btn btn-danger active" style="margin-top: 7px; margin-left: 5px"
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
                <form class="navbar-form navbar-right md" id="search">
                    <div class="input-group">
                        <input id="search_text" type="text" class="form-control" placeholder="Search">

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

<div class="container">
    <div class="row">
        <div class="col-md-2 nd_menu">
            <div>
                <button class="btn btn-danger" id="orders">View Orders</button>
                <button class="btn btn-danger" id="comments">View Comments</button>
            </div>
            <div>
                <button class="btn btn-danger" id="articles">Manage Article</button>
            </div>
            <div>
                <button class="btn btn-danger" id="admins">Add Admin</button>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-9 nd_result">
            <div class="col-md-12">
                <div style="border-radius: 10px; border: 2px solid #ffffff; padding: 10px; margin-bottom: 20px;">
                    <h1>Welcome to the <strong>Admin Area</strong>!</h1>
                    <p>If you are seeing this, it means you are an admin!</p>
                    <p>If you aren't, congratulations! <em>You've hacked us! :D</em></p>
                </div>
                <div style="padding: 10px">
                    <p><strong>Please, navigate using the menu to the left od the screen.</strong></p>
                    <p>Here, you can:</p>
                    <ul>
                        <li>view all undelivered orders</li>
                        <li>view the newest comments from across the whole site</li>
                        <li>add or remove articles</li>
                        <li>add (but not remove) new admins</li>
                    </ul>
                    <p><strong><em>We hope you have a good day!</em></strong></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="confirm_delivery" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Confirm delivery</div>
            </div>
            <div class="modal-body" id="nd_delivery_text">
                Do you really want to mark this order as delivered and charge the appropriate account?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="nd_confirm_deliver">CONFIRM</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php
    }
    else
    {
        header('Location:index.php');
    }
?>


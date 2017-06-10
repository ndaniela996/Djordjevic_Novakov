<?php
//    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>First Page</title>
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
</head>
<body>
<div class="nav">
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
                    <li id="home" class="active"><a href="">Home</a></li>
                    <li id="shop"><a href="shop.php">Shop</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right md">
                    <?php
                        if(!$_SESSION['logged_in'])
                        {
                    ?>
                    <li id="reg"><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li id="login"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php
                        }
                        else
                        {
                    ?>
                    <li id="profile"><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                    <li id="logout"><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                    <?php
                        }
                    ?>
                    <li id="cart"><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
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

<div class="jumbotron">
    <div class="container text-center">
        <h1>New Day</h1>
        <p>A website for all your clothing needs.</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    20% OFF ON ALL JEANS
                </div>
                <div class="panel-body">
                    <a href="shop.php?search=jeans">
                        <img src="img/placeholder-jeans.jpg" class="img-responsive" style="width: 100%;" alt="Jeans">
                    </a>
                </div>
                <div class="panel-footer">
                    In celebration of our new online store, we're having a discount on all jeans.
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    20% OFF ON ALL SNEAKERS
                </div>
                <div class="panel-body">
                    <a href="shop.php?search=sneakers">
                        <img src="img/placeholder-sneakers.jpg" class="img-responsive" style="width: 100%" alt="Sneakers">
                    </a>
                </div>
                <div class="panel-footer">
                    In celebration of our new online store, we're having a discount on all sneakers.
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    20% OFF ON ALL HEELS
                </div>
                <div class="panel-body">
                    <a href="shop.php?search=heels">
                        <img src="img/placeholder-heels.jpg" class="img-responsive" style="width: 100%" alt="Heels">
                    </a>
                </div>
                <div class="panel-footer">
                    In celebration of our new online store, we're having a discount on all heels.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid text-center footer">
    <h2>New Day <small>for all your clothing needs</small></h2>
    <h4><u>About us:</u></h4>
    <p>Address: <small>Marka Oreškovi?a 16,<br>Subotica, Republic of Serbia</small></p>
    <p>Phone: <small>012-345-6789</small></p>
    <p>Email: <small>support@newday.com</small></p>
</div>
</body>
</html>

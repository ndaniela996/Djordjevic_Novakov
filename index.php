<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Day - for all your clothing needs</title>
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

<!-- MENU -->
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
                        if($_SESSION['admin'])
                        {
                ?>
                        <button class="btn btn-danger" style="margin-top: 5px; margin-left: 5px" id="admin_area">
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
                <form class="navbar-form navbar-right md" action="search.php" method="GET">
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

<!-- LOGIN FORM -->
<div id="log_in" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Login</h4>
            </div>
            <form id="login_form">
            <div class="modal-body">
                <div class="form-group" id="username_div">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" aria-describedby="username_help">
                    <span id="username_help" class="help-block"></span>
                </div>

                <div class="form-group" id="password_div">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" aria-describedby="password_help">
                    <span id="password_help" class="help-block"></span>
                </div>
                <p>Dont's have an account? <a href="" data-dismiss="modal" data-toggle="modal" data-target="#register">Sign up!</a></p>
            </div>
            <div class="modal-footer">
                <input type="submit" id="submit_login" class="btn btn-primary" value="Log In">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- ERROR -->
<div id="error" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">ERROR!</div>
            </div>
            <div class="modal-body">
                <span id="error_text" class="help-block"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- REGISTRATION -->
<div id="register" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title"><h4>Register</h4></div>
            </div>
            <form id="register-form">
                <div class="modal-body">
                    <div class="form-group" id="username_register_div">
                        <label for="username_register">Username</label>
                        <input type="text" class="form-control" id="username_register"
                               placeholder="Username" aria-describedby="username_register_help">
                        <span id="username_register_help" class="help-block"></span>
                    </div>

                    <div class="form-group" id="email_register_div">
                        <label for="email_register">Email</label>
                        <input type="text" class="form-control" id="email_register"
                               placeholder="email@mail.com" aria-describedby="email_register_help">
                        <span id="email_register_help" class="help-block"></span>
                    </div>

                    <div class="form-group" id="password_register_div">
                        <label for="password1_register">Password</label>
                        <input type="password" class="form-control" id="password1_register"
                               placeholder="Password" aria-describedby="password_register_help">
                        <input type="password" class="form-control" id="password2_register"
                               placeholder="Confirm Password" aria-describedby="password_register_help">
                        <span id="password_register_help" class="help-block"></span>
                    </div>

                    <div class="form-group" id="f_name_register_div">
                        <label for="f_name_register">First Name</label>
                        <input type="text" class="form-control" id="f_name_register"
                               placeholder="First Name" aria-describedby="f_name_register_help">
                        <span id="f_name_register_help" class="help-block"></span>
                    </div>

                    <div class="form-group" id="l_name_register_div">
                        <label for="l_name_register">Last Name</label>
                        <input type="text" class="form-control" id="l_name_register"
                               placeholder="First Name" aria-describedby="l_name_register_help">
                        <span id="l_name_register_help" class="help-block"></span>
                    </div>

                    <div class="form-group" id="address_register_div">
                        <label for="address_register">Address <small style="color: red;">*optional</small></label>
                        <input type="text" class="form-control" id="address_register"
                               placeholder="Address" aria-describedby="address_register_help">
                        <span id="address_register_help" class="help-block"></span>
                    </div>
                    <p>Already have an account? <a href="" data-dismiss="modal" data-toggle="modal" data-target="#log_in">Log in!</a></p>
                </div>
                <div class="modal-footer">
                    <input type="submit" id="submit_register" class="btn btn-primary" value="Sign Up">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JUMBOTRON -->
<div class="jumbotron">
    <div class="container text-center">
        <h1>New Day</h1>
        <p>A website for all your clothing needs.</p>
    </div>
</div>

<!-- NEWS -->

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

<!-- ABOUT -->
<div class="container-fluid text-center footer">
    <h2>New Day <small>for all your clothing needs</small></h2>
    <h4><u>About us:</u></h4>
    <p>Address: <small>Marka Oreskovica 16,<br>Subotica, Republic of Serbia</small></p>
    <p>Phone: <small>012-345-6789</small></p>
    <p>Email: <small>support@newday.com</small></p>
</div>
</body>
</html>

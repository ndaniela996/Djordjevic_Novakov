<?php
    session_start();
    global $connection;
    require_once('db_config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Day - Shop</title>
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
    <script src="js/scripts_shop.js"></script>
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
                <a class="navbar-brand" href="index.php">
                    <strong>New Day</strong>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav md">
                    <li id="home"><a href="index.php">Home</a></li>
                    <li id="shop" class="active"><a href="shop.php">Shop</a></li>
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
                                    <a href="">
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

<!-- CART -->
<div id="cart_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4><div class="modal-title">Your cart</div></h4>
            </div>
            <div class="modal-body">
                <div id="cart_contents"></div>
            </div>
            <div class="modal-footer">
                <button type="button" value="none" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ADD TO CART -->
<div id="cart_added" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add_to_cart">
            <div class="modal-body">
                <span id="added_cart">
                    <label for="num_ordered">How many of these would you like?</label>
                    <input type="number" id="num_ordered">
                </span>
            </div>
            <div class="modal-footer">
                <input type="submit" id="order_submit" class="btn btn-primary" value="Order!">
                <button type="button" id="close_order" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- PAGE -->
<?php
    $search="";
    $search=$_GET['search'];
    $search=mysqli_real_escape_string($connection,$search);

    if($search=="")
    {
        $article="";
        $article=$_GET['a'];
        $article=mysqli_real_escape_string($connection,$article);
        if($article=="")
        {
            ?>
            <div class="container">
                <div class="row">
                    <!-- TYPES -->
                    <div class="col-md-3" id="nd_type">
                        <button class="btn btn-default" value="all" style="width: 100%;">
                            All
                        </button>
                        <?php
                            $sql="SELECT * FROM type ORDER BY name_type";
                            $result=mysqli_query($connection,$sql);

                            if(mysqli_num_rows($result))
                            {
                                while($r=mysqli_fetch_array($result))
                                {
                                    $display="<button class='btn btn-default' value='".$r['id_type']."' style='width: 100%;'>".
                                        ucfirst($r['name_type'])."</button>";

                                    echo $display;
                                }
                            }
                        ?>
                    </div>

                    <!-- PAGE -->
                    <div class="col-md-9">
                        <input type="hidden" id="nd_page" value="1">
                        <div id="shop_area"></div>

                        <!-- PAGE NAV -->
                        <nav aria-label="Page navigation">
                            <ul class="pager">
                                <li class="previous">
                                    <a href="">
                                        <span aria-hidden="true">&larr;</span> Back
                                    </a>
                                </li>
                                <li class="next">
                                    <a href="">
                                        Next <span aria-hidden="true">&rarr;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <?php
        }
        else
        {
            $sql="SELECT * FROM article WHERE id_article='$article'";
            $result=mysqli_query($connection,$sql);

            if(mysqli_num_rows($result)>0)
            {
                while($r=mysqli_fetch_array($result))
                {
                    ?>
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="article_id" value="<?php echo $r['id_article']; ?>">
                            <div class="col-md-4" style="padding: 5px; border-radius: 10px; border: 3px solid #1e60d3">
                                <img src="img/articles/<?php echo $r['id_article']; ?>.jpg" class="img-responsive">
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-7">
                                <h2>
                                    <?php
                                        echo $r['name_article'];
                                        if($r['discount']!='')
                                        {
                                            echo " - <small>Discount ".$r['discount']."%</small>";
                                        }
                                    ?>
                                    <small>
                                        <a href="shop.php" style="float: right;">
                                            <button class="btn btn-default">Back</button>
                                        </a>
                                        <?php if(isset($_SESSION['logged_in']) && !isset($_SESSION['admin'])){ ?>
                                            <a href="" style="float: right;" id="cart_add">
                                                <button class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
                                                </button>
                                            </a>
                                        <?php } ?>
                                    </small>
                                </h2>
                                <hr style="border-width: 3px; border-color: #1e60d3;">
                                <br>
                                <div style="float: right; text-align: right;">
                                    <h2><small><s><?php echo $r['price_base']/100; echo " RSD"; ?></s></small></h2>
                                    <h1><?php echo $r['price_sell']/100; echo " RSD"; ?></h1>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="padding: 0 10px;">
                            <h2>Comments:
                                <?php if(isset($_SESSION['logged_in'])){ ?>
                                    <small style="float: right;">
                                        <a href="" data-toggle="modal" data-target="#comment">
                                            <button class="btn btn-default">Comment!</button>
                                        </a>
                                    </small>
                                <?php } ?>
                            </h2>
                            <hr style="border-color: #1e60d3;">
                            <?php
                                $sql="SELECT username,comment,time FROM comments cm JOIN users u ON u.id_user=cm.id_user WHERE id_article='$article'";
                                $result=mysqli_query($connection,$sql);

                                if(mysqli_num_rows($result)==0)
                                {
                                    ?>
                                    <h3><small>There are no comments on this article.</small></h3>
                                    <?php
                                }
                                else
                                {
                                    while($r=mysqli_fetch_array($result))
                                    {
                                        ?>
                                        <div>
                                            <h3><?php echo $r['username']; ?><small style="float: right"><?php echo $r['time']; ?></small></h3>
                                            <p><?php echo $r['comment']; ?></p>
                                        </div>
                                        <hr style="border-color: #1e60d3;">
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
        }
    }
    else
    {
?>
<div class="container">
    <div class="row">
        <!-- TYPES -->
        <div class="col-md-3" id="nd_type">
            <button class="btn btn-default" value="all" style="width: 100%;">All</button>
            <?php
                $sql = "SELECT * FROM type ORDER BY name_type";
                $result = mysqli_query($connection, $sql);

                if (mysqli_num_rows($result))
                {
                    while ($r = mysqli_fetch_array($result))
                    {
                        $display = "<button class='btn btn-default' value='" . $r['id_type'] . "' style='width: 100%;'>" .
                            ucfirst($r['name_type']) . "</button>";

                        echo $display;
                    }
                }
            ?>
        </div>

        <!-- PAGE -->
        <div class="col-md-9">
            <input type="hidden" id="nd_searched" value="<?php echo $search; ?>">
            <input type="hidden" id="nd_page" value="1">
            <div id="shop_area"></div>
        </div>
    </div>
</div>
<?php
    }
?>

<!-- COMMENT FORM -->
<div id="comment" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Comment</h4>
            </div>
            <form id="comment_form">
                <div class="modal-body" id="comment_modal_body">
                    <input type="hidden" id="comment_user" value="<?php echo $_SESSION['id_user']; ?>">
                    <input type="hidden" id="comment_article" value="<?php echo $article; ?>">

                    <div class="form-group" id="password_div">
                        <label for="comment_text">Comment:</label>
                        <textarea class="form-control" id="comment_text" placeholder="Type your comment here." aria-describedby="comment_help"></textarea>
                        <span id="comment_help" class="help-block"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" id="submit_comment" class="btn btn-primary" value="Submit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
<?php
    mysqli_close($connection);
?>


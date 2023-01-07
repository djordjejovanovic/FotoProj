<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>User login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body,
        html {
            color: rgb(0, 0, 0);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top navbar-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">FotoProj</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php"><span class="glyphicon glyphicon-home	
                "></span> Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- registration -->
    <div class="container">
        <div class="col-lg-6 col-lg-offset-3">
            <form action="login.php" method="POST">
                <?php include('errors.php'); ?>
                <div class="imgcontainer">
                    <img src="images/avatar.png" alt="Avatar" class="avatar">
                </div>
                <div id="error"></div>
                <div class="divCenter">
                    <label for='username'>Username</label>
                    <br>
                    <input id='username' placeholder="Enter Username" type="text" required name="username"
                        value="<?php if(isset($_COOKIE['username'])) { echo $_COOKIE['username']; } ?>">
                </div>
                <div class="divCenter">
                    <label for='password'>Password</label>
                    <br>
                    <input id='password' placeholder="Enter Password" type="password"
                        pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[a-z]).*$" required name="password"
                        value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>">
                </div>
                <div class="divCenter">
                    <input type="checkbox" name="rememberMe" 
                        <?php if(isset($_COOKIE['rememberMe'])) echo "checked" ?>
                        /> Remember me
                </div>
                <div class="divCenter">
                    <input id="submit_button" name="login_confirm" type="submit" value="Log in">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
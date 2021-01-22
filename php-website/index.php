<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>My Awesome Company </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>
<div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" ><a href="index.php">Home</a></li>
            <li role="presentation"><a href="login.php">Login</a></li>
            <li role="presentation"><a href="register.php">Register</a></li>
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation"><a href="joinus.php">Join us</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">My Awesome Company</h3>
      </div>

      <div class="jumbotron">
      <h1 class="display-4">Hello, world!</h1>
      <p class="lead">This is a very safe web application, don't even think about trying to hack it !!</p>
      <hr class="my-4">
      <p>Want to work for us and learn how to build safe and reliable apps ?</p>
      <p class="lead">
        <a class="btn btn-primary btn-lg" href="./joinus.php" role="button">Join us</a>
      </p>
      </div>

  <?php
    if (isset($_SESSION['message']) && $_SESSION['message'])
    {
      printf('<b>%s</b>', $_SESSION['message']);
      unset($_SESSION['message']);
    }
  ?>
  
</body>
</html>

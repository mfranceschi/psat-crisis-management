<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>PHPSAT </title>
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
          </ul>
        </nav>
        <h3 class="text-muted">PHP SAT</h3>
      </div>

      <div class="jumbotron">
        <h1>Upload your CV here!</h1>

        <form method="POST" action="upload.php" enctype="multipart/form-data">
    <div>
      <span>Upload a File:</span>
      <input type="file" name="uploadedFile" />
    </div>

    <input type="submit" name="uploadBtn" value="Upload" />
  </form>
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

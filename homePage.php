<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>RS-MQF 1200 V.2</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="styles/mediaqueries.css" type="text/css" media="all">
<link rel="stylesheet" href="styles/button.css" type="text/css" media="all">
<script src="scripts/jquery.1.9.0.min.js"></script>
<script src="scripts/jquery-mobilemenu.min.js"></script>
<!--[if lt IE 9]>
<link rel="stylesheet" href="styles/ie.css" type="text/css" media="all">
<script src="scripts/ie/css3-mediaqueries.min.js"></script>
<script src="scripts/ie/ie9.js"></script>
<script src="scripts/ie/html5shiv.min.js"></script>
<![endif]-->
<!-- BEFORE USING THIS FRAMEWORK REMOVE THIS DEMO STYLING - ONLY USED TO EMPHASISE THE DIV CONTAINERS IN THE CONTENT AREA -->

<style type="text/css">
div.full_width{margin-top:20px;}
div.full_width:first-child{margin-top:0;}
div.full_width div{color:#666666; background-color:#fffefe;}
</style>
<!-- END DEMO STYLING -->
</head>
<body>
  <?php
                require __DIR__ . '/functions.php';
                $conn = startConnection();
  ?>
<div class="wrapper row1">
  <header id="header" class="clear">
    <div id="hgroup">
      <h1><a href="#">Bananazon</a></h1>
      <h2>Our banana store</h2>
    </div>
  </header>
</div>
<!-- ################################################################################################ -->
<div class="wrapper row2">
  <nav id="topnav">
    <ul class="clear">
      <li class="active first"><a href="homePage.php?user_id=<?php echo($_GET[user_id])?>">Homepage</a></li>
      <li><a href="#"></a></li>
      <li><a href="orderHistory.php?user_id=<?php echo($_GET[user_id])?>">Order history</a></li>
      <li><a href="shoppingCart.php?user_id=<?php echo($_GET[user_id])?>">Cart</a></li>
      <li><a href="login.php">Logout</a></li>
    </ul>
  </nav>
</div>
<!-- content -->
<div class="wrapper row3">
<div id="container">
<!-- ################################################################################################ -->
<div class="full_width clear">
  
  <?php
    $sql = "SELECT item_ID, name, price, image FROM Items";
    $result = mysqli_query($conn, $sql);

    echo('<table>');
      echo('<tr>');
      while ($row = mysqli_fetch_assoc($result)) {
        if((htmlentities($row['item_ID']))%3 == 1){ //only display 3 items per row
          echo('</tr>');
          echo('<tr>');
        }
        echo('<td>');
        echo('<div class="imgContainer">');
          echo('<div>');
                    echo('<div>');
              echo("<h2>".htmlentities($row['name']). " - " . htmlentities($row['price']). " kr/item</h2>");
              echo('<a href="inspect.php?user_id='.$_GET[user_id].'&item_id='.$row['item_ID'].'" ><img src='.htmlentities($row['image']).' style="width:300px;height:300px;"></a>');
            echo('</div>');
                    echo('<div class="imgButton">');
              echo('<a  class="button" href="">Buy</a>');
            echo('</div>');
          echo('</div>');
        echo('</div>');
        echo('</td>');
      }
      echo('</tr>');
    echo('</table>');
  ?>

<?php
  closeConnection($conn);
?>
</body>
</html>
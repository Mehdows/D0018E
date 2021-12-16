<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>RS-MQF 1200 V.2</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="styles/mediaqueries.css" type="text/css" media="all">
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
div.full_width div{color:#666666; background-color:#DEDEDE;}

</style>
<!-- END DEMO STYLING -->
</head>
<body>

    <?php
        require __DIR__ . '/functions.php';
        $conn = startConnection();
    ?>

    <style>
        table, th, td {
            border:1px solid black;
        }
    </style>

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
        <li class="active first"><a href="homePage.php?user_id=<?php echo($_GET['user_id'])?>">Homepage</a></li>
        <li><a href="#"></a></li>
        <li><a href="orderHistory.php?user_id=<?php echo($_GET['user_id'])?>">Order history</a></li>
        <li><a href="shoppingCart.php?user_id=<?php echo($_GET['user_id'])?>">Cart</a></li>
        <li><a href="login.php">Logout</a></li>
    </ul>
    </nav>
</div>

<!-- content -->
<div class="wrapper row3">
<div id="container">

<!-- ################################################################################################ -->

    <div class="full_width clear">
    <h2>Shopping cart</h2>

    <?php
        $user_ID = $_GET['user_id'];
        $sql = "SELECT name, amount, Items.price FROM OrderItems 
        JOIN Items ON OrderItems.item_ID = Items.item_ID WHERE OrderItems.order_ID in 
            (SELECT order_ID FROM Orders WHERE customer_ID = $user_ID AND bought = '0')";
        $result = mysqli_query($conn, $sql);
    ?>

    <table style="width:100%">
        <tr>
            <th>Item</th>
            <th>Amount</th>
            <th>Cost</th>
        </tr>

        <?php
            $costTot = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo('
                    <tr>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['amount'].'</td>
                    <td>'.$row['price'].'</td>
                    </tr>
                ');
                $costTot += $row['amount']*$row['price'];
            }
        ?>
        
    </table>

    <?php
        echo('<h3>Total Cost: '.$costTot. ' kr</h3>');
    ?>
    <form class="form" method="post" name="adress">
        <div class="container">
            <label for="adress"><b>adress</b></label>
            <input type="text" 
            placeholder="Enter Adress" 
            name="adress" 
            required 
        />
    </form>
    <div class="imgButton">
        <button value="test">Buy</button>
    </div>

    <?php
        
        if(isset($_POST['adress'])) {

            $user_ID = $_GET['user_id'];
            
            //CHECK IF STOCK WILL BE NEGATIVE AFTER PURCHASE
            $order = "SELECT order_ID FROM `Orders` WHERE customer_ID='$user_ID' AND bought=0";
            $order_query = mysqli_query($conn, $order) ;
            $order_ID = mysqli_fetch_assoc($order_query);
            
            $orderList = "SELECT * FROM `OrderItems` WHERE order_ID = '$order_ID'";
            $orderList = mysqli_query($conn, $orderList) ;
            
            $adress = $_POST['adress'];    
            $today = date("Y/m/d");

            while($row = mysqli_fetch_assoc($orderList)){
                $item_ID = $row['item_ID'];
                $amount = $row['amount'];
                $query = "SELECT stock FROM `items` WHERE item_ID = '$item_ID'";
                $stock = mysqli_query($conn, $query) ;
                if($stock < $amount){
                    mysqli_rollback($conn);
                    break;
                }
                $currentPrice = $Row['price'];
                $newStock = $Row['stock'] - $amount;
                
                //Updates to the new
                $query = "UPDATE `items` SET stock = '$newStock' WHERE item_ID = '$item_ID'";
                $update = mysqli_query($conn, $query) ;
                    
                //Set the current price in history
                $query = "UPDATE `OrderList` SET price='$currentPrice' WHERE item_ID='$item_ID'";
                $update = mysqli_query($conn, $query) ;
                    

            }
        }
        
    ?>



    <?php
    closeConnection($conn);
    ?>
</body>
</html>
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
    <h2>Orders</h2>
</body>
<?php
    $user_ID = $_GET['user_id'];
    $query = "SELECT * FROM Orders WHERE customer_ID = $user_ID AND bought = 1";
    $orders = mysqli_query($conn, $query);
    
    while($order = mysqli_fetch_assoc($orders)){
        echo('<h1>
        Order ID: '.$order['order_ID'].' Purchase Date: '.$order['purchase_Date'].' Sent to: '.$order['adress'].'
        </h1>');
        $order_ID = $order['order_ID'];
        $query = "SELECT * FROM OrderItems WHERE order_ID = $order_ID";
        $orderItems = mysqli_query($conn, $query);
        echo('<table style="width:100%">
        <tr>
                    <td>item ID</td>
                    <td>item name</td>
                    <td>amount</td>
                    <td>price</td>
                    <td>info</td>
                
        </tr>');
        while($items = mysqli_fetch_assoc($orderItems)){
            $item_ID = $items['item_ID']; 
            $query = "SELECT * FROM Items WHERE item_ID = $item_ID";
            $itemInfo = mysqli_query($conn, $query);
            $itemInfo = mysqli_fetch_assoc($itemInfo);
            echo('
                <tr>
                    <td>'.$items['item_ID'].'</td>
                    <td>'.$itemInfo['name'].'</td>
                    <td>'.$items['amount'].'</td>
                    <td>'.$items['price'].'</td>
                    <td>'.$itemInfo['info'].'</td>
                </tr>
            ');}
    echo('</table>');
    }

?>
<!--
        <div class="full_width">Order</div>
        <div class="one_third">One Third</div>
        <div class="one_third">One Third</div>
    </div>

    <div class="full_width clear">
        <div class="one_third first">One Third</div>
        <div class="two_third">Two Third</div>
    </div>

    <div class="full_width clear">
        <div class="two_third first">Two Third</div>
        <div class="one_third">One Third</div>
    </div>
-->

    <!-- ################################################################################################ -->
</div>
</div>
<!-- Footer -->
<!--
<div class="wrapper row4">
    <footer id="footer" class="clear">
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    </footer>
</div>
-->
<?php
    closeConnection($conn);
?>

</html>
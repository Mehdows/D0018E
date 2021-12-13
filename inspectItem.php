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

.container {
	max-width: 640px;
	margin: 30px auto;
	background: #fff;
	border-radius: 8px;
	padding: 20px;
}

.comment {
	display: block;
	transition: all 1s;
}
.commentClicked {
	min-height: 0px;
	border: 1px solid #eee;
	border-radius: 5px;
	padding: 5px 10px
}

.container textarea {
	width: 100%;
	border: none;
	background: #E8E8E8;
	padding: 5px 10px;
	height: 50%;
	border-radius: 5px 5px 0px 0px;
	border-bottom: 2px solid #016BA8;
	transition: all 0.5s;
	margin-top: 15px;
}

button.primaryContained {
	background: #016ba8;
	color: #fff;
	padding: 10px 10px;
	border: none;
	margin-top: 0px;
	cursor: pointer;
	text-transform: uppercase;
	letter-spacing: 4px;
	box-shadow: 0px 2px 6px 0px rgba(0, 0, 0, 0.25);
	transition: 1s all;
	font-size: 10px;
	border-radius: 5px;
}

button.primaryContained:hover {
	background: #9201A8;
}

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



<!-- ################################################################################################ -->

<div class="wrapper row3">
<div id="container">

<?php
    
    $curr_id = $_GET['item_id'];
    $sql = "SELECT name, stock, price, info, image FROM Items WHERE item_ID = $curr_id";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);

    echo('<h2>'.$row["name"].'</h2>');
?>
        <td>
            <div class="imgContainer">
                <div>
                    <img src=
                    <?php
                        echo(htmlentities($row['image'])); 
                    ?>
                    style="width:300px;height:300px;">
                </div>
                <div class="imgButton">
                    <button value="test">buy</button>
                </div>
            </div>
        </td>

    <div class="full_width clear">
        <div class="one_third first">
            <?php
                echo($row["stock"]. ' items in stock');
            ?>
        </div>
        <div class="two_third">
            <?php
                echo($row["info"]);
            ?>
        </div>
    </div>


    <div class="full_width clear">
        <div class="one_third first">Total grading</div>
        <div class="one_third second">
            <?php
                echo($row["price"]. ' kr/item');
            ?>
        </div>
    </div>

    <section id="app">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="comment">
                        <p v-for="items in item" v-text="items"></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <textarea type="text" class="input" placeholder="Write a comment" v-model="newItem" @keyup.enter="addItem()"></textarea>
                    <button v-on:click="addItem()" class='primaryContained float-right' type="submit">Add Comment</button>
                </div>
            </div>
        </div>
    </section>


</div>
</div>
    <!-- ################################################################################################ -->

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

</body>
</html>
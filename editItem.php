<?php
    session_start();
?>

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
    <li><a href="adminHome.php?user_id=<?php echo($_GET['user_id'])?>">Homepage</a></li>
    <li><a href="adminItems.php?user_id=<?php echo($_GET['user_id'])?>">Items</a></li>
    <li><a href="adminUsers.php?user_id=<?php echo($_GET['user_id'])?>">Users</a></li>
    <li><a href="logout.php">Logout</a></li>
    </ul>
    </nav>
</div>

<!-- content -->



<!-- ################################################################################################ -->

<div class="wrapper row3">
<div id="container">

<?php

    $item_id = $_GET['item_id'];

    if ( isset($_POST['name']) && isset($_POST['image']) && isset($_POST['info'])
    && isset($_POST['price']) && isset($_POST['stock'])) {

        //check for empty fields
        if (empty($_POST['name']) || empty($_POST['image']) || empty($_POST['info'])
            || empty($_POST['price'])) {
            echo("You may not leave fields empty");
            echo "<br>";
            goto exitIf;
        }

        //check for numbers
        if (is_numeric($_POST['stock']) == 0 || is_numeric($_POST['price']) == 0) {
            echo("Stock and price must be numbers");
            echo "<br>";
            goto exitIf;
        }

        //check for negative numbers
        if ($_POST['stock'] < 0 || $_POST['price'] < 0) {
            echo("You may not have negative numbers");
            echo "<br>";
            goto exitIf;
        }

        $stmt = $conn->prepare("UPDATE Items SET name = ?, stock= ?, price = ?, info = ?, image = ? WHERE item_ID = $item_id");

        $name = $_POST['name'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];
        $info = $_POST['info'];
        $image = $_POST['image'];

        $stmt->bind_param("siiss", $name, $stock, $price, $info, $image);
        if ($stmt->execute()){
            echo("Updated successfully");
        } else {
            echo("Could not update, please try again");
        }
        echo("<div></div>");

        exitIf:
    }

    $sql = "SELECT * FROM Items WHERE item_ID = $item_id";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);

    echo('
        <img src='.htmlentities($row['image']).' style="width:300px;height:300px;">
    ');

    //The form
    $n = htmlentities($row['name']);
    $s = htmlentities($row['stock']);
    $p = htmlentities($row['price']);
    $in = htmlentities($row['info']);
    $im = htmlentities($row['image']);
    $id = $row['item_ID'];
    ?>
    <p>Edit Item</p>
    <form method="post" action="<?php echo (htmlspecialchars($_SERVER["PHP_SELF"]) . '?user_id=' . $_GET['user_id'] . '&item_id=' . $_GET['item_id']);?>">
    <p>Name:
    <input type="text" name="name" value="<?= $n ?>"></p>
    <p>Stock:
    <input type="text" name="stock" value="<?= $s ?>"></p>
    <p>Price:
    <input type="text" name="price" value="<?= $p ?>"></p>
    <p>Info:
    <textarea name="info" rows="5" cols="60"><?= $in ?></textarea></p>
    <p>Image:
    <textarea name="image" rows="2" cols="60"><?= $im ?></textarea></p>
    <input type="hidden" name="item_ID" value="<?= $id ?>">
    <p><input type="submit" value="Update"/>
    <a href="adminItems.php?user_id=<?php echo($_GET['user_id'])?>">Cancel</a></p>
    </form>


</div>
</div>

<?php
    closeConnection($conn);
?>

</body>
</html>
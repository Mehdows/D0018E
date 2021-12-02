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
      <li><a href="adminHome.php?user_id=<?php echo($_GET[user_id])?>">Homepage</a></li>
      <li class="active"><a href="adminItems.php?user_id=<?php echo($_GET[user_id])?>">Items</a></li>
      <li><a href="adminUsers.php?user_id=<?php echo($_GET[user_id])?>">Users</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
    </nav>
</div>

<!-- content -->
<div class="wrapper row3">
<div id="container">

<!-- ################################################################################################ -->

    <div class="full_width clear">
    <h2>Item List</h2>

    <?php
        $sql = "SELECT item_ID, name, stock, price FROM Items";
        $result = $conn->query($sql);
    ?>

    <table style="width:100%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Edit</th>
        </tr>

        <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo('
                    <tr>
                    <td>'.$row[item_ID].'</td>
                    <td>'.$row[name].'</td>
                    <td>'.$row[price].'</td>
                    <td>'.$row[stock].'</td>
                    <td><a href="editItem.php?user_id='.$_GET[user_id].'&item_id='.$row['item_ID'].'">Edit Item</a></td>
                    </tr>
                ');
            }
            
        ?>
        
    </table>

<?php
    echo "<br>";
    echo('<a  class="button" href="addItem.php?user_id='.$_GET[user_id].'">Add new item</a>');
    closeConnection($conn);
?>
</body>
</html>
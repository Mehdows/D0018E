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
    if ($_GET['status'] == 0){
        $statusName = 'Active';
        $statusNew = '1';
    } else if ($_GET['status'] == 1){
        $statusName = 'Inactive';
        $statusNew = '0';
    }


    if ( isset($_POST['status']) && isset($_POST['customer_id']) ) {
        try {
            $id = $_POST['customer_id'];

            //Set customer to inactive/active
            $stmt1 = $conn->prepare("UPDATE Customers SET active = $statusNew WHERE customer_ID = ?");
            $stmt1->bind_param("i", $id);
            $stmt1->execute();


            //Delete the the users cart items
            $stmt2 = $conn->prepare("DELETE FROM OrderItems WHERE order_ID IN (SELECT order_ID FROM Orders WHERE customer_ID = ? AND bought = '0')");
            $stmt2->bind_param("i", $id);
            $stmt2->execute();


            //Delete the the users cart 
            $stmt3 = $conn->prepare("DELETE FROM Orders WHERE customer_ID = ? AND bought = '0'");
            $stmt3->bind_param("i", $id);
            $stmt3->execute();


            echo('Set '.$statusName.' successfully for '.$id);
            mysqli_commit($conn);
            header( 'Location: adminUsers.php?user_id='.$_GET['user_id']);

        } catch (mysqli_sql_exception $exception) {
            $mysqli->rollback();
            echo("Could not change status, please try again");
            throw $exception;
        }

        return;
    }

    $customer_id = $_GET['customer_id'];
    $sql = "SELECT name, customer_ID FROM Customers WHERE customer_ID = $customer_id";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);


    //The form
    $n = htmlentities($row['name']);
    $id = $row['customer_ID'];

    echo("<p>Set Customer ".$id.", ".$n.", to: ".$statusName."</p><br/>");
    ?>
    <form method="post" action="<?php echo (htmlspecialchars($_SERVER["PHP_SELF"]) . '?user_id=' . $_GET['user_id'] . '&customer_id=' . $_GET['customer_id'] . '&status=' . $_GET['status']);?>">
    <input type="hidden" name="customer_id" value="<?=$id?>">
    <input type="submit" name="status" value="<?=$statusName?>">
    <a href="adminUsers.php?user_id=<?php echo($_GET['user_id'])?>">Cancel</a></p>
    </form>


</div>
</div>

<?php
    closeConnection($conn);
?>

</body>
</html>
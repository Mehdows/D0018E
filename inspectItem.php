<!DOCTYPE html>
<html lang="en" dir="ltr">
<title>RS-MQF 1200 V.2</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="styles/mediaqueries.css" type="text/css" media="all">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

<!-- stars -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
	<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
	<link rel='stylesheet' href='https://raw.githubusercontent.com/kartik-v/bootstrap-star-rating/master/css/star-rating.min.css'>

<script src="scripts/jquery.1.9.0.min.js"></script>
<script src="scripts/jquery-mobilemenu.min.js"></script>

<!-- stars -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/index.js"></script>




<!--[if lt IE 9]>
<link rel="stylesheet" href="styles/ie.css" type="text/css" media="all">
<script src="scripts/ie/css3-mediaqueries.min.js"></script>
<script src="scripts/ie/ie9.js"></script>
<script src="scripts/ie/html5shiv.min.js"></script>
<![endif]-->

<!-- BEFORE USING THIS FRAMEWORK REMOVE THIS DEMO STYLING - ONLY USED TO EMPHASISE THE DIV CONTAINERS IN THE CONTENT AREA -->

<style type="text/css">

div.full_width{margin-top:10px;}
div.full_width:first-child{margin-top:0;}
div.full_width div{color:#666666; background-color:#DEDEDE;}

.container {
	max-width: 640px;
	margin: 30px auto;
	background: #fff;
	border-radius: 8px;
	padding: 5px;
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
    
    $item_id = $_GET['item_id'];
    $sql = "SELECT name, stock, price, info, image FROM Items WHERE item_ID = $item_id";
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
                <form method="post">
              <input type="hidden" name="item_ID" value="buy" >
              <input type="submit" name="buy" value="Buy">
              </form>
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


<!-- #############################  Grading     ############################################### -->


<!-- HTML for the grading system -->
<body>
<h3><b>Rating</b></h3>
<div class="container mt-5">
    <form action="" method="post" class="mb-3">
    <div class="select-block">
        <select name="Rating">
            <option value="" disabled selected>Choose option</option>
            <option value="1">One star</option>
            <option value="2">Two stars</option>
            <option value="3">Three stars</option>
            <option value="4">Four stars</option>
            <option value="5">Five stars</option>
        </select>
    </div>
    <input type="submit" name="Rate" vlaue="Choose options">
    </form>

    <?php
    //PHP for the grading system
    $itemId = $_GET['item_id'];
    $customer_ID = $_GET['user_id'];

        if(isset($_POST['Rate'])){
            if(!empty($_POST['Rating'])) {
            $selected = $_POST['Rating'];

            // Check rating inside the table
            $itemId = $_GET['item_id'];
            $customer_ID = $_GET['user_id'];
            
            $query = "SELECT COUNT(*) AS countProduct FROM Grading WHERE item_id = " . $itemId . " and customer_id = " . $customer_ID;
            
            $result = mysqli_query($conn, $query);
            $getdata = mysqli_fetch_array($result);
            $count = $getdata['countProduct'];
            
            if($count == 0){
                $insertquery = "INSERT INTO Grading (customer_id, item_id, Grade) VALUES (". $customer_ID .", ". $itemId .", ". $selected .")";
                mysqli_query($conn, $insertquery);
            }else {
                $updateRating = "UPDATE Grading SET Grade=" . $selected . " where customer_id=" . $customer_ID . " and item_id=" . $itemId;
                mysqli_query($conn, $updateRating);
            }
            
            echo 'You have chosen: ' . $selected;
        } else {

            echo 'Please select the value.';
        }
        }
    ?>
</div>

</body>

</html>

<?php
    // avg function
    $query = mysqli_query($conn,"SELECT AVG(Grade) as AVGGrade from Grading where item_id = $item_id");
    $row = mysqli_fetch_array($query);
    $AVGGrade=$row['AVGGrade'];

    if($AVGGrade <= 0){
        $AVGGrade = 0;
    }
?>


<!-- avg star html -->
	<div class="row">
	
		<div class="col-md-6">
			<h3 align="center"><b><?php echo round($AVGGrade,1);?></b> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i></h3>
        </div>
    </div>
</div>


<!-- #################################  Comment  ##################################################### -->

<!-- Comment box html -->
<div class="panel panel-default">
<div class="panel-heading">Submit Your Comments</div>
    <div class="panel-body">
    <form method="post">
	    <div class="form-group">
	        <label for="exampleInputPassword1">Subject</label>
	        <textarea name="comment" class="form-control" rows="3"></textarea>
	    </div>
	<button type="submit" name="text" class="btn btn-primary">Submit</button>
	</form>
    </div>
<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
</div>


<?php
// Put comments into the database
if(isset($_POST['text']) & !empty($_POST['comment'])){
    echo('test test');
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $item_id = $_GET['item_id'];
    $user_id = $_GET['user_id'];

	$isql = "INSERT INTO Comments (customer_ID, item_id, comment) VALUES ('$user_id', '$item_id', '$comment')";
	$ires = mysqli_query($conn, $isql) or die(mysqli_error($conn));
	if($ires){
		$smsg = "Your Comment Submitted Successfully";
	}else{
		$fmsg = "Failed to Submit Your Comment";
	}
}
?>
<?php

$user_ID = $_GET['user_id'];



$query = "SELECT * FROM Orders WHERE customer_ID = '$user_ID' AND bought = 0";
$res = mysqli_query($conn, $query);
$rows = mysqli_num_rows($res);
if ($rows == 0){
  echo("\n$user_ID\n");
  $query = "INSERT INTO Orders (customer_ID) VALUES ($user_ID)";
  $return = mysqli_query($conn, $query) ;
}


if(isset($_POST['buy'])){
  
  $item_ID = $_GET['item_id'];
  $order_ID = mysqli_query($conn, $query);
  $order_ID = mysqli_fetch_assoc($order_ID);
  $order_ID = $order_ID['order_ID'];

  $query = "SELECT * FROM OrderItems WHERE order_ID = $order_ID AND item_ID = $item_ID";
  $item = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($item);

  if ($row){
    
    $amount = $row['amount'] + 1;
    
    $query = "UPDATE OrderItems SET amount = $amount WHERE order_ID = $order_ID AND item_ID = $item_ID";
    $result = mysqli_query($conn, $query);
  
  }else{
    
    $query = "INSERT INTO OrderItems (order_ID, item_ID, amount) VALUES ($order_ID, $item_ID, 1)";
    $result = mysqli_query($conn, $query);
    
  }

  unset($_POST['buy']);

}
?>



<!-- See Comments html -->
<div class="panel panel-default">
	<div class="panel-heading">Comments</div>
	<table class="table table-striped"> 
		<thead> 
			<tr> 
				<th>Name</th> 
				<th>Comment</th> 
			</tr> 
		</thead> 
		<tbody> 

        <?php
        // Take comments from database
        $item_id = $_GET['item_id'];
        $sql = "SELECT name, comment FROM Comments 
                JOIN Customers ON Comments.customer_ID = Customers.customer_ID
                WHERE item_ID ='$item_id'";
                
        $res = mysqli_query($conn, $sql);
        ?>
        <?php
	    while ( $r = mysqli_fetch_assoc($res)) {
        ?>
	    <tr> 
		    <th scope="row"><?php echo $r['name']; ?></th> 
		    <td><?php echo $r['comment']; ?></td> 
	    </tr> 
        <?php } ?> 

		</tbody> 
	</table>
</div>


    <!--
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
    -->

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
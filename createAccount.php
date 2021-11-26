<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #04AA6D;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 20%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
    display: block;
    float: none;
    }
    .cancelbtn {
    width: 100%;
    }
}
</style>
</head>
<body>

<?php
    require('databaseCode.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['name'])) {
        // removes backslashes
        $name = stripslashes($_REQUEST['name']);
        //escapes special characters in a string
        $name = mysqli_real_escape_string($con, $name);
        $pssword = stripslashes($_REQUEST['pssword']);
        $pssword = mysqli_real_escape_string($con, $pssword);
        $query    = "INSERT into `Customers` (name, pssword)
                    VALUES ('$name', '" . md5($pssword) . "' )";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                <h3>You are registered successfully.</h3><br/>
                <p class='link'>Click here to <a href='login.php'>Login</a></p>
                </div>";
        } else {
            echo "<div class='form'>
                <h3>Required fields are missing.</h3><br/>
                <p class='link'>Click here to <a href='createAccount.php'>registration</a> again.</p>
                </div>";
        }
    } else {
?>



<!--- <form action="/action_page.php" method="post"> --->

    <form class="form" action="" method="post">
        <h2>Create an account</h2>
        <div class="container">
        <label for="uname"><b>name</b></label>
        <input type="text" class="login-input" placeholder="Enter Username" name="name" required>

        <label for="psw"><b>Pssword</b></label>
        <input type="password" class="login-input" placeholder="Enter Password" name="pssword" required>
        
        <button class="link"><a href="login.php">Register</a></button>

        </div>

        <div class="container" style="background-color:#f1f1f1">
        <button type="button" class="cancelbtn" onclick="window.location.href='login.php';"> Cancel </button
        </div>
    </form>

<?php
    }
?>

</body>
</html>
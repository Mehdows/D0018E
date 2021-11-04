<?php


$conn = NULL;

echo 'hello world';
startDb();
createTable();
getUsers();
closeDb();



function startDb() {
  $servername = "localhost";
  $username = "username";
  $password = "password";

  // Create connection
  
  $conn = mysqli_connect($servername, $username, $password);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully";

}

function createTable() {
  Global $conn;

  //Make Table
  $sql = "CREATE TABLE MyUsers (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    passwrd VARCHAR(30) NOT NULL,
    
    )";//Todo: Add cart and cart history

  $sql = "INSERT INTO MyUsers (username, passwrd)
  VALUES ('Admin', 'Admin123')";

  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

function closeDb() {
  Global $conn;
  mysqli_close($conn);
}

function createUser($username, $password){
  Global $conn;
  $sql = "INSERT INTO MyUsers (username, passwrd)
  VALUES ($username, $password)";

  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

function getUsers(){
  global $conn;
  $sql = "SELECT id, firstname, lastname FROM MyUsers";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      echo "id: " . $row["id"]. " - User: " . $row["username"]. " " . $row["passwrd"]. "<br>";
    }
  } else {
    echo "0 results";
  }

}

?>
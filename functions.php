<?php

function startConnection() {
  $servername = "130.240.200.63";
  $username = "ConnectUser";
  $password = "ConnectUser";
  $db = "D0018E";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $db);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  //echo "Connected successfully";
  return $conn;
}


function closeConnection($conn) {
  $conn->close();
  //echo "Closed connection";
}


function getAllItems($conn) {
    $sql = "SELECT item_ID, name, price, image FROM Items";
    $result = $conn->query($sql);
    
    return $result;
}
?>
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
  mysqli_begin_transaction($conn);
  mysqli_autocommit($conn, false);
  return $conn;
}



function closeConnection($conn) {
  mmysqli_commit($conn);
  $conn->close();
  //echo "Closed connection";
}

?>
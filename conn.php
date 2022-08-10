<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "latihan";

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);

// Check connection
if (!$conn) {
  die("Connection failed: " . $conn->connect_error);
}

<?php
$servername = "localhost";
$username = "root";
$password = "root";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

// Lav Database
$sql = "CREATE DATABASE RTS";
if ($conn->query($sql) === TRUE) {
	echo "Database created successfully". "<br>";
} else {
		echo "Error creating database: ". $conn->error. "<br>";
}

// Lav brugertabel
$users = "CREATE TABLE RTS.users (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	username VARCHAR(30) NOT NULL,
	password VARCHAR(30) NOT NULL
)";

if ($conn->query($users) === TRUE){
	echo "Table created successfully". "<br>";
} else {
	echo "Error creating Table: ". $conn->error. "<br>";
}

$usernamePost = $_POST["username"];

$result = $conn->query("SELECT 1 FROM RTS.users WHERE `username` = '$usernamePost'");

//echo '$result'. "<br>";

if ($result && mysqli_num_rows($result) > 0){
	echo 'Username is already taken'. "<br>";
} 
else 
{
	$sql = "INSERT INTO RTS.users (username, password) 
	VALUES ('".$_POST['username']."', '".$_POST['password']."')";
	if ($conn->query($sql) === TRUE) {
		echo "Bruger tilføjet". "<br>";
	}
	else
	{
		echo "Fejl ved tilføjelse af bruger". $conn->error. "<br>";
	}
}

?>



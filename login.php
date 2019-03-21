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

// Lav tabel til users
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
$passwordPost = $_POST["password"];


$result = $conn->query("SELECT 1 FROM RTS.users WHERE `username` = '$usernamePost'");
if ($result && mysqli_num_rows($result) > 0){
	
	$sql = "SELECT password FROM RTS.users WHERE username = '". $usernamePost."'";
	
	echo $sql. "<br>";
	
	$res=$conn->query($sql);
	
	$row = $res->fetch_assoc();
	echo $row['password']. "<br>";
	
	echo $passwordPost. "<br>";
	
	if ($row['password'] === $passwordPost){
		echo 'Hej'. "<br>";
		
		//session til at gemme hvem der er logget ind
		session_start();
		$_SESSION["username"] = $usernamePost;
		
		//sætter sessionen til at huske id
		$sql = "SELECT id FROM RTS.users WHERE username = '". $usernamePost."'";
		$res=$conn->query($sql);
		$row = $res->fetch_assoc();
		echo $row['id']. "<br>";
		$_SESSION["id"] = $row['id'];
		
		//sender brugen til selve siden efter de har logget ind
		header("Location: http://localhost/site.php");
	}
}
?>

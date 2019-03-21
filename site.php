<?php 
session_start();

// Lav tabel til users
$users = "CREATE TABLE RTS.diagrams (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(30) NOT NULL,
	owner VARCHAR(30) NOT NULL,
	score 
)";
if ($conn->query($users) === TRUE){
	echo "Table created successfully". "<br>";
} else {
	echo "Error creating Table: ". $conn->error. "<br>";
}



?>

<!DOCTYPE html>
<html>
	Velkommen "<?php echo $_SESSION["username"].'"'."<br>"; ?>
	Bruger nummer:<?php echo $_SESSION["id"]."<br>"; ?>
	<head>
		<title>Really Tired Seal</title>
	</head>
	<body>
		<h2>Create Diagram</h2>
		<form action="/createDiagram" method="post">
		  Diagram name: <input type="text" name="dName"><br>
		  <input type="submit" value="Submit">
		</form>
	</body>
</html>
	
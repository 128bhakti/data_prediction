<html>
	<head>
		<title>Insert</title>
	</head>
	<body>
		<center>
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "nutrition";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			// prepare and bind
			$stmt = $conn->prepare("INSERT INTO sample (age,education,income,gender) VALUES (?,?,?,?)");
			$stmt->bind_param("ssss",$age,$edu,$income,$gen);

			// set parameters and execute
			
			$age = $_POST["age"];
			$edu = $_POST["edu"];
			$income = $_POST["income"];
			$gen = $_POST["gen"];
			
			
			$stmt->execute();

			
			if($stmt)
			{
				//header('Location: choice.html');
				echo "New User created successfully";
			}
			else{
				//header('Location: signup.html');
				echo "Unsuccessful";
			}
			
			//echo "New User created successfully";

			$stmt->close();
			$conn->close();
		?>
		<br><br>
		<h3><a href="Login.html">Proceed for LOGIN</a></h3>
		<center>
	</body>
</html>


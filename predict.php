<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<center>
		<?php
		
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "nutrition";
			
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			
			if($conn->connect_error)
			{
				die("Connaction Failed: ".$conn->connect_error);
			}
			
			$age = $_POST["age"];
			$edu = $_POST["edu"];
			$income = $_POST["income"];
			$gen = "Female";
			$fn = 0;
			
			//$sql="SELECT age,education,income,gender FROM sample where age = '$age' AND education = '$education' AND income = '$income'";
			$sql="SELECT age,education,income,gender FROM sample";
			
			$result = $conn->query($sql);
			$tn = $result->num_rows;
			$flag=0;
			if($result->num_rows > 0)
			{
				echo "<center><table border='2'><tr><th>Age </th><th>Education</th><th>Income</th><th>Gender</th></tr>";

				while($row = $result->fetch_assoc())
				{
					//if(!(strcmp($age,$row["age"])&& strcmp($edu,$row["education"])&& strcmp($income,$row["income"])&& strcmp($gen,$row["gender"])))
					if(!(strcmp($gen,$row["gender"])))
					{
						
						
							$fn = $fn + 1;
							$flag=1;
						
					//	header('Location: choice.html');
					}
					
					if(!(strcmp($gen,$row["gender"])&& strcmp($gen,$row["gender"])))
					{
						
						
							$fn = $fn + 1;
							$flag=1;
						
					//	header('Location: choice.html');
					}
	
					echo "<tr><td>".$row["age"]."</td><td>".$row["education"]."</td><td>".$row["income"]."</td><td>".$row["gender"]."</td></tr>";
					//echo "<tr><td>".$result["age"]."</td><td>".$result["education"]."</td><td>".$result["income"]."</td><td>".$result["gender"]."</td></tr>";
				}
				echo "</table></center>";
			}
			else
			{
				echo "0 number of Comments found";
			//	header('Location: login.html');
			}
			
			
			
			//Prediction code:
			$mn = $tn - $fn;
			
			$p = $fn/$tn;
			$n = $mn/$tn;
			
			
			if($flag==1)
			{
				//header('Location: login.html');
				echo "Total (N):".$tn;
				echo "<br>Male:".$mn;
				echo "<br>Female:".$fn;
				echo "<br>P(Male):".$p;
				echo "<br>P(Female):".$n;
				
				
			}
			else{
				echo "0 number of results found";
				echo "Data found:".$tn."<br>".$mn;
			}

			
			$result->close();
		
			$conn->close();
			
		
		?>
	</body>
</html>
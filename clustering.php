<?php


echo "<a href='health_regression.php'><- Go Back</a>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dm_db";

		
		$bmi=array();

$k1=10;
$k2=13;
$k3=23;

$x=0;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM health_dataset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		$bmi[$x]=$row["bmi_new"];
		$x++;
        //echo "<br> Height: ". $row["height"]. " Weight: ". $row["weight"]. " BMI:" . $row["bmi"] . "<br>";
		
    }
	
	$arrlength = count($bmi);
	/*for($x = 0; $x < $arrlength; $x++) {
		
	echo $bmi[$x];
   
    echo "<br>";
	}*/
	//
	
	//$test = 10;
	
		$newk1 = $bmi[$k1];
		$newk2 = $bmi[$k2];
		$newk3 = $bmi[$k3];
	
	do {

		$c1=array();  	$cc1=0;
		$c2=array();	$cc2=0;
		$c3=array();	$cc3=0;
		
		$oldk1 = $bmi[$k1];
		$oldk2 = $bmi[$k2];
		$oldk3 = $bmi[$k3];
		
		$sum1=0;
		$sum2=0;
		$sum3=0;
		
	for($i=0;$i<$arrlength;$i++)
	{
		$t1=abs($bmi[$i]-$newk1);
		$t2=abs($bmi[$i]-$newk2);
		$t3=abs($bmi[$i]-$newk3);
		
		//echo $bmi[$i]."===".$t1."--".$t2."--".$t3."\t";
		
		if ( $t1 == min($t1,$t2,$t3) ) {
			$c1[$cc1++] = $bmi[$i];
			$sum1 += $bmi[$i];
		}
		
		if ( $t2 == min($t1,$t2,$t3) ){
			$c2[$cc2++] = $bmi[$i];
			$sum2 += $bmi[$i];	
		}
		
		
		if ( $t3 == min($t1,$t2,$t3) ){
			$c3[$cc3++] = $bmi[$i];
			$sum3 += $bmi[$i];
		}
		
	}
		
		$oldk1 = $newk1;
		$oldk2 = $newk2;
		$oldk3 = $newk3;
		
		$newk1 = $sum1/$cc1;
		$newk2 = $sum2/$cc2;
		$newk3 = $sum3/$cc3;
		
		/*echo $oldk1."--".$newk1."<br>";
		echo $oldk2."--".$newk2."<br>";
		echo $oldk3."--".$newk3."<br>";*/
		
	}
	
	while (($newk1 != $oldk1) && ($newk2 != $oldk2) && ($newk3 != $oldk3));
	
		/*echo $oldk1."--".$newk1."<br>";
		echo $oldk2."--".$newk2."<br>";
		echo $oldk3."--".$newk3."<br>";*/
	
	//while($test-- != 0);
	
	echo "<br><br>";
	
	/*for($x = 0; $x < $cc1; $x++) {
		
		echo $c1[$x]."\t";
	}
	
	echo "<br><br>";
	for($x = 0; $x < $cc2; $x++) {
		
		echo $c2[$x]."\t";
	}
	echo "<br><br>";
	for($x = 0; $x < $cc3; $x++) {
		
		echo $c3[$x]."\t";
	}
	*/
	
	echo "<center><h1>K-Mean Clustering:</h1>";
	
	echo "<table border=1><tr><th>TYPE</th><th>TOTAL</th></tr>";
	echo "<tr><td>Underweight</td><td>".$cc1."</td></tr>";
	echo "<tr><td>Proper weight</td><td>".$cc2."</td></tr>";
	echo "<tr><td>Overweight</td><td>".$cc3."</td></tr></table>";
	echo "<br><br>";
	echo "You will need to follow the below chart for the maximum people... So work on it the best!<br><br>";
	
	
	if (max($cc1,$cc2,$cc3)==$cc1)
	{
		echo "Underweight people's chart!<br>";
		echo "<img src='w1.jpg'>";
		
		echo "<h3>Other charts are also ready.</h3><br><br>";
		echo "For normal people's chart!<br>";
		echo "<img src='w2.jpg'>";
		echo "<br><br>Overweight people's chart!<br><br>";
		echo "<img src='w3.png'>";
		
	}
	else if (max($cc1,$cc2,$cc3)==$cc3)
	{
		echo "<img src='w3.png'>";
		echo "Other charts are also ready.<br>";
		echo "<img src='w1.jpg'>";
		echo "<img src='w2.jpg'>";
		
		
	}
	else if (max($cc1,$cc2,$cc3)==$cc2){
		echo "<img src='w2.jpg'>";
		echo "Other charts are also ready.<br>";
		echo "<img src='w1.jpg'>";
		echo "<img src='w3.png'>";
	}
	
	echo "</center>";
	
	
	
	
	
	
	
	
	
} 

else {
    echo "0 results";
}

$conn->close();




?>


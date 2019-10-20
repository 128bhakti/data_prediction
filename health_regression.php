<?php

 echo "<a href='Clustering.php'>Click here to find the maximum people that visits you!</a>";
 
mysqli_connect("localhost","root","","dm_db");
$db = mysqli_connect('localhost','root','','dm_db')
 or die('Error connecting to MySQL server.');

 $sql = "select * from  health_dataset";
$result=mysqli_query($db,$sql);
$i=0;
while ($row = mysqli_fetch_array($result)) {
  $bmi[$i]=$row['bmi'];
  $rf[$i]=$row['riskfactor'];
  $i++;
  
}
//$data=array(18.5,19,21,17.8,25.2,32.5,39);
//$deta=array(20,21,25,18,39,51,65);
$bmi2=$_GET["bmi"];		//get bmi from user using which the heart risk factor will be calculated

$var=array(linear_regression($bmi,$rf,$bmi2));

/**
 * linear regression function
 * @param $x array x-coords
 * @param $y array y-coords
 * @returns array() m=>slope, b=>intercept
 */

function linear_regression($x, $y, $bmi2) {

  // calculate number points
  $n = count($x);
  
  // to ensure both arrays of points are the same size
  if ($n != count($y)) {

    trigger_error("linear_regression(): Number of elements in coordinate arrays do not match.", E_USER_ERROR);
  
  }

  // calculate sums
  $x_sum = array_sum($x);
  $y_sum = array_sum($y);

  $xx_sum = 0;
  $xy_sum = 0;
  
  for($i = 0; $i < $n; $i++) {
  
    $xy_sum+=($x[$i]*$y[$i]);
    $xx_sum+=($x[$i]*$x[$i]);
    
  }
  
  // calculate slope
  $b = (($n * $xy_sum) - ($x_sum * $y_sum)) / (($n * $xx_sum) - ($x_sum * $x_sum));
  
  // calculate intercept
  $m = ($y_sum - ($b * $x_sum)) / $n;
    
  

  ///calculating performance :RMSE (Root Mean Square Error)
for($i = 0; $i < $n; $i++) {
  
   $new[$i]=$m+($b*$x[$i]);   //predicted y (i.e.predicted risk factor)
   //echo "<br>$new[$i]";
   $u=((($new[$i]-$y[$i])*($new[$i]-$y[$i]))/$n);   //rmse formula
  }
  $rmse=sqrt($u);

  $risk=$m+($b*$bmi2);


// display result
  echo "<h1 align='center'>Risk factor prediction for heart disease</h1>";
  echo "<table width='400' height='130' border='3' align='center'><tr><th align='center'>BMI</th><th>Predicted Risk factor(%)</th></tr>";
  echo "<tr><td align='center'>$bmi2</td><td align='center'>$risk</td></tr>";
  echo "</table>";

  echo "<hr>";
  //echo "<br> Your risk factor is predicted as: $risk %";
  echo "<br>";
   echo "<br>";
  echo "<br>";
echo "<center>";
  echo "<table><tr><td>";
echo "<img src='risk.jpg'>";
echo "</td><td>";

echo "<img src='heart_disease.jpg'>";
echo "</td></tr></table>";
echo "</center>";
echo "<br><br>";
echo "<h2><u>Linear regression</u></h2><br><h3>Coefficients:</h3>";
echo ' a='.$m.',   b='.$b.' ';
echo "<h3>Performance Vector (Root Mean square Error):</h3>";
  echo "$rmse";
  return true;

}

?>

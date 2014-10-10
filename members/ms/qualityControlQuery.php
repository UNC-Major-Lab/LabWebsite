<?php
$con=mysqli_connect("sql1.csbio.unc.edu","dennisg","ciS6ah7d","signal");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM quameter");

$to_encode = array();
while($row = mysqli_fetch_array($result)) {
    $to_encode[] = $row;
}

mysqli_close($con);

echo json_encode($to_encode);
?>
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$conn = new mysqli("localhost", "root", "", "exam_reg");
if ($conn->connect_error) {
    die("Error" . $conn->connect_error);
}
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$name=$_POST["name"];
	$passing=$_POST["password"];
	$sql="select * from reg where name=?";
	$stmt=$conn->prepare($sql);
	if($stmt===false)
{
	die("Error".$conn->error);
}
$stmt->bind_param("s",$name);
$stmt->execute();
$result=$stmt->get_result();

if($result->num_rows>0)
{
$user=$result->fetch_assoc();
if(password_verify($user['pass'],$passing))
{
echo "success";
}
else
{
echo "failed";
}
}
else{
	echo " no user found";
}
$stmt->close();
}
$conn->close();
?>

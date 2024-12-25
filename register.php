<?php
error_reporting(E_ALL);
ini_set("displaying_errors",1);
$conn=new mysqli("localhost","root","","exam_reg");
if($conn->connect_error)
{
	die("Error".$conn->connect_error);
}
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$name=$_POST["name"];
$email=$_POST["email"];
$mobile=$_POST["mobile"];
$pass=$_POST["password"];
$sql="insert into reg values (?,?,?,?)";
$stmt=$conn->prepare($sql);
if($stmt===false)
{
	die("Error here".$conn->error);
}
$pass=password_hash($pass,PASSWORD_BCRYPT);
$stmt->bind_param("ssss",$name,$email,$mobile,$pass);
if($stmt->execute())
{
	header("Location:main.html");
}
else
{
	echo " Error".$stmt->error;
}
$stmt->close();
}
$conn->close();
?>
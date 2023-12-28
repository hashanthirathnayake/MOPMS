<?php 
$servername ="localhost";
$username ="root";
$password = "";
$db="register";

//create creation
$conn= mysqli_connect($servername,$username,$password,$db);

// check connection 
if(!$conn){
    die("connection failed:" . mysqli_connect_error());
    return "Error";

}
$id= $_POST["id"];
$sql= "DELETE FROM registration WHERE id=$id";
$result= mysqli_query($conn,$sql);
if($result){
    echo true;
}

?>
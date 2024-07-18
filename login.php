<?php

$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "mydatabase"; 

$conn = new mysqli($servername, $username, $password, $dbname); 

if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
   $id = $_GET['id'];
   $pwd = $_GET['password']; 

   $sql = "SELECT pwd FROM login WHERE id=?"; 
   $stmt = $conn->prepare($sql); 
   $stmt->bind_param("s", $id); 
   $stmt->execute(); 

   $dbpwd = $stmt->get_result()->fetch_assoc()['pwd']; 
   if($dbpwd) {
     $match = password_verify($pwd, $dbpwd); 
     if($match) {
        echo("로그인 성공!"); 
     }else {
        echo("비밀번호가 틀립니다."); 
     }
   }else {
     echo "해당 아이디가 존재하지 않습니다."; 
   }

   
   $conn->close(); 
   exit(); 
}







?> 
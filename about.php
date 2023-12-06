<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'photography';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection Error " . $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
function val($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$name = val($_POST['name']);
$email = val($_POST['email']);
$number = val($_POST['number']);


$stmt = $conn->prepare("INSERT INTO users (`name`, `email`, `number`) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $name, $email, $number);
$result = $stmt->execute();


if($result){
    header('location:index.php?success=Submitted Successfully');
    exit();
}else{
    echo "Error " . $stmt->error;
}
$stmt->close();
$conn->close();
}
?>
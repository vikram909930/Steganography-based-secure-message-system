<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}
    $conn = new mysqli("localhost", "root", "", "enc");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userId = $_SESSION['id']; 
    $imageData = $_POST['imageData'];
    $operationType = 'encryption';
    $message=$_POST['inputData'];
    
if ($imageData) {

    $filteredData = explode(',', $imageData);
    $base64Data = $filteredData[1];
    $decodedData = base64_decode($base64Data); 

    $sql = "INSERT INTO history (user_id, image, message, operation_type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ibss", $userId, $decodedData, $message, $operationType);
    $stmt->execute();
    $stmt->close();
}
}
$conn->close();
?>
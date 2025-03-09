<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = hash("sha256", $password);

    $conn = new mysqli("localhost", "root", "", "enc");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Username or Email already exists.'); window.location.href='register.html';</script>";
    } else {
        
        $stmt = $conn->prepare("INSERT INTO users(username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='register.html';</script>";
        } else {
            echo "<script>alert('Error: Could not register.'); window.location.href='register.html';</script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
<?php
session_start();
session_set_cookie_params(0);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST['username']; // Assuming the form input name is 'username_or_email'
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "root", "", "enc");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id,password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $input, $input);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id,$hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && hash_equals($hashed_password, hash("sha256", $password))) {
    	$_SESSION['id'] = $id;
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $input; 
        session_regenerate_id(true); 
        header("Location: index.php");
    }    
else {
        echo "<script>alert('Invalid credentials.'); window.location.href='login.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
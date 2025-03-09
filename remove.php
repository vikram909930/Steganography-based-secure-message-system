<?php
session_start();

$conn = new mysqli("localhost", "root", "", "enc");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    if (empty($username)) {
        $_SESSION['message'] = "Username is required";
        $_SESSION['msg_type'] = "error";
    } else {
        $sql = "DELETE FROM users WHERE username = ?"; 

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $username);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $_SESSION['message'] = "User '$username' has been successfully deleted.";
                    $_SESSION['msg_type'] = "success";
                } else {
                    $_SESSION['message'] = "No user found with username '$username'.";
                    $_SESSION['msg_type'] = "error";
                }
            } else {
                $_SESSION['message'] = "Error executing query: " . $conn->error;
                $_SESSION['msg_type'] = "error";
            }
            $stmt->close();
        } else {
            $_SESSION['message'] = "Error preparing query: " . $conn->error;
            $_SESSION['msg_type'] = "error";
        }
    }
    header("Location: remove.php"); 
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: rgb(231, 231, 231);
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 20px 40px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 400px;
            position: relative;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #ff8c42;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ff7043;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            color: white;
        }

        .alert.success {
            background-color: #4CAF50;
        }

        .alert.error {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert <?= $_SESSION['msg_type'] ?>">
                <?= $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); unset($_SESSION['msg_type']); ?>
        <?php endif; ?>

        <h2>Delete User</h2>
        <form action="remove.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <button type="submit">Delete User</button>
        </form>
    </div>
</body>
</html>
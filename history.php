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

$userId = $_SESSION['id'];
$stmt = $conn->prepare("SELECT id, image, message, operation_type, created_at FROM history WHERE user_id = ?");
$stmt->bind_param("s", $userId);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $image, $message, $operationType, $createdAt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            padding: 20px;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table th, .history-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .history-table th {
            background-color: #007acc;
            color: white;
        }

        .history-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .history-table tr:hover {
            background-color: #ddd;
        }

        .image-preview {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h1>History</h1>
    <table class="history-table">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>message</th>
            <th>Operation Type</th>
            <th>Timestamp</th>
        </tr>
        <?php while ($stmt->fetch()): ?>
        <tr>
            <td><?php echo htmlspecialchars($id); ?></td>
            <td><img src="data:image/png;base64,<?php echo base64_encode($image); ?>" alt="Image Preview" class="image-preview"></td>
            <td><?php echo htmlspecialchars($message); ?></td>
            <td><?php echo htmlspecialchars($operationType); ?></td>
            <td><?php echo htmlspecialchars($createdAt); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
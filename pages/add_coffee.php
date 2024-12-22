<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("INSERT INTO coffee_menu (name, description, price) VALUES (?, ?, ?)");
    $stmt->execute([$name, $description, $price]);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Coffee</title>
</head>
<body>
    <h1>Add New Coffee</h1>
    <form method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>
        
        <label for="price">Price:</label><br>
        <input type="number" step="0.01" id="price" name="price" required><br><br>
        
        <button type="submit">Add Coffee</button>
    </form>
</body>
</html>

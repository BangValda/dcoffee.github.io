<?php
include '../includes/config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM coffee_menu WHERE id = ?");
$stmt->execute([$id]);
$menu = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$menu) {
    die("Menu not found!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("UPDATE coffee_menu SET name = ?, description = ?, price = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $id]);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Coffee</title>
</head>
<body>
    <h1>Edit Coffee</h1>
    <form method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($menu['name']); ?>" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required><?= htmlspecialchars($menu['description']); ?></textarea><br><br>
        
        <label for="price">Price:</label><br>
        <input type="number" step="0.01" id="price" name="price" value="<?= htmlspecialchars($menu['price']); ?>" required><br><br>
        
        <button type="submit">Update Coffee</button>
    </form>
</body>
</html>

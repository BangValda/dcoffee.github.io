<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "dcoffee");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Tambahkan menu baru
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $category = $_POST["category"];

    // Proses unggahan file gambar
    if (isset($_FILES["image_file"]) && $_FILES["image_file"]["error"] == 0) {
        $upload_dir = "uploads/"; // Direktori penyimpanan file
        $image_name = uniqid() . '_' . basename($_FILES["image_file"]["name"]); // Nama unik untuk file
        $image_path = $upload_dir . $image_name;

        // Buat direktori jika belum ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Pindahkan file ke direktori penyimpanan
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $image_path)) {
            // Simpan data ke database
            $sql = "INSERT INTO coffee_menu (name, image_url, description, price, category) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssds", $name, $image_path, $description, $price, $category);
            $stmt->execute();
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "No file uploaded or there was an error.";
    }
}

// Ambil data menu dikelompokkan berdasarkan kategori
$menusByCategory = [];
$sql = "SELECT * FROM coffee_menu ORDER BY category, name";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $menusByCategory[$row["category"]][] = $row;
}

// Hapus menu
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];

    // Hapus file gambar dari server
    $result = $conn->query("SELECT image_url FROM coffee_menu WHERE id = $id");
    $row = $result->fetch_assoc();
    if ($row && file_exists($row["image_url"])) {
        unlink($row["image_url"]); // Hapus file
    }

    $conn->query("DELETE FROM coffee_menu WHERE id = $id");
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style></style>
<body>
    <div class="container py-5">
        <h1>Manage Coffee Menu</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Coffee Name" class="form-control mb-2" required>
            <input type="file" name="image_file" class="form-control mb-2" accept="image/*" required>
            <textarea name="description" placeholder="Description" class="form-control mb-2"></textarea>
            <input type="number" step="0.01" name="price" placeholder="Price" class="form-control mb-2" required>
            <select name="category" class="form-select mb-2" required>
                <option value="Hot Coffee">Hot Coffee</option>
                <option value="Iced Coffee">Iced Coffee</option>
                <option value="Food">Food</option>
                <option value="Snack">Snack</option>
                <option value="Merchant">Merchant</option>
                <option value="Recommendation">Recommendation</option>
            </select>
            <button type="submit" name="add" class="btn btn-primary">Add Menu</button>
        </form>

        <h2 class="mt-5">Existing Menus</h2>
        <?php foreach ($menusByCategory as $category => $menus): ?>
            <h3><?= htmlspecialchars($category) ?></h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($menus as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row["name"]) ?></td>
                        <td><img src="<?= htmlspecialchars($row["image_url"]) ?>" width="100" alt="<?= htmlspecialchars($row["name"]) ?>"></td>
                        <td><?= htmlspecialchars($row["description"]) ?></td>
                        <td>$<?= number_format($row["price"], 2) ?></td>
                        <td>
                            <a href="?delete=<?= $row["id"] ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    </div>
      

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

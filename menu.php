<?php
session_start(); // Pastikan sesi dimulai di awal

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "dcoffee");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Menambahkan item ke keranjang
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => 1
        ];
    }
    header("Location: cart.php");
    exit();
}




// Ambil kategori yang tersedia
$categories_result = $conn->query("SELECT DISTINCT category FROM coffee_menu");
$categories = [];
while ($row = $categories_result->fetch_assoc()) {
    $categories[] = $row['category'];
}

// Pencarian dan filter kategori
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$sql = "SELECT * FROM coffee_menu WHERE name LIKE ? AND (category LIKE ?)";
$stmt = $conn->prepare($sql);
$searchTerm = '%' . $search . '%';
$categoryTerm = '%' . $category_filter . '%';
$stmt->bind_param("ss", $searchTerm, $categoryTerm);
$stmt->execute();
$menus = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'Coffee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/background.jpg');
            background-size: cover;
        }
        .category-list {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
        }
        .foto-menu {
            height: 200px;
            width: 200px;
            border-radius: 10px;
        }
        
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row">
        <!-- Sidebar Categories -->
        <div class="col-md-3">
            <div class="category-list">
                <h5>Categories</h5>
                <ul class="list-unstyled">
                    <?php foreach ($categories as $category): ?>
                        <li>
                            <a href="?category=<?= urlencode($category) ?>&search=<?= htmlspecialchars($search) ?>" 
                               class="text-decoration-none <?= $category_filter === $category ? 'fw-bold' : '' ?>">
                                <?= htmlspecialchars($category) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!-- Product Grid -->
        <div class="col-md-9">
            <!-- Search Bar -->
            <div class="search-bar mb-4">
                <form method="GET" action="menu.php">
                    <input type="hidden" name="category" value="<?= htmlspecialchars($category_filter) ?>">
                    <input type="text" name="search" class="form-control" placeholder="Search Items" 
                           value="<?= htmlspecialchars($search) ?>">
                </form>
            </div>
            <!-- Product Cards -->
            <div class="row g-3">
                <?php while ($row = $menus->fetch_assoc()): ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="<?= htmlspecialchars($row['image_url']) ?>" class="foto-menu container mt-3 rounded" alt="<?= htmlspecialchars($row['name']) ?>">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?= htmlspecialchars($row['name']) ?></h5>
                                <p class="fw-bold">Rp.<?= number_format($row['price'], ) ?></p>
                                <form method="POST" action="">
                                    <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="product_name" value="<?= htmlspecialchars($row['name']) ?>">
                                    <input type="hidden" name="product_price" value="<?= $row['price'] ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php if ($menus->num_rows === 0): ?>
                    <div class="col-12 text-center">
                        <p>No items found matching your search.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

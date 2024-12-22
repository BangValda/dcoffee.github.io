<?php
session_start(); // Memulai session

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "dcoffee");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Update jumlah produk di keranjang melalui AJAX
if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    }

    // Kirimkan total harga produk sebagai respons AJAX
    $total_price = $_SESSION['cart'][$product_id]['quantity'] * $_SESSION['cart'][$product_id]['price'];
    echo json_encode(['total_price' => $total_price]);
    exit();
}

// Hapus item dari keranjang
if (isset($_GET['delete'])) {
    $product_id = $_GET['delete'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]); // Menghapus item dari keranjang
    }
    header("Location: cart.php"); // Redirect ke halaman keranjang
    exit();
}

// Ambil data keranjang
$cart_items = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cart - D'Coffee</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/background.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .cart-header {
            background-color: #f8f9fa;
            border-bottom: 2px solid #ddd;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cart-header h1 {
            font-size: 24px;
            font-weight: bold;
        }

        .cart-header input {
            width: 300px;
            border-radius: 20px;
            border: 1px solid #ccc;
            padding: 5px 15px;
        }

        .table tbody tr {
            background-color: white;
            height: 150px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table img {
            margin-top: 20px;
            height: 100px;
            border-radius: 5px;
        }

        .delete-link {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }

        .delete-link:hover {
            text-decoration: underline;
        }
        .body-cart {
            margin-top: 50px;
        }
    </style>
</head>
<body>
        <!-- Navbar -->

        <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <img src="img/coffee-beans.png" alt="Logo">
            D'COFFEE
        </a>
        <!-- Toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Icons -->
                <li class="nav-item">
                        <!-- Logout link -->
                        <a class="btn btn-sign-in mx-2" href="logout.php">About</a>
                    </li>
                    <li class="nav-item">
                        <!-- Logout link -->
                        <a class="btn btn-sign-in mx-2" href="menu.php">Menu</a>
                    </li>

                <!-- User Info and Logout Button -->
                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <!-- Logout link -->
                        <a class="btn btn-sign-in mx-2" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-dark" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-sign-in mx-2" href="form.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="body-cart">

<div class="container py-4">
    <!-- Cart Table -->
    <div class="table-responsive mt-4">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"><input type="checkbox"></th>
                <th scope="col">Produk</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody class="body-cart">
            <!-- Tampilkan Item di Keranjang -->
            <?php foreach ($cart_items as $id => $item): ?>
                <?php
                    // Ambil URL gambar produk dari database (asumsi gambar sudah ada di dalam database)
                    $product_query = $conn->prepare("SELECT image_url FROM coffee_menu WHERE id = ?");
                    $product_query->bind_param("i", $id);
                    $product_query->execute();
                    $product_result = $product_query->get_result();
                    $product = $product_result->fetch_assoc();
                    $image_url = $product['image_url'] ?? 'https://via.placeholder.com/80'; // Jika tidak ada gambar, tampilkan placeholder
                ?>
                <tr data-id="<?= $id ?>">
                    <td><input type="checkbox"></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="<?= htmlspecialchars($image_url) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                            <div class="ms-3">
                                <h6 class="fw-bold mb-0"><?= htmlspecialchars($item['name']) ?></h6>
                            </div>
                        </div>
                    </td>
                    <td><p class="mt-5">Rp<?= number_format($item['price'],) ?></p></td>
                    <td>
                        <input  type="number" class="form-control quantity mt-5" value="<?= $item['quantity'] ?>" style="width: 60px;">
                    </td>
                    <td class="total-price"><p class="mt-5">Rp<?= number_format($item['price'] * $item['quantity']) ?></p></td>
                    <td><a href="cart.php?delete=<?= $id ?>" class="delete-link"><p class="mt-5">Delete</p></a></td>
                </tr>
            <?php endforeach; ?>

            <!-- Jika Keranjang Kosong -->
            <?php if (empty($cart_items)): ?>
                <tr style="height:50px;">
                    <td colspan="6" class="text-center">Your cart is empty.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Update quantity and total price dynamically
        $('.quantity').on('change', function () {
            let row = $(this).closest('tr');
            let productId = row.data('id');
            let quantity = $(this).val();

            $.post('cart.php', {update_quantity: true, product_id: productId, quantity: quantity}, function (response) {
                let data = JSON.parse(response);
                row.find('.total-price').text('Rp' + parseFloat(data.total_price).toLocaleString('id-ID', {minimumFractionDigits: 2}));
            });
        });
    });
</script>
</body>
</html>

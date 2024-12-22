<?php
session_start();

// Konfigurasi database
$host = 'localhost';
$user = 'root';
$password = ''; // Ganti dengan password database Anda
$dbname = 'dcoffee'; // Ganti dengan nama database Anda

// Koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    // Login
 // Login
 if ($action === 'login') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['email']; // Menyimpan nama user dalam session
            header('Location: index.php'); // Ganti dengan lokasi halaman utama
            exit();
        } else {
            $error = 'Invalid password.';
        }
    } else {
        $error = 'No account found with this email.';
    }
}


    // Register
    elseif ($action === 'register') {
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);
        $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

        if ($password === $confirm_password) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";

            if ($conn->query($query)) {
                $_SESSION['user_id'] = $conn->insert_id;
                $_SESSION['user_email'] = $email;
                header('Location: form.php'); // Ganti dengan lokasi dashboard Anda
                exit();
            } else {
                $error = 'Error creating account. Please try again.';
            }
        } else {
            $error = 'Passwords do not match.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'Coffee Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/login.jpg'); /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        .form-container h1 {
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .form-container a {
            color: #007bff;
            text-decoration: none;
        }

        .form-container a:hover {
            text-decoration: underline;
        }

        .btn-action {
            background-color: #6f4e37;
            color: white;
            font-weight: bold;
        }

        .btn-action:hover {
            background-color: #5a3c2e;
        }

        .hidden {
            display: none;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center h-100">
        <!-- Login Form -->
        <div class="form-container" id="login-form">
            <h1 class="text-center">D'COFFEE</h1>
            <?php if ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST">
                <input type="hidden" name="action" value="login">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-action w-100">LOGIN</button>
            </form>
            <div class="mt-3">
                <p>Don't Have An Account? <a href="#" onclick="toggleForms()">Sign Up</a></p>
            </div>
        </div>

        <!-- Register Form -->
        <div class="form-container hidden" id="register-form">
            <h1 class="text-center">D'COFFEE</h1>
            <form method="POST">
                <input type="hidden" name="action" value="register">
                <div class="mb-3">
                    <label for="reg-email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="reg-password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm your password" required>
                </div>
                <button type="submit" class="btn btn-action w-100">REGISTER</button>
            </form>
            <div class="mt-3">
                <p>Already Have An Account? <a href="#" onclick="toggleForms()">Login</a></p>
            </div>
        </div>
    </div>
    <script>
        function toggleForms() {
            document.getElementById('login-form').classList.toggle('hidden');
            document.getElementById('register-form').classList.toggle('hidden');
        }
    </script>
</body>
</html>

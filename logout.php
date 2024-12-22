<?php
session_start();  // Mulai session
session_unset();  // Hapus semua variabel session
session_destroy();  // Hancurkan session
header("Location: index.php");  // Redirect ke halaman utama setelah logout
exit();
?>

<?php
session_start(); // Memulai session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
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
                    <a class="nav-link text-dark" href="#"><i class="fas fa-search"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#"><i class="fas fa-heart"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#"><i class="fas fa-shopping-cart"></i></a>
                </li>
                <!-- User Info and Logout Button -->
                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <span class="btn btn-sign-in mx-2">
                            Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-sign-in mx-2" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-sign-in mx-2" href="login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
    <div class="container-fluid p-0">
        <div class="jumbotron d-flex align-items-center text-white"">
            <div class=" container text-start lh-1">
            <h1 class="display-5 fw-bold">INSPIRING</h1>
            <h1 class="display-1 fw-bold">COFFEE</h1>
            <h2 class="lead fs-4 fw-semibold">"The Stories Behind Every Brew"</h2>
            <p class="fs-6 text-wrap" style="width: 450px; height: 100px;">
                Gorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis
                molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla
                accumsan, risus sem sollicitudin lacus.
            </p>
            <a href="#" class="btn text-white btn-lg fw-semibold"
                style="background-color: #986B54; border-radius: 8px; font-size: 20px;">READ MORE</a>
        </div>
    </div>
    </div>
    <div class="custom-bg">
        <div class="container pt-5">
            <h1 class="text-center lh-1 fw-semibold">CATEGORIES</h1>
            <div class="row row-cols-5 g-2 mt-5">
                <div class="col">
                    <div class="card shadow-sm rounded-3 custom-card">
                        <img src="img/KOPI 8.jpg" class="custom-img" alt="Coffee 1">
                        <div class="card-body">
                            <p class="card-text mt-3">Kopi Kenangan</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm rounded-3 custom-card">
                        <img src="img/KOPI 8.jpg" class="custom-img" alt="Coffee 1">
                        <div class="card-body">
                            <p class="card-text mt-3">Kopi Kenangan</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm rounded-3 custom-card">
                        <img src="img/KOPI 8.jpg" class="custom-img" alt="Coffee 1">
                        <div class="card-body">
                            <p class="card-text mt-3">Kopi Kenangan</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm rounded-3 custom-card">
                        <img src="img/KOPI 8.jpg" class="custom-img" alt="Coffee 1">
                        <div class="card-body">
                            <p class="card-text mt-3">Kopi Kenangan</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm rounded-3 custom-card">
                        <img src="img/KOPI 8.jpg" class="custom-img" alt="Coffee 1">
                        <div class="card-body">
                            <p class="card-text mt-3">Kopi Kenangan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-5 mt-5">
                <div class="col">
                    <div class="card shadow-sm rounded-3 custom-card">
                        <img src="img/KOPI 8.jpg" class="custom-img" alt="Coffee 1">
                        <div class="card-body">
                            <p class="card-text mt-3">Kopi Kenangan</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm rounded-3 custom-card">
                        <img src="img/KOPI 8.jpg" class="custom-img" alt="Coffee 1">
                        <div class="card-body">
                            <p class="card-text mt-3">Kopi Kenangan</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm rounded-3 custom-card">
                        <img src="img/KOPI 8.jpg" class="custom-img" alt="Coffee 1">
                        <div class="card-body">
                            <p class="card-text mt-3">Kopi Kenangan</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm rounded-3 custom-card">
                        <img src="img/KOPI 8.jpg" class="custom-img" alt="Coffee 1">
                        <div class="card-body">
                            <p class="card-text mt-3">Kopi Kenangan</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm rounded-3 custom-card">
                        <img src="img/KOPI 8.jpg" class="custom-img" alt="Coffee 1">
                        <div class="card-body">
                            <p class="card-text mt-3">Kopi Kenangan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="recom-cont">
        <div class="recom">
            <h2 class="pt-5">RECOMMENDATION</h2>
            <div class="recom-fill mt-5 mySwiper">
                <div class="fill swiper-wrapper">
                    <div class="img-fill swiper-slide"><img src="img/KOPI 8.jpg" alt=""></div>
                    <div class="img-fill swiper-slide"><img src="img/KOPI 8.jpg" alt=""></div>
                    <div class="img-fill swiper-slide"><img src="img/KOPI 8.jpg" alt=""></div>
                    <div class="img-fill swiper-slide"><img src="img/KOPI 8.jpg" alt=""></div>
                    <div class="img-fill swiper-slide"><img src="img/KOPI 8.jpg" alt=""></div>
                    <div class="img-fill swiper-slide"><img src="img/KOPI 8.jpg" alt=""></div>
                    <div class="img-fill swiper-slide"><img src="img/KOPI 8.jpg" alt=""></div>
                    <div class="img-fill swiper-slide"><img src="img/KOPI 8.jpg" alt=""></div>
                </div>
            </div>
            <div class=".nav-button mt-5 swiper-button-next">
                <img src="img/next.png" alt="" style="height: 35px;">
            </div>
            <div class=".nav-button mt-5 swiper-button-prev">
                <img src="img/next.png" alt="" style="height: 35px;">
            </div>
        </div>
    </div>
    <div class="promo">
        <div class="promo-fill">
            <div class="pro-fill">
                <h1 class="fw-bold">D'COFFE PROMO</h1>
                <p class="fw-semibold">FIND VARIOUS INTERESTING</p>
                <p class="fw-semibold">PROMOTIONS HERE!!</p>
                <a href="menu.php">
                <div class="but-promo">FIND HERE</div>
                </a>

            </div>
        </div>
    </div>
    <div class="snacks">
        <div class="snacks-fill">
            <div class="sna-fill">
                <h1>D'COFFE</h1>
                <h1>NEED SNACKS ?</h1>
                <p>HUNGRY ?</p>
                <p>CHECK HERE HURRY !</p>
                <a href="">
                    <div class="sna-promo">EXPLORE IT</div>
                </a>
            </div>
            <div class="sna-col">
                <img src="img/KOPI 8.jpg" alt="">
                <img src="img/KOPI 8.jpg" alt="">
                <img src="img/KOPI 8.jpg" alt="">
                <img src="img/KOPI 8.jpg" alt="">

            </div>
        </div>
    </div>
    <div class="news">
        <div class="news-1">
            <h2>NEWEST</h2>
        <div class="news-fill mySwiper2">
            <div class="new-fill swiper-wrapper">
                <div class="swiper-slide"><img src="img/news1.jpg" alt=""></div>
                <div class="swiper-slide"><img src="img/news1.jpg" alt=""></div>
                <div class="swiper-slide"><img src="img/news1.jpg" alt=""></div>
            </div>
        </div>
    </div>
        <div class=".nav-button1 swiper-button-next2"><img src="img/next.png" alt="" style="height: 35px;"></div>
        <div class=".nav-button1 swiper-button-prev2"><img src="img/next.png" alt="" style="height: 35px;"></div>
    </div>
    <footer class="footer">
        <div class="footer-container">
            <!-- Logo and Description -->
            <div class="footer-column">
                <h4>D'COFFEE</h4>
                <p>Sorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, </p>
            </div>
            <!-- Useful Links -->
            <div class="footer-column">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Categories</a></li>
                    <li><a href="#">Promo</a></li>
                    <li><a href="#">Newest</a></li>
                </ul>
            </div>
            <!-- Contact Information -->
            <div class="footer-column contact-info">
                <h4>Contact</h4>
                <p>123 Elm Street Springfield, IL 62701, USA</p>
                <p><a href="mailto:vmcomap09@gmail.com">vmcomap09@gmail.com</a></p>
                <p>(555) 123-4567</p>
            </div>
            <!-- Help Section -->
            <div class="footer-column">
                <h4>Help</h4>
                <ul>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Live Center</a></li>
                    <li><a href="#">Support Ticket</a></li>
                </ul>
            </div>
            <!-- Social Media Links -->
            <div class="footer-column">
                <h4>Find Us</h4>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="kiri-copy">
                <p>© 2024 VM PRODUCTION. All Rights Reserved.</p>
            </div>
            <div class="kanan-copy">
                <p>Privacy Police</p>
                <p>Terms</p>
                <p>Code Of Conduct</p>
            </div>
        </div>
    </footer>





    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>
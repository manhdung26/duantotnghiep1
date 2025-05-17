<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang bán hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
 /* Reset và cài đặt chung */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}


body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
}

header {
    background-color: #278a7b;
    color: #fff;
    padding: 10px 20px;
    position: sticky;
    top: 0;
    z-index: 1000;
}
h1 {
    text-align: center;
    margin: 30px 0 20px;
    font-size: 28px;
    color: #333;
}
.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: auto;
    position: relative;
}

.logo a {
    text-decoration: none;
    color: #fff;
    font-size: 24px;
    font-weight: bold;
}

nav ul {
    list-style: none;
    display: flex;
}

nav ul li {
    margin-left: 20px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
}

/* Banner */
.banner {
    width: 100%;
    height: 600px; /* Cố định chiều cao */
    overflow: hidden;
    position: relative;
    margin-bottom: 20px;
    background-color: #000;
    margin-top: 90px;
}

.banner-images {
    width: 100%;
    height: 100%;
    position: relative;
}

.banner-images a {
    display: none;
    width: 100%;
    height: 100%;
}

.banner-images a.active {
    display: block;
}

.banner-images img {
    width: 100%;
    height: 100%;
    object-fit: contain; /* Không bị cắt ảnh */
    display: block;
    background-color:rgb(255, 255, 255);
}

/* Nút điều hướng */
.banner-images .prev,
.banner-images .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0,0,0,0.5);
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    z-index: 10;
    font-size: 20px;
    border-radius: 50%;
}

.banner-images .prev {
    left: 20px;
}

.banner-images .next {
    right: 20px;
}

/* Dấu chấm */
.banner-dots {
    text-align: center;
    margin-top: 10px;
}

.banner-dots span {
    display: inline-block;
    width: 10px;
    height: 10px;
    margin: 0 5px;
    background-color: #ccc;
    border-radius: 50%;
    cursor: pointer;
}

.banner-dots span.active {
    background-color: #278a7b;
}

.horizontal-menu {
    position: fixed; /* Giữ cố định phần menu */
    top: 60px; /* Vị trí từ trên cùng */
    left: 0; /* Vị trí từ bên trái */
    width: 100%; /* Chiều rộng của menu */
    height: 80px;
    background-color: #fff; /* Màu nền của menu */
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); /* Đổ bóng để nổi bật */
    z-index: 999; /* Đảm bảo menu luôn ở trên các phần tử khác */
    padding: 10px 0; /* Padding cho menu */
}
        .horizontal-menu ul {
     display: flex;
    justify-content: center;
    align-items: center;
    list-style: none;
    gap: 20px;
    margin: 0;
    padding: 0;
}
       .horizontal-menu ul li {
    position: relative;
    border: 1px solid #ccc; /* Thêm viền */
    border-radius: 6px;
    padding: 5px 10px;
    background-color:rgb(245, 246, 246);
    transition: all 0.3s;
}
        .horizontal-menu ul li a {
    text-decoration: none;
    color: #333;
    padding: 10px 15px;
    display: block;
    transition: background-color 0.3s;
}
.horizontal-menu ul li a:hover {
    background-color: #278a7b;
    color: white;
    border-radius: 4px;
}
        /* Mega menu */
        .horizontal-menu .mega-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: #fff;
    padding: 10px 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    z-index: 1000;
    white-space: nowrap;
}
        .horizontal-menu .has-submenu:hover .mega-menu {
            display: block;          
        }     
        /* Main content layout */
        main {
            display: flex;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

.mega-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: #fff;
    padding: 10px 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    z-index: 1000;
    white-space: nowrap;
}

.has-submenu:hover .mega-menu {
    display: block;
}

/* Product Grid */
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.product-card {
    background-color: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    text-align: center;
}

.product-card img {
    max-width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 4px;
    margin-bottom: 10px;
}

.product-card h3 {
    font-size: 18px;
    margin: 10px 0;
}

.product-card .price {
    color: #e74c3c;
    font-weight: bold;
    margin: 10px 0;
}

.product-card button {
    background-color: #278a7b;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.product-card button:hover {
    background-color: #1f6f64;
}

footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 15px 0;
    margin-top: 40px;
}

/* Responsive */
@media (max-width: 768px) {
    .container, main {
        flex-direction: column;
        align-items: center;
    }

    .horizontal-menu ul {
        flex-direction: column;
        gap: 10px;
    }

    .product-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    }

    .product-card img {
        height: 160px;
    }
}


    </style>
</head>
<body>

    <header>
        <div class="container">
            <div class="logo">
                <a href="#">Fashion shop</a>
            </div>
            <nav>
                <ul>
                    <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li><a href="#"><i class="fa fa-store"></i> Sản phẩm</a></li>
                    <li><a href="indexgiohang.php"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                    <li><a href="#"><i class="fa fa-phone"></i> Liên hệ</a></li>
                    <li><a href="indexlogin.php"><i class=""></i> đăng xuất</a></li>
                </ul>
            </nav>
        </div>
    </header>

   <!-- Sidebar ngang -->
<nav class="sidebar horizontal-menu">
    <ul>
        <li class="has-submenu">
            <a href="#">Đồ đông</a>
            <ul class="mega-menu">
                <li><a href="indexaolen.php">Áo len</a></li>
                <li><a href="indexaoni.php">áo nỉ</a></li>
                <li><a href="indexaokhoac.php">áo khoác</a></li>
                <li><a href="indexquanni.php">quần nỉ</a></li>
                <li><a href="indexquangio.php">quần gió</a></li>
            </ul>
        </li>
        <li class="has-submenu">
            <a href="#">Đồ hè</a>
            <ul class="mega-menu">
                <li><a href="indexpolo.php">Áo polo</a></li>
                <li><a href="indexaotshirt.php">áo t-shirt</a></li>
                <li><a href="indexaotanktop.php">áo tanktop</a></li>
                <li><a href="indexshortni.php">quần short nỉ</a></li>
                <li><a href="indexshortkaki.php">quần short kaki</a></li>
                <li><a href="indexshortdui.php">quần short đũi</a></li>
                <li><a href="indexshortgio.php">quần short gió</a></li>
            </ul>
        </li>
        <li class="has-submenu">
            <a href="#">Đồ all</a>
            <ul class="mega-menu">
                <li><a href="indexaosomi.php">Áo sơ mi</a></li>
                <li><a href="indexquankaki.php">quần kaki</a></li>
                <li><a href="indexquanau.php">quần âu</a></li>
            </ul>
        </li>
    </ul>
</nav>
<!-- Banner -->
<section class="banner">
    <div class="banner-images">
        <a href="trang-banner.html" class="active"><img src="img/slide1.jpg" alt="Banner 1"></a>
        <a href="trang-banner.html"><img src="img/slide2.jpg" alt="Banner 2"></a>
        <a href="trang-banner.html"><img src="img/slide3.jpg" alt="Banner 3"></a>
        <button class="prev" onclick="prevImage()">&#10094;</button>
        <button class="next" onclick="nextImage()">&#10095;</button>
    </div>
</section>
<div class="banner-dots" id="bannerDots"></div>

  <!-- Sản phẩm nổi bật -->
<h1>Sản phẩm nổi bật</h1>
<div class="product-grid">
    <?php while ($product = $featured->fetch_assoc()): ?>
        <div class="product-card">
            <img src="img/<?= htmlspecialchars($product['anh']) ?>" alt="<?= htmlspecialchars($product['ten']) ?>">
            <h3><?= htmlspecialchars($product['ten']) ?></h3>
            <p><?= number_format($product['gia'], 0, ',', '.') ?>₫</p>

            <?php if ((int)$product['so_luong'] <= 0): ?>
                <p style="color: red; font-weight: bold;">Hết hàng</p>
                <button class="btn" disabled>Hết hàng</button>
            <?php else: ?>
                <form method="post" class="addToCartForm" data-id="<?= $product['id'] ?>">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <button type="submit" name="add_to_cart" class="btn">Thêm vào giỏ</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>

<!-- Sản phẩm khác -->
<h1>Sản phẩm khác</h1>
<div class="product-grid">
    <?php while ($product = $all->fetch_assoc()): ?>
        <div class="product-card">
            <img src="img/<?= htmlspecialchars($product['anh']) ?>" alt="<?= htmlspecialchars($product['ten']) ?>">
            <h3><?= htmlspecialchars($product['ten']) ?></h3>
            <p><?= number_format($product['gia'], 0, ',', '.') ?>₫</p>

            <?php if ((int)$product['so_luong'] <= 0): ?>
                <p style="color: red; font-weight: bold;">Hết hàng</p>
                <button class="btn" disabled>Hết hàng</button>
            <?php else: ?>
                <form method="post" class="addToCartForm" data-id="<?= $product['id'] ?>">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <button type="submit" name="add_to_cart" class="btn">Thêm vào giỏ</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>
</main>

<script>
    let currentImage = 0;
    const images = document.querySelectorAll(".banner-images a");
    const dotsContainer = document.getElementById("bannerDots");
    images.forEach((_, index) => {
        const dot = document.createElement("span");
        dot.addEventListener("click", () => {
            currentImage = index;
            showImage(currentImage);
        });
        dotsContainer.appendChild(dot);
    });
    const dots = dotsContainer.querySelectorAll("span");
    function showImage(index) {
        images.forEach((img, i) => {
            img.classList.remove("active");
            dots[i].classList.remove("active");
            if (i === index) {
                img.classList.add("active");
                dots[i].classList.add("active");
            }
        });
    }
    function nextImage() {
        currentImage = (currentImage + 1) % images.length;
        showImage(currentImage);
    }
    function prevImage() {
        currentImage = (currentImage - 1 + images.length) % images.length;
        showImage(currentImage);
    }
    showImage(currentImage);
    setInterval(nextImage, 2000);
    // Thêm sản phẩm vào giỏ qua AJAX
    document.addEventListener("DOMContentLoaded", function() {
    const forms = document.querySelectorAll(".addToCartForm");

    forms.forEach(form => {
        form.addEventListener("submit", function(e) {
            e.preventDefault(); // chặn gửi form

            const productId = this.dataset.id;
            const formData = new FormData();
            formData.append('add_to_cart', true);
            formData.append('product_id', productId);

            fetch('indexbanhang.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
            // Không hiển thị thông báo nữa
            // Nếu cần xử lý thêm, ví dụ cập nhật giỏ hàng trên giao diện
        })
            .catch(error => {
                console.error('Lỗi:', error);
                alert("Có lỗi xảy ra!");
            });
        });
    });
});
</script>
</body>
</html>

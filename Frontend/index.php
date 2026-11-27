<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova — Premium Fashion & Electronics Store</title>
    <meta name="description" content="Discover the latest fashion trends, premium shoes, headphones, watches and electronics at Nova Store. Shop now with fast delivery and secure payment.">
    <link rel="stylesheet" href="Assets/css/style.css">
    <?php include 'header.php'; ?>
</head>

<body>

    <!-- ==================== HERO ==================== -->
    <section id="home-header">
        <div class="hero-content">
            <h1>
                Premium <span>Fashion</span><br>
                Collection
            </h1>
            <p>
                Discover the latest trends with premium quality clothing,
                shoes, watches, bags and accessories. Shop your favorite
                brands at the best prices with fast delivery.
            </p>
            <div class="hero-btn">
                <a href="shop.php" class="btn1">Shop Now</a>
                <a href="#featured" class="btn2">Explore Collection</a>
            </div>
        </div>
    </section>

    <!-- ==================== CATEGORIES ==================== -->
    <section class="categories-strip">
        <div class="section-title">
            <h2>Shop by <span>Category</span></h2>
            <p>Find exactly what you're looking for</p>
        </div>
        <div class="categories-grid">
            <a href="shop.php?category=shoes" class="cat-card">
                <i class="fas fa-shoe-prints"></i>
                <span>Shoes</span>
            </a>
            <a href="shop.php?category=headphones" class="cat-card">
                <i class="fas fa-headphones"></i>
                <span>Headphones</span>
            </a>
            <a href="shop.php?category=watches" class="cat-card">
                <i class="fas fa-clock"></i>
                <span>Watches</span>
            </a>
            <a href="shop.php?category=electronics" class="cat-card">
                <i class="fas fa-mobile-alt"></i>
                <span>Electronics</span>
            </a>
        </div>
    </section>

    <!-- ==================== FEATURED PRODUCTS ==================== -->
    <section class="products-section" id="featured">
        <div class="section-title">
            <h2>Featured <span>Products</span></h2>
            <p>Handpicked items just for you</p>
        </div>

        <div class="container">

            <!-- Shoes -->
            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/2.jpg" alt="Nike Air Max 270">
                    <span class="discount">-25%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>Nike Air Max 270</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span>(245)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$149</span>
                        <span class="old-price">$199</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('Nike Air Max 270', 149, 'Assets/img/2.jpg', 'Shoes')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/3.jpg" alt="Adidas Ultra Boost">
                    <span class="discount">-20%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>Adidas Ultra Boost</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>(189)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$159</span>
                        <span class="old-price">$199</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('Adidas Ultra Boost', 159, 'Assets/img/3.jpg', 'Shoes')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <!-- Headphones -->
            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/headphon/budts1.webp" alt="Sony WF-1000XM5 Buds">
                    <span class="discount">-30%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>Sony WF-1000XM5</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>(312)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$209</span>
                        <span class="old-price">$299</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('Sony WF-1000XM5', 209, 'Assets/img/headphon/budts1.webp', 'Headphones')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/headphon/headphone 1.webp" alt="Bose QuietComfort 45">
                    <span class="discount">-15%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>Bose QuietComfort 45</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span>(198)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$254</span>
                        <span class="old-price">$299</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('Bose QuietComfort 45', 254, 'Assets/img/headphon/headphone 1.webp', 'Headphones')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/headphon/headphone2.webp" alt="JBL Tune 760NC">
                    <span class="discount">-25%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>JBL Tune 760NC</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span>(145)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$89</span>
                        <span class="old-price">$119</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('JBL Tune 760NC', 89, 'Assets/img/headphon/headphone2.webp', 'Headphones')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/headphon/headphone3.webp" alt="Apple AirPods Pro 2">
                    <span class="discount">-10%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>Apple AirPods Pro 2</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>(524)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$224</span>
                        <span class="old-price">$249</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('Apple AirPods Pro 2', 224, 'Assets/img/headphon/headphone3.webp', 'Headphones')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/headphon/headphone4.webp" alt="Sennheiser Momentum 4">
                    <span class="discount">-20%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>Sennheiser Momentum 4</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span>(87)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$279</span>
                        <span class="old-price">$349</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('Sennheiser Momentum 4', 279, 'Assets/img/headphon/headphone4.webp', 'Headphones')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <!-- Watches -->
            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/watch/jacob1.webp" alt="Jacob & Co. Smart Watch">
                    <span class="discount">-25%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>Jacob & Co. Luxury Watch</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>(63)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$749</span>
                        <span class="old-price">$999</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('Jacob &amp; Co. Luxury Watch', 749, 'Assets/img/watch/jacob1.webp', 'Watches')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/watch/jacob2.webp" alt="Classic Chronograph Watch">
                    <span class="discount">-20%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>Classic Chronograph</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span>(112)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$399</span>
                        <span class="old-price">$499</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('Classic Chronograph', 399, 'Assets/img/watch/jacob2.webp', 'Watches')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/watch/jacob3.webp" alt="Sport Smart Watch">
                    <span class="discount">-18%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>Sport Smart Watch Pro</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>(201)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$199</span>
                        <span class="old-price">$243</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('Sport Smart Watch Pro', 199, 'Assets/img/watch/jacob3.webp', 'Watches')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <!-- Shoes -->
            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/shoes/nike1.avif" alt="Nike Air Force 1">
                    <span class="discount">-25%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>Nike Air Force 1</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span>(378)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$112</span>
                        <span class="old-price">$150</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('Nike Air Force 1', 112, 'Assets/img/shoes/nike1.avif', 'Shoes')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/shoes/nike2.avif" alt="Nike React Infinity Run">
                    <span class="discount">-15%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>Nike React Infinity Run</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>(421)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$127</span>
                        <span class="old-price">$150</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('Nike React Infinity Run', 127, 'Assets/img/shoes/nike2.avif', 'Shoes')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/shoes/nike4.avif" alt="Nike Zoom Pegasus">
                    <span class="discount">-20%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>Nike Zoom Pegasus 40</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span>(167)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$120</span>
                        <span class="old-price">$150</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('Nike Zoom Pegasus 40', 120, 'Assets/img/shoes/nike4.avif', 'Shoes')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/shoes/nike5.avif" alt="Nike Dunk Low">
                    <span class="discount">-22%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>Nike Dunk Low Retro</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>(592)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$87</span>
                        <span class="old-price">$112</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('Nike Dunk Low Retro', 87, 'Assets/img/shoes/nike5.avif', 'Shoes')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <!-- Phones & Laptops -->
            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/phonelaptop/iphone1.webp" alt="iPhone 15 Pro">
                    <span class="discount">-10%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>iPhone 15 Pro Max</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>(1204)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$1,079</span>
                        <span class="old-price">$1,199</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('iPhone 15 Pro Max', 1079, 'Assets/img/phonelaptop/iphone1.webp', 'Electronics')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/phonelaptop/iphone2.webp" alt="iPhone 15">
                    <span class="discount">-12%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>iPhone 15 Standard</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>(876)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$879</span>
                        <span class="old-price">$999</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('iPhone 15 Standard', 879, 'Assets/img/phonelaptop/iphone2.webp', 'Electronics')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/phonelaptop/macbook1.webp" alt="MacBook Pro M3">
                    <span class="discount">-8%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>MacBook Pro M3</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>(432)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$1,839</span>
                        <span class="old-price">$1,999</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('MacBook Pro M3', 1839, 'Assets/img/phonelaptop/macbook1.webp', 'Electronics')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="Assets/img/phonelaptop/macbook2.webp" alt="MacBook Air M2">
                    <span class="discount">-15%</span>
                    <button class="wishlist-btn" title="Add to wishlist"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>MacBook Air M2</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>(689)</span>
                    </div>
                    <div class="price">
                        <span class="new-price">$1,019</span>
                        <span class="old-price">$1,199</span>
                    </div>
                    <button class="cart-btn" onclick="addToCart('MacBook Air M2', 1019, 'Assets/img/phonelaptop/macbook2.webp', 'Electronics')">
                        <i class="fas fa-shopping-bag"></i> Add To Cart
                    </button>
                </div>
            </div>

        </div>
    </section>

    <?php include 'footer.php'; ?>

</body>
</html>
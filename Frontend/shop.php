<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop — Nova Store | 50+ Premium Products</title>
    <meta name="description" content="Browse 50+ premium products — shoes, headphones, watches, phones and laptops at Nova Store.">
    <link rel="stylesheet" href="Assets/css/style.css">
    <?php include 'header.php'; ?>
    <style>
        #products-count {
            text-align: center;
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 30px;
            font-weight: 500;
        }
        #products-count span {
            color: var(--primary);
            font-weight: 700;
        }
    </style>
</head>

<body>

    <!-- Shop Banner -->
    <section id="shop-banner">
        <div class="banner-content">
            <h1>Summer Collection 2026</h1>
            <p>Up to 50% OFF on 50+ Premium Products</p>
            <button onclick="window.scrollTo({top:500,behavior:'smooth'})">Shop Now</button>
        </div>
    </section>

    <!-- Filter -->
    <section id="filter">
        <a href="#" class="filter-btn active" data-filter="all">All Products</a>
        <a href="#" class="filter-btn" data-filter="shoes">Shoes</a>
        <a href="#" class="filter-btn" data-filter="headphones">Headphones</a>
        <a href="#" class="filter-btn" data-filter="watches">Watches</a>
        <a href="#" class="filter-btn" data-filter="electronics">Electronics</a>
    </section>

    <p id="products-count"><span id="visible-count">50</span> products found</p>

    <!-- Products Grid -->
    <section id="products">

        <!-- ===== SHOES (15 products) ===== -->

        <div class="product" data-category="shoes">
            <img src="Assets/img/shoes/nike1.avif" alt="Nike Air Force 1" loading="lazy">
            <h3>Nike Air Force 1</h3>
            <p class="product-price">$112</p>
            <p class="product-old-price">$150</p>
            <button onclick="addToCart('Nike Air Force 1',112,'Assets/img/shoes/nike1.avif','Shoes')">Add To Cart</button>
        </div>

        <div class="product" data-category="shoes">
            <img src="Assets/img/shoes/nike2.avif" alt="Nike React Infinity Run" loading="lazy">
            <h3>Nike React Infinity Run</h3>
            <p class="product-price">$127</p>
            <p class="product-old-price">$150</p>
            <button onclick="addToCart('Nike React Infinity Run',127,'Assets/img/shoes/nike2.avif','Shoes')">Add To Cart</button>
        </div>

        <div class="product" data-category="shoes">
            <img src="Assets/img/shoes/nike4.avif" alt="Nike Zoom Pegasus 40" loading="lazy">
            <h3>Nike Zoom Pegasus 40</h3>
            <p class="product-price">$120</p>
            <p class="product-old-price">$150</p>
            <button onclick="addToCart('Nike Zoom Pegasus 40',120,'Assets/img/shoes/nike4.avif','Shoes')">Add To Cart</button>
        </div>

        <div class="product" data-category="shoes">
            <img src="Assets/img/shoes/nike5.avif" alt="Nike Dunk Low Retro" loading="lazy">
            <h3>Nike Dunk Low Retro</h3>
            <p class="product-price">$87</p>
            <p class="product-old-price">$112</p>
            <button onclick="addToCart('Nike Dunk Low Retro',87,'Assets/img/shoes/nike5.avif','Shoes')">Add To Cart</button>
        </div>

        <div class="product" data-category="shoes">
            <img src="Assets/img/2.jpg" alt="Nike Air Max 270" loading="lazy">
            <h3>Nike Air Max 270</h3>
            <p class="product-price">$149</p>
            <p class="product-old-price">$199</p>
            <button onclick="addToCart('Nike Air Max 270',149,'Assets/img/2.jpg','Shoes')">Add To Cart</button>
        </div>

        <div class="product" data-category="shoes">
            <img src="Assets/img/3.jpg" alt="Adidas Ultra Boost 23" loading="lazy">
            <h3>Adidas Ultra Boost 23</h3>
            <p class="product-price">$159</p>
            <p class="product-old-price">$199</p>
            <button onclick="addToCart('Adidas Ultra Boost 23',159,'Assets/img/3.jpg','Shoes')">Add To Cart</button>
        </div>

        <div class="product" data-category="shoes">
            <img src="Assets/img/shoes/adidas_yeezy.png" alt="Adidas Yeezy Boost 350" loading="lazy">
            <h3>Adidas Yeezy Boost 350</h3>
            <p class="product-price">$220</p>
            <p class="product-old-price">$280</p>
            <button onclick="addToCart('Adidas Yeezy Boost 350',220,'Assets/img/shoes/adidas_yeezy.png','Shoes')">Add To Cart</button>
        </div>

        <div class="product" data-category="shoes">
            <img src="Assets/img/shoes/jordan_1.png" alt="Air Jordan 1 Retro High OG" loading="lazy">
            <h3>Air Jordan 1 Retro OG</h3>
            <p class="product-price">$170</p>
            <p class="product-old-price">$210</p>
            <button onclick="addToCart('Air Jordan 1 Retro OG',170,'Assets/img/shoes/jordan_1.png','Shoes')">Add To Cart</button>
        </div>

        <div class="product" data-category="shoes">
            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&q=80" alt="Nike Air Max 90" loading="lazy">
            <h3>Nike Air Max 90</h3>
            <p class="product-price">$110</p>
            <p class="product-old-price">$140</p>
            <button onclick="addToCart('Nike Air Max 90',110,'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&q=80','Shoes')">Add To Cart</button>
        </div>

        <div class="product" data-category="shoes">
            <img src="https://images.unsplash.com/photo-1608231387042-66d1773070a5?w=400&q=80" alt="Converse Chuck Taylor" loading="lazy">
            <h3>Converse Chuck Taylor</h3>
            <p class="product-price">$65</p>
            <p class="product-old-price">$85</p>
            <button onclick="addToCart('Converse Chuck Taylor',65,'https://images.unsplash.com/photo-1608231387042-66d1773070a5?w=400&q=80','Shoes')">Add To Cart</button>
        </div>

        <div class="product" data-category="shoes">
            <img src="https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?w=400&q=80" alt="Vans Old Skool Pro" loading="lazy">
            <h3>Vans Old Skool Pro</h3>
            <p class="product-price">$75</p>
            <p class="product-old-price">$95</p>
            <button onclick="addToCart('Vans Old Skool Pro',75,'https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?w=400&q=80','Shoes')">Add To Cart</button>
        </div>

        <div class="product" data-category="shoes">
            <img src="https://images.unsplash.com/photo-1539185441755-769473a23570?w=400&q=80" alt="New Balance 990v5" loading="lazy">
            <h3>New Balance 990v5</h3>
            <p class="product-price">$185</p>
            <p class="product-old-price">$230</p>
            <button onclick="addToCart('New Balance 990v5',185,'https://images.unsplash.com/photo-1539185441755-769473a23570?w=400&q=80','Shoes')">Add To Cart</button>
        </div>

        <div class="product" data-category="shoes">
            <img src="https://images.unsplash.com/photo-1597045566677-8cf032ed6634?w=400&q=80" alt="Reebok Classic Leather" loading="lazy">
            <h3>Reebok Classic Leather</h3>
            <p class="product-price">$80</p>
            <p class="product-old-price">$100</p>
            <button onclick="addToCart('Reebok Classic Leather',80,'https://images.unsplash.com/photo-1597045566677-8cf032ed6634?w=400&q=80','Shoes')">Add To Cart</button>
        </div>

        <div class="product" data-category="shoes">
            <img src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=400&q=80" alt="Asics Gel-Nimbus 25" loading="lazy">
            <h3>Asics Gel-Nimbus 25</h3>
            <p class="product-price">$155</p>
            <p class="product-old-price">$190</p>
            <button onclick="addToCart('Asics Gel-Nimbus 25',155,'https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=400&q=80','Shoes')">Add To Cart</button>
        </div>

        <div class="product" data-category="shoes">
            <img src="https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=400&q=80" alt="Balenciaga Triple S" loading="lazy">
            <h3>Balenciaga Triple S</h3>
            <p class="product-price">$895</p>
            <p class="product-old-price">$1095</p>
            <button onclick="addToCart('Balenciaga Triple S',895,'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=400&q=80','Shoes')">Add To Cart</button>
        </div>

        <!-- ===== HEADPHONES (10 products) ===== -->

        <div class="product" data-category="headphones">
            <img src="Assets/img/headphon/budts1.webp" alt="Sony WF-1000XM5 Buds" loading="lazy">
            <h3>Sony WF-1000XM5</h3>
            <p class="product-price">$209</p>
            <p class="product-old-price">$299</p>
            <button onclick="addToCart('Sony WF-1000XM5',209,'Assets/img/headphon/budts1.webp','Headphones')">Add To Cart</button>
        </div>

        <div class="product" data-category="headphones">
            <img src="Assets/img/headphon/headphone 1.webp" alt="Bose QuietComfort 45" loading="lazy">
            <h3>Bose QuietComfort 45</h3>
            <p class="product-price">$254</p>
            <p class="product-old-price">$299</p>
            <button onclick="addToCart('Bose QuietComfort 45',254,'Assets/img/headphon/headphone 1.webp','Headphones')">Add To Cart</button>
        </div>

        <div class="product" data-category="headphones">
            <img src="Assets/img/headphon/headphone2.webp" alt="JBL Tune 760NC" loading="lazy">
            <h3>JBL Tune 760NC</h3>
            <p class="product-price">$89</p>
            <p class="product-old-price">$119</p>
            <button onclick="addToCart('JBL Tune 760NC',89,'Assets/img/headphon/headphone2.webp','Headphones')">Add To Cart</button>
        </div>

        <div class="product" data-category="headphones">
            <img src="Assets/img/headphon/headphone3.webp" alt="Apple AirPods Pro 2" loading="lazy">
            <h3>Apple AirPods Pro 2</h3>
            <p class="product-price">$224</p>
            <p class="product-old-price">$249</p>
            <button onclick="addToCart('Apple AirPods Pro 2',224,'Assets/img/headphon/headphone3.webp','Headphones')">Add To Cart</button>
        </div>

        <div class="product" data-category="headphones">
            <img src="Assets/img/headphon/headphone4.webp" alt="Sennheiser Momentum 4" loading="lazy">
            <h3>Sennheiser Momentum 4</h3>
            <p class="product-price">$279</p>
            <p class="product-old-price">$349</p>
            <button onclick="addToCart('Sennheiser Momentum 4',279,'Assets/img/headphon/headphone4.webp','Headphones')">Add To Cart</button>
        </div>

        <div class="product" data-category="headphones">
            <img src="Assets/img/headphon/sony_wh1000xm5.png" alt="Sony WH-1000XM5 Over-Ear" loading="lazy">
            <h3>Sony WH-1000XM5</h3>
            <p class="product-price">$348</p>
            <p class="product-old-price">$399</p>
            <button onclick="addToCart('Sony WH-1000XM5 Over-Ear',348,'Assets/img/headphon/sony_wh1000xm5.png','Headphones')">Add To Cart</button>
        </div>

        <div class="product" data-category="headphones">
            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&q=80" alt="Beats Studio Pro" loading="lazy">
            <h3>Beats Studio Pro</h3>
            <p class="product-price">$349</p>
            <p class="product-old-price">$399</p>
            <button onclick="addToCart('Beats Studio Pro',349,'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&q=80','Headphones')">Add To Cart</button>
        </div>

        <div class="product" data-category="headphones">
            <img src="https://images.unsplash.com/photo-1484704849700-f032a568e944?w=400&q=80" alt="Marshall Monitor II ANC" loading="lazy">
            <h3>Marshall Monitor II ANC</h3>
            <p class="product-price">$249</p>
            <p class="product-old-price">$299</p>
            <button onclick="addToCart('Marshall Monitor II ANC',249,'https://images.unsplash.com/photo-1484704849700-f032a568e944?w=400&q=80','Headphones')">Add To Cart</button>
        </div>

        <div class="product" data-category="headphones">
            <img src="https://images.unsplash.com/photo-1524678714210-9917a6c619c2?w=400&q=80" alt="Anker Soundcore Q45" loading="lazy">
            <h3>Anker Soundcore Q45</h3>
            <p class="product-price">$59</p>
            <p class="product-old-price">$79</p>
            <button onclick="addToCart('Anker Soundcore Q45',59,'https://images.unsplash.com/photo-1524678714210-9917a6c619c2?w=400&q=80','Headphones')">Add To Cart</button>
        </div>

        <div class="product" data-category="headphones">
            <img src="https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=400&q=80" alt="Samsung Galaxy Buds2 Pro" loading="lazy">
            <h3>Samsung Galaxy Buds2 Pro</h3>
            <p class="product-price">$169</p>
            <p class="product-old-price">$229</p>
            <button onclick="addToCart('Samsung Galaxy Buds2 Pro',169,'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=400&q=80','Headphones')">Add To Cart</button>
        </div>

        <!-- ===== WATCHES (10 products) ===== -->

        <div class="product" data-category="watches">
            <img src="Assets/img/watch/jacob1.webp" alt="Jacob & Co. Luxury Watch" loading="lazy">
            <h3>Jacob &amp; Co. Luxury</h3>
            <p class="product-price">$749</p>
            <p class="product-old-price">$999</p>
            <button onclick="addToCart('Jacob &amp; Co. Luxury Watch',749,'Assets/img/watch/jacob1.webp','Watches')">Add To Cart</button>
        </div>

        <div class="product" data-category="watches">
            <img src="Assets/img/watch/jacob2.webp" alt="Classic Chronograph" loading="lazy">
            <h3>Classic Chronograph</h3>
            <p class="product-price">$399</p>
            <p class="product-old-price">$499</p>
            <button onclick="addToCart('Classic Chronograph',399,'Assets/img/watch/jacob2.webp','Watches')">Add To Cart</button>
        </div>

        <div class="product" data-category="watches">
            <img src="Assets/img/watch/jacob3.webp" alt="Sport Smart Watch Pro" loading="lazy">
            <h3>Sport Smart Watch Pro</h3>
            <p class="product-price">$199</p>
            <p class="product-old-price">$243</p>
            <button onclick="addToCart('Sport Smart Watch Pro',199,'Assets/img/watch/jacob3.webp','Watches')">Add To Cart</button>
        </div>

        <div class="product" data-category="watches">
            <img src="Assets/img/watch/rolex1.webp" alt="Rolex Datejust" loading="lazy">
            <h3>Rolex Datejust 36</h3>
            <p class="product-price">$7,500</p>
            <p class="product-old-price">$9,200</p>
            <button onclick="addToCart('Rolex Datejust 36',7500,'Assets/img/watch/rolex1.webp','Watches')">Add To Cart</button>
        </div>

        <div class="product" data-category="watches">
            <img src="Assets/img/watch/rolex_sub.png" alt="Rolex Submariner" loading="lazy">
            <h3>Rolex Submariner</h3>
            <p class="product-price">$10,500</p>
            <p class="product-old-price">$13,000</p>
            <button onclick="addToCart('Rolex Submariner',10500,'Assets/img/watch/rolex_sub.png','Watches')">Add To Cart</button>
        </div>

        <div class="product" data-category="watches">
            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&q=80" alt="Apple Watch Series 9" loading="lazy">
            <h3>Apple Watch Series 9</h3>
            <p class="product-price">$399</p>
            <p class="product-old-price">$499</p>
            <button onclick="addToCart('Apple Watch Series 9',399,'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&q=80','Watches')">Add To Cart</button>
        </div>

        <div class="product" data-category="watches">
            <img src="https://images.unsplash.com/photo-1547996160-81dfa63595aa?w=400&q=80" alt="Samsung Galaxy Watch 6" loading="lazy">
            <h3>Samsung Galaxy Watch 6</h3>
            <p class="product-price">$299</p>
            <p class="product-old-price">$349</p>
            <button onclick="addToCart('Samsung Galaxy Watch 6',299,'https://images.unsplash.com/photo-1547996160-81dfa63595aa?w=400&q=80','Watches')">Add To Cart</button>
        </div>

        <div class="product" data-category="watches">
            <img src="https://images.unsplash.com/photo-1594576722512-582bcd135113?w=400&q=80" alt="Fossil Gen 6 Hybrid" loading="lazy">
            <h3>Fossil Gen 6 Hybrid</h3>
            <p class="product-price">$195</p>
            <p class="product-old-price">$249</p>
            <button onclick="addToCart('Fossil Gen 6 Hybrid',195,'https://images.unsplash.com/photo-1594576722512-582bcd135113?w=400&q=80','Watches')">Add To Cart</button>
        </div>

        <div class="product" data-category="watches">
            <img src="https://images.unsplash.com/photo-1619134778706-7015533a6150?w=400&q=80" alt="Garmin Fenix 7 Pro" loading="lazy">
            <h3>Garmin Fenix 7 Pro</h3>
            <p class="product-price">$699</p>
            <p class="product-old-price">$899</p>
            <button onclick="addToCart('Garmin Fenix 7 Pro',699,'https://images.unsplash.com/photo-1619134778706-7015533a6150?w=400&q=80','Watches')">Add To Cart</button>
        </div>

        <div class="product" data-category="watches">
            <img src="https://images.unsplash.com/photo-1508057198894-247b23fe5ade?w=400&q=80" alt="Omega Seamaster Diver" loading="lazy">
            <h3>Omega Seamaster Diver</h3>
            <p class="product-price">$5,200</p>
            <p class="product-old-price">$6,500</p>
            <button onclick="addToCart('Omega Seamaster Diver',5200,'https://images.unsplash.com/photo-1508057198894-247b23fe5ade?w=400&q=80','Watches')">Add To Cart</button>
        </div>

        <!-- ===== ELECTRONICS (15 products) ===== -->

        <div class="product" data-category="electronics">
            <img src="Assets/img/phonelaptop/iphone1.webp" alt="iPhone 15 Pro Max" loading="lazy">
            <h3>iPhone 15 Pro Max</h3>
            <p class="product-price">$1,079</p>
            <p class="product-old-price">$1,199</p>
            <button onclick="addToCart('iPhone 15 Pro Max',1079,'Assets/img/phonelaptop/iphone1.webp','Electronics')">Add To Cart</button>
        </div>

        <div class="product" data-category="electronics">
            <img src="Assets/img/phonelaptop/iphone2.webp" alt="iPhone 15" loading="lazy">
            <h3>iPhone 15 Standard</h3>
            <p class="product-price">$879</p>
            <p class="product-old-price">$999</p>
            <button onclick="addToCart('iPhone 15 Standard',879,'Assets/img/phonelaptop/iphone2.webp','Electronics')">Add To Cart</button>
        </div>

        <div class="product" data-category="electronics">
            <img src="Assets/img/phonelaptop/macbook1.webp" alt="MacBook Pro M3" loading="lazy">
            <h3>MacBook Pro M3</h3>
            <p class="product-price">$1,839</p>
            <p class="product-old-price">$1,999</p>
            <button onclick="addToCart('MacBook Pro M3',1839,'Assets/img/phonelaptop/macbook1.webp','Electronics')">Add To Cart</button>
        </div>

        <div class="product" data-category="electronics">
            <img src="Assets/img/phonelaptop/macbook2.webp" alt="MacBook Air M2" loading="lazy">
            <h3>MacBook Air M2</h3>
            <p class="product-price">$1,019</p>
            <p class="product-old-price">$1,199</p>
            <button onclick="addToCart('MacBook Air M2',1019,'Assets/img/phonelaptop/macbook2.webp','Electronics')">Add To Cart</button>
        </div>

        <div class="product" data-category="electronics">
            <img src="Assets/img/phonelaptop/samsung_s24.png" alt="Samsung Galaxy S24 Ultra" loading="lazy">
            <h3>Samsung Galaxy S24 Ultra</h3>
            <p class="product-price">$1,149</p>
            <p class="product-old-price">$1,299</p>
            <button onclick="addToCart('Samsung Galaxy S24 Ultra',1149,'Assets/img/phonelaptop/samsung_s24.png','Electronics')">Add To Cart</button>
        </div>

        <div class="product" data-category="electronics">
            <img src="Assets/img/phonelaptop/dell_xps15.png" alt="Dell XPS 15" loading="lazy">
            <h3>Dell XPS 15 Laptop</h3>
            <p class="product-price">$1,449</p>
            <p class="product-old-price">$1,699</p>
            <button onclick="addToCart('Dell XPS 15',1449,'Assets/img/phonelaptop/dell_xps15.png','Electronics')">Add To Cart</button>
        </div>

        <div class="product" data-category="electronics">
            <img src="https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=400&q=80" alt="iPad Pro M4" loading="lazy">
            <h3>iPad Pro M4 13"</h3>
            <p class="product-price">$1,099</p>
            <p class="product-old-price">$1,299</p>
            <button onclick="addToCart('iPad Pro M4',1099,'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=400&q=80','Electronics')">Add To Cart</button>
        </div>

        <div class="product" data-category="electronics">
            <img src="https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=400&q=80" alt="Samsung Galaxy Tab S9" loading="lazy">
            <h3>Samsung Galaxy Tab S9</h3>
            <p class="product-price">$699</p>
            <p class="product-old-price">$849</p>
            <button onclick="addToCart('Samsung Galaxy Tab S9',699,'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=400&q=80','Electronics')">Add To Cart</button>
        </div>

        <div class="product" data-category="electronics">
            <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&q=80" alt="Lenovo ThinkPad X1 Carbon" loading="lazy">
            <h3>Lenovo ThinkPad X1</h3>
            <p class="product-price">$1,299</p>
            <p class="product-old-price">$1,599</p>
            <button onclick="addToCart('Lenovo ThinkPad X1',1299,'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&q=80','Electronics')">Add To Cart</button>
        </div>

        <div class="product" data-category="electronics">
            <img src="https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2?w=400&q=80" alt="HP Spectre x360" loading="lazy">
            <h3>HP Spectre x360 14"</h3>
            <p class="product-price">$1,249</p>
            <p class="product-old-price">$1,499</p>
            <button onclick="addToCart('HP Spectre x360',1249,'https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2?w=400&q=80','Electronics')">Add To Cart</button>
        </div>

        <div class="product" data-category="electronics">
            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&q=80" alt="Google Pixel 8 Pro" loading="lazy">
            <h3>Google Pixel 8 Pro</h3>
            <p class="product-price">$899</p>
            <p class="product-old-price">$999</p>
            <button onclick="addToCart('Google Pixel 8 Pro',899,'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&q=80','Electronics')">Add To Cart</button>
        </div>

        <div class="product" data-category="electronics">
            <img src="https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=400&q=80" alt="OnePlus 12 Pro" loading="lazy">
            <h3>OnePlus 12 Pro</h3>
            <p class="product-price">$799</p>
            <p class="product-old-price">$999</p>
            <button onclick="addToCart('OnePlus 12 Pro',799,'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=400&q=80','Electronics')">Add To Cart</button>
        </div>

        <div class="product" data-category="electronics">
            <img src="https://images.unsplash.com/photo-1593642632559-0c6d3fc62b89?w=400&q=80" alt="Asus ROG Laptop" loading="lazy">
            <h3>Asus ROG Strix G16</h3>
            <p class="product-price">$1,599</p>
            <p class="product-old-price">$1,999</p>
            <button onclick="addToCart('Asus ROG Strix G16',1599,'https://images.unsplash.com/photo-1593642632559-0c6d3fc62b89?w=400&q=80','Electronics')">Add To Cart</button>
        </div>

        <div class="product" data-category="electronics">
            <img src="https://images.unsplash.com/photo-1484788984921-03950022c38b?w=400&q=80" alt="Surface Pro 9" loading="lazy">
            <h3>Microsoft Surface Pro 9</h3>
            <p class="product-price">$1,299</p>
            <p class="product-old-price">$1,499</p>
            <button onclick="addToCart('Microsoft Surface Pro 9',1299,'https://images.unsplash.com/photo-1484788984921-03950022c38b?w=400&q=80','Electronics')">Add To Cart</button>
        </div>

        <div class="product" data-category="electronics">
            <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=400&q=80" alt="MacBook Pro 14 M3 Pro" loading="lazy">
            <h3>MacBook Pro 14" M3 Pro</h3>
            <p class="product-price">$1,999</p>
            <p class="product-old-price">$2,299</p>
            <button onclick="addToCart('MacBook Pro 14 M3 Pro',1999,'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=400&q=80','Electronics')">Add To Cart</button>
        </div>

    </section>

    <?php include 'footer.php'; ?>

    <script>
    // Update product count when filtering
    const allFilterBtns = document.querySelectorAll('.filter-btn');
    allFilterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            setTimeout(() => {
                const visible = document.querySelectorAll('.product:not([style*="none"])').length;
                document.getElementById('visible-count').textContent = visible;
            }, 50);
        });
    });
    </script>

</body>
</html>
<?php
    include 'layouts/header.php';


?>
<main class="main-wrapper">
    <!-- Start Slider Area -->
    <div class="axil-main-slider-area main-slider-style-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="main-slider-content">
                        <h1 class="title">Discover Timeless Antiques and Retro Masterpieces.</h1>
                        <div class="shop-btn">
                            <a href="shop.php" class="axil-btn btn-bg-primary"><i class="far fa-shopping-cart"></i> Explore Now!</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="slide-thumb-area">
                        <div class="main-thumb">
                            <img src="assets/images/banner/Anqique_collection.jpg" alt="Antique Product">
                        </div>
                        <div class="banner-product">
                            <div class="product-details">
                                <h4 class="title"><a href="shop.php">Discover Unique Pcs here</a></h4>
                                <div class="price"> £25.00 - £50.00 (sample) </div>
                                <div class="product-rating">
                                    <span class="icon">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </span>
                                    <span class="rating-number">1,200 (sample) </span>
                                </div>
                            </div>
                            <div class="plus-icon">
                                <i class="far fa-plus"></i>
                            </div>
                        </div>
                        <ul class="shape-group">
                            <li class="shape-1">
                                <svg width="717" height="569" viewBox="0 0 717 569" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M700.635 568.176C593.701 653.555 569.268 645.843 418.418 256.006C229.855 -231.289 -105.017 93.7591 62.1304 620.614" stroke="url(#paint0_linear_3774_13416)" stroke-width="32" stroke-linecap="round" />
                                    <defs>
                                        <linearGradient id="paint0_linear_3774_13416" x1="359.308" y1="-263.741" x2="-235.553" y2="631.772" gradientUnits="userSpaceOnUse">
                                            <stop offset="0.258739" stop-color="#FAF1EE" />
                                            <stop offset="1" stop-color="#FEEAE9" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </li>
                            <li class="shape-2">
                                <svg width="806" height="605" viewBox="0 0 806 605" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1478_3882)">
                                        <path d="M786.673 3C806.703 135.413 745.738 384.513 341.63 321.606C-163.504 242.971 -51.9045 685.856 476.273 802" stroke="url(#paint0_linear_1478_3882)" stroke-width="32" stroke-linecap="round" />
                                    </g>
                                    <defs>
                                        <linearGradient id="paint0_linear_1478_3882" x1="-232.181" y1="-67.0641" x2="659.844" y2="1032.81" gradientUnits="userSpaceOnUse">
                                            <stop offset="0.525282" stop-color="#FBE9E3" />
                                            <stop offset="1" stop-color="#FFD3C5" />
                                        </linearGradient>
                                        <clipPath id="clip0_1478_3882">
                                            <rect width="806" height="605" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Slider Area -->

    <!-- Start Categorie Area  -->
    <div class="bg-color-white axil-section-gapcommon">
        <div class="container">
            <div class="slider-section-title section-title-border">
                <h2 class="title">Featured Categories</h2>
            </div>
            <div class="categrie-product-activation-4 slick-layout-wrapper--15 axil-slick-angle angle-top-slide">
                <div class="slick-single-layout">
                    <div class="row row-cols-lg-5 row-cols-sm-3 row-cols-2">

                    <?php
                                $sqlCat="SELECT * FROM tbl_categories";
                                $rsCat=$conn->query($sqlCat);

                                if($rsCat->num_rows>0){
                                    while($rowsCat=$rsCat->fetch_assoc()){
                                        ?>

                        <div class="col-lg-3">
                            <div class="categrie-product categrie-product-4" data-sal="zoom-out" data-sal-delay="100" data-sal-duration="500">
                                <a href="shop.php?cat_id=<?= $rowsCat['cat_id'] ?>" class="cate-thumb">
                                    <img src="admin/uploads/categories/<?= $rowsCat['cat_image'] ?>" alt="Antique Furniture">
                                    <h5 class="cat-title"><?= $rowsCat['cat_name'] ?></h5>
                                </a>
                            </div>
                        </div>

                        <?php
                                    }
                                }
                                ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Categorie Area  -->
    <!-- <div class="product-collection-area bg-lighter axil-section-gapcommon">
        <div class="container">
            <div class="section-title-border">
                <h2 class="title">Today’s Best Deals 💥</h2>
                <div class="view-btn"><a href="shop.php">View All Deals</a></div>
            </div>
            <div class="row">
                <div class="col-xl-7">
                    <div class="product-collection product-collection-two">
                        <div class="collection-content">
                            <h3 class="title" style="color:#fff;">Decorative Vintage Lamp</h3>
                            <div class="price-warp">
                                <span class="price-text" style="color:#fff;">Starting From</span>
                                <span class="price" style="color:#ffc9d7;">$60.00</span>
                            </div>
                            <div class="shop-btn">
                                <a href="shop.php" class="axil-btn btn-bg-primary btn-size-md"><i class="far fa-shopping-cart"></i> View All Items</a>
                            </div>
                        </div>
                        <div class="collection-thumbnail">
                            <img src="assets/images/product/vintage_lamp.png" alt="Decorative Lamp">
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-collection-three">
                                <div class="collection-content">
                                    <h6 class="title"><a href="shop.php">Vintage Wooden Clock</a></h6>
                                    <div class="price-warp">
                                        <span class="price-text">Starting From</span>
                                        <span class="price">$45.00</span>
                                    </div>
                                </div>
                                <div class="collection-thumbnail">
                                    <img src="assets/images/product/collection_5.png" alt="Vintage Wooden Clock">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-collection-three">
                                <div class="collection-content">
                                    <h6 class="title"><a href="shop.php">Retro Art Piece</a></h6>
                                    <div class="price-warp">
                                        <span class="price-text">Starting From</span>
                                        <span class="price">$100.00</span>
                                    </div>
                                </div>
                                <div class="collection-thumbnail">
                                    <img src="assets/images/product/collection_6.png" alt="Retro Art Piece">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-collection-three">
                                <div class="collection-content">
                                    <h6 class="title"><a href="shop.php">Victorian Era Pocket Watches</a></h6>
                                    <div class="price-warp">
                                        <span class="price-text">Starting From</span>
                                        <span class="price">$5,500.00</span>
                                    </div>
                                </div>
                                <div class="collection-thumbnail">
                                    <img src="assets/images/product/collection_6.png" alt="Retro Art Piece">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-collection-three">
                                <div class="collection-content">
                                    <h6 class="title"><a href="shop.php">Art Nouveau Jewelry</a></h6>
                                    <div class="price-warp">
                                        <span class="price-text">Starting From</span>
                                        <span class="price">$12,500.00</span>
                                    </div>
                                </div>
                                <div class="collection-thumbnail">
                                    <img src="assets/images/product/collection_6.png" alt="Retro Art Piece">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Start Expolre Product Area  -->
    <br><br>
    <!-- End Expolre Product Area -->
    <div class="delivery-poster-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="delivery-poster pickup">
                        <div class="content">
                            <span class="badge">Always free</span>
                            <h4 class="title">Order Pickup</h4>
                            <p>Choose Order Pickup & we’ll have it waiting for you inside the store.</p>
                        </div>
                        <div class="thumbnail">
                            <img src="assets/images/banner/order_pickup.png" style="border-radius:20px;" alt="Order Pickup">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="delivery-poster delivery">
                        <div class="content">
                            <span class="badge">Fast delivery</span>
                            <h4 class="title">Same Day Delivery</h4>
                            <p>We will deliver your goods on the same day to your doorstep.</p>
                        </div>
                        <div class="thumbnail">
                            <img src="assets/images/banner/delivery.png" style="border-radius:20px;" alt="Same Day Delivery">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include 'layouts/footer.php'; ?>

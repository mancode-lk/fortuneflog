<?php
    include 'layouts/header.php';

   
?>

    <main class="main-wrapper">
        <!-- Start Breadcrumb Area  -->
        <div class="axil-breadcrumb-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="inner">
                            <ul class="axil-breadcrumb">
                                <li class="axil-breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="separator"></li>
                                <li class="axil-breadcrumb-item active" aria-current="page">My Account</li>
                            </ul>
                            <h1 class="title">Explore All Products</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <div class="inner">
                            <div class="bradcrumb-thumb">
                                <img src="assets/images/product/product-45.png" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- End Breadcrumb Area  -->
        <!-- Start Shop Area  -->
        <div class="axil-shop-area axil-section-gap bg-color-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="axil-shop-top">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="category-select">

                                        <!-- Start Single Select  -->
                                        <select class="single-select" onchange="loadProducts(this.value)">
                                        <option>Categories</option>
                                        <?php
                                        $sqlCat="SELECT * FROM tbl_categories";
                                        $rsCat=$conn->query($sqlCat);

                                        if($rsCat->num_rows>0){
                                            while($rowsCat=$rsCat->fetch_assoc()){
                                               ?>
                                        <option value="<?= $rowsCat['cat_id'] ?>"><?= $rowsCat['cat_name'] ?></option>
                                        
                                        <?php 
                                            }
                                        }
                                        ?>
                                    </select>

                                        <!-- End Single Select  -->


                                        <!-- Start Single Select  -->
                                        <select class="single-select">
                                            <option>Price Range</option>
                                            <option>0 - 100</option>
                                            <option>100 - 500</option>
                                            <option>500 - 1000</option>
                                            <option>1000 - 1500</option>
                                        </select>
                                        <!-- End Single Select  -->

                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div id="viewProducts">

                </div>

                <div class="text-center pt--30">
                    <a onclick="loadMore()" class="axil-btn btn-bg-lighter btn-load-more">Load more</a>
                </div>
            </div>
            <!-- End .container -->
        </div>
        <!-- End Shop Area  -->
        <!-- Start Axil Newsletter Area  -->
        <div class="axil-newsletter-area axil-section-gap pt--0">
            <div class="container">
                <div class="etrade-newsletter-wrapper bg_image bg_image--5">
                    <div class="newsletter-content">
                        <span class="title-highlighter highlighter-primary2"><i class="fas fa-envelope-open"></i>Newsletter</span>
                        <h2 class="title mb--40 mb_sm--30">Get weekly update</h2>
                        <div class="input-group newsletter-form">
                            <div class="position-relative newsletter-inner mb--15">
                                <input placeholder="example@gmail.com" type="text">
                            </div>
                            <button type="submit" class="axil-btn mb--15">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End .container -->
        </div>
        <!-- End Axil Newsletter Area  -->
    </main>


    <div class="service-area">
        <div class="container">
            <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20">
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="./assets/images/icons/service1.png" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Fast &amp; Secure Delivery</h6>
                            <p>Tell about your service.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="./assets/images/icons/service2.png" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Money Back Guarantee</h6>
                            <p>Within 10 days.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="./assets/images/icons/service3.png" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">24 Hour Return Policy</h6>
                            <p>No question ask.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="service-box service-style-2">
                        <div class="icon">
                            <img src="./assets/images/icons/service4.png" alt="Service">
                        </div>
                        <div class="content">
                            <h6 class="title">Pro Quality Support</h6>
                            <p>24/7 Live support.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Footer Area  -->
    <?php
      include 'layouts/footer.php';
  ?>

<script>

$(document).ready(function() {
    let page = 1; // Initialize page counter
    
    // Initial load
    loadProducts(page);

    // Load products function with pagination
    window.loadProducts = function(pageNumber) {
        const urlParams = new URLSearchParams(window.location.search);
        const catId = urlParams.get('cat_id');
        let url = `ajax/viewProducts.php?page=${pageNumber}`;
        
        if (catId) {
            url += `&cat_id=${encodeURIComponent(catId)}`;
        }

        $.get(url, function(data) {
            if (pageNumber === 1) {
                $('#viewProducts').html(data);
            } else {
                $('#viewProducts').append(data);
            }
            
            // Hide load more button if no more results
            if (data.trim().length === 0) {
                $('.btn-load-more').hide();
            }
        });
    };

    // Load more button handler
    window.loadMore = function() {
        page++;
        loadProducts(page);
    };
});


            $(document).ready(function() {
                // Get URL parameters
                const urlParams = new URLSearchParams(window.location.search);
                const catId = urlParams.get('cat_id');

                // Build the URL for AJAX load
                let loadUrl = 'ajax/viewProducts.php';
                if (catId) {
                    loadUrl += '?cat_id=' + encodeURIComponent(catId);
                }

                // Load products dynamically
                $('#viewProducts').load(loadUrl);
            });


            function loadProducts(catId) {
                let url = 'ajax/viewProducts.php';
                if (catId && catId !== 'Categories') {
                    url += '?cat_id=' + encodeURIComponent(catId);
                }
                $('#viewProducts').load(url);
            }

</script>
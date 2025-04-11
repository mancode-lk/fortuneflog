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
                                        <option value="">All Categories</option>
                                        <?php
                                        $rsCat = $conn->query("SELECT * FROM tbl_categories");
                                        while ($row = $rsCat->fetch_assoc()) {
                                            $selected = ($row['cat_id'] == $_GET['cat_id']) ? 'selected' : '';
                                            echo "<option value='{$row['cat_id']}' $selected>{$row['cat_name']}</option>";
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



<!-- Product Quick View Modal Start -->
<div class="modal fade quick-view-product" id="quick-view-modal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div id="product_detail">

        </div>

    </div>
</div>
<!-- Product Quick View Modal End -->


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
    let currentPage = 1;
    let currentCategory = new URLSearchParams(window.location.search).get('cat_id') || '';

    function loadProducts(pageNumber, category) {
        let url = `ajax/viewProducts.php?page=${pageNumber}`;
        if (category && category !== 'Categories') {
            url += `&cat_id=${encodeURIComponent(category)}`;
        }

        $.get(url, function(data) {
            if (pageNumber === 1) {
                $('#viewProducts').html(data);
            } else {
                $('#viewProducts').append(data);
            }

            // Hide load more button if no more results
            $('.btn-load-more').toggle(data.trim().length > 0);
        }).fail(() => $('.btn-load-more').hide());
    }

    // Initial load
    loadProducts(currentPage, currentCategory);

    // Handle category change
    window.loadProducts = function(catId) {
        currentCategory = catId;
        currentPage = 1;
        const url = new URL(window.location);
        catId !== 'Categories'
            ? url.searchParams.set('cat_id', catId)
            : url.searchParams.delete('cat_id');
        history.pushState({}, '', url);
        loadProducts(currentPage, currentCategory);
    };

    // Handle load more
    window.loadMore = () => loadProducts(++currentPage, currentCategory);

    // Handle browser navigation
    window.addEventListener('popstate', () => {
        currentCategory = new URLSearchParams(window.location.search).get('cat_id') || '';
        currentPage = 1;
        loadProducts(currentPage, currentCategory);
    });
});

function openProductModal(product_id){
    $('#quick-view-modal').modal('show');
    $('#product_detail').load('ajax/product_detail.php',{product_id:product_id});
}

</script>

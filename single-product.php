<?php
    include 'layouts/header.php';

    if(isset($_REQUEST['product_id'])){
        $product_id=$_REQUEST['product_id'];
        $sqlProduct="SELECT * FROM tbl_products WHERE p_id='$product_id'";
        $rsProduct=$conn->query($sqlProduct);

        if($rsProduct->num_rows==1){
            $rowsProduct=$rsProduct->fetch_assoc();
            ?>

    <main class="main-wrapper">
        <!-- Start Shop Area  -->
        <div class="axil-single-product-area axil-section-gap pb--0 bg-color-white">
            <div class="single-product-thumb mb--40">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 mb--40">
                            <div class="row">
                                <div class="col-lg-10 order-lg-2">
                                <div class="single-product-thumbnail-wrap zoom-gallery">
                                    <div class="single-product-thumbnail product-large-thumbnail-3 axil-product">
                                        <?php 
                                        // Get first image as default
                                        $firstImage = 'admin/uploads/products/'.$rowsProduct['p_image']; // Default fallback
                                        $sqlImages="SELECT * FROM tbl_images WHERE product_id='$product_id'";
                                        $rsImages=$conn->query($sqlImages);
                                       
                                        ?>
                                        <div class="thumbnail">
                                            <a href="<?= $firstImage ?>" class="popup-zoom">
                                                <img src="<?= $firstImage ?>" alt="Product Images" id="mainProductImage">
                                            </a>
                                        </div>
                                    
                                    </div>
                                    <div class="label-block">
                                    <?php 
                                    
                                    // Add LIMIT 1 to get only the last entry
                                    $sqlOffer = "SELECT * FROM tbl_offer WHERE product_id='$product_id' ORDER BY created_at DESC LIMIT 1";
                                    $rsOffer = $conn->query($sqlOffer);
                                    $offerPercent=0;
                                    if ($rsOffer->num_rows > 0) {
                                        $offer = $rsOffer->fetch_assoc(); // Fix typo here ("frtch" → "fetch")
                                        $offerPercent=$offer['offer_percentage'];
                                        ?>
                                        <div class="product-badget"><?= $offer['offer_percentage'] ?>% OFF</div>
                                        <?php
                                    }

                                     $current_price= $rowsProduct['p_price'] - ($rowsProduct['p_price']*$offerPercent)/100;
                                    ?>
                                        </div>
                                </div>
                                </div>
                                <div class="col-lg-2 order-lg-1">
                                    <div class="product-small-thumb-3 small-thumb-wrapper">
                                    <?php 
                                    if($rsImages->num_rows > 0) {
                                        while($rowsImages = $rsImages->fetch_assoc()) {
                                            $imagePath = 'admin/uploads/products_more_images/' . $rowsImages['image_path'];
                                            ?>
                                            <div class="small-thumb-img" onclick="changeMainImage('<?= $imagePath ?>')">
                                                <img src="<?= $imagePath ?>" alt="thumb image">
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 mb--40">
                            <div class="single-product-content">
                                <div class="inner">
                                    <h2 class="product-title"><?= $rowsProduct['p_title'] ?></h2>
                                    <span class="price-amount">$<?= $current_price ?></span>
                                    <!-- <div class="product-rating">
                                        <div class="star-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <div class="review-link">
                                            <a href="#">(<span>2</span> customer reviews)</a>
                                        </div>
                                    </div> -->
                                    <ul class="product-meta">

                                    <?php 
                                    $sqlFeatures="SELECT * FROM tbl_features WHERE product_id='$product_id'";
                                    $rsFeatures=$conn->query($sqlFeatures);
                                    if($rsFeatures->num_rows>0){
                                        while($rowsFeatures=$rsFeatures->fetch_assoc()){
                                            ?>
                                            
                                        <li><i class="fal fa-check"></i><?= $rowsFeatures['feature_text'] ?></li>
                                        <?php
                                        }
                                    }else{
                                        ?>
                                         <li>No features added</li>
                                        <?php

                                    }
                                    ?>
                                    </ul>
                                    <!-- <p class="description">In ornare lorem ut est dapibus, ut tincidunt nisi pretium. Integer ante est, elementum eget magna. Pellentesque sagittis dictum libero, eu dignissim tellus.</p> -->

                                    <div class="product-variations-wrapper">

                                        <!-- Start Product Variation  -->
                                        <div class="product-variation">
                                                <h6 class="title">Colors:</h6>
                                                <?php 
                                                $sqlColor = "SELECT * FROM tbl_color WHERE product_id='$product_id'";
                                                $rsColor = $conn->query($sqlColor);
                                                if ($rsColor->num_rows > 0) {
                                                ?>
                                                <div class="color-variant-wrapper">
                                                    <ul class="color-variant">
                                                        <?php
                                                        $colorIndex = 0;
                                                        while ($rowsColor = $rsColor->fetch_assoc()) {
                                                            $activeClass = $colorIndex === 0 ? 'active' : '';
                                                        ?>
                                                        <li class="color-extra-0<?= ($colorIndex+1) ?> <?= $activeClass ?>" 
                                                            style="background-color: <?= htmlspecialchars($rowsColor['color_name']) ?>">
                                                            <span>
                                                                <span class="color"></span>
                                                            </span>
                                                        </li>
                                                        <?php
                                                            $colorIndex++;
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                                <?php }else{
                                                    ?>
                                                    <li>No colors available</li>
                                                    <?php
                                                } ?>
                                            </div>
                                        <!-- End Product Variation  -->

                                        <!-- Start Product Variation  -->
                                        <div class="product-variation product-size-variation">
                                            <h6 class="title">Size:</h6>
                                            <?php
                                             $sqlSize="SELECT * FROM tbl_sizes WHERE product_id='$product_id'";
                                             $rsSize=$conn->query($sqlSize);
                                             ?>
                                            
                                            <ul class="range-variant">
                                            <?php
                                             if($rsSize->num_rows>0){
                                                 while($rowsSize=$rsSize->fetch_assoc()){
                                                     ?>
                                               
                                                <li><?= $rowsSize['size'] ?></li>
                                                <?php
                                                 }
                                             }else{
                                                ?>
                                                <li>No size available</li>
                                                <?php
                                             }
                                            
                                            ?>
                                            </ul>
                                        </div>
                                        <!-- End Product Variation  -->

                                    </div>

                                    <!-- Start Product Action Wrapper  -->
                                    <div class="product-action-wrapper d-flex-center">
                                        <!-- Start Quentity Action  -->
                                        <div class="pro-qty"><input type="text" value="1"></div>
                                        <!-- End Quentity Action  -->

                                        <!-- Start Product Action  -->
                                        <ul class="product-action d-flex-center mb--0">
                                            <li class="add-to-cart"><a href="cart.php?product_id=<?= $product_id ?>" class="axil-btn btn-bg-primary">Add to Cart</a></li>
                                            <li class="wishlist"><a href="wishlist.html" class="axil-btn wishlist-btn"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <!-- End Product Action  -->

                                    </div>
                                    <!-- End Product Action Wrapper  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End .single-product-thumb -->

            <div class="woocommerce-tabs wc-tabs-wrapper bg-vista-white">
                <div class="container">
                    <ul class="nav tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item " role="presentation">
                            <a id="additional-info-tab" data-bs-toggle="tab" href="#additional-info" role="tab" aria-controls="additional-info" aria-selected="false">Additional Information</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <div class="product-desc-wrapper">
                                <div class="row">
                                <?php 
                                            $sqlDetails="SELECT * FROM tbl_advance_details WHERE product_id='$product_id'";
                                            $rsDetails=$conn->query($sqlDetails);
                                            if($rsDetails->num_rows>0){
                                                while($rowsDetails=$rsDetails->fetch_assoc()){
                                                    ?>

                                    <div class="col-lg-6 mb--30">
                                        <div class="single-desc">
                                            <h5 class="title"><?= $rowsDetails['ad_heading'] ?></h5>
                                            <p><?= $rowsDetails['ad_description'] ?></p>
                                        </div>
                                    </div>
                                    
                                    <?php
                                                }
                                            }else{
                                                ?>
                                                <?php
                                            }
                                            ?>
                                    
                                </div>
                                <!-- End .row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="pro-des-features">
                                            <li class="single-features">
                                                <div class="icon">
                                                    <img src="assets/images/product/product-thumb/icon-3.png" alt="icon">
                                                </div>
                                                Easy Returns
                                            </li>
                                            <li class="single-features">
                                                <div class="icon">
                                                    <img src="assets/images/product/product-thumb/icon-2.png" alt="icon">
                                                </div>
                                                Quality Service
                                            </li>
                                            <li class="single-features">
                                                <div class="icon">
                                                    <img src="assets/images/product/product-thumb/icon-1.png" alt="icon">
                                                </div>
                                                Original Product
                                            </li>
                                        </ul>
                                        <!-- End .pro-des-features -->
                                    </div>
                                </div>
                                <!-- End .row -->
                            </div>
                            <!-- End .product-desc-wrapper -->
                        </div>
                        <div class="tab-pane fade" id="additional-info" role="tabpanel" aria-labelledby="additional-info-tab">
                            <div class="product-additional-info">
                                <div class="table-responsive">
                                    <table>
                                        <tbody>

                                        <?php 
                                            $sqlSpecs="SELECT * FROM tbl_specifications WHERE product_id='$product_id'";
                                            $rsSpecs=$conn->query($sqlSpecs);
                                            if($rsSpecs->num_rows>0){
                                                while($rowsSpecs=$rsSpecs->fetch_assoc()){
                                                    ?>
                                                   
                                            <tr>
                                                <th><?= $rowsSpecs['spec_name'] ?></th>
                                                <td><?= $rowsSpecs['spec_value'] ?></td>
                                            </tr>

                                            <?php
                                                }
                                            }
                                            ?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="reviews-wrapper">
                                <div class="row">
                                    <div class="col-lg-6 mb--40">
                                        <div class="axil-comment-area pro-desc-commnet-area">
                                            <h5 class="title">01 Review for this product</h5>
                                            <ul class="comment-list">
                                                <!-- Start Single Comment  -->
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <div class="single-comment">
                                                            <div class="comment-img">
                                                                <img src="./assets/images/blog/author-image-4.png" alt="Author Images">
                                                            </div>
                                                            <div class="comment-inner">
                                                                <h6 class="commenter">
                                                                    <a class="hover-flip-item-wrapper" href="#">
                                                                        <span class="hover-flip-item">
                                                                            <span data-text="Cameron Williamson">Eleanor Pena</span>
                                                                        </span>
                                                                    </a>
                                                                    <span class="commenter-rating ratiing-four-star">
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star empty-rating"></i></a>
                                                                    </span>
                                                                </h6>
                                                                <div class="comment-text">
                                                                    <p>“We’ve created a full-stack structure for our working workflow processes, were from the funny the century initial all the made, have spare to negatives. ” </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- End Single Comment  -->

                                                <!-- Start Single Comment  -->
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <div class="single-comment">
                                                            <div class="comment-img">
                                                                <img src="./assets/images/blog/author-image-4.png" alt="Author Images">
                                                            </div>
                                                            <div class="comment-inner">
                                                                <h6 class="commenter">
                                                                    <a class="hover-flip-item-wrapper" href="#">
                                                                        <span class="hover-flip-item">
                                                                            <span data-text="Rahabi Khan">Courtney Henry</span>
                                                                        </span>
                                                                    </a>
                                                                    <span class="commenter-rating ratiing-four-star">
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                    </span>
                                                                </h6>
                                                                <div class="comment-text">
                                                                    <p>“We’ve created a full-stack structure for our working workflow processes, were from the funny the century initial all the made, have spare to negatives. ”</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- End Single Comment  -->

                                                <!-- Start Single Comment  -->
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <div class="single-comment">
                                                            <div class="comment-img">
                                                                <img src="./assets/images/blog/author-image-5.png" alt="Author Images">
                                                            </div>
                                                            <div class="comment-inner">
                                                                <h6 class="commenter">
                                                                    <a class="hover-flip-item-wrapper" href="#">
                                                                        <span class="hover-flip-item">
                                                                            <span data-text="Rahabi Khan">Devon Lane</span>
                                                                        </span>
                                                                    </a>
                                                                    <span class="commenter-rating ratiing-four-star">
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                        <a href="#"><i class="fas fa-star"></i></a>
                                                                    </span>
                                                                </h6>
                                                                <div class="comment-text">
                                                                    <p>“We’ve created a full-stack structure for our working workflow processes, were from the funny the century initial all the made, have spare to negatives. ” </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- End Single Comment  -->
                                            </ul>
                                        </div>
                                        <!-- End .axil-commnet-area -->
                                    </div>
                                    <!-- End .col -->
                                    <div class="col-lg-6 mb--40">
                                        <!-- Start Comment Respond  -->
                                        <div class="comment-respond pro-des-commend-respond mt--0">
                                            <h5 class="title mb--30">Add a Review</h5>
                                            <p>Your email address will not be published. Required fields are marked *</p>
                                            <div class="rating-wrapper d-flex-center mb--40">
                                                Your Rating <span class="require">*</span>
                                                <div class="reating-inner ml--20">
                                                    <a href="#"><i class="fal fa-star"></i></a>
                                                    <a href="#"><i class="fal fa-star"></i></a>
                                                    <a href="#"><i class="fal fa-star"></i></a>
                                                    <a href="#"><i class="fal fa-star"></i></a>
                                                    <a href="#"><i class="fal fa-star"></i></a>
                                                </div>
                                            </div>

                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Other Notes (optional)</label>
                                                            <textarea name="message" placeholder="Your Comment"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label>Name <span class="require">*</span></label>
                                                            <input id="name" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label>Email <span class="require">*</span> </label>
                                                            <input id="email" type="email">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-submit">
                                                            <button type="submit" id="submit" class="axil-btn btn-bg-primary w-auto">Submit Comment</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- End Comment Respond  -->
                                    </div>
                                    <!-- End .col -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- woocommerce-tabs -->

        </div>
        <!-- End Shop Area  -->

        <?php
        }
    }

    
?>
        <!-- Start Recently Viewed Product Area  -->
        <div class="axil-product-area bg-color-white axil-section-gap pb--50 pb_sm--30">
    <div class="container">
        <div class="section-title-wrapper">
            <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i> Your Recently</span>
            <h2 class="title">Viewed Antiques</h2>
        </div>
        <div class="recent-product-activation slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
            <!-- Victorian Sofa -->
            <div class="slick-single-layout">
                <div class="axil-product">
                    <div class="thumbnail">
                        <a href="single-product.html">
                            <img src="assets/images/product/electric/product-05.png" alt="Victorian Sofa">
                        </a>
                    </div>
                    <div class="product-content">
                        <div class="inner">
                            <h5 class="title"><a href="single-product.html">Victorian Sofa</a></h5>
                            <div class="product-price-variant">
                                <span class="price">$450</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Art Deco Lamp -->
            <div class="slick-single-layout">
                <div class="axil-product">
                    <div class="thumbnail">
                        <a href="single-product.html">
                            <img src="assets/images/product/electric/product-05.png" alt="Art Deco Lamp">
                        </a>
                    </div>
                    <div class="product-content">
                        <div class="inner">
                            <h5 class="title"><a href="single-product.html">Art Deco Lamp</a></h5>
                            <div class="product-price-variant">
                                <span class="price">$200</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vintage Jewelry Box -->
            <div class="slick-single-layout">
                <div class="axil-product">
                    <div class="thumbnail">
                        <a href="single-product.html">
                            <img src="assets/images/product/electric/product-05.png" alt="Vintage Jewelry Box">
                        </a>
                    </div>
                    <div class="product-content">
                        <div class="inner">
                            <h5 class="title"><a href="single-product.html">Vintage Jewelry Box</a></h5>
                            <div class="product-price-variant">
                                <span class="price">$120</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Antique Clock -->
            <div class="slick-single-layout">
                <div class="axil-product">
                    <div class="thumbnail">
                        <a href="single-product.html">
                            <img src="assets/images/product/electric/product-05.png" alt="Antique Clock">
                        </a>
                    </div>
                    <div class="product-content">
                        <div class="inner">
                            <h5 class="title"><a href="single-product.html">Antique Clock</a></h5>
                            <div class="product-price-variant">
                                <span class="price">$300</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Retro Fashion Dress -->
            <div class="slick-single-layout">
                <div class="axil-product">
                    <div the="thumbnail">
                        <a href="single-product.html">
                            <img src="assets/images/product/electric/product-05.png" alt="Retro Fashion Dress">
                        </a>
                    </div>
                    <div class="product-content">
                        <div class="inner">
                            <h5 class="title"><a href="single-product.html">Retro Fashion Dress</a></h5>
                            <div class="product-price-variant">
                                <span class="price">$150</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- End Recently Viewed Product Area  -->
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
    function changeMainImage(newSrc) {
    // Update main image
    document.getElementById('mainProductImage').src = newSrc;
    
    // Update popup zoom link
    document.querySelector('.popup-zoom').href = newSrc;
    
    // Update active thumbnail
    document.querySelectorAll('.small-thumb-img').forEach(thumb => {
        thumb.classList.remove('active-thumb');
    });
    event.currentTarget.classList.add('active-thumb');
}

// Initialize first thumbnail as active
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.small-thumb-img:first-child')?.classList.add('active-thumb');
});
</script>

<?php
include '../admin/backend/conn.php';
$product_id=$_REQUEST['product_id'];

                                            $sqlProduct="SELECT * FROM tbl_products WHERE p_id='$product_id'";
                                            $rsProduct=$conn->query($sqlProduct);
                                            if($rsProduct->num_rows==1){?>
                                            <?php
                                               $rowsProduct=$rsProduct->fetch_assoc();
                                                    ?>
                                               

<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times"></i></button>
            </div>
          

<div class="modal-body">
                <div class="single-product-thumb">
                    <div class="row">
                        <div class="col-lg-7 mb--40">
                            <div class="row">
                                <div class="col-lg-10 order-lg-2">
                                    <div class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">
                                      
                                        <div class="thumbnail">
                                            <img src="admin/uploads/products/<?= $rowsProduct['p_image'] ?>" alt="Product Images">
                                            <div class="label-block label-right">
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
                                                ?>
                                            </div>
                                            <div class="product-quick-view position-view">
                                                <a href="admin/uploads/products/<?= $rowsProduct['p_image'] ?>" class="popup-zoom">
                                                    <i class="far fa-search-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="col-lg-2 order-lg-1">
                                    <div class="product-small-thumb small-thumb-wrapper">
                                        <?php 
                                        $sqlImages="SELECT * FROM tbl_images WHERE product_id='$product_id'";
                                        $rsImages=$conn->query($sqlImages);
                                        if($rsImages->num_rows>0){
                                            while($rowsImages=$rsImages->fetch_assoc()){
                                                ?>
                                        <div class="small-thumb-img">
                                            <img src="admin/uploads/products_more_images/<?= $rowsImages['image_path'] ?>" alt="thumb image">
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
                                    <div class="product-rating">
                                        <div class="star-rating">
                                            <img src="assets/images/icons/rate.png" alt="Rate Images">
                                        </div>
                                        <!-- <div class="review-link">
                                            <a href="#">(<span>1</span> customer reviews)</a>
                                        </div> -->
                                    </div>
                                    <h3 class="product-title"><?= $rowsProduct['p_title'] ?></h3>
                                    <?php $current_price= $rowsProduct['p_price'] - ($rowsProduct['p_price']*$offerPercent)/100; ?>
                                    <span class="price-amount"><?= $current_price ?></span>
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
                                            <li class="add-to-cart"><a href="cart.php" class="axil-btn btn-bg-primary">Add to Cart</a></li>
                                            <li class="wishlist"><a href="wishlist.php" class="axil-btn wishlist-btn"><i class="far fa-heart"></i></a></li>
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

              
        </div>

        <?php
                                            }
?>
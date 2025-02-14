              
              
          <?php 
            include '../admin/backend/conn.php';

            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $itemsPerPage = 4;
            $offset = ($page - 1) * $itemsPerPage;

            $cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : null;

            if ($cat_id) {
                $stmt = $conn->prepare("SELECT * FROM tbl_products WHERE p_categories = ? LIMIT ? OFFSET ?");
                $stmt->bind_param("iii", $cat_id, $itemsPerPage, $offset);
            } else {
                $stmt = $conn->prepare("SELECT * FROM tbl_products LIMIT ? OFFSET ?");
                $stmt->bind_param("ii", $itemsPerPage, $offset);
            }

            $stmt->execute();
            $result = $stmt->get_result();
            ?>
              
              <div class="row row--15">

              <?php
                if($result->num_rows>0){
                    while($rows=$result->fetch_assoc()){
                        $product_id = $rows['p_id'];
                        ?>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="axil-product product-style-one has-color-pick mt--40">
                            <div class="thumbnail">
                                <a href="single-product.php?product_id=<?= $product_id ?>">
                                    <img src="admin/uploads/products/<?= $rows['p_image'] ?>" alt="Product Images">
                                </a>
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
                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        <li class="wishlist"><a href="wishlist.php"><i class="far fa-heart"></i></a></li>
                                        <li class="select-option"><a href="cart.php">Add to Cart</a></li>
                                        <li class="quickview">
                                        <a onclick="openProductModal(<?= $product_id ?>)" data-bs-toggle="modal">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a href="single-product.php?product_id=<?= $product_id ?>"><?= $rows['p_title'] ?></a></h5>
                                    <div class="product-price-variant">
                                        <?php $current_price= $rows['p_price'] - ($rows['p_price']*$offerPercent)/100; ?>

                                        <span class="price current-price">$<?= $current_price ?></span>
                                        <span class="price old-price">$<?= $rows['p_price'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <?php
                    }
                }else{
                    ?>
                    <p>No more products available</p>
                    <?php
                }
              ?>
                </div>
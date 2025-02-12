<?php
                                $sqlCat="SELECT * FROM tbl_categories";
                                $rsCat=$conn->query($sqlCat);

                                if($rsCat->num_rows>0){
                                    while($rowsCat=$rsCat->fetch_assoc()){
                                        
                                    }
                                }
                                ?>

<?php 
                                            $sqlColor="SELECT * FROM tbl_color WHERE product_id='$product_id'";
                                            $rsColor=$conn->query($sqlColor);
                                            if($rsColor->num_rows>0){
                                                while($rowsColor=$rsColor->fetch_assoc()){
                                                    ?>
                                                    <?php
                                                }
                                            }
                                            ?>
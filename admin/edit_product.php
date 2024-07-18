<?php
// include header file
include 'header.php'; ?>
<div class="admin-content-container">
    <h2 class="admin-heading">Edit Product</h2>
    <?php
    $id = $_GET['id'];
    $products = "SELECT * FROM products where product_id = '$id'";
    $row = mysqli_query($conn, $products);
    $result = mysqli_fetch_all($row, MYSQLI_ASSOC);
    // echo '<pre>';
    // print_r($result);
    // echo '</pre>';

    if ($result > 0) {
        foreach ($result as $row) { ?>
            <form id="updateProduct" class="add-post-form row" method="post" enctype="multipart/form-data">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="">Product Title</label>
                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
                        <input type="text" class="form-control product_title" name="product_title" value="<?php echo $row['product_title']; ?>" placeholder="Product Title" />
                    </div>
                    <div class="form-group category">
                        <label for="">Product Category</label>
                        <?php
                        $categories = "SELECT * FROM categories";
                        $row2 = mysqli_query($conn, $categories);
                        $result2 = mysqli_fetch_all($row2, MYSQLI_ASSOC);

                        if ($result2 > 0) { ?>
                            <select class="form-control product_category" name="product_cat">
                                <?php foreach ($result2 as $row2) {
                                    if ($row['product_cat'] == $row2['cat_id']) { ?>
                                        <option selected value="<?php echo $row2['cat_id']; ?>"><?php echo $row2['cat_title']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $row2['id']; ?>"><?php echo $row2['category_title']; ?></option>
                                    <?php  } ?>
                                <?php } ?>
                            </select>
                        <?php } ?>
                    </div>
                    <div class="form-group sub_category">
                        <label for="">Product Sub-Category</label>
                        <?php
                        $sub_categories = "SELECT * FROM sub_categories where cat_parent = '{$row['product_cat']}'";
                        $row3 = mysqli_query($conn, $categories);
                        $result3 = mysqli_fetch_all($row3, MYSQLI_ASSOC);
                        // echo '<pre>';
                        // print_r($result3);
                        // echo '</pre>';

                        if ($result3 > 0) { ?>
                            <select class="form-control product_sub_category" name="product_sub_cat">
                                <?php foreach ($result3 as $row3) {
                                    if ($row['product_sub_cat'] == $row3['sub_cat_id']) { ?>
                                        <option selected value="<?php echo $row3['sub_cat_id']; ?>"><?php echo $row3['sub_cat_title']; ?></option>
                                    <?php   } else { ?>
                                        <option value="<?php echo $row3['id']; ?>"><?php echo $row3['category_title']; ?></option>
                                <?php    }
                                } ?>
                            </select>
                        <?php } ?>
                    </div>
                    <div class="form-group brand">
                        <label for="">Product Brand</label>
                        <?php
                        $brands = "SELECT * FROM brands where brand_cat = '{$row['product_cat']}'";
                        $row4 = mysqli_query($conn, $brands);
                        $result4 = mysqli_fetch_all($row4, MYSQLI_ASSOC);
                        if ($result4 > 0) { ?>
                            <select class="form-control product_brands" name="product_brand">
                                <option value="">Select Brand</option>
                                <?php foreach ($result4 as $row4) {
                                    if ($row['product_brand'] == $row4['brand_id']) { ?>
                                        <option selected value="<?php echo $row4['brand_id']; ?>"><?php echo $row4['brand_title']; ?></option>
                                    <?php   } else { ?>
                                        <option value="<?php echo $row4['brand_id']; ?>"><?php echo $row4['brand_title']; ?></option>
                                <?php    }
                                } ?>
                            </select>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="">Product Description</label>
                        <?php
                        $productss = "SELECT * FROM products where product_id = '$id'";
                        $roww = mysqli_query($conn, $productss);
                        if (mysqli_num_rows($roww) > 0) {
                            while ($res = mysqli_fetch_assoc($roww)) { ?>
                                <textarea class="form-control product_description" name="product_desc" rows="8" cols="80"><?php echo $row['product_desc']; ?></textarea>
                        <?php  }
                        } ?>



                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Featured Image</label>
                        <input type="file" class="product_image" name="new_image">
                        <input type="hidden" class="old_image" name="old_image" value="<?php echo $row['featured_image']; ?>">
                        <img id="image" src="../product-images/<?php echo $row['featured_image']; ?>" alt="" width="100px" />
                    </div>
                    <div class="form-group">
                        <label for="">Product Price</label>
                        <input type="text" class="form-control product_price" name="product_price" value="<?php echo $row['product_price']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Available Quantity</label>
                        <input type="number" class="form-control product_qty" name="product_qty" value="<?php echo $row['qty']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="product_status">
                            <option <?php if ($row['product_status'] == '1') echo 'selected'; ?> value="1">Published</option>
                            <option <?php if ($row['product_status'] == '0') echo 'selected'; ?> value="0">Draft</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn add-new btn-golden mt-lg-4 mt-2" name="submit" value="Update">
                    </div>
                </div>
            </form>
    <?php
        }
    }
    ?>
</div>
<?php
//    include footer file
include "footer.php"; ?>
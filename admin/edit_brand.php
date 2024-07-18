<?php
// include header file
include 'header.php'; ?>
<div class="admin-content-container">
    <h3 class="admin-heading">update brand</h3>
    <?php
    $brand_id = $_GET['id'];
    $brands = "SELECT * FROM brands where brand_id = '$brand_id'";
    $row = mysqli_query($conn, $brands);
    $result = mysqli_fetch_all($row, MYSQLI_ASSOC);
    if (count($result) > 0) {
        foreach ($result as $row) { ?>
            <div class="row">
                <!-- Form -->
                <form id="updateBrand" class="add-post-form col-md-6" method="POST">
                    <input type="hidden" name="brand_id" value="<?php echo $row['brand_id']; ?>" />
                    <div class="form-group">
                        <label>Brand Title</label>
                        <input type="text" name="brand_title" class="form-control brand_name" value="<?php echo $row['brand_title']; ?>" placeholder="Brand Name" required />
                    </div>
                    <div class="form-group">
                        <label>Brand Category</label>
                        <?php
                        $categories = "SELECT * FROM categories";
                        $result = mysqli_query($conn, $categories) or die("Query Failed");
                        $result2 = mysqli_fetch_all($result, MYSQLI_ASSOC); ?>

                        <?php if (count($result2) > 0) { ?>

                            <select class="form-control brand_category" name="brand_cat">
                                <?php foreach ($result2 as $row2) {
                                    if ($row2['id'] == $row['brand_cat']) { ?>
                                        <option selected value="<?php echo $row2['id'];?>"><?php echo $row2['category_title']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $row2['id']; ?>"><?php echo $row2['category_title']; ?></option>
                                <?php }
                                } ?>
                            </select>
                        <?php } ?>
                        
                       


                    </div>
                    <input type="submit" name="submit" class="btn-golden fs-16 fw-600 mt-lg-4 mt-2" value="Update" />
                </form>
                <!-- /Form -->
            </div>
        <?php
        }
    } else { ?>
        <div class="not-found">!!! Result Not Found !!!</div>
    <?php } ?>
</div>
<?php
//    include footer file
include "footer.php";
?>
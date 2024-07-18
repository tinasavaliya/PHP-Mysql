<?php
// include header file
include 'header.php'; ?>
    <div class="admin-content-container">
        <h3 class="admin-heading">update sub_category</h3>
        <?php
            $sub_cat_id = $_GET['id'];
            $sub_cat = "SELECT * FROM sub_categories WHERE sub_cat_id = $sub_cat_id";
            $row = mysqli_query($conn, $sub_cat);
            $sub_categories = mysqli_fetch_all($row, MYSQLI_ASSOC);
            if ($sub_categories > 0) {
                foreach($sub_categories as $row){?>
                <div class="row">
                    <!-- Form -->
                    <form id="updateSubCategory" class="add-post-form col-md-6" method ="POST">
                            <input type="hidden" name="sub_cat_id" value="<?php echo $row['sub_cat_id']; ?>" >
                            <div class="form-group">
                                <label>Sub Category Title</label>
                                <input type="text" name="sub_cat_title" class="form-control sub_category" value="<?php echo $row['sub_cat_title']; ?>"  placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <?php
                                 $categories = "SELECT * FROM categories";
                                 $row2 = mysqli_query($conn, $categories);
                                 $categories = mysqli_fetch_all($row2, MYSQLI_ASSOC); ?>

                                <select name="cat_parent" class="form-control cat_parent">
                                    <option value="">Select Category</option>
                                    <?php if (count($categories) > 0) {  ?>
                                        <?php foreach($categories as $row2) { ?>
                                            <option <?php if($row2['id'] == $row['cat_parent']) echo 'selected="selected"';  ?> value="<?php echo $row2['id']; ?>"><?php echo $row2['category_title']; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="submit" name="sumbit" class="btn add-new btn-golden mt-lg-4 mt-2" value="Update" />
                        </form>
                    <!-- /Form -->
                </div>
                <?php
                }
            } else { ?>
                <div class="not-found">!!! Result Not Found !!!</div>
          <?php  } ?>
    </div>
<?php
//    include footer file
    include "footer.php";
?>
          
   


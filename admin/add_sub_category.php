<?php
// include header file
include 'header.php'; ?>
<div class="admin-content-container">
    <h2 class="admin-heading">Add New Sub Category</h2>
    <div class="row">
        <!-- Form -->
        <form id="createSubCategory" class="add-post-form col-md-6" method="POST">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="sub_cat_title" class="form-control sub_category" placeholder="Sub Category Name" />
            </div>
            <div class="form-group">
                <label for="">Parent Category</label>
                <?php
                $query = "SELECT * FROM categories";
                $row =  mysqli_query($conn, $query);
                $cat = mysqli_fetch_all($row, MYSQLI_ASSOC); ?>
                <select class="form-control cat_parent" name="cat_parent">
                    <option value="" selected disabled>Select Category</option>
                    <?php if (count($cat) > 0) {  ?>
                        <?php foreach ($cat as $row) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['category_title']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <input type="submit" name="save" class="btn add-new btn-golden mt-lg-4 mt-2" value="Submit" />
        </form>
        <!-- /Form -->
    </div>
</div>
<?php
//    include footer file
include "footer.php";
?>
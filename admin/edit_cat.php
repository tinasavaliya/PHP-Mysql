<?php
// include header file
include 'header.php'; ?>
    <div class="admin-content-container">
        <h3 class="admin-heading">update category</h3>
        <?php
            $cat_id = $_GET['id'];
            $cat = "SELECT * FROM categories WHERE id ='{$cat_id}'";
            $row = mysqli_query($conn, $cat);
            $categories = mysqli_fetch_all($row, MYSQLI_ASSOC);
            if ($categories > 0) {
                foreach($categories as $row){?>
                <div class="row">
                    <!-- Form -->
                    <form id="updateCategory" class="add-post-form col-md-6" method ="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="category_title" class="form-control" value="<?php echo $row['category_title']; ?>"  placeholder="Category Name" required />
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
          
   


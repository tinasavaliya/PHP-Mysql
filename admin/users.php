<?php
// include header file
include 'header.php'; ?>
<div class="admin-content-container">
    <h2 class="admin-heading">All Users</h2>
    <?php
    $limit = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    $user = "SELECT * FROM user ORDER BY user_id DESC LIMIT 3";
    $result = mysqli_query($conn, $user) or die("Query Failed");
    if (mysqli_num_rows($result) > 0) { ?>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <th>Full Name</th>
                <th>Username</th>
                <th>Mobile</th>
                <th>City</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['f_name'] . ' ' . $row['l_name']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td>
                            <a href="" class="btn btn-xs btn-primary user-view" data-id="<?php echo $row['user_id']; ?>" data-bs-toggle="modal" data-bs-target="#user-detail"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" height="12px" width="12px" fill="#fff">
                                    <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                </svg></a>
                            <?php
                            if ($row['user_role'] == '1') { ?>
                                <a href="" class="btn btn-xs btn-primary user-status" data-id="<?php echo $row['user_id']; ?>" data-status="<?php echo $row['user_role'] ?>">Block</a>
                            <?php } else { ?>
                                <a href="" class="btn btn-xs btn-primary user-status" data-id="<?php echo $row['user_id']; ?>" data-status="<?php echo $row['user_role'] ?>">Unblock</a>
                            <?php   } ?>
                            <a class="btn btn-xs btn-danger delete_user" href="javascript:void();" data-id="<?php echo $row['user_id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#fff" height="12px" width="12px">
                                    <path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                                </svg></a>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="not-found clearfix">!!! No Users Found !!!</div>
    <?php  }  ?>
    <div class="col-md-12 pagination-outer">
        <?php
        $total_pages_sql = "SELECT COUNT(*) FROM products";
        $total_pages_result = mysqli_query($conn, $total_pages_sql);
        $total_rows = mysqli_fetch_array($total_pages_result)[0];
        $total_pages = ceil($total_rows / $limit);

        echo '<ul class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
        }
        echo '</ul>';
        ?>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="user-detail" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->
<?php
//    include footer file
include "footer.php";
?>
<?php 
session_start();
// Include database connection
require("inc/conn.php");

try {
 
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

} catch (PDOException $e) {
    echo "Error " . $e->getMessage();
    exit();
}
?>

<?php 
include('inc/header1.php');
?>
    <div class="container mt-5">
        <!-- Table Product -->
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
            <strong><i class="fa fa-database"></i> Products</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-title float-left">Table Products</h5>
                    <a href="dashboard.php" class="btn btn-dark float-right mb-3 mr-1 ml-4"> Back </a>
                    <a href="addnew.php" class="btn btn-success float-right mb-3"></i>Add New</a>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="col-1">ID</th>
                        <th class="col-2">Product Name</th>
                        <th class="col-2">Price</th>
                        <th class="col-2">Image</th>
                        <!-- <th class="col-2">Insert Date</th>
                        <th class="col-2">Modified Date</th> -->
                        <th class="col-2">Availability</th>
                        <th style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($result->rowCount() > 0) : ?>
                    <?php foreach ($result as $product) : ?>
                    <tr>
                    	<td class="col-1"><?php echo $product['product_id'] ?></td>
                        <td class="col-1"><?php echo $product['product_name'] ?></td>
                        <td class="col-2">&#8360;<?php echo $product['price'] ?></td>
                        <td class="col-2"><?php echo $product['product_image'] ?></td>
                        <!-- <td class="col-2"><?php echo $product['insert_date'] ?></td>
                        <td class="col-2"><?php echo $product['modified_date'] ?></td> -->
                        <td class="col-1"><?php echo $product['availability'] ?></td>
                        <td>
                            <a href="view.php?product_id=<?=$product['product_id']?>" class="btn btn-sm btn-warning text-white">View</a>
                            <a href="update.php?product_id=<?=$product['product_id']?>" class="btn btn-sm btn-primary">Update</a>
                            <a href="delete.php?product_id=<?=$product['product_id']?>" class="btn btn-sm btn-danger">Delete</a>

                            <!-- <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-<?= $product['product_id']?>">Delete</a>-->
                            <?php ?>
                       </td>
                    </tr>
                    <?php endforeach ?>
                <?php endif ?>
                </tbody>
            </table>
        </div>
      </div>
      <!-- End Table Product -->
      <br>
    </div>
<?php 
include('inc/footer.php');
?>

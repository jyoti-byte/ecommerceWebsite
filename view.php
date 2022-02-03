<?php
session_start();
require ("inc/conn.php");

if (isset($_GET["product_id"]) && !empty(trim($_GET["product_id"]))) {

    $id = trim($_GET["product_id"]);
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = :pid");
    $stmt->bindParam(':pid', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pName         = $result["product_name"];
        $pPrice        = $result["price"];
        $pImage        = $result["product_image"];
        $pAvailability = $result["availability"];
    } else {
        header("location: addnew.php");
        exit();
    }

} else {
    header("location: addnew.php");
    exit();
}

?>

<?php 
include('inc/header1.php');
?>
  <div class="container">
        <a href="index.php" class="btn btn-dark mb-3 mt-3"><< Go Back</a>
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <strong><i class="fa fa-database"></i> View Product</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-10">
                        <table class="table ml-5">
                            <tr scope="row">
                                <th>Product Name:</th>
                                <td><?php echo $pName ?></td>
                            </tr>
                            <tr scope="row">
                                <th>Product Price:</th>
                                <td>&#8360; <?php echo $pPrice?></td>
                            </tr>   
                            <tr scope="row">
                                <th>Image:</th>
                                <td><img src="<?php echo 'image/'.$pImage ?>" style="height:150px; width:200px;"></td>
                            </tr>  
                            <tr scope="row">
                                <th>Availability:</th>
                                <td><?php echo $pAvailability?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Show a product -->
        <br>
    </div>
<?php 
include('inc/footer.php');
?>
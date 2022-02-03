<?php
session_start();
require_once('inc/conn.php');
$id = ''; 
if( isset( $_GET['product_id'])) {
    $id = $_GET['product_id']; 
} 
$sql = "SELECT * FROM products where product_id=:pid";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':pid', $id, PDO::PARAM_INT);
$stmt->execute();
$result=$stmt->fetch(PDO::FETCH_ASSOC);

if($stmt->rowCount()>0)
{
?>
<?php 
include('inc/header1.php');
?>
    <div class="container">
    <a href="index.php" class="btn btn-dark mt-3 mb-3"><< Go Back</a>
        <!-- Create Form -->
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <strong><i class="fa fa-edit"></i> Update Product</strong>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
<!--                     <input type="hidden" name="id" value="<?php echo $product_id;?>" >
 -->                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="name" required value="<?php echo $result['product_name'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="price" class="col-form-label">Price:</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="price" required value="<?php echo $result['price'] ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="image" class="col-form-label">Image:</label>
                            <input type="file" class="form-control" id="product_image" name="product_image" placeholder="Image URL" value="<?php echo $result['product_image'] ?>" >
                            <input type="hidden" name="image_url" id="image_url" value="<?php echo $result['product_image']?>">
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="available" class="col-form-label">Availability:</label>
                                 <select class="form-control" id="availability" name="availability" value="<?php echo $result['availability'] ?>">
                                        <option value="in stock">In stock</option>
                                        <option value="out of stock">Out of stock</option>
                                </select>
                        </div>
 <?php } ?>
                    <button type="submit" class="btn btn-success" name="update"><i class="fa fa-check-circle"></i> Save</button>
                    <a href="index.php" class="btn btn-primary"><i class="fa fa-times"></i> Cancel</a>
                </form>
            </div>
        </div>
        <!-- End form -->
        <br>
    </div>

<?php 
include('inc/footer.php');
?>

<?php
require_once('inc/conn.php');
if(isset($_GET['product_id'])){
if(isset($_POST['update'])) {
    $id          = $_GET['product_id'];
    $name        = $_POST['product_name'];
    $price       = $_POST['price'];
    $availability= $_POST['availability'];
    $image      = $_FILES['product_image']['name'];
    $tmp_dir    = $_FILES['product_image']['tmp_name'];

    $image_url  = $_POST['image_url'];
    $fileName   = $image_url;
    
    if(($_FILES['product_image']['error'] == 0) && ($_FILES['product_image']['name'] !== "")){
        $imgExt   = strtolower(pathinfo($image,PATHINFO_EXTENSION));
        $fileName = $image.".".$imgExt;
        $hasFileUploaded = move_uploaded_file($image, 'image/'.$fileName);
    }

    if($_FILES['product_image']['name'] !== ""){
        $sql = "UPDATE products 
        SET product_name = :name, price = :price, availability= :availability, product_image = :image 
         WHERE product_id = :pid";

        $stmt = $conn->prepare($sql);
            
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":availability", $availability);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":pid", $id, PDO::PARAM_INT);

        
    }
    else {
        $sql = "UPDATE products 
        SET product_name = :name, price = :price, availability= :availability 
         WHERE product_id = :pid";
    

          $stmt = $conn->prepare($sql);

          $stmt->bindParam(":name", $name);
          $stmt->bindParam(":price", $price);
          $stmt->bindParam(":availability", $availability);
          $stmt->bindParam(":pid", $id, PDO::PARAM_INT);
    }
   
  
    if($stmt->execute())
   {
    echo "<script>alert('Record updated successfully');</script>";
    echo "<script>window.location.href='index.php'</script>";
    
   }
   else
   {
    echo "<script>alert('Something went wrong. Please try again');</script>";
    echo "<script>window.location.href='index.php'</script>";
   }
}
}
?>

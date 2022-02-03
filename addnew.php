<?php
session_start();
error_reporting( ~E_NOTICE );
 require("inc/conn.php");
 
 if(isset($_POST['btnsave']))
 {
    $name          = $_POST['product_name'];
    $price         = $_POST['price'];
    $availability  = $_POST['availability'];
    $imgFile       = $_FILES['product_image']['name'];
    $tmp_dir       = $_FILES['product_image']['tmp_name'];
    $img           = $_FILES['product_image']['size'];
    
    
  if(empty($name)){
   $errMSG = "Please Enter Product name.";
  }
  else if(empty($price)){
   $errMSG = "Please Enter Price of Product.";
  }
  else if(empty($availability)){
   $errMSG = "Please give the details of available.";
  }
  else if(empty($imgFile)){
   $errMSG = "Please Select Image File.";
  }
  else
  {
   $upload_dir = 'image/'; // upload directory
 
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
   // rename uploading image
   // $image = rand(1000,1000000).".".$imgExt;
    
   // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
    // if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$imgFile);
    }
    // else{
    //  echo "Sorry, your file is too large.";
    // }
   else{
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
   }
  }
  
  
  // if no error occured, continue ....
  if(!isset($errMSG))
  {
   $stmt = $conn->prepare('INSERT INTO products(product_name, price, product_image, availability) 
                VALUES(:product_name, :price, :product_image, :availability)');

        $stmt->bindParam(":product_name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":product_image", $imgFile);
        $stmt->bindParam(":availability", $availability);
   
   if($stmt->execute())
   {
   echo "<script>alert('Record inserted successfully');</script>";
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

<?php 
include('inc/header1.php');
?>
    <div class="container mt-3">
            <!-- Create Form -->
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <strong><i class="fa fa-plus"></i> Add New Product</strong>
                </div>
                <div class="card-body">
                    <form action="addnew.php" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price" class="col-form-label">Price:</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="image" class="col-form-label">Image:</label>
                                <input type="file" class="form-control" id="product_image" name="product_image" placeholder="Image URL">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="available" class="col-form-label">Availability:</label>
                                 <select class="form-control" id="availability" name="availability" placeholder="select the available status">
                                        <option value="in stock">In stock</option>
                                        <option value="out of stock">Out of stock</option>
                                </select>
                        </div>
                        <button type="submit" class="btn btn-success" name="btnsave"><i class="fa fa-check-circle"></i> Save</button>
                        <a href="index.php" class="btn btn-primary"><i class="fa fa-times"></i> Cancel</a>

                    </form>
                </div>
            </div>
            <!-- End form-->
           <br>         
    </div>
<?php 
include('inc/footer.php');
?>
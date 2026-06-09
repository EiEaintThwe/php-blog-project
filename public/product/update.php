<?php
require_once("../../db/connection.php");
require_once("../helper/header.php");
require_once("source/categoryList.php");

$query="SELECT * FROM product WHERE id=?";
$res=$pdo->prepare($query);
$res->execute([$_GET['id']]);

$product=$res->fetch(PDO::FETCH_ASSOC);

?>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="d-flex justify-content-end">
                <a href="list.php" class="btn btn-secondary text-white m-3 rounded shadow-sm">Product List</a>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="d-flex justify-content-center my-2">
                    <img src="../../image/<?php echo $product['image'] ?>" id="output" class=" w-50">
                </div>
                <input type="file" name="image" id="" class="form-control my-2 w-100" onChange="loadFile(event)">

                <input type="text" name="name" value="<?php echo $_POST['name'] ?? $product['name']; ?>" class="form-control my-2 w-100" placeholder="Enter Product Name...">
                <?php
                    if(isset($_POST['update-btn'])){
                        $nameStatus=$_POST['name'] == "" ? false : true;
                        echo $nameStatus ? "" : "<small class='text-danger'>Product name is required!</small>";
                    }

                ?>
                <input type="text" name="price" value="<?php echo $_POST['price'] ?? $product['price']; ?>" class="form-control my-2 w-100" placeholder="Enter Product Price...">
                 <?php
                    if(isset($_POST['update-btn'])){
                        $priceStatus=$_POST['price'] == "" ? false : true;
                        echo $priceStatus ? "" : "<small class='text-danger'>Product price is required!</small>";
                    }

                ?>

                <textarea name="description" rows="10" cols="30" class="form-control my-2" placeholder="Enter Product Description..."><?php echo $_POST['description'] ?? $product['description']; ?></textarea>
                 <?php
                    if(isset($_POST['update-btn'])){
                        $descriptionStatus=$_POST['description'] == "" ? false : true;
                        echo $descriptionStatus ? "" : "<small class='text-danger'>Product description is required!</small>";
                    }

                ?>
                <select name="categoryId" class="form-select">
                    <option value="">Choose Category Name...</option>
                    <?php 
                        foreach($categories as $item){
                           echo '<option value="'.$item['id'].'" '. ( $item['id'] == $product['category_id'] ? 'selected' : '' ) .'>'.$item['name'].'</option>';
                           }
                    ?>
                </select>
                 <?php
                    if(isset($_POST['update-btn'])){
                        $categoryStatus=$_POST['categoryId'] == "" ? false : true;
                        echo $categoryStatus ? "" : "<small class='text-danger'>Category name is required!</small>";
                    }

                ?>
                <input type="submit" value="Update" name="update-btn" class="btn btn-secondary text-white w-100 my-2">                
               
            </form>      
            
            <?php
                require_once("updateProcess.php");
            ?>
          
        </div>
    </div>
</div>

 

<?php
require_once("../helper/footer.php");
?>

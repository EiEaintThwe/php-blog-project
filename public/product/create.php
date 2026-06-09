<?php

require_once("../../db/connection.php");
require_once("../helper/header.php");
require_once("source/categoryList.php");

?>



<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="d-flex justify-content-end">
                <a href="list.php" class="btn btn-secondary text-white m-3 rounded shadow-sm">Product List</a>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="d-flex justify-content-center my-2">
                    <img src="" id="output" class=" w-50">
                </div>
                <input type="file" name="image" id="" class="form-control my-2 w-100" onChange="loadFile(event)">
                <?php
                   if(isset($_POST['create-btn'])){
                    $imageStatus=$_FILES['image']['name'] == "" ? false : true;
                    echo $imageStatus ? "" : "<small class='text-danger'>Product image is required!</small>";
                   } 

                ?>

                <input type="text" name="name" value="<?php echo $_POST['name'] ?? ''; ?>" class="form-control my-2 w-100" placeholder="Enter Product Name...">
                <?php
                    if(isset($_POST['create-btn'])){
                        $nameStatus=$_POST['name'] == "" ? false : true;
                        echo $nameStatus ? "" : "<small class='text-danger'>Product name is required!</small>";
                    }

                ?>
                <input type="text" name="price" value="<?php echo $_POST['price'] ?? ''; ?>" class="form-control my-2 w-100" placeholder="Enter Product Price...">
                 <?php
                    if(isset($_POST['create-btn'])){
                        $priceStatus=$_POST['price'] == "" ? false : true;
                        echo $priceStatus ? "" : "<small class='text-danger'>Product price is required!</small>";
                    }

                ?>

                <textarea name="description" rows="10" cols="30" class="form-control my-2" placeholder="Enter Product Description..."><?php echo $_POST['description'] ?? ''; ?></textarea>
                 <?php
                    if(isset($_POST['create-btn'])){
                        $descriptionStatus=$_POST['description'] == "" ? false : true;
                        echo $descriptionStatus ? "" : "<small class='text-danger'>Product description is required!</small>";
                    }

                ?>
                <select name="categoryId" class="form-select">
                    <option value="">Choose Category Name...</option>
                    <?php 
                        foreach($categories as $item){
                           echo '<option value="'.$item['id'].'" '. ( isset($_POST['categoryId']) && $item['id'] == $_POST['categoryId'] ? 'selected' : '' ) .'>'.$item['name'].'</option>';
                           }
                    ?>
                </select>
                 <?php
                    if(isset($_POST['create-btn'])){
                        $categoryStatus=$_POST['categoryId'] == "" ? false : true;
                        echo $categoryStatus ? "" : "<small class='text-danger'>Category name is required!</small>";
                    }

                ?>
                <input type="submit" value="Create" name="create-btn" class="btn btn-secondary text-white w-100 my-2">
                
               
            </form>

             <?php
                if(isset($_REQUEST['create-btn'])){
                    if($imageStatus && $nameStatus && $priceStatus && $descriptionStatus && $categoryStatus){
                        $imageName=uniqid().$_FILES['image']['name'];
                        $tmpName=$_FILES['image']['tmp_name'];
                        $targetFile="../../image/".$imageName;
                        move_uploaded_file($tmpName, $targetFile);

                        $productName=$_REQUEST['name'];
                        $productPrice=$_REQUEST['price'];
                        $productDescription=$_REQUEST['description'];
                        $categoryId=$_REQUEST['categoryId'];

                        $productQuery="INSERT INTO product (name,price,image,description,category_id) VALUES(?,?,?,?,?)";
                        $productRes=$pdo->prepare($productQuery);
                        $productRes->execute([$productName,$productPrice,$imageName,$productDescription,$categoryId]);

                        header("Location:list.php");
                    }
                }

            ?>


          
        </div>
    </div>
</div>

 

<?php
require_once("../helper/footer.php");
?>
<?php

if(isset($_POST['update-btn'])){
    if($nameStatus && $priceStatus && $descriptionStatus && $categoryStatus){
        if($_FILES['image']['name'] != ""){
            $oldPics = $product['image'];
            unlink("../../image/$oldPics");

            $imgName = uniqid().$_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            $targetFile = "../../image/".$imgName;

            move_uploaded_file($tmpName,$targetFile);

            $updateQuery = "UPDATE product SET name=?, price=?, image=?, description=?, category_id=? WHERE id=?";
            $updateRes=$pdo->prepare($updateQuery);
            $updateRes->execute([$_POST['name'],$_POST['price'],$imgName,$_POST['description'],$_POST['categoryId'],$_GET['id']]);

        }else{
            $updateQuery = "UPDATE product SET name=?, price=?, description=?, category_id=? WHERE id=?";
            $updateRes=$pdo->prepare($updateQuery);
            $updateRes->execute([$_POST['name'],$_POST['price'],$_POST['description'],$_POST['categoryId'],$_GET['id']]);
        }

        header("Location:list.php");
    }
}


?>
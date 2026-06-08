<?php
require_once("../helper/header.php");
require_once("../../db/connection.php");

 $query = "SELECT * FROM categories where id=?";
 $res=$pdo->prepare($query);
 $res->execute([$_GET['id']]);

 $data = $res->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="" method="post">
                <input type="text" name="categoryName" id="" class="form-control w-100" value="<?php echo $_POST['categoryName'] ?? $data['name']; ?>">
                <?php
                    if(isset($_POST['update-btn'])){
                        $categoryStatus = $_POST['categoryName'] == "" ? false : true;
                        echo $categoryStatus ? "" : "<small class='text-danger'>Category is required!</small>";

                    }

                ?>

                <input type="submit" name="update-btn" value="Update" class="form-control btn btn-secondary mt-3 rounded shadow-sm w-25">
            </form>
        </div>
    </div>
</div>

<?php 
    if(isset($_POST['update-btn'])){
        $categoryName = $_POST['categoryName'];

        if($categoryStatus){
            $categoryQuery = "UPDATE categories SET name=? WHERE id=?";
            $categoryRes = $pdo->prepare($categoryQuery);
            $categoryRes->execute([$categoryName,$_GET['id']]);

            header("Location:create.php");
        }
    }
?>


<?php require_once("../helper/footer.php"); ?>
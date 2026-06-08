<?php
require_once("../../db/connection.php");
require_once("../helper/header.php");

$categoryQuery = "SELECT id,name FROM categories ORDER BY created_at DESC";
$categoryRes = $pdo->prepare($categoryQuery);
$categoryRes->execute();

$categories = $categoryRes->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container">
    <div class="row">
        <div class="col-4">
            <form action="" method="post">
                <input type="text" name="categoryName" class="form-control w-100" placeholder="Enter Category Name...">
                <?php
                if (isset($_POST['create-btn'])) {
                    $categoryStatus = $_POST['categoryName'] == "" ? false : true;
                    echo $categoryStatus ? "" : "<small class='text-danger'>Category is required!</small>";
                }
                ?>
                <input type="submit" name="create-btn" value="Create" class="form-control btn bg-dark text-white mt-3 rounded shadow-sm">
            </form>
        </div>

        <div class="col">
            <?php

            if (isset($_POST["create-btn"])) {
                $categoryName = $_POST["categoryName"];

                if ($categoryStatus) {
                    $query = "INSERT INTO categories(name) VALUES (?)";
                    $res = $pdo->prepare($query);
                    $res->execute([$categoryName]);

                    header("Location:create.php");
                }
            }

            foreach ($categories as $item) {
                $category = $item['name'];
                $id = $item['id'];
                echo "
                    <div class='card my-2'>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-10'>
                                    <div class='p-1'>
                                      $category
                                    </div>
                                </div>
                                <div class='col'>
                                    <a href='update.php?id=$id' class='btn btn-sm rounded btn-secondary'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a href='delete.php?id=$id' class='btn btn-sm rounded btn-danger'><i class='fa-solid fa-trash'></i></a>
                                </div>
                            </div>
                        </div>
                    </div>";
            }
            ?>
        </div>

    </div>
</div>

<?php


require_once("../helper/footer.php");


?>
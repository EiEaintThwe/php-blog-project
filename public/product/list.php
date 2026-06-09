<?php
require_once("../helper/header.php");
require_once("../../db/connection.php");

$query="SELECT product.id,product.name as product_name,product.price,product.description,product.image,categories.name as category_name FROM product 
        LEFT JOIN categories 
        ON product.category_id=categories.id 
        ORDER BY product.created_at DESC";
$res=$pdo->prepare($query);
$res->execute();

$products=$res->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="container">
    <div class="row">
        <div class="col">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th class="col-4">Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Category Name</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($products as $item){
                            echo "
                            <tr>
                                <td><img class='w-50' src='../../image/".$item['image']."'></td>
                                <td>".$item['product_name']."</td>
                                <td>".$item['price']."</td>
                                <td>".$item['description']."</td>
                                <td>".$item['category_name']."</td>
                                <td>
                                    <a href='update.php?id=".$item['id']."' class='btn btn-sm rounded btn-secondary'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a href='delete.php?id=".$item['id']."&oldImageName=".$item['image']."' class='btn btn-sm rounded btn-danger'><i class='fa-solid fa-trash'></i></a>
                                </td>
                            </tr>";

                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php
require_once("../helper/footer.php");

?>
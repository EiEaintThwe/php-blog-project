<?php

require_once("../../db/connection.php");

$product_id=$_GET['id'];

$imageName=$_GET['oldImageName'];

unlink("../../image/$imageName");

$query="DELETE FROM product WHERE id=?";
$res=$pdo->prepare($query);
$res->execute([$product_id]);

header("Location:list.php");

?>
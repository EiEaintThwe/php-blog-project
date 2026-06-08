<?php

require_once("../../db/connection.php");

   $query = "DELETE FROM categories WHERE id=?";
   $res = $pdo->prepare($query);
   $res->execute([$_GET['id']]);

   header("Location:create.php");
?>
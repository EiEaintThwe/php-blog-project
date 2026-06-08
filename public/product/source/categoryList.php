<?php

$query="SELECT * FROM categories";
$res=$pdo->prepare($query);
$res->execute();

$categories=$res->fetchAll(PDO::FETCH_ASSOC);

?>
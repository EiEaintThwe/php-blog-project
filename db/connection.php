<?php 

try{
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=mini_blogs_project", "root", "");

}catch(PDOException $e){
    echo "Connection Error" . $e;
}

?>

<?php
$username = $_POST['username'];
 
    require_once '../mysql_connect.php';

    //DELETE FROM `users` WHERE `users`.`login` = "geotek"


    $sql = 'DELETE FROM `users` WHERE `users`.`login` = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$username]);

    echo 'Deleted';

?>
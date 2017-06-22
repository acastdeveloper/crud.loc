<?php
$usuario="137656_root";
$password="1234";
$host="mysql-testingmultiverse.alwaysdata.net";
$db="testingmultiverse_empl_b";

try {
    // $conn = new PDO('mysql:host=mysql-testingmultiverse.alwaysdata.net;dbname=testingmultiverse_symfo1', $usuario, $password);

    $conn = new PDO('mysql:host='.$host.';dbname='.$db, $usuario, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "ERROR: <br>" . $e->getMessage()."<br>".getTraceAsString();
}

 ?>

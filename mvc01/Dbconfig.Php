<?php
$DB_user="137656_root";
$DB_pass="1234";
$DB_host="mysql-testingmultiverse.alwaysdata.net";
$DB_name="testingmultiverse_empl_b";


try
{
 $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
 $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
 echo $e->getMessage();
}

include_once 'class.crud.php';

$crud = new crud($DB_con);

?>
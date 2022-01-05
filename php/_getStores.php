<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);
require_once("_access.php");
access([1,2,3,4,5]);
$id = $_SESSION['userid'];

require_once("dbconnection.php");
try{

   $query = "select stores.*, clients.name as client_name , clients.phone as client_phone
   from stores inner join clients on clients.id = stores.client_id where stores.client_id=?";
   $data = getData($con,$query,[$id]);
   $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>
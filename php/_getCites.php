<?php
session_start();
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3]);
require_once("dbconnection.php");
try{
  $query = "select * from cites";
  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>
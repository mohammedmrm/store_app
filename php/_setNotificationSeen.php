<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3,4,5]);
require_once("dbconnection.php");
$user_id = $_SESSION['userid'];
$id = $_REQUEST['id'];

$sql = 'update notification set client_seen = 1 where for_client = 1 and id = ?';
$result = setData($con,$sql,[$id]);
$success = 1;
echo json_encode(['success'=>$success,$sql]);
?>
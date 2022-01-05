<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access();
require_once("dbconnection.php");
require_once("_crpt.php");

$success = 0;
$error = [];
$user_id = $_SESSION['userid'];


$sql = 'select count(*) as unseen from notification where for_client = 1 and client_id = ? and client_seen=0';
$res = getData($con,$sql,[$user_id]);
$unseen = $res[0]['unseen'];
$sql = 'select notification.*,orders.order_no from notification inner join orders on orders.id = notification.order_id where for_client = 1 and notification.client_id = ? order by date DESC limit 50';
$result = getData($con,$sql,[$user_id]);
$success = 1;
echo json_encode([$user_id,'success'=>$success,"data"=>$result,'unseen'=>$unseen]);
?>
<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access();
require_once("dbconnection.php");
require_once("_sendNoti.php");
$id = $_SESSION['userid'];
$order_id = $_REQUEST['id'];
$error="";
$success = 0;
use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب {250} رمز كحد اعلى '
]);

$v->validate([
    'id'        => [$id,  'required|int'],
    'order_id'  => [$order_id,'required|int']
]);

if($v->passes()) {
   $sql = "select count(*) as times from tracking where order_id=? and order_status_id=?";
   $res =getData($con,$sql,[$order_id,13]);
   if($res[0]['times'] < 2){
   $sql = 'update orders set order_status_id =?, new_price = price
           where id=? and client_id=? and orders.storage_id <> 1 and orders.storage_id <> -1';
   $result = setData($con,$sql,['13',$order_id,$id]);
   if($result > 0){
    $success = 1;
    $sql = 'insert into tracking
    (order_status_id,note,order_id,staff_id) values(?,?,?,?)';
    $result = setData($con,$sql,['13',"تم طلب اعادة ارسال الطلب من قبل العميل (".$_SESSION['user_details']['name'].")",$order_id,0]);
    $sql = "select staff.token as s_token, clients.token as c_token from orders inner join staff
            on
            staff.id = orders.manager_id
            or
            staff.id = orders.driver_id
            inner join clients on clients.id = orders.client_id
            where orders.id =  ?";
    $res =getData($con,$sql,[$order_id]);
    sendNotification([$res[0]['s_token'],$res[1]['s_token']],[$order_id],'طلب رقم - '.$order_id,"اعادة ارسال الطلب - ".$note,"../orderDetails.php?o=".$order_id);
   }else{
     $error= "لايمكن تحديث الحالة";
   }
   }else{
     $error= "لايمكن اعادة ارسال الطلب اكثر من مرتين";
   }

}else{
  $error = "لايمكن اعادة ارسال الطلب";
}
echo json_encode(['success'=>$success, 'error'=>$error,$_POST]);
?>

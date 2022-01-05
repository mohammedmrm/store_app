<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3]);
require_once("dbconnection.php");
require_once("../config.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$v->addRuleMessage('isPhoneNumber', 'رقم هاتف غير صحيح ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
  if(preg_match("/^[0-9]{10,15}$/",$value) || empty($value)){
    $x=(bool) 1;
  }
    return $x;
});

$v->addRuleMessage('isPrice', 'المبلغ غير صحيح');

$v->addRule('isPrice', function($value, $input, $args) {
  if(preg_match("/^(0|[1-9]\d*)(\.\d{2})?$/",$value) || empty($value)){
    $x=(bool) 1;
  }
  return   $x;
});

$v->addRuleMessage('unique', 'القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique', function($value, $input, $args) {
    $value  = trim($value);
    $exists = getData($GLOBALS['con'],"SELECT * FROM orders WHERE order_no ='".$value."'");
    return ! (bool) count($exists);
});
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'تم ادخال بيانات اكثر من الحد المسموح',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);
$error = [];
$success = 0;
$client = $_SESSION['userid'];
$store = $_REQUEST['store'];
$order_price = $_REQUEST['price'];
$customer_name = $_REQUEST['name'];
$customer_phone = $_REQUEST['phone'];
$city_to = $_REQUEST['city'];
$town_to = $_REQUEST['town'];
$order_note= $_REQUEST['note'];
$order_address= $_REQUEST['address'];


$v->validate([
    'order_price'   => [$order_price,"required|isPrice"],
    'customer_name' => [$customer_name, 'required|min(3)|max(100)'],
    'customer_phone'=> [$customer_phone,  'required|isPhoneNumber'],
    'store'         => [$store,    'required|int'],
    'city'          => [$city_to,  'required|int'],
    'town'          => [$town_to,  'required|int'],
    'order_note'    => [$order_note,   'max(250)'],
    'order_address' => [$order_address,'max(250)'],
]);
$msg = "";
$sql = "select sum(qty) as qty from receipt where store_id=? and status=1";
$res = getData($con,$sql,[$store]);
if($res[0]['qty'] <= 0){
   $msg = "لايوجد لديك وصولات";
}
if($v->passes() && $msg == "") {
  $sql = "select max(order_no) as max FROM orders";
  $res = getData($con,$sql);
  $number = (int) $res[0]['max'] + 1;

  $sql = "select* FROM clients where id=?";
  $res = getData($con,$sql,[$client]);
  $branch = $res[0]['branch_id'];

  $sql = 'insert into orders (from_branch,client_id,order_no,price,customer_name,
                              customer_phone,to_city,to_town,note,address)
                              VALUES
                              (?,?,?,?,?,?,?,?,?,?)';
  $result = setData($con,$sql,
                   [$branch,$client,$number,$order_price,$customer_name,
                    $customer_phone,$city_to,$town_to,$order_note,$order_address]);

if($result>=1){
  $success =1;

  $sql = "update receipt set qty = qty - 1 where store_id=? and qty > 0";
  $res = setData($con,$sql,[$store]);

  $sql = "select * from orders where order_no=? and from_branch = ? order by date DESC limit 1";
  $result2 = getData($con,$sql,[$number,$branch]);

  if(count($result2)>=1){
  $sql = "insert into tracking (order_id,order_status_id,note) values(?,?,?)";
  $result3 = setData($con,$sql,[$result2[0]["id"],1,"تم تسجيل الطلب "]);

  }
}
}else{
$msg = "يوجد بعض الاخطاء";
$error = [
           'store'=>implode($v->errors()->get('store')),
           'order_no'=>implode($v->errors()->get('order_no')),
           'order_price'=>implode($v->errors()->get('order_price')),
           'customer_name'=>implode($v->errors()->get('customer_name')),
           'customer_phone'=>implode($v->errors()->get('customer_phone')),
           'city'=>implode($v->errors()->get('city')),
           'town'=>implode($v->errors()->get('town')),
           'branch_to'=>implode($v->errors()->get('branch_to')),
           'order_note'=>implode($v->errors()->get('order_note')),
           'order_address'=>implode($v->errors()->get('order_address'))
           ];
}
echo json_encode(['success'=>$success,'msg'=>$msg, 'error'=>$error]);
?>
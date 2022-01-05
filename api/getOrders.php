<?php
ob_start();
session_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require_once("_apiAccess.php");
access();
error_reporting(0);
require_once("../php/dbconnection.php");
$search = $_REQUEST['search'];
$start = trim($_REQUEST['start']);
$end = trim($_REQUEST['end']);
$city = trim($_REQUEST['city']);
$store = trim($_REQUEST['store']);
$limit = trim($_REQUEST['limit']);
$page = trim($_REQUEST['page']);
$status = $_REQUEST['status'];///-posponded , recived , returned , instorage , onway
$orders = 0;
$msg="";
if(empty($limit)){
 $limit = 10;
}
if(empty($page)){
 $page = 1;
}
if(empty($end)) {
  $end = date('Y-m-d h:i:s', strtotime($end. ' + 1 day'));
}else{
  $end .=" 23:59:59";
}
$start .=" 00:00:00";
try{
  $count = "select count(*) as count from orders";
  $query = "select orders.*,DATEDIFF('".date('Y-m-d')."', date_format(orders.date,'%Y-%m-%d')) as days,
            clients.name as client_name,clients.phone as client_phone,
            cites.name as city,towns.name as town,branches.name as branch_name,
            if(orders.bar_code > 0 and orders.remote_driver_phone is not null,remote_driver_phone,staff.phone) as driver_phone,
            stores.name as store_name ,order_status.status as status_name,tracking.note as t_note
            from orders left join
            clients on clients.id = orders.client_id
            left join cites on  cites.id = orders.to_city
            left join staff on  orders.driver_id = staff.id
            left join towns on  towns.id = orders.to_town
            left join stores on  stores.id = orders.store_id
            left join branches on  branches.id = orders.to_branch
            left join order_status on  order_status.id = orders.order_status_id
            left join (
              select max(id) as last_id,order_id from tracking group by order_id
            ) a on a.order_id = orders.id
            left join tracking on a.last_id = tracking.id
            ";
  $where = "where";
  if($status == "onway"){
  $filter = "orders.client_id ='".$userid."'  and (orders.confirm=1 or orders.confirm=4) and (
            orders.order_status_id = 1 or
            orders.order_status_id = 2 or
            orders.order_status_id = 3 or
            orders.order_status_id = 8 or
            orders.order_status_id = 13
            )";
  }
  else if ($status == "returned"){
   $filter = "orders.invoice_id= 0 and orders.client_id =".$userid." and (orders.order_status_id=9 or orders.order_status_id=6 or orders.order_status_id=5)  and (orders.confirm=1 or orders.confirm=4) and orders.storage_id <> 1 and orders.storage_id <> -1";
  }
  else if ($status == "recived"){
   $filter = "orders.invoice_id = 0 and orders.client_id =".$userid." and (orders.order_status_id=4)  and (orders.confirm=1 or orders.confirm=4)";
  }
  else if ($status == "instorage"){
   $filter = "orders.client_id =".$userid." and orders.confirm=1 and orders.storage_id = 1 and invoice_id=0";
  }
  else if ($status == "posponded"){
   $filter = "orders.client_id =".$userid." and orders.order_status_id=7  and (orders.confirm=1)";
 }
  else{
  $filter = "orders.client_id ='".$userid."'  and (orders.confirm=1 or orders.confirm=4) and (
            orders.order_status_id = 1 or
            orders.order_status_id = 2 or
            orders.order_status_id = 3 or
            orders.order_status_id = 8 or
            orders.order_status_id = 13
            )";
  }
  if(!empty($search)){
   $filter .= " and (order_no like '%".$search."%'
                    or customer_name like '%".$search."%'
                    or customer_phone like '%".$search."%'
                    or tracking.note like '%".$search."%'
                    )
                    ";
  }
   $filter .= " and money_status =0";
  if($city > 0){
   $filter .= " and to_city =".$city;
  }
  if($store > 0){
   $filter .= " and store_id =".$store;
  }
  function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
  if(validateDate($start) && validateDate($end)){
      $filter .= " and orders.date between '".$start."' AND '".$end."'";
     }
  if($filter != ""){
    $filter = preg_replace('/^ and/', '', $filter);
    $filter = $where." ".$filter;
    $count .= " ".$filter;
    $query .= " ".$filter;
  }
  if($page != 0){
    $page = $page - 1;
  }
  $query .= " order by orders.id DESC limit ".($page * $limit).",".$limit;
  $data = getData($con,$query);
  $ps = getData($con,$count);
  $orders = $ps[0]['count'];
  $pages= ceil($ps[0]['count']/$limit);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
   $msg = "Query Error";
}
if($success == '1'){
  foreach($data as $k=>$v){
    if($v['with_dev'] == 1){
      $data[$k]['with_dev'] = "نعم";
    }else{
      $data[$k]['with_dev'] = "لا";
    }
    if($v['money_status'] == 1){
      $data[$k]['money_status'] = "تم التحاسب";
    }else{
      $data[$k]['money_status'] = "لم يتم التحاسب";
    }
  }
}
$code = 200;
ob_end_clean();
echo (json_encode(array('code'=>$code,'message'=>$msg,'orders'=>$orders,"success"=>$success,"data"=>$data,'pages'=>$pages,'nextPage'=>$page+2),JSON_PRETTY_PRINT));
?>
<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access();
require_once("dbconnection.php");
$search = $_REQUEST['search-text'];
$start = trim($_REQUEST['start']);
$end = trim($_REQUEST['end']);
$city = trim($_REQUEST['city']);
$store = trim($_REQUEST['store']);
$limit = trim($_REQUEST['limit']);
$page = trim($_REQUEST['currentPage']);
$orders = 0;
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
            stores.name as store_name
            from orders left join
            clients on clients.id = orders.client_id
            left join cites on  cites.id = orders.to_city
            left join towns on  towns.id = orders.to_town
            left join stores on  stores.id = orders.store_id
            left join branches on  branches.id = orders.to_branch
            ";
  $where = "where";
  $filter = "orders.invoice_id = 0 and orders.client_id =".$_SESSION['userid']." and (order_status_id=4)  and (orders.confirm=1 or orders.confirm=4)";
  if(!empty($search)){
   $filter .= " and (order_no like '%".$search."%'
                    or customer_name like '%".$search."%'
                    or customer_phone like '%".$search."%')
                    ";
  }

  function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
  if(validateDate($start) && validateDate($end)){
      $filter .= " and orders.date between '".$start."' AND '".$end."'";
     }
  if($city > 0){
   $filter .= " and to_city =".$city;
  }
  if($store > 0){
   $filter .= " and store_id =".$store;
  }
  if($filter != ""){
    $filter = preg_replace('/^ and/', '', $filter);
    $filter = $where." ".$filter." order by orders.id DESC";
    $count .= " ".$filter;
    $query .= " ".$filter;
  }
  if($page != 0){
    $page = $page - 1;
  }
  $query .= " limit ".($page * $limit).",".$limit;
  $data = getData($con,$query);
  $ps = getData($con,$count);
  $orders = $ps[0]['count'];
  $pages= ceil($ps[0]['count']/$limit);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
if($success == '1'){
  foreach($data as $k=>$v){
    if($v['with_dev'] == 1){
      $data[$k]['with_dev'] = "نعم";
    }else{
      $data[$k]['with_dev'] = "لا";
    }
    if($v['money_status'] == 1){
      $data[$k]['money_status'] = "مدفوع";
    }else{
      $data[$k]['money_status'] = "غير مدفوع";
    }
  }
}
print_r(json_encode(array('orders'=>$orders,"success"=>$success,"data"=>$data,'pages'=>$pages,'nextPage'=>$page+2)));
?>
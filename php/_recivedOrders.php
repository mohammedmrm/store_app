<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);
require_once("_access.php");
access([1,2,3]);
require_once("dbconnection.php");
require_once("../config.php");
$id = $_SESSION['userid'];
$start = $_REQUEST['start'];
$end = $_REQUEST['end'];
$store = $_REQUEST['store'];
if(!empty($end)) {
  $end = date($end, strtotime(' + 1 day'));
}
if(!empty($start)) {
  $start = date($start, strtotime(' - 1 hour'));
}
$data = [];
$success =0;
if($_SESSION['user_details']['show_earnings'] == 1){
$sql = "select
          sum(new_price) as income,

          sum(
                 if(order_status_id = 9,
                     0,
                     if(to_city = 1,
                           if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                           if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
                      )
                  )
          ) as dev,

          sum(new_price -
              (
                 if(order_status_id = 6 or order_status_id = 5 or order_status_id = 4,
                     if(to_city = 1,
                           if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                           if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
                      ),
                      0
                  )
              )
          ) as client_price,
          sum(discount) as discount,
          count(orders.id) as orders
          from orders
          left JOIN client_dev_price on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city
          where orders.client_id = ?  and invoice_id = 0 and (order_status_id = 4 or order_status_id = 5 or order_status_id = 6)  and orders.confirm=1
          ";
          if(!empty($end) && !empty($start)){
            $sql .=' and orders.date between "'.$start.'" and "'.$end.'" ';
          }
          if($store > 0){
            $sql .=' and orders.store_id="'.$store.'"';
          }
          $res4= getData($con,$sql,[$id]);
          $res4= $res4[0];

$sql2 = "select invoice.*,count(orders.id) as orders,date_format(invoice.date,'%Y-%m-%d') as in_date,clients.name as client_name,clients.phone as client_phone
           ,stores.name as store_name
           from invoice
           inner join stores on stores.id = invoice.store_id
           inner join orders on orders.invoice_id = invoice.id
           inner join clients on stores.client_id = clients.id
           where clients.id=?";
          if(!empty($end) && !empty($start)){
            $sql2 .=' and invoice.date between "'.$start.'" and "'.$end.'" ';
          }
          if($store > 0){
            $sql2 .=' and invoice.store_id="'.$store.'"';
          }
           $sql2 .= " group by invoice.id";
$res2 = getData($con,$sql2,[$id]);
}
echo json_encode(array($sql2,"success"=>$success,"data"=>$res4,"invoice"=>$res2));
?>
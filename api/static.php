<?php
ob_start(); 
session_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require_once("_apiAccess.php");
access();
error_reporting(0);
require_once("../php/dbconnection.php");
require_once("../config.php");
$msg="";
$start30 = date('Y-m-d 00:00:00',strtotime(' - 30 day'));
$end30 = date('Y-m-d 00:00:00',strtotime(' + 1 day'));
try{
    $sql30 = "select
                SUM(IF (order_status_id = '1' or order_status_id = '2' or order_status_id = '3' or order_status_id = '13',1,0)) as  onway,
                SUM(IF (order_status_id = '9' and storage_id<>1,1,0)) as  inprocess,
                SUM(IF (order_status_id = '6' and storage_id<>1,1,0)) as  partiallyReturnd,
                SUM(IF (order_status_id = '5' and storage_id<>1,1,0)) as  `replace`,
                SUM(IF ((order_status_id = '9') and storage_id=1,1,0)) as  instorageReturnd,
                SUM(IF ((order_status_id = '6') and storage_id=1,1,0)) as  instoragepartiallyReturnd,
                SUM(IF ((order_status_id = '5') and storage_id=1,1,0)) as  instoragereplace,
                SUM(IF (order_status_id = '4',1,0)) as  recieved,
                SUM(IF (order_status_id = '7',1,0)) as  posponded,    
               sum(
                     if(orders.order_status_id = 4 or orders.order_status_id = 6 or orders.order_status_id = 5,

                      (orders.new_price -
                           (
                           if(to_city = 1,
                                     if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                                     if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
                               )
                            )
                        ),0)
                    ) as client_price,
                 count(*) as orders
                 from orders
                 left JOIN client_dev_price
                on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city
                where (orders.confirm=1 or orders.confirm=4) and invoice_id=0 and orders.client_id=".$userid." and
                date between '".$start30."' and '".$end30."'";
    $last30 =  getData($con,$sql30);
    $last30[0]['client_price'] = number_format($last30[0]['client_price']);

    $start7 = date('Y-m-d 00:00:00',strtotime(' - 7 day'));
    $end7 = date('Y-m-d 00:00:00',strtotime(' + 1 day'));
    $sql7 = "select
                SUM(IF (order_status_id = '1' or order_status_id = '2' or order_status_id = '3' or order_status_id = '13',1,0)) as  onway,
                SUM(IF (order_status_id = '9' and storage_id<>1,1,0)) as  inprocess,
                SUM(IF (order_status_id = '6' and storage_id<>1,1,0)) as  partiallyReturnd,
                SUM(IF (order_status_id = '5' and storage_id<>1,1,0)) as  `replace`,
                SUM(IF ((order_status_id = '9') and storage_id=1,1,0)) as  instorageReturnd,
                SUM(IF ((order_status_id = '6') and storage_id=1,1,0)) as  instoragepartiallyReturnd,
                SUM(IF ((order_status_id = '5') and storage_id=1,1,0)) as  instoragereplace,
                SUM(IF (order_status_id = '4',1,0)) as  recieved,
                SUM(IF (order_status_id = '7',1,0)) as  posponded,
               sum(
                     if(orders.order_status_id = 4 or orders.order_status_id = 6 or orders.order_status_id = 5,
                      (orders.new_price -
                           (
                           if(to_city = 1,
                                     if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                                     if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
                               )
                            )
                        ),0)
                    ) as client_price,
                 count(*) as orders
                 from orders
                 left JOIN client_dev_price
                on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city
                where (orders.confirm=1 or orders.confirm=4) and invoice_id=0 and orders.client_id=".$userid." and
                date between '".$start7."' and '".$end7."'";
    $last7 =  getData($con,$sql7);
    $last7[0]['client_price'] = number_format( $last7[0]['client_price']);

    $start1 = date('Y-m-d 00:00:00');
    $end1 = date('Y-m-d 00:00:00',strtotime(' + 1 day'));
    $sql1 = "select
                sum(
                     if(orders.order_status_id = 4 or orders.order_status_id = 6 or orders.order_status_id = 5,
                     (orders.new_price -
                           (
                           if(to_city = 1,
                                     if(client_dev_price.price is null,(".$config['dev_b']." - discount),(client_dev_price.price - discount)),
                                     if(client_dev_price.price is null,(".$config['dev_o']." - discount),(client_dev_price.price - discount))
                               )
                            )
                      ),0)
                 ) as client_price,
                SUM(IF (order_status_id = '1' or order_status_id = '2' or order_status_id = '3' or order_status_id = '13',1,0)) as  onway,
                SUM(IF (order_status_id = '9' and storage_id<>1,1,0)) as  inprocess,
                SUM(IF (order_status_id = '6' and storage_id<>1,1,0)) as  partiallyReturnd,
                SUM(IF (order_status_id = '5' and storage_id<>1,1,0)) as  `replace`,
                SUM(IF ((order_status_id = '9') and storage_id=1,1,0)) as  instorageReturnd,
                SUM(IF ((order_status_id = '6') and storage_id=1,1,0)) as  instoragepartiallyReturnd,
                SUM(IF ((order_status_id = '5') and storage_id=1,1,0)) as  instoragereplace,
                SUM(IF (order_status_id = '4',1,0)) as  recieved,
                SUM(IF (order_status_id = '7',1,0)) as  posponded,
                 count(*) as orders
                 from orders
                 left JOIN client_dev_price
                on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city
                where (orders.confirm=1 or orders.confirm=4) and invoice_id=0 and orders.client_id=".$userid." and
                date between '".$start1."' and '".$end1."'";
    $last1 =  getData($con,$sql1);
    $last1[0]['client_price'] = number_format($last1[0]['client_price']);
    if($showearnings != 1){
        $last1[0]['client_price'] = "HIDDEN";
        $last7[0]['client_price'] = "HIDDEN";
        $last30[0]['client_price'] = "HIDDEN";
    }
    $sql = "SELECT
          SUM(IF (order_status_id = '1' or order_status_id = '2' or order_status_id = '3' or order_status_id = '13',1,0)) as  onway,
          SUM(IF (order_status_id = '9' and storage_id<>1,1,0)) as  inprocess,
          SUM(IF (order_status_id = '6' and storage_id<>1,1,0)) as  partiallyReturnd,
          SUM(IF (order_status_id = '5' and storage_id<>1,1,0)) as  `replace`,
          SUM(IF ((order_status_id = '9') and storage_id=1,1,0)) as  instorageReturnd,
          SUM(IF ((order_status_id = '6') and storage_id=1,1,0)) as  instoragepartiallyReturnd,
          SUM(IF ((order_status_id = '5') and storage_id=1,1,0)) as  instoragereplace,
          SUM(IF (order_status_id = '4',1,0)) as  recieved,
          SUM(IF (order_status_id = '7',1,0)) as  posponded,
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
          ) as client_price
          FROM orders
          left JOIN client_dev_price on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city
          where orders.client_id=".$userid." and invoice_id=0  and confirm=1";
          $static =  getData($con,$sql);
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
   $msg ="Query Error";
}
ob_end_clean();
echo(json_encode(array('code'=>200,'message'=>$msg,"last1"=>$last1,"last7"=>$last7,"last30"=>$last30,'static'=>$static),JSON_PRETTY_PRINT));
?>
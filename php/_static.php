<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access();
require_once("dbconnection.php");
require_once("../config.php");

$start30 = date('Y-m-d 00:00:00',strtotime(' - 30 day'));
$end30 = date('Y-m-d 00:00:00',strtotime(' + 1 day'));
$sql30 = "select
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
            where (orders.confirm=1 or orders.confirm=4) and invoice_id=0 and orders.client_id=".$_SESSION['userid']." and
            date between '".$start30."' and '".$end30."'";
$last30 =  getData($con,$sql30);
$last30[0]['client_price'] = number_format($last30[0]['client_price']);

$start7 = date('Y-m-d 00:00:00',strtotime(' - 7 day'));
$end7 = date('Y-m-d 00:00:00',strtotime(' + 1 day'));
$sql7 = "select
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
            where (orders.confirm=1 or orders.confirm=4) and invoice_id=0 and orders.client_id=".$_SESSION['userid']." and
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
             count(*) as orders
             from orders
             left JOIN client_dev_price
            on client_dev_price.client_id = orders.client_id AND client_dev_price.city_id = orders.to_city
            where (orders.confirm=1 or orders.confirm=4) and invoice_id=0 and orders.client_id=".$_SESSION['userid']." and
            date between '".$start1."' and '".$end1."'";
$last1 =  getData($con,$sql1);
$last1[0]['client_price'] = number_format($last1[0]['client_price']);
if($_SESSION['user_details']['show_earnings'] != 1){
$last1[0]['client_price'] = "HIDDEN";
$last7[0]['client_price'] = "HIDDEN";
$last30[0]['client_price'] = "HIDDEN";
}
print_r(json_encode(array("last1"=>$last1,"last7"=>$last7,"last30"=>$last30)));
?>
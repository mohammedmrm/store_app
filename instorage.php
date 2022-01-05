<?php
require_once("config.php");
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<meta name="description" content="في هذه الصفحة الرئيسية لشركة النهر تستطيع ان تتعرف على الطلبيات الخاصة بك الواصة والراجعة والكثير من المعلومات">
<meta name="الصفحة الرئيسية للعميل" property="og:title" content="معلومات متكاملة للعميل في هذه الصفحة خاصة بعملاء شركة النهر">

<title>شركة النهر للحلول البرمجية</title>
<link href="https://fonts.googleapis.com/css?family=Cairo:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="styles/style.css">
<link rel="stylesheet" type="text/css" href="styles/framework.css">
<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">
<link rel="stylesheet" type="text/css" href="styles/datapicker.css">
<link rel="apple-touch-icon" sizes="180x180" href="pwa/apple-touch-icon.png">
<link rel="manifest" href="pwa/site.webmanifest">
<!-- load header -->
<style type="text/css">
 #search{
   width: 30%;
   min-width:10px;
   margin-left: 1.3333%;
   margin-right: 0%;
 }
 #start {
  width: 30%;
  margin-left: 1.3333%;
  margin-right: 0%;
  min-width:10px;
  border-bottom: #777777 solid 1px;
 }
 #end{
   width: 30%;
   margin-left:1.3333%;
   margin-right: 0%;
   min-width:10px;
   border-bottom: #777777 solid 1px;
 }
</style>
</head>

<body class="theme-light" data-background="none" data-highlight="orange">

<div id="page">

    <!-- load main header and footer -->
     <?php include_once("pre.php");?>
     <?php include_once("top-menu.php");?>
     <?php include_once("footer-menu.php");  ?>


    <div class="page-content header-clear-medium">

         <div class="content">
         <form id="searchForm">
            <div class="search-box search-color bg-blue2-dark shadow-tiny round-tiny bottom-10">
                <i class="fa fa-search"></i>
                <input type="text" name="search-text" placeholder=" رقم الوصل، رقم او اسم الزبون">
            </div>
            <div class="clear">
                <select type="text" name="city" style="width: 48%"  id="city" class="">
                     <option value="" >-- المحافظة --</option>
                </select>
                <select type="text" name="store" style="width: 48%" id="store" class="">
                      <option value="">-- store --</option>
                </select>
            </div>
            <input type="text" name="start" id="start" class="datepicker" placeholder="من">
            <input type="text" name="end" id="end" class="datepicker"  placeholder="الى">
            <button id="search" onclick="getorders('reload')" class="btn btn-primary" type="button" value="">
                 بحث
            </button>
            <input type="hidden" name="currentPage" id="currentPage" value="1">
         </form>
        </div>


        <div class="content-boxed">
            <div class="content bottom-0">
                <h3 class="bolder text-right">طلبات بالمخزن <span id="orders_count"></span></h3>
            </div>


            <div id="orders"></div>

         </div>

         <!-- load footer -->
         <div id="footer-loader"></div>
    </div>
</div>
<div class="modal fade" id="orderdetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title text-left" id="exampleModalLongTitle">تفاصيل الطلب <span id="orders_count"></span></h5>

      </div>
      <div class="modal-body">
       <div id="order-details"></div>
       <input type="hidden" id="order_id"/>
      </div>
      <div class="modal-footer text-right" dir="ltr">
        <button type="button" onclick="showMore()" class="btn btn-warning">عرض المزيد</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/plugins.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script type="text/javascript" src="scripts/datapicker.js"></script>
<script type="text/javascript" src="scripts/getCities.js"></script>
<script type="text/javascript" src="scripts/getStores.js"></script>
<script>
$('#start').datepicker({ format: 'yyyy-mm-dd'});
$('#end').datepicker({ format: 'yyyy-mm-dd'});

function getorders(action){
if(action == "reload"){
    $("#currentPage").val(1);
}
$.ajax({
  url:"php/_getinstorageOrders.php",
  type:"POST",
  data:$("#searchForm").serialize(),
  beforeSend:function(){
    $("#orders").addClass("loading");
  },
  success:function(res){
    $("#orders").removeClass("loading");
    if(action == "reload"){
     $("#orders").html('');
    }
   $("#loader").remove();
   $("#loading-items").remove();
   $("#currentPage").val(res.nextPage);
   $("#orders_count").text(" ( "+res.orders+" ) ");
   console.log(res);
   $.each(res.data,function(){
      color = 'bg-magenta1-dark';
     $("#orders").append(
          '<a onclick="getOrderDetails('+this.id+')" data-toggle="modal" data-target="#orderdetailsModal" >'+
             '<div data-accordion="accordion-content-10" data-height="100" class="caption caption-margins round-small bottom-5" style="height: 90px;">'+
                '<div class="caption-center">'+
                    '<h4 class="color-white center-text bottom-0 uppercase bolder">'+this.order_no+'</h4>'+
                    '<p class="color-white right-text right-10 bottom-0">'+this.customer_name+' | '+this.customer_phone+'</p>'+
                    '<p class="color-white right-text right-10 bottom-0">'+this.city+' | '+this.town+'</p>'+
                '</div>'+
                '<div class="caption-overlay '+color+' opacity-80"></div>'+
                '<div class="caption-background "></div>'+
            '</div>'+
          '</a>'
       );
     });
     if(res.pages >= res.nextPage){
      $("#orders").append('<div id="loader" onclick="getorders(\'append\')" class="btn btn-link form-control center-text top-10">تحميل المزيد</div>');
      $("#orders").append('<div id="loading-items"></div>');
     }
     if(res.pages == 0){
        $("#orders").append('<div class="text-center text-danger">لايوجد اي طلبيات</div>');
     }
    },
   error:function(e){
     $("#orders").removeClass("loading");
    console.log(e);
  }
});
}
function getOrderDetails(id){
  $("#order_id").val(id);
$.ajax({
  url:"php/_getOrder.php",
  type:"POST",
  beforeSend:function(){
    $("#order-details").addClass("loading");
  },
  data:{id : id},
  success:function(res){
    $("#order-details").removeClass("loading");
    $("#order-details").html("");
   console.log(res);
   if(res.success == 1){
     $.each(res.data,function(){
       $("#order-details").append(
        '<h1 class="text-center right-10">'+this.order_status+'</h1>'+
        '<h3 class="text-center">'+this.store_name+'</h3>'+
        '<h3 class="text-center">'+this.order_no+'</h3>'+
        '<table style="width:100%;" class="table-striped">'+
         '<tbody>'+
         '<tr><td class="text-right right-10">اسم الزبون</td><td>'+this.customer_name+'</td></tr>'+
         '<tr><td class="text-right right-10">هاتف الزبون</td><td><a href="tel:'+this.customer_phone+'">'+this.customer_phone+'</a></td></tr>'+
         '<tr><td class="text-right right-10">اسم العميل</td><td>'+this.client_name+'</td></tr>'+
         '<tr><td class="text-right right-10">رقم هاتف العميل</td><td><a href="tel:'+this.client_phone+'">'+this.client_phone+'</a></td></tr>'+
         '<tr><td class="text-right right-10"><br />العنوان<br /></td><td>'+this.city+' | '+this.town+'<br />'+this.address+'</td></tr>'+
         '<tr><td class="text-right right-10">مبلغ الوصل</td><td>'+this.price+'</td></tr>'+
         '<tr><td class="text-right right-10">المبلغ المستلم</td><td>'+this.new_price+'</td></tr>'+
         '<tr><td class="text-right right-10">سعر التوصيل</td><td>'+this.dev_price+'</td></tr>'+
         '<tr><td class="text-right right-10">الخصم</td><td>'+this.discount+'</td></tr>'+
         '<tr><td class="text-right right-10">المبلغ الصافي</td><td>'+this.client_price+'</td></tr>'+
         '</tbody>'+
        '</table>'
       );

       $("#order_price").val(""+this.price+"");
       $("#new_price").val(""+this.price+"");
     });
   }else{
       $("#order-details").append(
        '<h1>خطأ</h1>'
       );
   }
  },
  error:function(e){
    $("#order-details").removeClass("loading"); 
   console.log(e);
  }
});

}
function showMore(){
  window.location.href = "orderDetails.php?o="+$("#order_id").val();
}
getorders('reload');
getCities($("#city"));
getStores($("#store"));
</script>
</body>
</html>

<?
require_once("php/_access.php");
access();
include("config.php");
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2, viewport-fit=cover" />
    <meta name="description" content="في هذه الصفحة الرئيسية <?php echo $config['Company_name'];?> تستطيع ان تتعرف على الطلبيات الخاصة بك الواصة والراجعة والكثير من المعلومات">
    <meta name="<?php echo $config['Company_name'];?>" property="og:title" content="معلومات متكاملة للعميل في هذه الصفحة خاصة بعملاء  <?php echo $config['Company_name'];?>">

    <title><?php echo $config['Company_name'];?></title>
<link href="https://fonts.googleapis.com/css?family=Cairo:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="styles/style.css">
<link rel="stylesheet" type="text/css" href="styles/framework.css">
<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">
<link rel="stylesheet" type="text/css" href="styles/datapicker.css">
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
 .call {
   border-left: 2px  #CC0000;
   background-color: #FFFFFF;
   border-radius: 100px;
 }
 .resend {
   border-left: 2px  #CC0000;
   background-color: #FFFFFF;
   border-radius: 100px;
 }

</style>
</head>

<body class="theme-light" data-background="none" data-highlight="red2">

<div id="page">

    <!-- load main header and footer -->
    <div id="page-preloader">
        <div class="loader-main"><div class="preload-spinner border-highlight"></div></div>
    </div><?php include_once("top-menu.php");?>
     <?php include_once("footer-menu.php");  ?>

    <div class="page-content header-clear-medium">

         <div class="content">
         <form id="searchForm">
            <div class="search-box search-color bg-red1-dark shadow-tiny round-large bottom-20">
                <i class="fa fa-search"></i>
                <input type="text"  name="search-text" width="100%" placeholder="رقم الوصل او رقم هاتف الزبون">
            </div>
            <div class="clear">
                <select type="text" name="city" style="width: 48%"  id="city" class="">
                     <option value="" >-- المحافظة --</option>
                </select>
                <select type="text" name="store" style="width: 48%" id="store" class="">
                      <option value="">-- store --</option>
                </select>
            </div>
            <hr />
            <div class="clear">
                <select type="text" name="reason" style="width: 96%"  id="city" class="">
                     <option value="" >-- سبب الراجع --</option>
                     <option value="لايرد">لايرد</option>
                     <option value="لايرد مع رسالة">لايرد مع رسالة</option>
                     <option value="تم اغلاق الهاتف">تم اغلاق الهاتف</option>
                     <option value="رفض الطلب">رفض الطلب</option>
                     <option value="مكرر">مكرر</option>
                     <option value="كاذب">كاذب</option>
                     <option value="الرقم غير معرف">الرقم غير معرف</option>
                     <option value="رفض الطلب">رفض الطلب</option>
                     <option value="حظر المندوب">حظر المندوب</option>
                     <option value="لايرد بعد التاجيل">لايرد بعد التاجيل</option>
                     <option value="مسافر">مسافر</option>
                     <option value="تالف">تالف</option>
                     <option value="راجع بسبب الحظر">راجع بسبب الحظر</option>
                     <option value="لايمكن الاتصال به">لايمكن الاتصال به</option>
                     <option value="مغلق بعد الاتفاق">مغلق بعد الاتفاق</option>
                     <option value="مستلم سابقا">مستلم سابقا</option>
                     <option value="لم يطلب">لم يطلب</option>
                     <option value="لايرد بعد سماع المكالمة">لايرد بعد سماع المكالمة</option>
                     <option value="غلق بعد سماع المكالمة">غلق بعد سماع المكالمة</option>
                     <option value="مغلق">مغلق</option>
                     <option value="تم الوصول والرفض">تم الوصول والرفض</option>
                     <option value="لايرد بعد الاتفاق">لايرد بعد الاتفاق</option>
                     <option value="غير داخل بالخدمة">غير داخل بالخدمة</option>
                     <option value="خطأ بالعنوان">خطأ بالعنوان</option>
                     <option value="مستلم سابقا">مستلم سابقا</option>
                     <option value="خطأ بالتجهيز">خطأ بالتجهيز</option>
                     <option value="نقص رقم">نقص رقم</option>
                     <option value="زيادة رقم">زيادة رقم</option>
                     <option value="وصل بدون طلبية">وصل بدون طلبية</option>
                     <option value="الغاء الحجز">الغاء الحجز</option>
                </select>
            </div>

              <div class="input-group mb-3">
                <input type="text" name="start" id="start" class="datepicker" placeholder="من">
                <input type="text" name="end" id="end" class="datepicker"  placeholder="الى">
                <button id="search" onclick="getorders('reload')" class="btn btn-danger" type="button" value="">
                     بحث
                </button>
              </div>
            <input type="hidden" name="currentPage" id="currentPage" value="1">
         </form>
        </div>


        <div class="content-boxed">
            <div class="content bottom-0">
                <h3 class="bolder text-right">الطلبيات الراجعة<span id="orders_count"></span></h3>
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
<div class="toast rounded-pill toast-bottom" id="toast-success">
    <p class="color-white" id="toast-msg"><i class='fa fa-sync fa-spin right-10'></i>
      تم التحديث
    </p>
    <div class="toast-bg opacity-90 bg-green2-dark"></div>
</div>
<div class="toast rounded-pill toast-bottom" id="toast-error">
    <p class="color-white" id="toast-msg-err"><i class='fa fa-sync fa-spin right-10'></i>
      خطا
    </p>
    <div class="toast-bg opacity-90 bg-red2-dark"></div>
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
  url:"php/_getReturnedOrders.php",
  type:"POST",
  data:$("#searchForm").serialize(),
  beforeSend:function(){
    if (action == "reload") {
        $("#orders").addClass("loading");
    }
  },
  success:function(res){
    if(action == "reload"){
     $("#orders").html('');
    }
   $("#orders").removeClass("loading");
   $("#loader").remove();
   $("#loading-items").remove();
   $("#currentPage").val(res.nextPage);
   $("#orders_count").text(" ( "+res.orders+" ) ");
   console.log(res);
   $.each(res.data,function(){
     if(this.order_status_id == 9){
       color = 'bg-red1-dark';
       btn = "";
       //btn = '<button style="z-index:100; width:100%;" onclick="resend('+this.id+')" class="btn btn-warning">اعادة ارسال</button>';
     }else if(this.order_status_id == 6){
        btn = "";
        color = 'bg-red1-light';
     }else if(this.order_status_id == 4){
        color = 'bg-green1-dark';
     }else if(this.order_status_id == 5){
        color = 'bg-yellow1-dark';
     }else{
       color = 'bg-magenta1-light';
     }
     $("#orders").append(
             '<div class="content-boxed '+color+'">'+
                '<div class="content  list-columns-right">'+
                    '<div>'+
                        '<a style="z-index:100;" class="call" href="tel:'+this.driver_phone+'"><i class="fa fa-phone color-green1-light call fa-2x"></i></a>'+
                        '<a href="javascript:;" onclick="getOrderDetails('+this.id+')" data-toggle="modal" data-target="#orderdetailsModal" >'+
                          '<h1 class="bolder text-center text-white">'+this.order_no+'</h1>'+
                          '<p class=" text-center text-white">'
                            +this.customer_phone+
                            '<br /><b>'+this.status_name+'</b>'+
                            '<br />'+this.city+' | '+this.town+' | '+this.address+
                            '<br /> مضى '+this.days+" يوم على تسجيل الطلب "+
                            '<br />'+this.store_name+
                            '<br />( '+this.t_note+
                          ' )</p>'+
                        '</a>'+
                    '</div>'+
                '</div>'+
            '</div>'
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
getorders('reload');
function resend(id){
  if(confirm("هل انت متاكد من اعادة ارسال الطلب")){
      $.ajax({
        url:"php/_resendOrder.php",
        type:"POST",
        data:{id:id},
        beforeSend:function(){
          $("#orders").addClass("loading");
        },
        success:function(res){
          $("#orders").removeClass("loading");
         if(res.success == 1){
            $('#toast-msg').text('تم طلب اعادة ارسال الطلب');
            $('#toast-success').addClass('toast-active');
            setTimeout(function(){
            $('#toast-success').removeClass('toast-active');
            },3000);
            getorders('reload');
         }else{
            $('#toast-msg-err').text(res.error);
            $('#toast-error').addClass('toast-active');
            setTimeout(function(){
            $('#toast-error').removeClass('toast-active');
            },5000);
         }
         console.log(res)
        } ,
        error:function(e){
          $("#orders").removeClass("loading");
          console.log(e);
        }
      });
  }
}
function getOrderDetails(id){
  $("#order_id").val(id);
$.ajax({
  url:"php/_getOrder.php",
  type:"POST",
  beforeSend:function(){
     //$("#order-details").addClass("loading");
  },
  data:{id : id},
  success:function(res){
    //$("#order-details").removeClass("loading");
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
    //$("#order-details").removeClass("loading");
   console.log(e);
  }
});

}
function showMore(){
  window.location.href = "orderDetails.php?o="+$("#order_id").val();
}
getCities($("#city"));
getStores($("#store"));
</script>
</body>
</html>

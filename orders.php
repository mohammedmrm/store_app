<?php
require_once("php/_access.php");
access();
require_once("config.php");
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
<link rel="apple-touch-icon" sizes="180x180" href="pwa/apple-touch-icon.png">
<link rel="manifest" href="pwa/site.webmanifest">
    <!-- load header -->
    <style type="text/css">
 #search{
   width: 30%;
   min-width:10px;
   margin-left: 0%;
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
 #qrlink button{
   width:100%;
   background-color: #f96332;
   color:#F8F8FF;
   box-shadow: 0 5px 30px 0 rgba(0,0,0,.11),0 5px 15px 0 rgba(0,0,0,.08)!important;
 }

        .bg-green_ {
            background-color: #0F9D58;
        }

        .bg-blue_ {
            background-color: #4285F4;
            color: black;
        }

        .bg-yallow_ {
            background-color: #F4B400;
        }

        .bg-gray_ {
            background-color: #444444;
        }

        .bg-red_ {
            background-color: #DB4437;
        }

        .bg-carrot_ {
            background-color: #ED5E21 !important;
        }
       .call {
         border-left: 2px  #CC0000;
         background-color: #FFFFFF;
         border-radius: 100px;
       }
       a:hover {
        text-underline: none;
       }
    </style>
</head>

<body class="theme-light" data-background="none" data-highlight="blue2">

    <div id="page">

        <!-- load main header and footer -->
     <?php include_once("pre.php");?>
     <?php include_once("top-menu.php");?>
     <?php include_once("footer-menu.php");  ?>

        <div class="page-content header-clear-medium">

            <div class="content">
                <form id="searchForm">
                    <div class="search-box  shadow-large round-small bottom-10">
                        <i class="fa fa-search"></i>
                        <input type="text" name="search-text" placeholder="ابحث بواسطة الوصل، موبايل اواسم الزبون" aria-label="search">
                    </div>
                    <div class="clear">
                        <select type="text" name="city" style="width: 48%"  id="city" class="">
                             <option value="" >-- المحافظة --</option>
                        </select>
                        <select type="text" name="store" style="width: 48%" id="store" class="">
                              <option value="">-- store --</option>
                        </select>
                    </div>
                    <div class="clear">
                        <input type="text" name="start" aria-label="date start" id="start" class="datepicker" placeholder="من">
                        <input type="text" name="end" aria-label="date to" id="end" class="datepicker" placeholder="الى">
                        <button id="search" onclick="getorders('reload')" aria-label="search" class="shadow-large btn bg-blue_" type="button" value="">
                            بحث
                        </button>
                   </div>
                    <div class="top-5 bottom-5">
                      <a href="#" data-menu="sacnModal" id="qrlink">
                        <button id="searchbyQR" onclick="scanQR()" aria-label="search" class="btn" type="button" value="">
                             بحث من خلال QR
                        </button>
                      </a>
                    </div>
                    <input type="hidden" name="currentPage" id="currentPage" value="1">
                </form>

                <!--<div class="content bottom-0 top-5 left-20 right-20">-->
<!--
<ul class="gallery-filter-controls">
<li class="gallery-filter-active color-highlight gallery-filter-all" data-filter="all">الكل </li>
<li data-filter="1">بطريق</li>
<li data-filter="4">مستلم</li>
<li data-filter="5">رواجع</li>
<li data-filter="6">مؤجلات</li>
</ul>
</div>-->

            </div>


            <div class="content-boxed">
                <div class="content bottom-0">
                    <h3 class="bolder text-right">الطلبات<span id="orders_count"></span></h3>
                </div>


                <div id="orders"></div>

            </div>

            <!-- load footer -->
            <div id="footer-loader"></div>
        </div>
    <div id="sacnModal"
     class="menu  menu-box-bottom menu-box-detached round-medium"
     data-menu-height="500"
     data-menu-effect="menu-over">
     <div class="content">
            <h2 class="uppercase bold font-16 text-center top-20">البحث من خلال QR كود</h2>
            <p class="font-13 under-heading text-center bottom-20">ضع QR code مقابل الكامره</p>
            <video id="preview" style="width: 100%;height: 300px;"></video>
            <button onclick="close_qr()" class="button bg-carrot_ button-full button-l shadow-large button-round-small  top-20">اغلاق</button>
     </div>
    </div>
    </div>
   <div class="menu-hider"></div>
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
    <script type="text/javascript" src="scripts/getCities.js"></script>
    <script type="text/javascript" src="scripts/getStores.js"></script>
    <script type="text/javascript" src="scripts/instascan.min.js"></script>
    <script>
            var selectedCam;
            var scanner;
            function scanQR(){
              scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
              scanner.addListener('scan', function (content) {
                window.location.href = "orderDetails.php?o="+content
                console.log(content);
              });
              Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    selectedCam = cameras[0];
                    $.each(cameras, (i, c) => {
                      if (c.name.indexOf('back') != -1) {
                          selectedCam = c;
                          return false;
                      }
                    });

                    scanner.start(selectedCam);
                } else {
                    console.error('No cameras found.');
                }

                console.log(cameras);
              }).catch(function (e) {
                console.error(e);
              });
              }
            function close_qr(){
              scanner.stop(selectedCam);
             $("#sacnModal").removeClass('menu-active');
             $(".menu-hider").removeClass('menu-active');

            }
        function getorders(action) {
            if (action == "reload") {
                $("#currentPage").val(1);
            }
            $.ajax({
                url: "php/_getOrders.php",
                type: "POST",
                data: $("#searchForm").serialize(),
                beforeSend:function(){
                    if (action == "reload") {
                        $("#orders").addClass("loading");
                    }
                },
                success: function(res) {
                    if (action == "reload") {
                        $("#orders").html('');
                        $("#orders").removeClass("loading");
                    }
                    $("#loader").remove();
                    $("#loading-items").remove();
                    $("#currentPage").val(res.nextPage);
                    $("#orders_count").text(" ( "+res.orders+" ) ");
                    console.log(res);
                    $.each(res.data, function() {
                         if (this.order_status_id == 13) { // changed address
                            color = 'bg-yallow_';
                        } else { //not recieved yes
                            color = 'bg-gray_';
                        }
                        $("#orders").append(
                         '<div class="content-boxed '+color+'">'+
                            '<div class="content  list-columns-right">'+
                                '<div>'+
                                    '<a style="z-index:100;" class="call" href="tel:'+this.driver_phone+'"><i class="fa fa-phone color-green1-light call fa-2x"></i></a>'+
                                    '<a href="javascript:;" onclick="getOrderDetails('+this.id+')" data-toggle="modal" data-target="#orderdetailsModal">'+
                                      '<h1 class="bolder text-center text-white">'+this.order_no+'</h1>'+
                                      '<p class=" text-center text-white">'
                                          +this.customer_phone+
                                        '<br />'+this.city+' | '+this.town+' | '+this.address+
                                        '<br /> مضى '+this.days+" يوم على تسجيل الطلب "+
                                        '<br />'+this.store_name+
                                      '</p>'+
                                    '</a>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                        );
                    });
                    if (res.pages >= res.nextPage) {
                        $("#orders").append('<div id="loader" onclick="getorders(\'append\')" class="btn btn-link form-control color-black center-text top-10">تحميل المزيد</div>');
                        $("#orders").append('<div id="loading-items"></div>');
                    }
                },
                error: function(e) {
                    $("#orders").removeClass("loading");
                    console.log(e);
                }
            });
        }
        $(document).ready(function() {
            $('#start').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#end').datepicker({
                format: 'yyyy-mm-dd'
            });
            getorders('reload');
            getCities($("#city"));
            getStores($("#store"));
        });
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
    </script>
    <script type="text/javascript" src="scripts/custom.js"></script>
    <script type="text/javascript" src="scripts/datapicker.js"></script>
    <script type="text/javascript" src="scripts/plugins.js"></script>
</body>

</html>
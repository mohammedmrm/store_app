<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>اضافة طلب</title>
<link href="https://fonts.googleapis.com/css?family=Cairo:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="styles/style.css">
<link rel="stylesheet" type="text/css" href="styles/framework.css">
<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="pwa/apple-touch-icon.png">
    <link rel="manifest" href="pwa/site.webmanifest">
</head>

<body class="theme-light" data-background="none" data-highlight="red2">
<style type="text/css">

</style>
<script type="text/javascript" src="scripts/jquery.js"></script>

<div id="page">

     <?php include_once("pre.php");?>
     <?php include_once("top-menu.php");?>
     <?php include_once("footer-menu.php");  ?>

     <div class="page-content header-clear-medium">
        <div data-height="100" class="caption shadow-large caption-margins top-10 round-medium shadow-huge">
            <div class="caption-top top-10">

            </div>
            <div class="caption-overlay bg-black opacity-80"></div>
            <div class="caption-bg bg-14"></div>
        </div>
        <div class="content-boxed" >
            <div class="content">
            <form id="requestForm">
                <h1 class="color-highlight bold text text-center">اضافة طلب</h1>
                <div class="content-box">
                  <span class="text-right">السوق</span>
                  <select class="selectpicker form-control" name="store" id="store">
                       <option>--اختر--</option>
                  </select>
                  <span class="text-right text-danger" id="store_err"></span>
                 </div>
                <div class="content-box">
                  <span class="text-right">اسم الزبون</span>
                  <input id="name" name="name" class="form-control"  type="text"/>
                  <span class="text-right text-danger" id="name_err"></span>
                </div>
                <div class="content-box">
                  <span class="text-right">هاتف الزبون</span>
                  <input id="phone" name="phone" class="form-control"  type="text"/>
                  <span class="text-right text-danger" id="phone_err"></span>
                </div>
                <div class="content-box">
                  <span class="text-right">السعر</span>
                  <input id="price" name="price" class="form-control"  type="text"/>
                  <span class="text-right text-danger" id="price_err"></span>
                </div>
                <div class="row" style="padding:0; margin:0;">
                  <div class="col-sm-6">
                    <span class="text-right">المحافظه</span>
                    <select  class="form-control" onchange="uptadeTowns()" id="city" name="city">
                    </select>
                    <span class="text-right text-danger" id="city_err"></span>
                  </div>
                  <div class="col-sm-6">
                    <span class="text-right">القضاء</span>
                    <select class="form-control" id="town" name="town">

                    </select>
                    <span class="text-right text-danger" id="town_err"></span>
                  </div>
                </div>
                <div class="content-box">
                  <span class="text-right">تفاصيل العنوان</span>
                  <textarea id="address" name="address" class="form-control"  type="text"></textarea>
                  <span class="text-right text-danger" id="address_err"></span>
                </div>
                <div class="content-box">
                  <span class="text-right">ملاحظات</span>
                  <textarea id="note" name="note" class="form-control"  type="text"></textarea>
                  <span class="text-right text-danger" id="note_err"></span>
                </div>
                <div class="content-box">
                    <input onclick="addOrder()" class="bg-orange-light btn form-control" value="اضافة" type="button" />
                </div>
            </form>
            </div>
        </div>

    </div>
    <div class="toast toast-bottom" id="toast-error">
        <p class="color-white"><i class='fa fa-sync fa-spin right-10'></i>
          <span id="msg"></span>
        </p>
        <div class="toast-bg opacity-90 bg-red2-dark"></div>
    </div>

    <div class="toast toast-bottom" id="toast-success">
        <p class="color-white"><i class='fa fa-sync fa-spin right-10'></i>
          تم الاضافه
        </p>
        <div class="toast-bg opacity-90 bg-green2-dark"></div>
    </div>
</div>
<script type="text/javascript" src="scripts/plugins.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script type="text/javascript" src="scripts/getStores.js"></script>
<script type="text/javascript" src="scripts/getCities.js"></script>
<script type="text/javascript" src="scripts/getTowns.js"></script>

<script>
getStores($("#store"));
getCities($("#city"));
function uptadeTowns(){
  $("#twon").append("<option>Loading ..... </option>");
  getTowns($("#town"),$("#city").val());
}
function addOrder(){
  $.ajax({
    url:"php/_addOrder.php",
    type:"POST",
    data:$("#requestForm").serialize(),
    beforeSend:function(){
    },
    success:function(res){
        console.log(res);
        $("#msg").text(res.msg);
       if(res.success == 1){
         $("#requestForm input[name='price']").val("");
         $("#requestForm input[name='name']").val("");
         $("#requestForm input[name='phone']").val("");
         $("#requestForm input[name='note']").val("");
         $("#requestForm .text-danger").text("");
         $('#toast-success').addClass('toast-active');
         setTimeout(function(){
              $('#toast-success').removeClass('toast-active');
         },3000);
       }else{
           $('#toast-error').addClass('toast-active');
             setTimeout(function(){
                  $('#toast-error').removeClass('toast-active');
            },3000);
           $("#store_err").text(res.error["store"]);
           $("#price_err").text(res.error["order_price"]);
           $("#name_err").text(res.error["customer_name"]);
           $("#phone_err").text(res.error["customer_phone"]);
           $("#city_err").text(res.error["city"]);
           $("#town_err").text(res.error["town"]);
           $("#town_err").text(res.error["town"]);
           $("#note_err").text(res.error["order_note"]);
           $("#address_err").text(res.error["order_address"]);



       }
    },
    error:function(e){
      console.log(e);

    }
  });
}

</script>
</body>
</html>

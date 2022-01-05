<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>شركة النهر للحلول البرمجية</title>
<link href="https://fonts.googleapis.com/css?family=Cairo:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="styles/style.css">
<link rel="stylesheet" type="text/css" href="styles/framework.css">
<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">


</head>

<body class="theme-light" data-background="none" data-highlight="red2">
<style type="text/css">

</style>
<div id="page">

     <?php include_once("pre.php");?>
     <?php include_once("top-menu.php");?>
     <?php include_once("bottom-menu.php");?>
     <div class="page-content header-clear-medium">
        <div data-height="200" class="caption shadow-large caption-margins top-10 round-medium shadow-huge">
            <div class="caption-top top-30">
                 <h1 class="center-text color-white bolder fa-4x">الوصولات<span id="avalible"></span></h1>
            </div>
            <div class="caption-overlay bg-black opacity-80"></div>
            <div class="caption-bg bg-14"></div>
        </div>
        <div class="content-boxed" >
            <div class="content">
            <form id="requestForm">
                <h1 class="color-highlight bold text text-center">طلب وصولات</h1>
                <div class="content-box">
                  <span class="text-right">السوق</span>
                  <select class="selectpicker form-control" name="store" id="store">
                       <option>--اختر--</option>
                  </select>
                  <span class="text-right text-danger" id="store_err"></span>
                 </div>
                <div class="content-box">
                  <span class="text-right">العدد</span>
                  <input id="qty" name="qty" class="form-control"  type="phone"/>
                  <span class="text-right text-danger" id="qty_err"></span>
                </div>

                <div class="content-box">
                    <input onclick="request()" class="bg-orange-light btn form-control" value="طلب" type="button" />
                </div>
            </form>
            </div>
        </div>

    </div>
    <div class="toast toast-bottom" id="toast-error">
        <p class="color-white"><i class='fa fa-sync fa-spin right-10'></i>
          خطاء مدخلات غير صحيحة
        </p>
        <div class="toast-bg opacity-90 bg-red2-dark"></div>
    </div>

    <div class="toast toast-bottom" id="toast-success">
        <p class="color-white"><i class='fa fa-sync fa-spin right-10'></i>
          تم التحديث
        </p>
        <div class="toast-bg opacity-90 bg-green2-dark"></div>
    </div>
</div>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/plugins.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script type="text/javascript" src="scripts/getStores.js"></script>
<script>
getStores($("#store"));
function request(){
    $.ajax({
       url:"php/_request.php",
       type:"POST",
       data:$("#requestForm").serialize(),

       beforeSend:function(){

       },
       success:function(res){
         console.log(res);
       if(res.success == 1){
         $(".text-danger").text('');
         $('#toast-success').addClass('toast-active');
         setTimeout(function(){
              $('#toast-success').removeClass('toast-active');
         },3000);
         getProfile();
       }else{
           $("#store_err").text(res.error["store"]);
           $("#qty_err").text(res.error["qty"]);
           $('#toast-error').addClass('toast-active');
             setTimeout(function(){
                  $('#toast-error').removeClass('toast-active');
            },3000);
       }

       },
       error:function(e){
       $('#toast-error').addClass('toast-active');
         setTimeout(function(){
              $('#toast-error').removeClass('toast-active');
        },3000);
        console.log(e);
       }
    });
}
</script>
</body>
</html>

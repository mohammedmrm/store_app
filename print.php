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
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/plugins.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script type="text/javascript" src="scripts/getStores.js"></script>
            <script>
            function removeLoading(){
               $("#receiptIfram").parent().removeClass("loading");
              }
            </script>
<div id="page">

     <?php include_once("pre.php");?>
     <?php include_once("top-menu.php");?>
     <?php include_once("bottom-menu.php");?>
     <div class="page-content header-clear-medium">
<div class="content-boxed" >
            <div class="content">
            <form id="printForm" method="post" action="receiptShow.php">
                <h1 class="color-highlight bold text text-center"></h1>
                <div class="content-box">
                  <span class="text-right">السوق</span>
                  <select class="selectpicker form-control" name="store" id="store">
                       <option>--اختر--</option>
                  </select>
                  <span class="text-right text-danger" id="store_err"></span>
                 </div>
                <div class="row" style="padding:0; margin:0;">
                  <div class="col-sm-6">
                    <span class="text-right">تحديد الوصولات</span>
                    <select onchange="updateForm()" class="form-control" id="receiptType" name="receiptType">
                          <option value="" >----اختر----</option>
                          <option value="1">الكل</option>
                          <option value="2">الوصولات الفارغه</option>
                          <option value="3">الوصولات للطبيات المدخله</option>
                    </select>
                    <span class="text-right text-danger"  id="receiptType_err"></span>
                  </div>
                  <div class="col-sm-6">
                    <span class="text-right">عدد الوصولات الفارغه المطلوب</span>
                    <input type="number" class="form-control" id="number" name="number" />
                    <span class="text-right text-danger" id="number_err"></span>
                  </div>
                </div>
                <div class="content-box">
                  <span class="text-right">طباعه وصولات يوم</span>
                  <input id="date" name="date" class="form-control"  type="date"/>
                  <span class="text-right text-danger" id="phone_err"></span>
                </div>

                <div class="content-box">
                    <input onclick="laodReceipt()" class="bg-orange-light btn form-control" value="طباعه" type="button" />
                </div>
            </form>

            <iframe width="100%" onload="removeLoading();" height="500" id="receiptIfram">

            </iframe>
            </div>
            </div>

    </div>

</div>

<script type="text/javascript">
getStores($("#store"));
function updateForm() {
  if($('#receiptType').val() == 1){
     $("#date").parent().css("display",'block');
     $("#number").parent().css("display",'block');
  }else if($('#receiptType').val() == 2){
     $("#date").parent().css("display",'none');
     $("#number").parent().css("display",'block');
  }else if($('#receiptType').val() == 3){
     $("#date").parent().css("display",'block');
     $("#number").parent().css("display",'none');
  }else{

  }
}
function laodReceipt(){
  $("#receiptIfram").parent().addClass("loading");
  $("#receiptIfram").attr('src',"php/_printReceipt.php?store="+$("#store").val()+"&number="+$("#number").val()+"&date="+$("#date").val()+"&type="+$("#receiptType").val());
   console.log($("#receiptIfram").attr('src'));
}

</script>
</body>
</html>

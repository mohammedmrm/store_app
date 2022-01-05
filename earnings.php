<?php
session_start();
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
 }
 #start {

 }
 #end{

 }
 .tit {

 }
 .val {

 }

</style>
</head>

<body class="theme-light" data-background="none" data-highlight="red2">

<div id="page">

    <!-- load main header and footer -->
        <?php include_once("pre.php");  ?>
        <?php include_once("top-menu.php");  ?>
        <?php include_once("bottom-menu.php");  ?>

    <div class="page-content header-clear-medium">

         <div class="content">
         <form id="searchForm">
            <div class="col-12">
              <div class="input-group mb-2 ">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">من</span>
                </div>
               <input type="text" name="start" id="startdate" value="<?php echo date('Y-m-d',strtotime(' - 61 day'));?>" class="datepicker form-control" placeholder="من">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">الى</span>
                </div>
               <input type="text" name="end" id="enddate"  value="<?php echo date('Y-m-d',strtotime(' + 1 day'));?>" class="datepicker form-control"  placeholder="الى">
              </div>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">السوق</span>
                </div>
                <select class="form-control" id="store" name="store">
                 <option>--- اختر السوق ---</option>
                </select>
              </div>
              <div class="input-group">
                <button  onclick="earnings()" class="btn form-control btn btn-success" type="button" value="">
                     بحث
                </button>
              </div>
            </div>
           <!-- <input type="hidden" name="currentPage" id="currentPage" value="1">-->
         </form>
        </div>


        <div class="content-boxed">
            <div class="content bottom-0">
                <h6 class="bolder text-right">الطلبات التي لم يتم التحاسب عليها</h6>
            </div>
            <div id="inprocess">

            </div>
            <div class="content bottom-0">
                <h6 class="bolder text-right">الكشوفات</h6>
            </div>
            <div id="earnings">
                  <h4 class="text-danger">لايوجد كشف للفتره الزمنيه المحدده</h4>
            </div>
            </div>

         <!-- load footer -->
         <div id="footer-loader"></div>
    </div>
</div>


<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/plugins.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script type="text/javascript" src="scripts/moneyformat.js"></script>
<script type="text/javascript" src="scripts/datapicker.js"></script>
<script type="text/javascript" src="scripts/getStores.js"></script>
<?php if($_SESSION['user_details']['show_earnings'] != 1){ die("<h1>لايمكن عرض الصفحة</h1>");}?> 
<script>
$('#startdate').datepicker({ format: 'yyyy-mm-dd'});
$('#enddate').datepicker({ format: 'yyyy-mm-dd'});
getStores($('#store'));

function earnings(){
  $.ajax({
  url:"php/_recivedOrders.php",
  type:"POST",
  data:$("#searchForm").serialize(),
  beforeSend:function(){
    $("#earnings").addClass("loading");
    $("#inprocess").addClass("loading");
  },
  success:function(res){
    $("#earnings").html("");
    $("#inprocess").html("");
    $("#earnings").removeClass("loading");
    $("#inprocess").removeClass("loading");
    console.log(res);
    if(res.data.income == null){
      res.data.income = 0;
    }
    if(res.data.dev == null){
      res.data.dev = 0;
    }
    if(res.data.client_price == null){
      res.data.client_price = 0;
    }
    $("#inprocess").append(
       '<div class="clear text-right" >'+
              '<div  class="content-boxed bottom-20">'+
                  '<div class="content bottom-15">'+
                      '<div class="col-sm-12"><span class="tit col-sm-6">عدد الطلبات :   </span><span class="val col-6">'+res.data.orders+'</span></div>'+
                      '<div class="col-sm-12"><span class="tit col-sm-6">المبلغ الصافي:  </span><span class="val col-6">'+formatMoney(res.data.client_price)+'</span></div>'+
                  '</div>'+
              '</div>'+
       '</div>'
    );
    $.each(res.invoice,function(){
      if(this.order_status_id == 4){
        bg = "bg-green1-light";
      }else{
        bg = "bg-red1-light";
      }
       $("#earnings").append(
       '<a href="invoiceVeiwer.php?invoice='+this.path+'">'+
         '<div class="clear text-right" >'+
              '<div  class="content-boxed  '+bg+' bottom-20">'+
                  '<div class=" content bottom-15">'+
                      '<h5 class="color-black text-center">كشف يوم ('+this.in_date+')</h5>'+
                      '<h6 class="text-center top-5 bottom-0">'+this.store_name+'</h6>'+
                      '<p class="text-center bold font-14 top-5 bottom-0">'+this.orders+' طلبيه</p>'+
                  '</div>'+
              '</div>'+
          '</div>'+
        '</a>'
       )
    });
  },
  error:function(e){
    console.log(e);
    $("#earnings").removeClass("loading");
    $("#inprocess").removeClass("loading");
  }
});
}
earnings();
</script>
</body>
</html>

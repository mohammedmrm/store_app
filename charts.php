<?php

require_once("config.php");
?>
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
<link rel="stylesheet" type="text/css" href="styles/datapicker.css">
<link rel="apple-touch-icon" sizes="180x180" href="pwa/apple-touch-icon.png">
<link rel="manifest" href="pwa/site.webmanifest">
<!-- load header -->
<style type="text/css">

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
            <input type="text" name="start" id="start" class="datepicker" placeholder="من">
            <input type="text" name="end" id="end" class="datepicker"  placeholder="الى">
            <button id="search" onclick="charts('reload')" class="btn btn-info" type="button" value="">
                 بحث
            </button>
            <input type="hidden" name="currentPage" id="currentPage" value="1">
         </form>
        </div>

         <div class="content-boxed">
            <div class="content">
                <h2 class="center-text bolder bottom-0">حالة الطلبيات</h2>
                <p class="center-text under-heading font-11 color-highlight"></p>
                <div class="chart-container">
                    <canvas class="chart" id="polar-chart"/></canvas>
                </div>
            </div>
        </div>
      <!--  <div class="content-boxed">
            <div class="footer">
                <a href="#" class="footer-title"><span class="color-highlight">StickyMobile</span></a>
                <p class="footer-text"><span>Made with <i class="fa fa-heart color-highlight font-16 left-10 right-10"></i> by Enabled</span><br><br>Powered by the best Mobile Website Developer on the Envato Marketplaces. Elite Quality. Elite Products.</p>
                <div class="footer-socials">
                    <a href="#" class="round-tiny shadow-medium bg-facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="round-tiny shadow-medium bg-twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="round-tiny shadow-medium bg-phone"><i class="fa fa-phone"></i></a>
                    <a href="#" data-menu="menu-share" class="round-tiny shadow-medium bg-red2-dark"><i class="fa fa-share-alt"></i></a>
                    <a href="#" class="back-to-top round-tiny shadow-medium bg-dark1-light"><i class="fa fa-angle-up"></i></a>
                </div>
                <div class="clear"></div>
                <p class="footer-copyright">Copyright &copy; Enabled <span id="copyright-year">2017</span>. All Rights Reserved.</p>
                <p class="footer-links"><a href="#" class="color-highlight">Privacy Policy</a> | <a href="#" class="color-highlight">Terms and Conditions</a> | <a href="#" class="back-to-top color-highlight"> Back to Top</a></p>
                <div class="clear"></div>
            </div>
        </div>
-->
    <!-- Page Content Class Ends Here-->

         <!-- load footer -->
         <div id="footer-loader"></div>
    </div>
</div>


<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/plugins.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script type="text/javascript" src="scripts/charts.js"></script>
<script type="text/javascript" src="scripts/datapicker.js"></script>
<script>
$('#start').datepicker({ format: 'yyyy-mm-dd'});
$('#end').datepicker({ format: 'yyyy-mm-dd'});
function charts(){
$.ajax({
  url:"php/_charts.php",
  type:"POST",
  data:$("#searchForm").serialize(),
  success:function(res){
    console.log(res);
    $.each(res.data,function(){
      data = {
          datasets: [{
              data: [
                    this.returnd,
                    this.posponded,
                    this.recieved,
                    this.ontheway,
                    this.chan,
                    this.regiserd,
                    this.redy
              ],
              backgroundColor: [
               '#FF0000',
               '#FF9900',
               '#66CC00',
               '#6699FF',
               '#FFFF00',
               '#BBBBBB',
               '#66CCFF'
              ]
          }],

          // These labels appear in the legend and in the tooltips when hovering different arcs
          labels: [
              'الراجعة',
              'المؤجلة',
              'المستلمه',
              'مع المندوب',
              'تغير العنوان',
              'مسجلة',
              'جاهز للارسال',
          ]
      };
    });
    var ctx = document.getElementById('polar-chart').getContext('2d');
    var chart = new Chart(ctx, {
    data: data,
    type: 'polarArea',

});
  },
  error:function(e){
    console.log(e);
  }
});
}
charts();
</script>
</body>
</html>

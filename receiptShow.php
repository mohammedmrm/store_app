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


</head>

<body class="theme-light" data-background="none" data-highlight="red2">
<style type="text/css">

</style>
<div id="page">

     <?php include_once("pre.php");?>
     <?php include_once("top-menu.php");?>
     <?php include_once("bottom-menu.php");?>
     <div class="page-content header-clear-medium">
        <div data-height="100" class="caption shadow-large caption-margins top-10 round-medium shadow-huge">
            <div class="caption-top top-10">
            </div>
            <div class="caption-overlay bg-black opacity-80"></div>
            <div class="caption-bg bg-14"></div>
        </div>
        <div class="content-boxed" >
            <iframe width="100%" height="500" id="receiptIfram">

            </iframe>
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
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/plugins.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script type="text/javascript" src="scripts/getStores.js"></script>
<script type="text/javascript" src="scripts/getCities.js"></script>
<script type="text/javascript" src="scripts/getTowns.js"></script>

<script>

function loadReceipt(){
  $("#receiptIfram").src();
}
</script>
</body>
</html>

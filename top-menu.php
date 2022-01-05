<?php require_once("config.php")?>
<style type="text/css">
a:hover {
    text-underline: none;
}
body * :not(.fa)::not(.fas):not(.la):not(.kt-widget-20__label):not(.kt-widget-19__label):not(.close):not(.check-mark):not(.prev):not(.next) {
  font-family: 'Cairo', sans-serif !important;
}

body {
   background-color: #F0F8FF;
   overflow-x: hidden;
}

body,body * :not([type="tel"]):not(.other):not(td):not(th):not(.datepicker):not(div):not(.hour):not(.prev):not(.next):not(.minute) {
    direction: rtl !important;
    text-align: right ;
}
</style>
<link href="bootstrap-4.3.1-dist/css/bootstrap.min.css" />
<script type="text/javascript" src="scripts/jquery.js"></script>
<script src="bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js"></script>
<div class="header header-fixed header-logo-center">
        <a href="index.php" class="header-title text-center"><?php echo $config['Company_name'];?></a>
		<a href="#" class="back-button header-icon header-icon-1"><i class="fas fa-3x fa-home"></i></a>
		<a href="logout.php" data-toggle-theme-switch class="header-icon header-icon-4 fa-2x">خروج</a>
</div>

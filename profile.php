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
<link rel="apple-touch-icon" sizes="180x180" href="pwa/apple-touch-icon.png">
<link rel="manifest" href="pwa/site.webmanifest">

</head>

<body class="theme-light" data-background="none" data-highlight="orange">
<style type="text/css">
.bg-div1 {
 background-color: #CC0011;
}
.bg-div2 {
 background-color: #CC1122;
}
.bg-div3 {
 background-color: #CC2233;
}
.bg-div4 {
 background-color: #CC3344;
}
.bg-div5 {
 background-color: #CC4455;
}

</style>
<script type="text/javascript" src="scripts/jquery.js"></script>
<div id="page">

     <?php include_once("pre.php");?>
     <?php include_once("top-menu.php");?>
     <?php include_once("footer-menu.php");  ?>

    <div class="page-content header-clear-medium">
        <div data-height="200" class="caption shadow-large caption-margins top-30 round-medium shadow-huge">
            <div class="caption-top top-30">
                <h1 id="head-name" class="center-text color-white bolder fa-2x">الاسم</h1>
            </div>
            <div class="caption-overlay bg-black opacity-80"></div>
            <div class="caption-bg"></div>
        </div>

        <div class="content-boxed" >
            <div class="content">
            <form id="profileForm">
                <h1 class="color-highlight bold text text-center">معلومات العميل</h1>
                <div class="content-box">
                  <span class="text-right">الاسم</span>
                  <input autocomplete="new-password" id="name" name="name" class="form-control" type="name"/>
                  <span class="text-right text-danger" id="name_err"></span>
                 </div>
                <div class="content-box">
                  <span class="text-right">رقم الهاتف</span>
                  <input autocomplete="new-password" id="phone" name="phone" class="form-control"  type="phone"/>
                  <span class="text-right text-danger" id="phone_err"></span>
                </div>
                <div class="content-box">
                  <span class="text-right">البريد الالكتروني</span>
                  <input autocomplete="new-password" id="email" name="email" class="form-control"  type="text"/>
                  <span class="text-right text-danger" id="email_err"></span>
                </div>
                <div class="content-box">
                    <span class="text-right">كلمة السر</span>
                    <input autocomplete="new-password" id="password" name="password" class="form-control"  type="password" />
                    <span class="text-right text-danger" id="password_err"></span>
                </div>
                <div class="content-box">
                    <input onclick="updateProfile()" class="bg-orange-light btn form-control" value="حفظ التغيرات" type="button" />
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
<script type="text/javascript" src="scripts/plugins.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script>
function getProfile(){
  $.ajax({
    url:"php/_getProfile.php",
    success:function(res){
      if(res.success == 1){
        $.each(res.data,function(){
          $('#head-name').text(this.name);
          $('#name').val(this.name);
          $('#email').val(this.email);
          $('#phone').val(this.phone);
        });
      }
      console.log(res);
    },
    error:function(e){
      console.log(e);
    }
  });
}
function updateProfile(){
    $.ajax({
       url:"php/_updateProfile.php",
       type:"POST",
       data:$("#profileForm").serialize(),

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
           $("#name_err").text(res.error["name_err"]);
           $("#email_err").text(res.error["email_err"]);
           $("#phone_err").text(res.error["phone_err"]);
           $("#password_err").text(res.error["password_err"]);

           $('#toast-error').addClass('toast-active');
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

 getProfile();

</script>
<script type="text/javascript" src="scripts/custom.js"></script>
</body>
</html>

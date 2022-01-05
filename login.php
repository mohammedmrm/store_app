<?php require_once("config.php")?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2, viewport-fit=cover" />
    <meta name="description" content="<?php echo $config['Company_name'];?>">
    <meta name="<?php echo $config['Company_name'];?>" property="og:title" content=" <?php echo $config['Company_name'];?>">

    <title><?php echo $config['Company_name'];?></title>
    <link href="https://fonts.googleapis.com/css?family=Cairo:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="styles/framework.css">
    <!--<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">
load header -->
<link rel="apple-touch-icon" sizes="180x180" href="pwa/apple-touch-icon.png">
<link rel="manifest" href="pwa/site.webmanifest">
</head>
<style>
    .div_btn{
        background-color: #f96332;
    }
    
    </style>
<body class="theme-light" data-background="none" data-highlight="red2">

    <div id="page">

        <!-- load main header and footer -->
        <div id="page-preloader">
            <div class="loader-main">
                <div class="preload-spinner border-highlight"></div>
            </div>
        </div>

        <div class="header header-fixed header-logo-center">
            <a href="login.php" class="header-title"><?php echo $config['Company_name'];?></a>
        </div>



        <div class="page-content header-clear-medium">
            <div class="content-boxed left-40 right-40" id="loginDiv">
                <div class="content top-10 bottom-30">
                    <h1 class="center-text bottom-30 ultrabold fa-1x">تسجيل الدخول</h1>
                    <label id="msg" class="text-danger text-right"></label>
                    <div class="input-style has-icon input-style-1 input-required bottom-30">
                        <input type="name" aria-label="user name" style="padding-right: 10px;" id="username" placeholder="رقم الهاتف"/>
                    </div>
                    <div class="input-style has-icon input-style-1 input-required">
                        <input type="password" aria-label="password" style="padding-right: 10px;" id="password" placeholder="كلمة المرور"/>
                    </div>
                    <button onclick="login()" class="button button-full button-xl shadow-huge button-round-small div_btn top-30 bottom-10" style="width: 100%;">تسجيل الدخول</button>
                    <div class="clear">
                        <a href="#" class="text-center font-11 color-theme">نسيت كلمة؟ المرور اتصل بالشركة الرئيسية</a>
                    </div>
                    <div class="clear"></div>


                </div>
            </div>
            <!-- load footer -->
            <div id="footer-loader"></div>
        </div>
        <script type="text/javascript" src="scripts/config.js"></script>
        <script>
            function login() {
                $.ajax({
                    url: apiurl+"/_login.php",
                    type: "POST",
                    data: {
                        username: $("#username").val(),
                        password: $("#password").val()
                    },
                    beforeSend: function() {
                     $("#loginDiv").addClass("loading");
                    },
                    success: function(res) {
                      $("#loginDiv").removeClass("loading");
                        console.log(res);
                        if (res.msg == 1) {
                            sessionStorage.setItem("username",  $("#username").val());
                            sessionStorage.setItem("password",  $("#password").val());
                            window.location.href = "index.php";
                        } else {
                            $("#msg").text(res.msg);
                        }
                    },
                    error: function(e) {
                       $("#loginDiv").removeClass("loading");
                        console.log(e.responseText);
                    }
                });
            }
        </script>
    </div>


    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript" src="scripts/plugins.js"></script>
    <script type="text/javascript" src="scripts/custom.js"></script>
    <script type="text/javascript" src="sw_reg.js"></script>

</body>

</html>
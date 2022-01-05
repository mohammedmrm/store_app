<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2, viewport-fit=cover" />
    <meta name="description" content="في هذه الصفحة الرئيسية لشركة النهر تستطيع ان تتعرف على الطلبيات الخاصة بك الواصة والراجعة والكثير من المعلومات">
    <meta name="الصفحة الرئيسية للعميل" property="og:title" content="معلومات متكاملة للعميل في هذه الصفحة خاصة بعملاء شركة النهر">
    <meta name="description" content="order details is here">



    <title>شركة النهر للحلول البرمجية</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="styles/framework.css">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">
<link rel="apple-touch-icon" sizes="180x180" href="pwa/apple-touch-icon.png">
<link rel="manifest" href="pwa/site.webmanifest">
    <!-- load header -->
    <style type="text/css">
        .timeline-deco {
            width: 5px;
            background-color: #666666;
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
            <input type="hidden" id="order_id" value="<?php echo $_GET['o']?>">

            <div id="order-details" class="text-right"></div>
            <span class="divider"></span>
            <h1 class="text-center">معلومات تتبع الطلبية</h1>
            <div id="orderTimeline" class="timeline-body top-10"></div>
        </div>
    </div>


    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript" src="scripts/plugins.js"></script>
    <script type="text/javascript" src="scripts/custom.js"></script>
    <script type="text/javascript" src="sw_reg.js"></script>
    <script>
        function getorder() {
            $.ajax({
                url: "php/_getOrder.php",
                type: "POST",
                beforeSend: function() {

                },
                data: {
                    id: $("#order_id").val()
                },
                success: function(res) {
                    console.log(res);
                    if (res.success == 1) {
                        $.each(res.data, function() {
                            $("#order-details").append(
                                '<h1 class="text-center right-10">' + this.order_status + '</h1>' +
                                '<h3 class="text-center">' + this.order_no + '</h3>' +
                                '<table style="width:100%;" class="table-striped">' +
                                '</thead><tr><th class="text-right right-10">النص</th><th>القيمة</th></th></thead>' +
                                '<tbody>' +
                                '<tr><td class="text-right right-10">اسم الزبون</td><td>' + this.customer_name + '</td></tr>' +
                                '<tr><td class="text-right right-10">هاتف الزبون</td><td>' + this.customer_phone + '</td></tr>' +
                                '<tr><td class="text-right right-10">اسم المندوب</td><td>' + this.driver_name + '</td></tr>' +
                                '<tr><td class="text-right right-10">رقم هاتف المندوب</td><td>' + this.driver_phone + '</td></tr>' +
                                '<tr><td class="text-right right-10"><br />العنوان<br /></td><td>' + this.city + ' | ' + this.town + '<br />' + this.address + '</td></tr>' +
                                '<tr><td class="text-right right-10">مبلغ الوصل</td><td>' + this.price + '</td></tr>' +
                                '<tr><td class="text-right right-10">المبلغ المستلم</td><td>' + this.new_price + '</td></tr>' +
                                '<tr><td class="text-right right-10">سعر التوصيل</td><td>' + this.dev_price + '</td></tr>' +
                                '<tr><td class="text-right right-10">الخصم</td><td>' + this.discount + '</td></tr>' +
                                '<tr><td class="text-right right-10">المبلغ الصافي</td><td>' + this.client_price + '</td></tr>' +
                                '</tbody>' +
                                '</table>'

                            );
                        });
                    } else {
                        $("#order-details").append(
                            '<h1>خطأ</h1>'
                        );
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }

        function OrderTracking(id) {
            $.ajax({
                url: "php/_getOrderTrack.php",
                data: {
                    id: id
                },
                beforeSend: function() {

                },
                success: function(res) {
                    $("#orderTimeline").html('');
                    $("#orderTimeline").append('<div class="timeline-deco"></div>');
                    console.log(res);
                    if (res.success == 1) {
                        $.each(res.data, function() {
                            address = "";
                            if (this.order_status_id == 1) {
                                icon = "fa-list";
                                color = "blue1-light";
                            } else if (this.order_status_id == 2) {
                                icon = "fa-list";
                                color = "blue1-light";
                            } else if (this.order_status_id == 3) {
                                icon = "fa-vehicle";
                                color = "magenta2-dark";
                            } else if (this.order_status_id == 4) {
                                icon = "fa-hands";
                                color = "green2-dark";
                            } else if (this.order_status_id == 5) {
                                icon = "fa-list";
                                color = "yellow2-dark";
                            } else if (this.order_status_id == 6) {
                                icon = "fa-list";
                                color = "red1-dark";
                            } else if (this.order_status_id == 7) {
                                icon = "fa-list";
                                color = "orange-dark";
                            } else if (this.order_status_id == 8) {
                                icon = "fa-list";
                                color = "blue1-dark";
                                address = "تغير العنوان الى: " + this.new_address;
                            } else {
                                icon = "fa-list";
                                color = "blue1-light";
                            }
                            if (this.note != null) {
                                note = this.note;
                            } else {
                                note = "";
                            }

                            $("#orderTimeline").append(
                                '<div class="timeline-item">' +
                                '<i class="fa ' + icon + ' bg-' + color + ' shadow-large timeline-icon"></i>' +
                                '<div class="timeline-item-content shadow-large round-small">' +
                                '<h5 class="thin color-' + color + ' center-text">' + this.status + '<br />' + this.date + '<br />' + this.hour + '</h5>' +
                                '<p class=" center-text color-theme  bottom-0 font-14">' + note + '</p>' +
                                '<p class="color-' + color + ' center-text color-theme top-5 bottom-0 font-14">عدد القطع: ' + this.items_no + '</p>' +
                                '<p class=" center-text color-theme top-20 bottom-0 font-16">' + address + '</p>' +
                                '</div>' +
                                '</div>'
                            );
                        });
                    } else {
                        $("#orderTimeline").append("<h2>لا يوجد معلومات</h2>")
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }
        OrderTracking($('#order_id').val())

        getorder();
    </script>
</body>

</html>
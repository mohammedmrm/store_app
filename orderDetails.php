<?
include_once("php/_access.php");
access();
include_once("config.php");
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
<link rel="apple-touch-icon" sizes="180x180" href="pwa/apple-touch-icon.png">
<link rel="manifest" href="pwa/site.webmanifest">
<!-- load header -->
<style type="text/css">
.timeline-deco {
width:5px;
background-color:#666666;
}
 .chatbody {
  height: 400px;
  border-bottom:2px solid #D3D3D3;
  border-radius: 1px;
  overflow-y: scroll;
  padding-top:5px;
  width:100%;
  margin-top:10px;
 }
 .msg {
   display: block;
   position: relative;
   margin-bottom:15px;
   padding-bottom:10px;
 }
 .other{
   position: relative;
   margin-left:0px;
   width:80%;
   margin-right:auto;
   text-align: left !important;
 }
 .other .content {
   background-color: #F8F8FF;
   border-top-right-radius: 5px;
   border-bottom-right-radius: 5px;
   text-align: left !important;
 }

 .mine {
   position: relative;
   width:80%;
   margin-right: 2px;
   text-align: right;
 }
 .mine .content {
   background-color: #008B8B;
   color:#F8F8FF;
   border-top-left-radius: 5px;
   border-bottom-left-radius: 5px;
 }

 .content{
   position: relative;
   padding:5px;
   padding-left:15px;
   padding-right:15px;
   min-width:10px;
   max-width:80%;
   font-size: 16px;
   color:#000000;
   margin:0 !important;
   display: inline-block;
 }
.name {
  position: relative;
  display: inline-block;
  font-size:10px;
  margin-bottom:2px;
}
.time {
  display:inline-block;
  position: relative;
  font-size: 10px;
  color: #696969;
  margin-top:2px;
}
.inputs {
  margin-bottom:20px;
}
.chat-btn:hover{
  color: #F8F8FF;
  text-decoration: none;
}

.chat-btn {
  display: block;
  background-color: #F96332;
  color:#F8F8FF;
  text-align: center;
  padding: 2px;
   box-shadow: 0 5px 30px 0 rgba(0,0,0,.11),0 5px 15px 0 rgba(0,0,0,.08)!important;
}
.chat-btn span{
  width: 100%;
  height: 100%;
  display: block;
}

.input-chat-send {
  height: 40px !important;
  border-top-left-radius: 5px !important;
  border-bottom-left-radius: 5px !important;
}
.btn-chat-send {
  height: 40px;
  border-top-right-radius: 5px !important;
  border-bottom-right-radius:5px !important;
}

</style>
<script type="text/javascript" src="scripts/jquery.js"></script>

</head>

<body class="theme-light" data-background="none" data-highlight="red2">

<div id="page">

    <!-- load main header and footer -->
        <?php include_once("pre.php");  ?>
        <?php include_once("top-menu.php");  ?>
        <?php include_once("bottom-menu.php");  ?>

    <div class="page-content header-clear-medium">
         <input type="hidden" id="order_id" value="<?php echo $_GET['o']?>">
         <a href="#" class="btn btn-waring btn-full  chat-btn left-5 right-5 top-5 bottom-5" data-menu="chat" onclick="OrderChat(<?php echo $_GET['o']?>)">
                <span class="left-5 right-5 top-5 bottom-5">محادثه</span>
         </a>
         <div id="order-details" class="text-right"></div>
         <span class="divider"></span>
         <h3 class="text-center">معلومات تتبع الطلبية</h3>
         <div  id="orderTimeline" class="timeline-body top-10"></div>
    </div>
</div>
<div id="chat"
     class="menu  menu-box-bottom menu-box-detached round-medium"
     data-menu-height="600"
     data-menu-effect="menu-over">
        <div class="col-12">
        <div class="col-12">
        <div class="row">
            <div class="col-12 chatbody" id="chatbody">

            </div>
        </div>
        <div class="row"><hr /></div>
          <div class="row">
            <div class="col-12 padding-none">
              <div class="input-group">
                <div class="input-group-append">
                  <button onclick="sendMessage()" class="btn btn-info btn-chat-send" type="button">ارسال</button>
                </div>
                <textarea type="text" id="message" class="form-control input-chat-send" placeholder="اكتب...." aria-label="" aria-describedby="basic-addon2"></textarea>

              </div>
               <input type="hidden"  id="chat_order_id"/>
               <input type="hidden" value="0" id="last_msg"/>
            </div>
          </div>
        </div>
        </div>
</div>
<div class="menu-hider"></div>
<input type="hidden" id="user_id" value="<?php echo $_SESSION['userid'];?>"/>
<input type="hidden" id="user_branch" value="<?php echo $_SESSION['user_details']['branch_id'];?>"/>
<input type="hidden" id="user_role" value="<?php echo $_SESSION['role'];?>"/>
<input type="hidden" value="<?php echo $_GET['notification'];?>" id="notification_seen_id"  />

<script type="text/javascript" src="scripts/plugins.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script>
function getorder(){
$.ajax({
  url:"php/_getOrder.php",
  type:"POST",
  beforeSend:function(){

  },
  data:{id : $("#order_id").val()},
  success:function(res){
   console.log(res);
   if(res.success == 1){
     $.each(res.data,function(){
       $("#order-details").append(
        '<h2 class="text-center right-10">'+this.order_status+'</h2>'+
        '<h3 class="text-center">'+this.store_name+'</h3>'+
        '<h4 class="text-center">'+this.order_no+'</h4>'+
        '<table style="width:100%;" class="table-striped">'+
         '</thead><tr><th class="text-right right-10">النص</th><th>القيمة</th></th></thead>'+
         '<tbody>'+
         '<tr><td class="text-right right-10">اسم الزبون</td><td>'+this.customer_name+'</td></tr>'+
         '<tr><td class="text-right right-10">هاتف الزبون</td><td>'+this.customer_phone+'</td></tr>'+
         '<tr><td class="text-right right-10">اسم المندوب</td><td>'+this.driver_name+'</td></tr>'+
         '<tr><td class="text-right right-10">رقم هاتف المندوب</td><td>'+this.driver_phone+'</td></tr>'+
         '<tr><td class="text-right right-10"><br />العنوان<br /></td><td>'+this.city+' | '+this.town+'<br />'+this.address+'</td></tr>'+
         '<tr><td class="text-right right-10">مبلغ الوصل</td><td>'+this.price+'</td></tr>'+
         '<tr><td class="text-right right-10">المبلغ المستلم</td><td>'+this.new_price+'</td></tr>'+
         '<tr><td class="text-right right-10">سعر التوصيل</td><td>'+this.dev_price+'</td></tr>'+
         '<tr><td class="text-right right-10">الخصم</td><td>'+this.discount+'</td></tr>'+
         '<tr><td class="text-right right-10">المبلغ الصافي</td><td>'+this.client_price+'</td></tr>'+
         '</tbody>'+
        '</table>'

       );
     });
   }else{
       $("#order-details").append(
        '<h1 class="text-danger text-center">لا يوجد معلومات</h1>'
       );
   }
  },
  error:function(e){
   console.log(e);
  }
});
}
function OrderChat(id,last){
  if(id != $("#chat_order_id").val()){
    chat = 1;
    $("#chatbody").html("");
  }else{
    chat = 0;
  }
  $("#chat_order_id").val(id);

  $.ajax({
    url:"php/_getMessages.php",
    type:"POST",
    data:{order_id:$("#chat_order_id").val(),last:last},
    beforeSend:function(){

    },
    success:function(res){
       if(res.success == 1){
         if(res.last <= 0){
             $("#chatbody").html("");
         }
         $.each(res.data,function(){
            clas = 'other';
           if(this.is_client == 1){
                name = this.client_name
                role = "عميل"
               if(this.from_id== $("#user_id").val()){
                 clas = 'mine';
               }
           }else{
               name = this.staff_name
               if(this.from_id == $("#user_id").val() && this.is_client == 1){
                 clas = 'mine';
               }
             role =  this.role_name;
           }
           message =
           "<div class='row'>"+
             "<div class='msg "+clas+"' msq-id='"+this.id+"'>"+
                "<span class='name'>"+name+ " ( "+role+" ) "+"</span><br />"+
                "<span class='content'>"+this.message+"</span><br />"+
                "<span class='time'>"+this.date+"</span><br />"+
             "</div>"+
           "</div>"
           $("#chatbody").append(message);
           $("#last_msg").val(this.id);
           });
           $("#chatbody").animate({ scrollTop: $('#chatbody').prop("scrollHeight")}, 100);
           $("#spiner").remove();
       }
      
    },
    error:function(e){
      console.log(e);
    }
  });
}
function sendMessage(){
  $.ajax({
    url:"php/_sendMessage.php",
    type:"POST",
    data:{message:$("#message").val(), order_id:$("#chat_order_id").val()},
    beforeSend:function(){
      $("#chatbody").append('<div id="spiner" class="spiner"></div>');
    },
    success:function(res){
      OrderChat($("#chat_order_id").val(),$("#last_msg").val());
      $("#chatbody").animate({ scrollTop: $('#chatbody').prop("scrollHeight")}, 100);
      $("#message").val("");
      $("#message").focus();
      console.log(res);
    },
    error:function(e){
      console.log(e);
    }
  });
}
var mychatCaller;
mychatCaller = setInterval(function(){
  OrderChat($("#chat_order_id").val(),$("#last_msg").val());
}, 1000);


function OrderTracking(id){
   $.ajax({
     url:"php/_getOrderTrack.php",
     data:{id: id},
     beforeSend:function(){

     },
     success:function(res){
       $("#orderTimeline").html('');
       $("#orderTimeline").append('<div class="timeline-deco"></div>');
       console.log(res);
     if(res.success == 1){
       $.each(res.data,function(){
         address = "";
         if(this.order_status_id == 1){
             icon = "fa-list";
             color = "blue1-light";
         }else if(this.order_status_id == 2){
             icon = "fa-list";
             color = "blue1-light";
         }else if(this.order_status_id == 3){
             icon = "fa-vehicle";
             color = "magenta2-dark";
         }else if(this.order_status_id == 4){
             icon = "fa-hands";
             color = "green2-dark";
         }else if(this.order_status_id == 5){
             icon = "fa-list";
             color = "yellow2-dark";
         }else if(this.order_status_id == 6){
             icon = "fa-list";
             color = "red1-dark";
         }else if(this.order_status_id == 7){
             icon = "fa-list";
             color = "orange-dark";
         }else if(this.order_status_id == 8){
             icon = "fa-list";
             color = "blue1-dark";
             address = '<p class=" center-text color-theme top-5 bottom-0 font-12">'+ 'تغير العنوان الى: '+this.new_address
              +'</p>' ;
         }else if(this.order_status_id == 9){
             icon = "fa-list";
             color = "brown1-dark";
             9
         }else{
             icon = "fa-list";
             color = "blue1-light";
         }
         if(this.note != null){
           note = this.note;
         }else{
           note = "";
         }

         $("#orderTimeline").append(
           '<div class="timeline-item">'+
				'<i class="fa '+icon+' bg-'+color+' shadow-large timeline-icon"></i>'+
				'<div class="padding-none  timeline-item-content shadow-large round-small">'+
					'<p class="font-14 top-10 thin color-'+color+' center-text">'+this.status+'<br />'+this.date+'<br />'+this.hour+'</p>'+
                    '<p class=" center-text color-theme  bottom-0 font-12">'+note+'</p>'+
                    //'<p class="color-'+color+' center-text color-theme top-5 bottom-0 font-14">عدد القطع: '+this.items_no+'</p>'+
                    ''+address+
				'</div>'+
			'</div>'
         );
        });
       }else{
         $("#orderTimeline").append("<h4 class='text-center text-danger'>لا يوجد معلومات</h4>")
       }
     },
     error:function(e){
       console.log(e);
     }
   });
}
OrderTracking($('#order_id').val())

getorder();

if($("#notification_seen_id").val() > 0){
   $.ajax({
    url:"php/_setNotificationSeen.php",
    type:"POST",
    data:{id:$("#notification_seen_id").val()},
    success:function(res){
       console.log(res);
    }
  });
}
</script>
</body>
</html>

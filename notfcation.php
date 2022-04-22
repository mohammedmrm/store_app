<?php include_once("config.php"); ?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2, viewport-fit=cover" />
  <meta name="description" content="في هذه الصفحة الرئيسية <?php echo $config['Company_name']; ?> تستطيع ان تتعرف على الطلبيات الخاصة بك الواصة والراجعة والكثير من المعلومات">
  <meta name="<?php echo $config['Company_name']; ?>" property="og:title" content="معلومات متكاملة للعميل في هذه الصفحة خاصة بعملاء  <?php echo $config['Company_name']; ?>">

  <title><?php echo $config['Company_name']; ?></title>
  <link href="https://fonts.googleapis.com/css?family=Cairo:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="styles/style.css">
  <link rel="stylesheet" type="text/css" href="styles/framework.css">
  <link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">
  <link rel="apple-touch-icon" sizes="180x180" href="pwa/apple-touch-icon.png">
  <link rel="manifest" href="pwa/site.webmanifest">

</head>

<body class="theme-light" data-background="none" data-highlight="red2">
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

    .unseen {
      background-color: #E6E6FA;
    }

    .active-nav label {
      color: #FFFFFF !important;
    }

    .basket-info {
      padding-bottom: 5px;
    }

    .basket-con {
      background-color: #fff;
      margin: 5px;
      margin-bottom: 15px;
      border-radius: 5px;
      padding: 5px;
      box-shadow: 0px 0px 5px #CCCCCC;
    }
  </style>
  <script type="text/javascript" src="scripts/jquery.js"></script>
  <div id="page">

    <?php include_once("pre.php");  ?>
    <?php include_once("top-menu.php");  ?>
    <?php include_once("bottom-menu.php");  ?>

    <div class="page-content header-clear-medium">
      <!--        <div data-height="100" class="caption shadow-large caption-margins top-30 round-medium shadow-huge">
            <div class="caption-top top-10">
                <h2 class="center-text color-white bolder fa-4x" id="noti-count"></h2>
            </div>
            <div class="caption-overlay bg-black opacity-80"></div>
            <div class="caption-bg bg-14"></div>
        </div>-->
      <div id="baskets">

      </div>


    </div>
  </div>
  <div class="modal fade" id="showItemsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title text-left" id="title"></h5>

        </div>
        <div class="modal-body">
          <div>
            <h3><span>المبلغ: </span><span class="price" id="total_price">0</span></h3>
            <table class="table table-striped" id="tb-items">
              <thead>
                <tr>
                  <th>صوره</th>
                  <th>الاسم</th>
                  <th>حذف</th>
                </tr>
              </thead>
              <tbody id="items">
              </tbody>
            </table>
          </div>
        </div>
        <div id="btns" class="col-12">
        </div>
        <div class="modal-footer text-right">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editBasketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title text-left" id="title"></h5>

        </div>
        <div class="modal-body">
          <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="kt-portlet">
              <form class="kt-form kt-form--label-right" id="editBasketForm">
                <div class="kt-portlet__body">
                  <div class="kt-section kt-section--first">
                    <div class="kt-section__body">
                      <div class="form-group row">
                        <div class="col-lg-6 kt-margin-b-10-tablet-and-mobile">
                          <label>اسم الزبون</label>
                          <input type="text" class="form-control" id="customer_name" name="name" />
                          <span class="form-text text-danger" id="customer_name_err"></span>
                        </div>
                        <div class="col-lg-6 kt-margin-b-10-tablet-and-mobile">
                          <label>رقم هاتف الزبون</label><br />
                          <input type="text" onkeydown="getOldOrder()" class="form-control" id="customer_phone" name="phone" />
                          <span class="form-text text-danger" id="customer_phone_err"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-6 kt-margin-b-10-tablet-and-mobile">
                          <label>المدينة</label>
                          <select data-live-search="true" onchange="getTowns($('#town'),$(this).val());" class=" form-control" id="city" name="city"></select>
                          <span class="form-text text-danger" id="city_err"></span>
                        </div>
                        <div class="col-lg-6 kt-margin-b-10-tablet-and-mobile">
                          <label>القضاء او الناحية او المنطقة</label><br />
                          <select data-live-search="true" class=" form-control" id="town" name="town">
                          </select>
                          <span class="form-text text-danger" id="town_err"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-6 kt-margin-b-10-tablet-and-mobile">
                          <label>تفاصيل العنوان</label>
                          <textarea type="text" class="form-control" id="address" name="address"></textarea>
                          <span class="form-text text-danger" id="address_err"></span>
                        </div>
                        <div class="col-lg-6 kt-margin-b-10-tablet-and-mobile">
                          <label>ملاحظه</label>
                          <textarea type="text" class="form-control" id="note" name="note"></textarea>
                          <span class="form-text text-danger" id="note_err"></span>
                        </div>
                        <input type="hidden" value="0" id="e_basket_id" name="basket">
                      </div>

                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div id="btns" class="col-12">
      </div>
      <div class="modal-footer text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
        <button type="button" class="btn btn-info" onclick="updateBasket()">تحديث</button>
      </div>
    </div>
  </div>
  </div>
  <script type="text/javascript" src="scripts/plugins.js"></script>
  <script type="text/javascript" src="scripts/custom.js"></script>
  <script type="text/javascript" src="sw_reg.js"></script>
  <link href="styles/select2-4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="styles/select2-4.0.13/dist/js/select2.min.js"></script>
  <script>
    function getCities(elem) {
      $.ajax({
        url: apiurl + "_getCities.php",
        type: "POST",
        data: {
          username: sessionStorage.getItem("username"),
          password: sessionStorage.getItem("password")
        },
        success: function(res) {
          elem.html("");
          elem.append(
            '<option value="">... المحافظة ...</option>'
          );
          $.each(res.data, function() {
            elem.append("<option value='" + this.id + "'>" + this.name + "</option>");
          });
          //elem.selectpicker('refresh');
          //console.log(res);
        },
        error: function(e) {
          elem.append("<option value='' class='bg-danger'>خطأ اتصل بمصمم النظام</option>");
          console.log(e);
        }
      });
      return 1;
    }

    const getTowns = function(elem, city) {
      return (
        $.ajax({
          url: apiurl + "_getTowns.php",
          type: "POST",
          data: {
            username: sessionStorage.getItem("username"),
            password: sessionStorage.getItem("password"),
            city: city
          },
          beforeSent: function() {},
          success: function(res) {
            elem.html("");
            $.each(res.data, function() {
              elem.append("<option value='" + this.id + "'>" + this.name + "</option>");
              //elem.selectpicker('refresh');
              //var option = new Option(this.name, this.id, false, false);
              //$("#town").append(option);
            });

            // $("#town").select2({
            //   placeholder: "- اختر المنطقه -",
            //   dropdownParent: $('#createBasketModal')
            // });
          },
          error: function(e) {
            elem.append(
              "<option value='' class='bg-danger'>خطأ اتصل بمصمم النظام</option>"
            );
            console.log(e);
          },
        }))
    }

    function getBaskets() {
      $.ajax({
        url: apiurl + "_getBaskets.php",
        type: "POST",
        data: {
          username: sessionStorage.getItem("username"),
          password: sessionStorage.getItem("password")
        },
        beforeSend: function() {
          $("#baskets").addClass("loading");
        },
        success: function(res) {
          $("#baskets").removeClass("loading");
          $('#baskets').html("");
          console.log(res);
          if (res.code == 300 || res.code == 301) {
            window.location.href = "login.php";
          }
          if (res.success == 1) {
            $.each(res.data, function() {
              btn = '<div class="col-3"><button class="btn btn-icon fa-2x text-success" onclick="showItems(' + this.id + ')" data-toggle="modal" data-target="#showItemsModal"><i class="fa fa-eye"></i></button></div>' +
                '<div class="col-3"><button class="btn btn-icon fa-2x text-info" onclick="sendBasket(' + this.id + ')"><i class="fa fa-paper-plane"></i></button></div>' +
                '<div class="col-3"><button class="btn btn-icon fa-2x text-default" onclick="editBasket(' + this.id + ')" data-toggle="modal" data-target="#editBasketModal"><i class="fa fa-edit"></i></button></div>' +
                '<div class="col-3"><button class="btn btn-icon fa-2x text-danger" onclick="deleteBasket(' + this.id + ')"><i class="fa fa-trash-alt"></i></button></div>';
              if (this.status == 2) {
                btn = '<div class="col-3"><button class="btn btn-icon fa-2x text-success" onclick="showItems(' + this.id + ')" data-toggle="modal" data-target="#showItemsModal"><i class="fa fa-eye"></i></button></div>' +
                  '<div class="col-3"><button class="btn btn-icon fa-2x text-warning" onclick="cancelBasket(' + this.id + ')"><i class="fa fa-undo"></i></button></div>' +
                  '<div class="col-3"><button class="btn btn-icon fa-2x text-default" onclick="editBasket(' + this.id + ')" data-toggle="modal" data-target="#editBasketModal"><i class="fa fa-edit"></i></button></div>' +
                  '<div class="col-3"><button class="btn btn-icon fa-2x text-danger" onclick="deleteBasket(' + this.id + ')"><i class="fa fa-trash-alt"></i></button></div>';

              }
              $("#baskets").append(
                '<div class="basket-con">' +
                '<div class="row">' +
                '<div class="col-12 text-center basket-info">' +
                this.customer_name + ' - ' + this.customer_phone + '<br />' +
                this.city_name + ' ( ' + this.town_name + ' )' +
                '</div>' +
                '</div>' +
                '<div class="row text-center basket-control">' +
                btn +
                '</div>' +
                '</div>'
              );

            });
          }
        },
        error: function(e) {
          $("#baskets").removeClass("loading");
          console.log(e);
        }
      });
    }

    function showItems(id) {
      $.ajax({
        url: apiurl + "_getBasketByID.php",
        type: "POST",
        data: {
          username: sessionStorage.getItem("username"),
          password: sessionStorage.getItem("password"),
          id: id
        },
        beforeSend: function() {
          $("#tb-items").addClass("loading");
        },
        success: function(res) {
          $("#tb-items").removeClass("loading");
          $('#items').html("");
          $('#btn').html("");
          console.log(res);
          if (res.code == 300 || res.code == 301) {
            window.location.href = "login.php";
          }
          if (res.success == 1) {
            $("#total_price").text(res.data.total_price);
            $("#btns").html("");
            if (res.data.status == 1) {
              $("#btns").append(
                `  <div class="input-group input-group-md mb-3">
                <input type="number" min="0" step="250" onchange="updatePrice()" class="form-control" value="0" id="discount" name="discount" aria-label="Small" aria-describedby="search">
                <div class="input-group-prepend">
                  <button type="button" class="input-group-text" onclick="sendBasket2(` + res.data.id + `)" >ارسال <i class="fa fa-send"></i></button>
                </div>
              </div>`
              );
            } else if (res.data.status == 2) {
              $("#btns").append("تم ارسال السله");
            }
            $.each(res.data.items, function() {
              $("#items").append(
                '<tr>' +
                '<td>' +
                '<img src="' + imgurl + this.img + '" height="70px" />' +
                '</td>' +
                '<td>' +
                this.sub_name +
                '</td>' +
                '<td>' +
                '<button class="btn btn-icon text-danger" onclick="deleteItem(' + this.bi_id + ',' + id + ')"><i class="fa fa-trash-alt"></i></button>' +
                '</td>' +
                '</tr>'
              );

            });
          }
        },
        error: function(e) {
          $("#tb-items").removeClass("loading");
          console.log(e);
        }
      });
    }

    function editBasket(id) {
      $("#e_basket_id").val(id);
      $.ajax({
        url: apiurl + "_getBasketByID.php",
        type: "POST",
        data: {
          username: sessionStorage.getItem("username"),
          password: sessionStorage.getItem("password"),
          id: id
        },
        beforeSend: function() {
          $("#tb-items").addClass("loading");
        },
        success: function(res) {
          $("#tb-items").removeClass("loading");
          $('#items').html("");
          $('#btn').html("");
          if (res.code == 300 || res.code == 301) {
            window.location.href = "login.php";
          }
          if (res.success == 1) {
            $("#customer_name").val(res.data.customer_name);
            $("#customer_phone").val(res.data.customer_phone);
            $("#city").val(res.data.city_id)
            getTowns($("#town"), res.data.city_id).then(function() {
              $("#town").val(res.data.town_id);
            });
            $("#address").val(res.data.address);
            $("#note").val(res.data.note);
          }
        },
        error: function(e) {
          $("#tb-items").removeClass("loading");
          console.log(e);
        }
      });
    }

    function updateBasket() {
      $.ajax({
        url: apiurl + "_updateBasket.php",
        type: "POST",
        data: $('#editBasketForm').serialize() +
          '&username=' + sessionStorage.getItem("username") + '&password=' + sessionStorage.getItem("password"),
        beforeSend: function() {
          $("#baskets").addClass("loading");
        },
        success: function(res) {
          $("#baskets").removeClass("loading");
          console.log(res);
          if (res.code == 300 || res.code == 301) {
            window.location.href = "login.php";
          }
          if (res.success == 1) {
            Toast.success("تم التعديل");
            getBaskets();
          } else {
            $("#customer_name_err").text(this.name);
            $("#customer_phone_err").text(this.phone);
            $("#city_err").text(this.city);
            $("#town_err").text(this.town);
            $("#address_err").text(this.address);
            $("#note_err").text(this.note);
            Toast.warning("خطأ", res.error.basket);
          }
        },
        error: function(e) {
          $("#baskets").removeClass("loading");
          console.log(e);
        }
      });

    }

    function updatePrice() {
      total = $("#total_price").val();
      $("#total_price").val((Number(total) - Number($("#discount").val())))
    }

    function sendBasket(id) {
      $.ajax({
        url: apiurl + "_sendBasket.php",
        type: "POST",
        data: {
          username: sessionStorage.getItem("username"),
          password: sessionStorage.getItem("password"),
          id: id
        },
        beforeSend: function() {
          $("#tb-items").addClass("loading");
        },
        success: function(res) {
          $("#tb-items").removeClass("loading");
          console.log(res);
          if (res.code == 300 || res.code == 301) {
            window.location.href = "login.php";
          }
          if (res.success == 1) {
            Toast.success("تم الارسال");
            getBaskets();
          } else {
            Toast.success("خطأ", res.error.id);
          }
        },
        error: function(e) {
          $("#tb-items").removeClass("loading");
          console.log(e);
        }
      });
    }

    function sendBasket2(id) {
      $.ajax({
        url: apiurl + "_sendBasket.php",
        type: "POST",
        data: {
          username: sessionStorage.getItem("username"),
          password: sessionStorage.getItem("password"),
          id: id,
          discount: $("#discount").val()
        },
        beforeSend: function() {
          $("#tb-items").addClass("loading");
        },
        success: function(res) {
          $("#tb-items").removeClass("loading");
          console.log(res);
          if (res.code == 300 || res.code == 301) {
            window.location.href = "login.php";
          }
          if (res.success == 1) {
            Toast.success("تم الارسال");
            getBaskets();
            showItems(id);
          } else {
            Toast.success("خطأ", res.error.id);
          }
        },
        error: function(e) {
          $("#tb-items").removeClass("loading");
          console.log(e);
        }
      });
    }


    function deleteBasket(id) {
      if (confirm("هل انت متاكد من الحذف؟")) {
        $.ajax({
          url: apiurl + "_deleteBasket.php",
          type: "POST",
          data: {
            username: sessionStorage.getItem("username"),
            password: sessionStorage.getItem("password"),
            id: id
          },
          beforeSend: function() {
            $("#tb-items").addClass("loading");
          },
          success: function(res) {
            $("#tb-items").removeClass("loading");
            console.log(res);
            if (res.code == 300 || res.code == 301) {
              window.location.href = "login.php";
            }
            if (res.success == 1) {
              Toast.success("تم الحذف");
              getBaskets();
            } else {
              Toast.success("خطأ", res.error.id);
            }
          },
          error: function(e) {
            $("#tb-items").removeClass("loading");
            console.log(e);
          }
        });
      }
    }

    function cancelBasket(id) {
      $.ajax({
        url: apiurl + "_cancelBasket.php",
        type: "POST",
        data: {
          username: sessionStorage.getItem("username"),
          password: sessionStorage.getItem("password"),
          id: id
        },
        beforeSend: function() {
          $("#tb-items").addClass("loading");
        },
        success: function(res) {
          $("#tb-items").removeClass("loading");
          console.log(res);
          if (res.code == 300 || res.code == 301) {
            window.location.href = "login.php";
          }
          if (res.success == 1) {
            Toast.success("يمكن الان تعديل محتوى السله", "تم الغأ الارسال");
            getBaskets();
          } else {
            Toast.success("خطأ", res.error.id);
          }
        },
        error: function(e) {
          $("#tb-items").removeClass("loading");
          console.log(e);
        }
      });
    }

    function deleteItem(bi_id, id) {
      if (confirm("هل انت متاكد من الحذف؟")) {
        $.ajax({
          url: apiurl + "_deleteItemFromBasket.php",
          type: "POST",
          data: {
            username: sessionStorage.getItem("username"),
            password: sessionStorage.getItem("password"),
            id: bi_id,
            basket: id
          },
          beforeSend: function() {
            $("#tb-items").addClass("loading");
          },
          success: function(res) {
            $("#tb-items").removeClass("loading");
            console.log(res);
            if (res.code == 300 || res.code == 301) {
              window.location.href = "login.php";
            }
            if (res.success == 1) {
              Toast.success("تم الحذف");
              showItems(id)
            } else {
              Toast.success(res.error.id, "خطأ");
            }
          },
          error: function(e) {
            $("#tb-items").removeClass("loading");
            console.log(e);
          }
        });
      }
    }
    $(document).ready(function() {
      getCities($("#city"));
      getBaskets();
    })
  </script>
</body>

</html>
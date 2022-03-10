<?php
include_once("config.php");
?>
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
  <link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/toast.css">
  <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <link rel="apple-touch-icon" sizes="180x180" href="pwa/apple-touch-icon.png">
  <link rel="manifest" href="pwa/site.webmanifest">
</head>
<!--#FF6347;-->

<body class="theme-light" data-background="none" data-highlight="orange">
  <style type="text/css">
    .content-boxed {
      background-color: #fff;
      margin: 10px 5px 10px 5px;
      display: block;
      border-radius: 1px !important;
      box-shadow: 0 4px 24px 0 rgb(0 0 0 / 8%);
      padding: 10px;
      overflow: hidden;
    }

    a:hover {
      text-decoration: none;
    }

    .img {
      position: relative;
      height: 100px;
    }

    .price {
      color: #660000;
      font-size: 14px;
    }

    .modal {
      overflow: auto !important;
    }

    .otherDetails {
      padding-right: 10px;
    }
  </style>
  <script type="text/javascript" src="scripts/config.js"></script>
  <script type="text/javascript" src="scripts/jquery.js"></script>
  <div id="page">

    <?php include_once("pre.php");  ?>
    <?php include_once("top-menu.php");  ?>
    <?php include_once("bottom-menu.php");  ?>

    <div class="page-content header-clear-medium">
      <div class="">
        <div class="row">
          <div class="col-sm-12">
            <div class="content-boxed">
              <div class="input-group input-group-md mb-3">
                <input type="text" class="form-control" id="search" name="search" aria-label="Small" aria-describedby="search">
                <div class="input-group-prepend">
                  <span class="input-group-text" onclick="search(1,1)"><i class="fa fa-search"></i></span>
                </div>
              </div>
              <div class="input-group input-group-md">
                <select type="text" class="form-control" id="cat">
                </select>
                <select class="form-control" id="store" name="search">
                </select>
              </div>
            </div>
          </div>
          <div class="col-sm-12" id="products">
          </div>
          <input id="page" value="1" type="hidden" />
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="productDetails" tabindex="-1" role="dialog" aria-labelledby="productDetails" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title text-left" id="title"></h5>

        </div>
        <div class="modal-body">
          <form id="product_config">
            <div id="proD"></div>
            <div id="proOp"></div>
          </form>
        </div>
        <div class="modal-footer text-right">
          <div id="btns"></div>
          &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="basketsModal" tabindex="-1" role="dialog" aria-labelledby="basketsModal" aria-hidden="true">
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
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>الاسم</th>
                  <th>اضافه</th>
                </tr>
              </thead>
              <tbody id="baskets">
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer text-right">
          <div id="btns"></div>
          &nbsp;&nbsp;&nbsp;
          <input type="hidden" value="0" id="product_id" />
          <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createBasketModal">انشاء سله</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="showItemsModal" tabindex="-1" role="dialog" aria-labelledby="showItemsModal" aria-hidden="true">
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
        <div id="btns2" class="col-12">
        </div>
        <div class="modal-footer text-right">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="createBasketModal" tabindex="-1" role="dialog" data-backdrop="" aria-labelledby="createBasketModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title text-left" id="title"></h5>

        </div>
        <div class="modal-body">
          <!--Begin:: App Content-->
          <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="kt-portlet">
              <form class="kt-form kt-form--label-right" id="addBasketForm">
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
                        <!--<div class="col-lg-6 kt-margin-b-10-tablet-and-mobile">
                          <label>استبدال؟</label><br />
                          <input type="checkbox" onclick="replaceStatus()" value="2" id="replace" name="replace" />
                          <span class="form-text text-danger" id="replace_err"></span>
                        </div>
                        <div style="display: none;" class="col-lg-6 kt-margin-b-10-tablet-and-mobile" id="oldOrderDiv">
                          <label>الطلب السابق</label><br />
                          <select class="selectpicker form-control" id="oldOrders" name="oldOrder">
                            <option>--اختر الطلب--</option>
                          </select>
                          <span class="form-text text-danger" id="oldOrder_err"></span>
                        </div>
                      </div>
                      <span class="form-text text-danger" id="staff_password_err"></span>
                    </div>-->
                      </div>

                    </div>
              </form>
            </div>
          </div>
          <!--End:: App Content-->
        </div>
        <div class="modal-footer text-right">
          <div id="btns"></div>
          <button type="button" onclick="createBasket()" class="btn btn-success">انشاء السلة</button>&nbsp;
          &nbsp;&nbsp;&nbsp;
          <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript" src="scripts/config.js"></script>
  <script type="text/javascript" src="scripts/plugins.js"></script>
  <script type="text/javascript" src="scripts/custom.js"></script>
  <script type="text/javascript" src="sw_reg.js"></script>
  <script type="text/javascript" src="bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js"></script>
  <link href="styles/select2-4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <script src="styles/select2-4.0.13/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    if ('serviceWorker' in navigator) {
      avigator.serviceWorker.register('/sw.js');
    }

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
    }
    getCities($("#city"));

    function getTowns(elem, city) {
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
            //elem.append("<option value='" + this.id + "'>" + this.name + "</option>");
            //elem.selectpicker('refresh');
            var option = new Option(this.name, this.id, false, false);
            $("#town").append(option);
          });

          $("#town").select2({
            placeholder: "- اختر المنطقه -",
            dropdownParent: $('#createBasketModal')
          });
        },
        error: function(e) {
          elem.append(
            "<option value='' class='bg-danger'>خطأ اتصل بمصمم النظام</option>"
          );
          console.log(e);
        },
      });
    }



    function getCategories(elem) {
      $.ajax({
        url: apiurl + "_getCategories.php",
        type: "POST",
        data: {
          username: sessionStorage.getItem("username"),
          password: sessionStorage.getItem("password")
        },
        success: function(res) {
          console.log(res);
          elem.html("");
          elem.append(
            '<option value="">... التصنيف ...</option>'
          );
          $.each(res.data, function() {
            elem.append("<option value='" + this.id + "'>" + this.title + "</option>");
          });
          //elem.selectpicker('refresh');
          //console.log(res);
        },
        error: function(e) {
          elem.append("<option value='' class='bg-danger'>خطأ اتصل بمصمم النظام</option>");
          console.log(e);
        }
      });
    }
    getCategories($("#cat"));

    function getStores(elem) {
      $.ajax({
        url: apiurl + "_getStores.php",
        type: "POST",
        data: {
          username: sessionStorage.getItem("username"),
          password: sessionStorage.getItem("password")
        },
        success: function(res) {
          console.log(res);
          elem.html("");
          elem.append(
            '<option value="">... السوق ...</option>'
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
    }
    getStores($("#store"));

    function search(type = 1, page = 1) {
      $.ajax({
        url: apiurl + "/_products.php",
        type: "POST",
        data: {
          username: sessionStorage.getItem("username"),
          password: sessionStorage.getItem("password"),
          page: page,
          search: $("#search").val(),
          category: $("#cat").val(),
          store: $("#store").val()
        },
        beforeSend: function() {
          if (type == 1) {
            $("#products").addClass("loading");
          }
        },
        success: function(res) {
          $("#products").removeClass("loading");
          if (type == 1) {
            $("#products").html("");
          }
          console.log(res);
          if (res.code == 300 || res.code == 301) {
            window.location.href = "login.php";
          }
          $.each(res.data, function() {
            $("#products").append(
              '<div class="content-boxed">' +
              '<a href="#"  onclick="showProduct(' + this.id + ')" data-toggle="modal" data-target="#productDetails">' +
              '<div class="content  list-columns-right" style="margin:0 !important;" >' +
              '<div class="row" >' +
              '<div class="col-3" >' +
              '<img style="height:100%;position:relative; padding:0;margin:0 !important;" src="' + imgurl + this.img + '">' +
              '</div>' +
              '<div class="col-9 otherDetails">' +
              '<h5 class="text-center">' + this.name + '</h5>' +
              '<span class="text-right price"> &nbsp;السعر:&nbsp;' + this.price + '</span>' +
              '<p class=" text-center text-white">' +
              this.des +
              '</p>' +

              '</div>' +
              '</div>' +
              '</div>' +
              '</a>' +
              '</div>'
            );
          });
        },
        error: function(e) {
          $("#products").removeClass("loading");
          console.log(e);
        }
      });
    }
    search();
    $(window).scroll(function() {
      if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
        page = Number($("#page").val());
        search(2, (page + 1));
        $("#page").val((page + 1));
        window.scrollTo(0, $(window).scrollTop());
      }
    });

    function showProduct(id) {
      $.ajax({
        url: apiurl + "/_product.php",
        type: "POST",
        data: {
          username: sessionStorage.getItem("username"),
          password: sessionStorage.getItem("password"),
          id: id
        },
        beforeSend: function() {
          $("#proD").addClass("loading");
        },
        success: function(res) {
          $("#proD").removeClass("loading");
          $('#proOp').html("");
          $('#proD').html("");
          //$('#btns').html("");
          console.log(res);
          if (res.code == 300 || res.code == 301) {
            window.location.href = "login.php";
          }
          if (res.success == 1) {
            $("#title").text(res.data[0].name);
            $.each(res.data, function() {
              if (this.type == 2) {
                $.each(this.attribute, function() {
                  attr = '<span>' + this.name + ':</span>';
                  attr += '<select name="option[]" class="form-control">';
                  attr += '<option value="">--</option>';
                  $.each(this.config, function() {
                    attr += '<option value="' + this.id + '">' + this.value + '</option>';
                  });
                  attr += '</select>';
                  $('#proOp').append(attr);
                });
              }
              $.each(this.images, function() {
                imgs = "<div class='col-sm-6'> <img class='img' src='" + imgurl + this.path + "'/></div>";
              });

              $("#proD").append(imgs + '<h3>السعر: ' + this.price + '</h3><h5>الوصف:</h5>' + '<p>' + this.simple_des + '</p>');
            });
            $("#btns").append('<button type="button" class="btn btn-warning" onclick="updateProId(' + id + ');getBaskets()" data-toggle="modal" data-target="#basketsModal">اضافه للسله</button> ')
          }
        },
        error: function(e) {
          $("#proD").removeClass("loading");
          console.log(e);
        }
      });
    }

    function updateProId(id) {
      $("#product_id").val(id);
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
              $("#baskets").append(
                '<tr><td><b>' +
                this.customer_name + '</b><br />' + this.customer_phone + '-' + this.city_name + " (" + this.town_name + ")<br />" +
                '</td>' +
                '<td>' +
                '<button class="btn btn-icon fa-2x text-success" onclick="addToBasket(' + this.id + ',' + $("#product_id").val() + ')">' +
                '<i class="fa fa-cart-plus fa-2x"></i>' +
                '</button>' +
                '<button class="btn btn-icon fa-2x text-info" onclick="showItems(' + this.id + ')" data-toggle="modal" data-target="#showItemsModal">' +
                '<i class="fa fa-eye fa-2x"></i>' +
                '</button>' +
                '</tr></td>'
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

    function addToBasket(bi_id, pro_id) {
      $.ajax({
        url: apiurl + "_addToBasket.php",
        type: "POST",
        data: $("#product_config").serialize() + '&basket=' + bi_id + '&product_id=' + pro_id +
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
            Toast.success("تم الاضافه");
          } else {
            Toast.warning("يرجي اختيار جميع الموصفات قبل الاضافه");
          }
        },
        error: function(e) {
          Toast.error("يرجي اختيار جميع الموصفات قبل الاضافه");
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
          $('#btns2').html("");
          console.log(res);
          if (res.code == 300 || res.code == 301) {
            window.location.href = "login.php";
          }
          if (res.success == 1) {
            $("#total_price").text(res.data.total_price);
            $("#btns2").html("");
            if (res.data.status == 1 || res.data.status == "1") {
              $("#btns2").append(
                `<div class="input-group input-group-md mb-3">
                <input type="number" min="0" step="250" onkeyup="updatePrice(${res.data.total_price})" class="form-control" value="0" id="discount" name="discount" aria-label="Small" aria-describedby="search">
                <div class="input-group-prepend">
                  <button type="button" class="input-group-text" onclick="sendBasket2(` + res.data.id + `)" >ارسال <i class="fa fa-send"></i></button>
                </div>
              </div>`
              );
            } else if (res.data.status == 2) {
              $("#btns2").append("تم ارسال السله");
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

    function updatePrice(total) {
      $("#total_price").text((Number(total) - Number($("#discount").val())));
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


    function createBasket() {
      $.ajax({
        url: apiurl + "_createBasket.php",
        type: "POST",
        data: $('#addBasketForm').serialize() +
          '&username=' + sessionStorage.getItem("username") + '&password=' + sessionStorage.getItem("password"),
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
            getBaskets();
            $('#createBasketModal').modal('hide');
            $("#customer_name").val("");
            $("#customer_phone").val("");
            $("#address").val("");
            //$("#city").val("");
            $("#note").val("");
            $('#customer_name_err').text('');
            $('#customer_phone_err').text('');
            $('#city_err').text('');
            $('#address_err').text('');
            $('#town_err').text('');
            $('#note_err').text('');
            $('#type_err').text('');
            Toast.success("تم انشاء السله");
          } else {
            $('#customer_name_err').text(res.error.name);
            $('#customer_phone_err').text(res.error.phone);
            $('#city_err').text(res.error.city);
            $('#address_err').text(res.error.address);
            $('#town_err').text(res.error.town);
            $('#note_err').text(res.error.note);
            $('#type_err').text(res.error.type);
          }
        },
        error: function(e) {
          $("#baskets").removeClass("loading");
          console.log(e);
        }
      });
    }
  </script>
  <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
  <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-messaging.js"></script>

  <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
  <!--<script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-analytics.js"></script>
-->
  <!-- Add Firebase products that you want to use -->
  <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-firestore.js"></script>
  <script>
    $('img').on('error', function() {
      this.src = 'img/default.svg';
    });
  </script>
</body>

</html>
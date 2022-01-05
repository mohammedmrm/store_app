<?php
ob_start();
session_start();
error_reporting(0);
require_once("_access.php");
access([1,2,3,5]);
require_once("dbconnection.php");

require_once("../config.php");
$style= '
<style>
  .title {
    background-color: #FFFACD;
  }
  .head-tr {
   background-color: #ddd;
   color:#111;
  }
  .col-50 {
      position: relative;
      display: inline-block;
      width:180px;
  }
  .client {
        position: relative;
      display: inline-block;
      width:180px;
  }
  .albarq {
    color :red;

  }
</style>';
$client_id = $_SESSION['userid'];
$store_id = $_REQUEST['store'];
$id = $_REQUEST['date'];
$type= $_REQUEST['type'];
$number= $_REQUEST['number'];
$date= $_REQUEST['date'];
$msg="";

$ids = [];
$sql = "select max(qty) as qty,id from receipt where store_id=?";
$res1 = getData($con,$sql,[$store_id]);

$sql = "select count(*) as count from orders where store_id=? and client_id=? and confirm=?" ;
$res2 = getData($con,$sql,[$store_id,$client_id,2]);


///-- validate user request
if($type == 1 || $type == 2) {
  if(empty($store_id) || empty($number)){
    $msg ="بجب ملئ جميع الحقول";
  }else{
    if($res2[0]['count'] >= $number){
      $msg ="";
    }else{
      if(($res2[0]['count'] + $res1[0]['qty']) >= $number){
        $msg ="";
      }else{
        $msg ="ليس لديك عدد وصولات كافي الوصولات المتوفره - " .($res2[0]['count'] + $res1[0]['qty']);
      }
    }
  }
}else if($type == 3){
 if(empty($store_id) || empty($date)){
    $msg ="*بجب ملئ جميع الحقول";
  }else{
     $msg ="";
  }
}else{
  $msg ="يجب تحديد الوصولات المطلوبه";
}

///-- add required empty receipt
if($msg == ""){
 if($res2[0]['count'] >= $number){
   $msg == "";
 }else{
    $required =  $number -  $res2[0]['count'];
    $sql = "select max(order_no) as max FROM orders";
    $res3 = getData($con,$sql);
    $order_no = (int) $res3[0]['max'];
    for ($x = 1; $x <= $required; $x++) {
       $sql = "insert into orders (client_id,store_id,order_no,confirm) values (?,?,?,?)";
       $res4 = setData($con,$sql,[$client_id,$store_id,$order_no + $x,2]);
    }
    if($res4 > 0){
        $sql = "update receipt set qty = qty - ? where id=?";
        $res5 = setData($con,$sql,[$required,$res1[0]['id']]);
    }
 }
}


require_once("../tcpdf/tcpdf.php");

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('07822816693');
$pdf->SetTitle('وصل');
$pdf->SetSubject('Receipt');
// set some language dependent data:


if($msg== ""){
  try{
  if($type == 1 || $type == 2 ){
  $query = "select orders.*, date_format(orders.date,'%y-%m-%d') as date,
              clients.name as client_name,clients.phone as client_phone,
              cites.name as city,towns.name as town,branches.name as branch_name,
              stores.name as store_name
              from orders
              left join clients on clients.id = orders.client_id
              left join cites on  cites.id = orders.to_city
              left join stores on  stores.id = orders.store_id
              left join towns on  towns.id = orders.to_town
              left join branches on  branches.id = orders.to_branch
              where orders.confirm = 2 and orders.store_id=? and orders.client_id=? limit ".$number;

        $dataa = getData($con,$query,[$store_id,$client_id]);

        $success="1";
foreach ($dataa as $K=>$data){
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'ar';
        $lg['w_page'] = 'page';

      // set some language-dependent strings (optional)
      $pdf->setLanguageArray($lg);
      // set font
      $pdf->SetFont('aealarabiya', '', 12);

      // set default header data
      $pdf->SetHeaderData("../../../".$config['Company_logo'],30,"");

      // set header and footer fonts
      $pdf->setHeaderFont(Array('aealarabiya', '', 12));
      //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


      // set margins
      $pdf->SetMargins(10, 30,10, 10);
      $pdf->SetHeaderMargin(5);
      //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      // set auto page breaks
      $pdf->SetAutoPageBreak(TRUE, 5);

      // set image scale factor
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // add a page
      $pdf->AddPage('P', 'A5');

        // Persian and English content
      $tbl = '
        <table  cellpadding="5">
            <tr>
            <td width="209">اسم السوق : '.$data['store_name'].'</td>
            <td width="209">هاتف : '.$data['client_phone'].'</td>
          </tr>
          <tr>
            <td width="209" >رقم الوصل : '.$data['order_no'].'</td>
            <td width="209">تاريخ : '.'   &nbsp;&nbsp; -   &nbsp;&nbsp;  -  &nbsp;&nbsp; 20'.'</td>
          </tr>
        </table>
        <br />
        <table  border="1" cellpadding="5">
            <tr>
            <td width="153" class="title">اسم الزبون</td>
            <td align="center" width="300"></td>
          </tr>
          <tr>
            <td width="153" class="title">هاتف الزبون</td>
            <td align="center" width="300"></td>
          </tr>
        </table>
        <br /><br />
        <table cellpadding="2" border="1">
            <tr>
                <td  align="center" class="title">العنوان</td>
            </tr>
            <tr>
                <td colspan="1" height="60" align="center"></td>
            </tr>
        </table>
        <br /><br />
        <table  border="1" cellpadding="5">
          <tr>
            <td colspan="6" class="title" align="center">تفاصيل الطلب</td>
          </tr>
          <tr>
            <td colspan="1"  class="title">النوع</td>
            <td colspan="1" align="center" ></td>
            <td colspan="1"  class="title">الوزن</td>
            <td colspan="1" align="center" ></td>
            <td colspan="1" class="title">العدد</td>
            <td colspan="1" align="center" ></td>
          </tr>
          <tr>
            <td colspan="1" class="title">ملاحظات</td>
            <td colspan="5" align="center" ></td>
          </tr>
          <tr>
            <td colspan="2"  class="title">المبلغ مع التوصيل</td>
            <td colspan="4" align="center"></td>
          </tr>
        </table>
        ';
        $comp = "
        <span>ﺍﻟﺸﺮﻛﻪ ﻣﺴﺠﻠﻪ ﻗﺎﻧﻮﻧﻴﺎ/ ﺭﻗﻢ ﺍﻟﺘﺴﺠﻴﻞ: ﻡ.ﺵ.ﺃ - 20 - 8807 &nbsp;&nbsp;&nbsp; ﺍﻟﺸﺮﻛﻪ ﻣﺴﺆﻭﻟﻪ ﻋﻦ ﺗﻮﺻﻴﻞ ﺍﻟﻄﻠﺒﺎﺕ ﻓﻘﻂ</span>
        <br /> <br />
        <span>ﺷﺮﻛﺔ ﺍﻟﺒﺮﻕ ﻟﻠﺘﻮﺻﻴﻞ ﺍﻟﺴﺮﻳﻊ, ﺍﻟﻔﺮﻉ ﺍﻟﺮﺋﻴﺴﻲ : ﺑﻐﺪﺍﺩ - ﺍﻟﻤﻨﺼﻮﺭ- ﺣﻲ ﺍﻟﻌﺮﺑﻲ </span>
        <span>078-780-0898 / 077-789-8898</span>
        <br />
        <span>فرع كركوك - فرع ديالى - فرع بابل - فرع كربلاء - فرع واسط - فرع ذي قار - فرع اربيل - فرع صلاح الدين - فرع الموصل</span>
        <br /><br />
        <span>* يسقط حق المطالبة بالوصال بعد مرور شهر من تاريخ الوصل </span>
        ";
        $pdf->writeHTML($style.$tbl, true, false, false, false, '');

        $pdf->cell('','','توقيع العميل','');
        $pdf->Ln();
        $pdf->SetFont('aealarabiya', '', 10);
        $pdf->setRTL(true);

        $pdf->SetFontSize(10);
        // print newline
        $style2 = array(
            'position' => 'L',
            'align' => 'L',
            'stretch' => false,
            'fitwidth' => false,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => "",
            'text' => true,
            'label' => $ids[$k],
            'font' => 'helvetica',
            'fontsize' => 12,
            'stretchtext' => 1
        );
        // CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
        $pdf->write1DBarcode($data['id'], 'S25+', 0, '', 60, 20, 0.4, $style2, 'N');
        $pdf->SetTextColor(25,25,112);
        $pdf->SetFont('aealarabiya', '', 9);

        $pdf->writeHTML("<hr>".$comp, true, false, false, false, '');
        $pdf->SetTextColor(55,55,55);
        $pdf->setRTL(false);
        $pdf->SetFont('aealarabiya', '', 9);
        $del = "<br /><hr />Developed and Designed by <a href='http://alnahr.net/'>Ahal Adeqa</a> Company for IT Solutions <br /> 07822816693 , itpcentre@gamil.com, www.alnahr.net";
        $pdf->writeHTML($del, true, false, false, false, '');
        $pdf->write2DBarcode($data['id'], 'QRCODE,M',0, 0, 30, 30, $style2, 'N');
        $style2['position'] = '';
        $pdf->write2DBarcode($data['id'], 'QRCODE,M',70, 130, 30, 30, $style2, 'N');
  }

  }
  if($type == 1 || $type == 3){
    $query = "select orders.*, date_format(orders.date,'%y-%m-%d') as date,
              clients.name as client_name,clients.phone as client_phone,
              cites.name as city,towns.name as town,branches.name as branch_name,
              stores.name as store_name
              from orders
              left join clients on clients.id = orders.client_id
              left join cites on  cites.id = orders.to_city
              left join stores on  stores.id = orders.store_id
              left join towns on  towns.id = orders.to_town
              left join branches on  branches.id = orders.to_branch
              where orders.confirm <> 2 and orders.store_id=? and orders.client_id=? and date(orders.date) = ? ";

        $dataa = getData($con,$query,[$store_id,$client_id,$date]);
        $success="1";
    foreach ($dataa as $K=>$data){
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'ar';
        $lg['w_page'] = 'page';

      // set some language-dependent strings (optional)
      $pdf->setLanguageArray($lg);
      // set font
      $pdf->SetFont('aealarabiya', '', 12);

      // set default header data
      $pdf->SetHeaderData("../../../".$config['Company_logo'],30,"");

      // set header and footer fonts
      $pdf->setHeaderFont(Array('aealarabiya', '', 12));
      //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


      // set margins
      $pdf->SetMargins(10, 30,10, 10);
      $pdf->SetHeaderMargin(5);
      //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      // set auto page breaks
      $pdf->SetAutoPageBreak(TRUE, 5);

      // set image scale factor
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // add a page
      $pdf->AddPage('P', 'A5');

        // Persian and English content
      $tbl = '
        <table  cellpadding="5">
            <tr>
            <td width="209">اسم السوق : '.$data['store_name'].'</td>
            <td width="209">هاتف : '.$data['client_phone'].'</td>
          </tr>
          <tr>
            <td width="209" >رقم الوصل : '.$data['order_no'].'</td>
            <td width="209">تاريخ : '.$data['date'].'</td>
          </tr>
        </table>
        <br />
        <table  border="1" cellpadding="5">
            <tr>
            <td width="153" class="title">اسم الزبون</td>
            <td align="center" width="300">'.$data['customer_name'].'</td>
          </tr>
          <tr>
            <td width="153" class="title">هاتف الزبون</td>
            <td align="center" width="300">'.$data['customer_phone'].'</td>
          </tr>
        </table>
        <br /><br />
        <table cellpadding="2" border="1">
            <tr>
                <td  align="center" class="title">العنوان</td>
            </tr>
            <tr>
                <td colspan="1" height="60" align="center">
                 '.$data['city'].' - '.$data['town'].' - '.$data['address'].'
                </td>
            </tr>
        </table>
        <br /><br />
        <table  border="1" cellpadding="5">
          <tr>
            <td colspan="6" class="title" align="center">تفاصيل الطلب</td>
          </tr>
          <tr>
            <td colspan="1"  class="title">النوع</td>
            <td colspan="1" align="center" >'.$data['order_type'].'</td>
            <td colspan="1"  class="title">الوزن</td>
            <td colspan="1" align="center" >'.$data['weight'].'</td>
            <td colspan="1" class="title">العدد</td>
            <td colspan="1" align="center" >'.$data['qty'].'</td>
          </tr>
          <tr>
            <td colspan="1" class="title">ملاحظات</td>
            <td colspan="5" align="center" >'.$data['note'].'</td>
          </tr>
          <tr>
            <td colspan="2"  class="title">المبلغ مع التوصيل</td>
            <td colspan="4" align="center">'.$data['price'].'</td>
          </tr>
        </table>
        ';
        $comp = "
        <span>ﺍﻟﺸﺮﻛﻪ ﻣﺴﺠﻠﻪ ﻗﺎﻧﻮﻧﻴﺎ/ ﺭﻗﻢ ﺍﻟﺘﺴﺠﻴﻞ: ﻡ.ﺵ.ﺃ - 20 - 8807 &nbsp;&nbsp;&nbsp; ﺍﻟﺸﺮﻛﻪ ﻣﺴﺆﻭﻟﻪ ﻋﻦ ﺗﻮﺻﻴﻞ ﺍﻟﻄﻠﺒﺎﺕ ﻓﻘﻂ</span>
        <br /> <br />
        <span>ﺷﺮﻛﺔ ﺍﻟﺒﺮﻕ ﻟﻠﺘﻮﺻﻴﻞ ﺍﻟﺴﺮﻳﻊ, ﺍﻟﻔﺮﻉ ﺍﻟﺮﺋﻴﺴﻲ : ﺑﻐﺪﺍﺩ - ﺍﻟﻤﻨﺼﻮﺭ- ﺣﻲ ﺍﻟﻌﺮﺑﻲ </span>
        <span>078-780-0898 / 077-789-8898</span>
        <br />
        <span>فرع كركوك - فرع ديالى - فرع بابل - فرع كربلاء - فرع واسط - فرع ذي قار - فرع اربيل - فرع صلاح الدين - فرع الموصل</span>
        <br /><br />
        <span>* يسقط حق المطالبة بالوصال بعد مرور شهر من تاريخ الوصل </span>
        ";
        $pdf->writeHTML($style.$tbl, true, false, false, false, '');

        $pdf->cell('','','توقيع العميل','');
        $pdf->Ln();
        $pdf->SetFont('aealarabiya', '', 10);
        $pdf->setRTL(true);

        $pdf->SetFontSize(10);
        // print newline
        $style2 = array(
            'position' => 'L',
            'align' => 'L',
            'stretch' => false,
            'fitwidth' => false,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => "",
            'text' => true,
            'label' => $ids[$k],
            'font' => 'helvetica',
            'fontsize' => 12,
            'stretchtext' => 1
        );
        // CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
        $pdf->write1DBarcode($data['id'], 'S25+', 0, '', 60, 20, 0.4, $style2, 'N');
        $pdf->SetTextColor(25,25,112);
        $pdf->SetFont('aealarabiya', '', 9);

        $pdf->writeHTML("<hr>".$comp, true, false, false, false, '');
        $pdf->SetTextColor(55,55,55);
        $pdf->setRTL(false);
        $pdf->SetFont('aealarabiya', '', 9);
        $del = "<br /><hr />Developed and Designed by <a href='http://alnahr.net/'>Ahal Adeqa</a> Company for IT Solutions <br /> 07822816693 , itpcentre@gamil.com, www.alnahr.net";
        $pdf->writeHTML($del, true, false, false, false, '');
        $pdf->write2DBarcode($data['id'], 'QRCODE,M',0, 0, 30, 30, $style2, 'N');
        $style2['position'] = '';
        $pdf->write2DBarcode($data['id'], 'QRCODE,M',70, 130, 30, 30, $style2, 'N');
   }
 }


  } catch(PDOException $ex) {
    $dataa=["error"=>$ex];
     $success="0";

  }
  //print_r($dataa);
 ob_end_clean();
 //print_r($dataa);
 $pdf->Output('order'.date('Y-m-d h:i:s').'.pdf', 'I');
}else{
 echo '<h1 style="text-align: left; color:red;"><center>'.$msg.'</center></h1>';
}
//echo json_encode(['num'=>$count,'success'=>$success]);
?>
<?php
if(!isset($_SESSION)){
 session_start();
}
//die(json_encode(['message'=>"Access Deny"]));
error_reporting(0);
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$token = $_REQUEST['token'];
require_once("../php/dbconnection.php");
if(!empty($token)){
  $sql = 'select * from clients where api_token=?';
  $loginres  = getData($con,$sql,[$token]);
  if(count($loginres) == 1){
     $msg = 1;
     $code = 200;
     $userid = $loginres[0]['id'];
     $showearnings =  $loginres[0]['show_earnings'];
  }else{
     $msg ="incorrect username or password";
     $code = 300;
  }
 }else if(!empty($password) && !empty($username)){
  $sql = 'select * from clients where phone=?';
  $loginres  = getData($con,$sql,[$username]);
  if(count($loginres) == 1 && password_verify($password,$loginres[0]['password'])){
     $msg = 1;
     $code = 200;
     $userid = $loginres[0]['id'];
     $head_company_id= $loginres[0]['company_id'];
     $showearnings =  $loginres[0]['show_earnings'];
     $userrole= $loginres[0]['role_id'];
  }else{
     $msg ="incorrect username or password";
     $code = 300;
  }
}else{
     $msg ="username and password required";
     $code = 301;
}

function access(){
  if($GLOBALS['msg']!=1){
     die(json_encode(['message'=>$GLOBALS['msg'],'code'=>$GLOBALS['code']]));
  }
}
?>
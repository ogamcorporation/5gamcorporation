<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/inc/function.php";

$state = $_GET['state'];
$redirect_uri = $_GET['redirect_uri'];
$code = '1122330'; // 코드

filelog('SSO_Login',"#shop_id : ".$_SESSION['shop_id']); // 파일로그 남기기

$aRequestData = array(
    'code'         => $code,
    'state'         => $state
);
$sUrl = $redirect_uri ."?". http_build_query($aRequestData);

header('Location: ' . $sUrl);
exit;


/*
$state = $_GET['state'];
$redirect_uri = $_GET['redirect_uri'];
$code = "AUTHORIZECODE"; // 코드

$aRequestData = array(
    'code'         => $code,
    'state'         => $state,
);
$sUrl = $redirect_uri ."?". http_build_query($aRequestData);

header('Location: ' . $sUrl);
exit;
*/
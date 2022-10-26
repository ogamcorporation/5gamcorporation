<?
/*
$access_token = "ACCESSCODE"; // Access Token 생성
$result = array(
    "access_token" => $access_token
);

$result = json_encode($result);
exit($result); // Access Token
*/


include_once $_SERVER['DOCUMENT_ROOT']."/inc/function.php";

//$jsonData = file_get_contents('php://input', true);
//$data = $jsonData;
//filelog('SSO_Login',"#002 : ".$data); // 파일로그 남기기 #01
//filelog('SSO_Login',"#0021 : ".$_SESSION['access_token']); // 파일로그 남기기

$code = $_POST['code']; // 코드
$result = array("access_token" => $code);
$result = json_encode($result);

//filelog('SSO_Login',"#002-1 : ".$result); // 파일로그 남기기 #01

exit($result);

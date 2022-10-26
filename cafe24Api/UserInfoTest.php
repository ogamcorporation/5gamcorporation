<?
/*
$result = array(
    "id" => "1122330",
    "name" => "오감테스트",
    "email" => "shine1324@gmail.com"
);
$result = json_encode($result);
exit($result); // 사용자 정보
*/

include_once $_SERVER['DOCUMENT_ROOT']."/inc/function.php";
include_once $_SERVER['DOCUMENT_ROOT']."/inc/ClassPDO.php";

$ip = $_SERVER['REMOTE_ADDR'];
$sql = "select request_id from cafe24_sso_id order by request_ip='".$ip."' limit 1";
$ret = $NDO->prepare($sql);
$ret->execute();
$rst = $ret->fetch(PDO::FETCH_ASSOC);
$user_id = $rst['request_id'];


$pleaApiDomain = "https://idollive-igms-community.devcloud.idolplus.com";
$userInfoUrl = "/user/api/v1.0/account/status";
$url = $pleaApiDomain.$userInfoUrl."?lang=en&sa_id=".$user_id;

// 회원정보조회
$userInfo=plea_curl_call($url);
if($userInfo['code']=="3A001004") {
    $name = "TEST_" . $user_id;
    $email = '';
}else{
    $name = $userInfo['data']['user_name'] ? $userInfo['data']['user_name'] : '';
    $email = $userInfo['data']['user_email'] ? $userInfo['data']['user_email'] : '';

    if(!$name && !$email) $name = "TEST_" . $user_id;
}

$result = array(
    "id" => $user_id,
    "name" => $name,
    "email" => $email
);
$result = json_encode($result);


exit($result);
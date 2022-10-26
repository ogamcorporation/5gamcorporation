<?php
include_once "./inc/inc.php";
include_once "./inc/frontSubNavi.php";

$shop_no = $_POST['shop_no'] ? $_POST['shop_no'] : 1;
$script_no = $_POST['script_no'];

if (!$script_no) {
    exit('스크립트 번호 없음');
}


$sEndPointUrl = "https://" . $_SESSION['mall_id'] . ".cafe24api.com/api/v2/admin/scripttags/" . $script_no;
debug($sEndPointUrl);
// 시작
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $sEndPointUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'DELETE',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $_SESSION['access_token'],
        'Content-Type: application/json',
        'X-Cafe24-Api-Version: 2022-09-01'
    ),
));
$response_org = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);


$response = json_decode($response_org, true);
filelog('script_tags_Delete', $http_code . " : " . $sEndPointUrl); // 파일로그 남기기 #01


$err = curl_error($curl);
if ($err) {
    filelog('script_tags_Delete', $err); // 실패 파일로그 남기기 #02
    echo 'cURL Error #:' . $err;
}
// 종료


debug($data);
debug("Response");
debug($response);
//echo "<script>location.href='dummyProductList.php';</script>";
echo "
    <a href='front_api.php?shop_no=" . $shop_no . "';>Front API</a>
";


exit;
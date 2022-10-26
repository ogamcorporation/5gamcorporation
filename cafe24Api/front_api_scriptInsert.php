<?php
include_once $_SERVER['DOCUMENT_ROOT']."/inc/inc.php";
include_once $_SERVER['DOCUMENT_ROOT']."/inc/dummyNavi.php";

$script_tag = $_POST['script_tag'];

if(!$script_tag){
    
    exit('파일명 없음');
}

$data = '{
    "shop_no": 1,
    "request": {
        "src": "'.$script_tag.'",
        "display_location": ["ALL"],
        "skin_no": [4]
    }
}';


$sEndPointUrl = "https://".$_SESSION['mall_id'].".cafe24api.com/api/v2/admin/scripttags";

// 시작
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $sEndPointUrl,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$_SESSION['access_token'],
    'Content-Type: application/json',
    'X-Cafe24-Api-Version: 2022-06-01',
    'Access-Control-Allow-Origin: *'
  ),
));
$response_org = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);


$response = json_decode($response_org,true);
filelog('script_tags_insert',$http_code." : ".$sEndPointUrl); // 파일로그 남기기 #01


$err = curl_error($curl);
if ($err) {
  filelog('productUpdate',$err); // 실패 파일로그 남기기 #02
  echo 'cURL Error #:' . $err;
}
// 종료


debug($data);
debug("Response");
debug($response);
//echo "<script>location.href='dummyProductList.php';</script>";
echo "
    <a href='front_api.php';>Front API</a>
";


exit;
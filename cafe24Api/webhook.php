<?php
date_default_timezone_set('Asia/Seoul');
include_once $_SERVER['DOCUMENT_ROOT']."/inc/cafe24_env.php";
include_once $_SERVER['DOCUMENT_ROOT']."/inc/function.php";
include_once $_SERVER['DOCUMENT_ROOT']."/inc/ClassPDO.php";

/* DB에서 최신 mall_id 불러오기 */
if(!$_SESSION['access_token']){
    
    $sql = "select * from cafe24_token order by id desc limit 1 ";
    $ret = $NDO->prepare($sql);
    $ret->execute();
    $token = $ret->fetch(PDO::FETCH_ASSOC);

    $_SESSION['mall_id']=$token['mall_id'];
    $_SESSION['access_token']=$token['access_token'];
    $_SESSION['expires_at']=$token['expires_at'];
    $_SESSION['refresh_token']=$token['refresh_token'];
    $_SESSION['refresh_token_expires_at']=$token['refresh_token_expires_at'];
}

$jsonData = file_get_contents('php://input', true);
$data = $jsonData;


//filelog('webhook',"#001 : ".$data); // 파일로그 남기기 #01


if($data){
    
    $arrData = json_decode($data,true);
    $order_id = $arrData['resource']['order_id'];

    //filelog('webhook',"#002 : ".$arrData); // 파일로그 남기기 #02
    //exit;

    // DB 저장
    $sql = "
    	INSERT INTO
    	    cafe24_webhook
    	SET
    	    data = '".$data."',
    	    order_id = '".$order_id."'
    ";
    $ret = $NDO->prepare($sql);
    $ret->execute();
    
    // 쇼핑몰에 접수된 주문의 배송상태가 변경된 경우
    if($arrData['event_no']=='90024'){
        
        // 해당 상품번호 추출
        $method = 'GET';
        $products = "https://{$_SESSION['mall_id']}.cafe24api.com/api/v2/admin/orders/20220819-0000013/items?fields=product_no,order_status,status_code";
        $response = curl_call_raw($products, $method);
        
        filelog('webhook',"#002 : ".$method." : ".$response." - ".$products); // 파일로그 남기기 #03
        
        // DB 저장
        $sql = "
        	UPDATE
        	    cafe24_webhook
        	SET
        	    product_no = '".$response."'
        	WHERE 
        	    order_id = '".$order_id."'
        ";
        $ret = $NDO->prepare($sql);
        $ret->execute();
    }

}
exit;
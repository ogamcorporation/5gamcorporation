<?php
include_once $_SERVER['DOCUMENT_ROOT']."/inc/inc.php";
include_once $_SERVER['DOCUMENT_ROOT']."/inc/dummyNavi.php";


/* category */
$method = 'GET';
$sEndPointUrl = "https://{$_SESSION['mall_id']}.cafe24api.com/api/v2/admin/categories?fields=shop_no,category_no,category_name";
//$responseCate = curl_call($sEndPointUrl, $method);
//debug($responseCate);



/* products */
$limit=($_GET['limit'])?$_GET['limit']:40;
$method = 'GET';
$pno=$_GET['pno'];
if($limit==1 && $pno){
    for($shop=1;$shop<=5;$shop++){
        $response = get_product($pno,$shop);
        debug($response);
    }
}else{
    //$fields = "&category=25";
    $sEndPointUrl = "https://{$_SESSION['mall_id']}.cafe24api.com/api/v2/admin/products?limit={$limit}{$fields}";
    $response = curl_call($sEndPointUrl, $method);
}

//debug($response);
//exit;



filelog('productList',$sEndPointUrl); // 파일로그 남기기
?>
<br>
<div>
    <?foreach($response['products'] as $product){?>
    <div style="display:inline-block;width:300px;">
        <div><img src="<?=$product['list_image']?>" style="width:250px;"></div>
        <div>
            product_no : <?=$product['product_no']?> 
            <a href="dummyProductList.php?limit=1&pno=<?=$product['product_no']?>">보기</a>
            <a href="dummyProductUpdate.php?limit=1&pno=<?=$product['product_no']?>">수정</a>
            <a href="dummyProductDel.php?pno=<?=$product['product_no']?>">삭제</a>
        </div>
        <div>price : <?=$product['price']?></div>
        <div>custom_product_code : <?=$product['custom_product_code']?></div>
        <div>product_name : <?=$product['product_name']?></div>
    </div>
    <?}?>
</div>
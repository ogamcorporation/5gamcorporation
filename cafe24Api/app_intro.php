<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/inc/function.php";
include_once $_SERVER['DOCUMENT_ROOT']."/inc/cafe24_env.php";
include_once $_SERVER['DOCUMENT_ROOT']."/inc/ClassPDO.php";

foreach($_GET as $key => $get){
    echo "{$key} = {$get}<br>";
}
/*
is_multi_shop = T
lang = ko_KR
mall_id = ogamcorp
nation = KR
shop_no = 1
timestamp = 1658670191
user_id = ogamcorp
user_name = 홍태원
user_type = P
hmac = zECrr/790Kkt+zdPY9my+7At236caYoMxmfPy8jUPjI=
*/
?>

<div>
     <br> - 앱실행 완료 - <br>
    <p> <a href="AuthorizeAccess.php?mallid=<?=$_GET['mall_id']?>"> API 자격증명 얻기</a> </p>
    
    <?if($_SESSION['mall_id']){?>
    <p> <a href="apiList.php">API 리스트</a> </p>
    <?}?>
</div>
<?php
include_once "./inc/inc.php";
include_once "./inc/frontSubNavi.php";

/* app list */
$method = 'GET';
$sEndPointUrl = "https://{$_SESSION['mall_id']}.cafe24api.com/api/v2/admin/apps";
//$responseCate = curl_call($sEndPointUrl, $method);
//debug($responseCate);

/* script list */
$method = 'GET';
$shop_no = $_GET['shop_no'] ? $_GET['shop_no'] : 5;
$sEndPointUrl = "https://{$_SESSION['mall_id']}.cafe24api.com/api/v2/admin/scripttags?shop_no=" . $shop_no;
$scriptRst = curl_call($sEndPointUrl, $method);
//debug($sEndPointUrl);
//debug($scriptRst);


?>
<br>
<div>
    <form method="post" action="front_api_scriptInsert.php">
        <input type="hidden" name="shop_no" value="<?= $shop_no ?>">
        <div style="width:100px;float:left;">스크립트 등록</div>
        <div style="width:400px;float:left;"><input type="text" name="script_tag" style="width:100%" required></div>
        <div style="width:50px;float:left;padding-left:10px;">
            <button type="submit">등록</button>
        </div>
        <div style="clear:both;"></div>
    </form>
</div>
<div>
    <form method="post" action="front_api_scriptUpdate.php">
        <input type="hidden" name="shop_no" value="<?= $shop_no ?>">
        <div style="width:100px;float:left;">스크립트 수정</div>
        <div style="width:400px;float:left;"><input type="text" name="script_no" style="width:100%" required></div>
        <div style="width:50px;float:left;padding-left:10px;">
            <button type="submit">수정</button>
        </div>
        <div style="clear:both;"></div>
    </form>
</div>
<div>
    <form method="post" action="front_api_scriptDelete.php">
        <input type="hidden" name="shop_no" value="<?= $shop_no ?>">
        <div style="width:100px;float:left;">스크립트 삭제</div>
        <div style="width:400px;float:left;"><input type="text" name="script_no" style="width:100%" required></div>
        <div style="width:50px;float:left;padding-left:10px;">
            <button type="submit">삭제</button>
        </div>
        <div style="clear:both;"></div>
    </form>
</div>

<div>
    <div>list</div>
    <? foreach ($scriptRst['scripttags'] as $scripttags) { ?>
        <div><? debug($scripttags) ?></div>
    <? } ?>
</div>
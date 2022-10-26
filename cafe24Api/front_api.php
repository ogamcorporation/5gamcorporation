<?php
include_once $_SERVER['DOCUMENT_ROOT']."/inc/inc.php";
include_once $_SERVER['DOCUMENT_ROOT']."/inc/dummyNavi.php";

/* app list */
$method = 'GET';
$sEndPointUrl = "https://{$_SESSION['mall_id']}.cafe24api.com/api/v2/admin/apps";
//$responseCate = curl_call($sEndPointUrl, $method);
//debug($responseCate);

/* script list */
$method = 'GET';
$sEndPointUrl = "https://{$_SESSION['mall_id']}.cafe24api.com/api/v2/admin/scripttags";
$scriptRst = curl_call($sEndPointUrl, $method);
//debug($scriptRst);



?>
<br>
<div>
    <form method="post" action="front_api_scriptInsert.php">
    <div style="width:100px;float:left;">스크립트 등록</div>
    <div style="width:400px;float:left;"><input type="text" name="script_tag" style="width:100%" required></div>
    <div style="width:50px;float:left;padding-left:10px;"><button type="submit">등록</button></div>
    <div style="clear:both;"></div>
    </form>
</div>

<div>
    <div>list</div>
    <?foreach($scriptRst['scripttags'] as $scripttags){?>
    <div><?debug($scripttags)?></div>
    <?}?>
</div>
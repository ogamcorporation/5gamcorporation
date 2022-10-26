<?php
include_once $_SERVER['DOCUMENT_ROOT']."/inc/function.php";
include_once $_SERVER['DOCUMENT_ROOT']."/inc/ClassPDO.php";

$id = $_GET['id'];
$ip = $_SERVER['REMOTE_ADDR'];


if($id){
    $sql = "insert into cafe24_sso_id set request_id='".$id."', request_ip='".$ip."'";
    $ret = $NDO->prepare($sql);
    $ret->execute();
    if($ret){
        $result=[
            "result" => "success",
            "member_id" => $id
            ];
    }else{
        $result=[
            "result" => "error",
            "member_id" => "서버 등록 오류"
            ];
    }
}else{
    $result=[
        "result" => "error",
        "member_id" => "아이디 없음"
        ];
}
exit(json_encode($result));
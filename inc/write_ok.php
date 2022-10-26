<?
session_start();

$secretKey = '6Le-IeAhAAAAAE2RQx5ovQA4R_IqGyRMYwPBI8zD'; 
$url = "https://www.google.com/recaptcha/api/siteverify";
$post = array(
	"secret" => $secretKey,
	"response" => $_POST['g-recaptcha-response'],
	"remoteip" => $_SERVER['REMOTE_ADDR']
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$result = curl_exec($ch);
curl_close ($ch);
$rst = json_decode($result, true);

if($rst['success'] != 1){
 alert("비정상적인 접근입니다.");
 exit;
}

?>
<?php
/**
 * Server curl call
 * @param string $url
 * @param string $method
 * @param mixed $data
 * @param array $headers
 *
 * @access public
 * @return array
 */
function curl_call($url, $method, $data = NULL, $headers = array(), $timeOut = 30)
{
    $ch = curl_init();
    if (empty($headers)) {
        $headers = array(
            'Authorization: Bearer ' . $_SESSION['access_token'],
            'Content-Type: application/json',
            'X-Cafe24-Api-Version: 2022-09-01'
        );
    }

    if (!empty($data) && is_array($data)) {
        $params = http_build_query($data);
    } else {
        $params = $data;
    }


    //curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);

    if ($timeOut != 30) {
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeOut);
    }

    switch ($method) {
        case 'POST':
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            break;
        case 'PUT':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            break;
        case 'DELETE':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            break;
        default:
            //GET is CURL default
            break;
    }

    //set URL
    curl_setopt($ch, CURLOPT_URL, $url);

    try {
        $return = curl_exec($ch);
        $return = json_decode($return, true);
    } catch (Exception $e) {
        $return = $e->getMessage();
    }

    return $return;
}

/**
 * Plea curl call
 * @param string $url
 * @param string $method
 * @param mixed $data
 * @param array $headers
 *
 * @access public
 * @return array
 */
function plea_curl_call($url, $method = "GET", $data = NULL, $headers = array(), $timeOut = 30)
{
    $ch = curl_init();
    if (empty($headers)) {
        $headers = array(
            'Content-Type: application/json',
        );
    }

    if (!empty($data) && is_array($data)) {
        $params = http_build_query($data);
    } else {
        $params = $data;
    }


    //curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);

    if ($timeOut != 30) {
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeOut);
    }

    switch ($method) {
        case 'POST':
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            break;
        case 'PUT':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            break;
        case 'DELETE':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            break;
        default:
            //GET is CURL default
            break;
    }

    //set URL
    curl_setopt($ch, CURLOPT_URL, $url);

    try {
        $return = curl_exec($ch);
        $return = json_decode($return, true);
    } catch (Exception $e) {
        $return = $e->getMessage();
    }

    return $return;
}

function curl_call_raw($url, $method, $data = NULL, $headers = array(), $timeOut = 30)
{
    $ch = curl_init();
    if (empty($headers)) {
        $headers = array(
            'Authorization: Bearer ' . $_SESSION['access_token'],
            'Content-Type: application/json',
            'X-Cafe24-Api-Version: 2022-09-01'
        );
    }

    if (!empty($data) && is_array($data)) {
        $params = http_build_query($data);
    } else {
        $params = $data;
    }


    //curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);

    if ($timeOut != 30) {
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeOut);
    }

    switch ($method) {
        case 'POST':
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            break;
        case 'PUT':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            break;
        case 'DELETE':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            break;
        default:
            //GET is CURL default
            break;
    }

    //set URL
    curl_setopt($ch, CURLOPT_URL, $url);

    try {
        $return = curl_exec($ch);
    } catch (Exception $e) {
        $return = $e->getMessage();
    }

    return $return;
}

// 로그 (파일)
function filelog($fileName = 'Log', $logTxt = '')
{
    $dir = $_SERVER['DOCUMENT_ROOT'] . '/cafe24Api/log/';
    $date = date("Y-m-d");
    $fn_log = $fileName . '_' . $date . '.log';
    $ff_log = (file_exists($dir . $fn_log) != false) ? 'a' : 'w';
    $fp_log = fopen($dir . $fn_log, $ff_log);
    fwrite($fp_log, date("Y-m-d H:i:s") . " - " . $logTxt . "\r\n\r\n");
    fclose($fp_log);
}

function get_product($pno, $shop_no = 1)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://' . $_SESSION['mall_id'] . '.cafe24api.com/api/v2/admin/products/' . $pno . '?shop_no=' . $shop_no,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $_SESSION['access_token'],
            'Content-Type: application/json',
            'X-Cafe24-Api-Version: 2022-09-01'
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    if ($err) {
        echo 'cURL Error #:' . $err;
    } else {
        $response = json_decode($response, true);
    }
    return $response;
}

function random_str_generator($len_of_gen_str)
{
    $chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $var_size = strlen($chars);
    $random = '';
    for ($x = 0; $x < $len_of_gen_str; $x++) {
        $random_str = $chars[rand(0, $var_size - 1)];
        $random .= $random_str;
    }
    return $random;
}


function debug($str)
{
    echo "<xmp>";
    print_r($str);
    echo "</xmp>";
}

function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

// AES 복호화
function apiDecrypt($str)
{
    $secret_key = 'idollivecomunity';
    $secret_iv = 'idollivecomunity';

    $result = openssl_decrypt(base64_decode($str), "AES-128-CBC", $secret_key, OPENSSL_RAW_DATA, $secret_iv);
    return $result;
}
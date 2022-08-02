<?php
    /**
     * Server curl call
     * @param string $url
     * @param string $method
     * @param mixed  $data
     * @param array  $headers
     *
     * @access public
     * @return array
     */
    function curl_call($url, $method, $data = NULL, $headers=array(), $timeOut = 30){
        $ch = curl_init();
        if( empty($headers)){
            $headers = array(
                'Authorization: Bearer '.$_SESSION['access_token'],
                'Content-Type: application/json',
                'X-Cafe24-Api-Version: 2022-06-01'
            );
        }

        if(! empty($data) && is_array($data)){
            $params = http_build_query($data);
        }else{
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

        switch($method){
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

        try{
            $return = curl_exec($ch);
            $return = json_decode($return,true);
        }catch(Exception $e){
            $return = $e->getMessage();
        }
        return $return;
    }


    function random_str_generator ($len_of_gen_str){
        $chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $var_size = strlen($chars);
        for( $x = 0; $x < $len_of_gen_str; $x++ ) {
            $random_str= $chars[ rand( 0, $var_size - 1 ) ];
            $random .= $random_str;
        }
        return $random;
    }


    function debug($str){
        echo "<xmp>";
        print_r($str);
        echo "</xmp>";
    }
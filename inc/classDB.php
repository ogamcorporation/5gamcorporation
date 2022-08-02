<?php

class NDO extends PDO {
    private $HOST, $DATA, $USER, $PASS, $PORT;
    function NDO() {
        return true;
    }

    function &_NDO ($host='', $data='', $user='', $pass='', $port='') {
        try {
            $host = ($this->HOST!='') ? $this->HOST : '127.0.0.1';
            $data = ($this->DATA!='') ? $this->DATA : 'cashkeyboard';
            $user = ($this->USER!='') ? $this->USER : 'cashkeyboard';
            $pass = ($this->PASS!='') ? $this->PASS : 'zotl$%^zlqhem**';
            $port = ($this->PORT!='') ? $this->PORT : '3306';
            $db = $this->__construct("mysql:host=$host;dbname=$data;port=$port", $user, $pass);
            $sql = "set names utf8";
            $this->exec($sql);
            return $db;
        } catch(Exception $e) {
            echo '오류 ->'.$e->getMessage();
        }
    }
}

if(!isset($NDO)) {
    $NDO = new NDO;
    $NDO->_NDO();
}

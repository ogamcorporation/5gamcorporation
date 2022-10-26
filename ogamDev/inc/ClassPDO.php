<?php

class NDO extends PDO
{
    private $HOST, $DATA, $USER, $PASS, $PORT;

    function NDO()
    {
        return true;
    }

    function &_NDO($host = '', $data = '', $user = '', $pass = '', $port = '')
    {
        try {
            $host = ($this->HOST != '') ? $this->HOST : 'localhost';
            $data = ($this->DATA != '') ? $this->DATA : 'hknapn2uvg2niaww_ogam';
            $user = ($this->USER != '') ? $this->USER : 'hknapn2uvg2niaww_ogam';
            $pass = ($this->PASS != '') ? $this->PASS : 'Ogam!1231';
            $port = ($this->PORT != '') ? $this->PORT : '3306';
            $db = $this->__construct("mysql:host=$host;dbname=$data;port=$port", $user, $pass);
            $sql = "set names utf8";
            $this->exec($sql);
            return $db;
        } catch (Exception $e) {
            echo '오류 ->' . $e->getMessage();
        }
    }
}

if (!isset($NDO)) {
    $NDO = new NDO;
    $NDO->_NDO();
}
<?php


abstract class SQl{
    const HOST = 'localhost';
    const LOGIN = 'root_antyakimen';
    const PASS = '4kdhHvyl';
    const N_TABLE = 'dev_antyakimen';
    //const N_TABLE2 = 'forma';
    private $sql;
    private $sql2;

    function __construct(){
        $this->sql = mysqli_connect(self::HOST, self::LOGIN, self::PASS, self::N_TABLE);
    }
     function conn2(){
        $this->sql2 = mysqli_connect(self::HOST, self::LOGIN, self::PASS, self::N_TABLE2);
    }
}



class Dell extends SQl {
 function __construct(){
        $this->sql = mysqli_connect(self::HOST, self::LOGIN, self::PASS, self::N_TABLE);
    }

   function del(){ 
   $sql = mysqli_query($this->sql,"DELETE FROM `dev_product` WHERE `id` = '" . $_GET['id'] ."' ");
   $redirect = $_SERVER['HTTP_REFERER'];
     header("Location: $redirect");
   }

}
$Del = new Dell();
$Del->del();

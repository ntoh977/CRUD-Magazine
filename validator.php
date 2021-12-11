

<form method="POST" enctype="multipart/form-data">
   
   <div>login:
    <input type="text" name="login">
   </div>
 <div>pass:
    <input type="text" name="pass">
   </div>
    <input type="submit" value="REGISTER">
</form>
<?php 

abstract class SQl{
    
    //const N_TABLE2 = 'forma';
    private $sql;
    public $sql2;

    
 
}

class Reg extends SQl{
const HOST = 'localhost';
    const LOGIN = 'root';
    const PASS = '';
    const N_TABLE = 'testphp';
 function conn2(){
        $this->sql2 = mysqli_connect(self::HOST, self::LOGIN, self::PASS, self::N_TABLE);
    }

function Reg(){
if (isset($_POST['login']) and isset($_POST['pass'])) {

$login = mysqli_real_escape_string($this->sql2, $_POST['login']);
   $pass = mysqli_real_escape_string($this->sql2, $_POST['pass']);

   $sql = mysqli_query($this->sql2, "INSERT INTO `login`(`user_login`,`user_password`)VALUES ('$login','$pass')");

   if (!empty($sql)) {
      echo "OK";
   header("Refresh: 0.5; url=/");
   }else{
    echo "NO OK";
     header("Refresh: 1; url=/validator.php");
   }
}}


}
$reg = new Reg();
$reg->conn2();
$reg->Reg();


?>

<style type="text/css">
    body{
        display: grid;
    justify-content: center;
    align-items: center;
    text-align: center;
}
</style>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>
<style type="text/css">
   #content{
    width: 99%;
    margin: 20px auto;
    border: 1px solid #cbcbcb;
    display: flex;
    flex-direction: inherit;
    flex-wrap:wrap;
   }
   form{

    position: relative;
    width: 50%;
 
   }
   form div{
    margin-top: 5px;
   }
   #img_div{
    width: 40%;
    padding: 5px;
    margin: 15px auto;
    border: 1px solid #cbcbcb;
   }
   #img_div:after{
    content: "";
    display: block;
    clear: both;
   }
   img{
    float: left;
    margin: 5px;
    width: 250px;
    height: 140px;
   }
   body{
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    
    box-sizing: border-box;
   }
   .imagee img{
    width: 35px;
    height: 27px;
 
   }
</style>
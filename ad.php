

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
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>

<form method="POST" enctype="multipart/form-data">
    <select name="cat">
        <option value="Инструмент">Инструмент</option>
        <option value="Дрели">Дрели</option>
        <option value="Ударные">Ударные</option>
        <option value="Интерскол">Интерскол</option>
    </select>
    <div>
        img
        <input type="file" name="img">
    </div>
        <div>
        img/url
        <input type="url" name="img">
    </div>
    <div>
        name
        <input type="text" name="name">
    </div>
      <div>
        price
        <input type="text" name="price">
    </div>
    <div>
        discount_price
        <input type="text" name="discount_price">
    </div>
     <div>
        attributes
        <input type="text" name="attributes">
    </div>
    <div>
        марка
        <input type="text" name="marca">
    </div>
       <div>
        номер модел
        <input type="text" name="number_model">
    </div>
       <div>
       relation
        <input type="text" name="relation">
    </div>
    <input type="submit" name="insert" value="Обновить товар ">
</form>

<a href="">вернуться </a>

<?php 

abstract class SQl{
  const HOST = 'localhost';
    const LOGIN = 'root';
    const PASS = '';
    const N_TABLE = 'testphp';
   // const N_TABLE2 = 'forma';
    private $sql;
    private $sql2;

    function __construct(){
        $this->sql = mysqli_connect(self::HOST, self::LOGIN, self::PASS, self::N_TABLE);
    }
     function conn2(){
        $this->sql2 = mysqli_connect(self::HOST, self::LOGIN, self::PASS, self::N_TABLE2);
    }


}
interface insert{
    function insert();
}

class Add_post extends SQl implements insert{

       function __construct(){
        $this->sql = mysqli_connect(self::HOST, self::LOGIN, self::PASS, self::N_TABLE);
    }

function insert(){
    if (isset($_POST['insert'])) {
         $cat = mysqli_real_escape_string($this->sql,$_POST['cat']);
         $name = mysqli_real_escape_string($this->sql,$_POST['name']);
         $price = mysqli_real_escape_string($this->sql,$_POST['price']);
         $discount_price = mysqli_real_escape_string($this->sql,$_POST['discount_price']);
         $attributes = mysqli_real_escape_string($this->sql,$_POST['attributes']);
         $marca = mysqli_real_escape_string($this->sql,$_POST['marca']);
         $number_model = mysqli_real_escape_string($this->sql,$_POST['number_model']);
         $relation = mysqli_real_escape_string($this->sql,$_POST['relation']);
          $date =  date('F  j,  Y');
          $id = $_GET['id'];
             $image = $_FILES['img']['name'];
  $target = "images/".basename($image);
  $sql = mysqli_query($this->sql,"UPDATE `dev_product` SET `relation` = '$relation', `main_category` = '$cat', `name` = '$name', `price` = '$price', `discount_price` = '$discount_price',`image` = '$image',`date_added` = '$date',`attributes` = '$attributes',`manufacturer` = '$marca',`model` = '$number_model' WHERE `id` = '$id'");



 if (move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
  }
}
}



}

$add = new Add_post;
$add->insert();


<form method="POST" enctype="multipart/form-data">
    <select name="cat">
        <option value="Инструмент">Инструмент</option>
        <option value="Дрели">Дрели</option>
        <option value="Ударные">Ударные</option>
        <option value="Интерскол">Интерскол</option>
    </select>
    <div class="form-row">
        <label>Изображения:</label>
        <div class="img-list" id="js-file-list"></div>
        <input id="js-file" type="file" name="file[]" multiple accept=".jpg,.jpeg,.png,.gif">
    </div>
    <div>
        img
        <input type="file" name="img">
    </div>
      <div>
        img/url
        <input type="text" name="img2">
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
    <input type="submit" name="insert" value="Добавить товар ">
</form>

<a href="/">вернуться в админку</a>
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

  $image = mysqli_real_escape_string($this->sql,$_POST['img2']);

// if (null !== $_FILES['img']) {
//      $image = $_FILES['img']['name'];
//   $target = "images/".basename($image);
// move_uploaded_file($_FILES['img']['tmp_name'], $target);
// }else{
         
// }

         

          $date =  date('F  j,  Y');
          

  $sql = mysqli_query($this->sql,"INSERT INTO `dev_product`(`relation`, `main_category`, `name`, `price`, `discount_price`,`image`,`date_added`,`attributes`,`manufacturer`,`model`) VALUES ('$relation', '$cat', '$name', '$price', '$discount_price','$image','$date','$attributes','$marca','$number_model')");

if ($this->sql->query("SET a=1")) {
    printf("Сообщение ошибки: %s\n", $mysqli->error);
}


}
}



}

$add = new Add_post;
$add->insert();
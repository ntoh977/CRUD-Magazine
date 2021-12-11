<?php
// Start the session
session_start();
?>
<?php

ini_set('memory_limit', '500M');


?>
<?
echo basename($_SERVER['DOCUMENT_ROOT']);
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Кодировка веб-страницы -->
  <meta charset="utf-8">
  <!-- Настройка viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tables</title>


  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<style type="text/css">
   
</style>

<?php if (!isset($_COOKIE['avtorize'])) { ?>

<form method="POST" enctype="multipart/form-data">
   
   <div>login:
    <input type="text" name="login">
   </div>
 <div>pass:
    <input type="text" name="pass">
   </div>
    <input type="submit" value="AVTORIZATION">
</form>
<?php }?>
<?php if (isset($_COOKIE['avtorize'])) { ?>
    

    <a href="add_post.php">добавить товар</a>
<p></p>
   <a href="validator.php">Регистрация</a> 
<p></p>
<a href="store_detail.php">выйти с админки </a>




<form action="search.php" method="GET">
    
    <input type="text" name="query" onkeyup="showResult(this.value)"/>
    <input type="submit" value="Search" />

  <div id="livesearch"></div>

  </form>

<?php }?>
<?php if (isset($_POST['variat'])) {


$_SESSION['sort21'] = $_POST['sort2'];
 $options = $_SESSION['sort21'];
 echo $_SESSION['sort21'];
}else{
     $options = $_SESSION['sort21'];
    $_POST['sort2'] = 10;
   
}


?>
<?php if (isset($_COOKIE['avtorize'])) { ?>
<form method="POST" enctype="multipart/form-data" id="sort21">
    <select name='sort2'>
        


 <option value="10"  <?php if($options==10) { echo 'selected="selected"'; }else{  } ?>>10</option>
 <option value="50"  <?php if($options==50) { echo 'selected="selected"'; }else{  } ?>>50</option>
   <option value="100" <?php if($options==100) { echo 'selected="selected"'; }else{  } ?>>100</option>

</select> 

    <input type="submit" value="Показать" name="variat">
</form>


<?php } ?>

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

interface Avtoriz{
    function Avtoriz();
}

interface insert{
    function insert();
}



trait Posts{
function Posts(){

 
  $start=0;

if (!empty($_POST['variat'])) {
$limit = $_POST['sort2'];
}else{
  $limit = 20;  
}
    

   

      $t=mysqli_query($this->sql,"select * from `dev_product`");
      $total=mysqli_num_rows($t);



       if(isset($_GET['id']))
       {
            $id=$_GET['id'] ; 
       $start=($id-1)*$limit;

                      }
                else
                {
            $id=1;
   }

     $page=ceil($total/$limit);

 //The Blank string is the password

  // if (isset($_POST['asc'])) {
  //       $result = mysqli_query($this->sql,"SELECT * FROM `dev_product` ORDER BY `price` ASC");
  //   } else {
  //       $result = mysqli_query($this->sql,"SELECT * FROM `dev_product` ORDER BY `price` DESC");

  //   }



   // function sortorder($fieldname){
   //      $sorturl = "?order_by=".$fieldname."&sort=";
   //      $sorttype = "asc";
   //      if(isset($_GET['order_by']) && $_GET['order_by'] == $fieldname){
   //          if(isset($_GET['sort']) && $_GET['sort'] == "asc"){
   //              $sorttype = "desc";
   //          }
   //      }
   //      $sorturl .= $sorttype;
   //      return $sorturl;
   //  }
      
//$result = mysqli_query($this->sql,"SELECT * FROM `dev_product`  ORDER BY `price` DESC limit $start, $limit");



$result = mysqli_query($this->sql,"SELECT * FROM `dev_product` limit $start, $limit");



  if (isset($_GET['price']) && $_GET['price'] == 'desc') {
      $result = mysqli_query($this->sql,"SELECT * FROM `dev_product` ORDER BY `price` DESC limit $start, $limit");
     


    } elseif (isset($_GET['price']) && $_GET['price'] == 'asc'){
         $result = mysqli_query($this->sql,"SELECT * FROM `dev_product` ORDER BY `price` ASC limit $start, $limit");

    }elseif(isset($_GET['date_added']) && $_GET['date_added'] == 'desc') {
      $result = mysqli_query($this->sql,"SELECT * FROM `dev_product` ORDER BY `date_added` DESC limit $start, $limit");
     

    } elseif (isset($_GET['date_added']) && $_GET['date_added'] == 'asc'){
         $result = mysqli_query($this->sql,"SELECT * FROM `dev_product` ORDER BY `date_added` ASC limit $start, $limit");

    }elseif(isset($_GET['discount_price']) && $_GET['discount_price'] == 'desc') {
      $result = mysqli_query($this->sql,"SELECT * FROM `dev_product` ORDER BY `discount_price` DESC limit $start, $limit");
     

    } elseif (isset($_GET['discount_price']) && $_GET['discount_price'] == 'asc'){
         $result = mysqli_query($this->sql,"SELECT * FROM `dev_product` ORDER BY `discount_price` ASC limit $start, $limit");

    }elseif(isset($_GET['ids']) && $_GET['ids'] == 'desc') {
      $result = mysqli_query($this->sql,"SELECT * FROM `dev_product` ORDER BY `id` DESC limit $start, $limit");
     

    } elseif (isset($_GET['ids']) && $_GET['ids'] == 'asc'){
         $result = mysqli_query($this->sql,"SELECT * FROM `dev_product` ORDER BY `id` ASC limit $start, $limit");

    };
if (isset($_COOKIE['avtorize'])) { 

   echo "<div class=''>
  <table class='table-3 table table-hover' style='zoom:0.7'>

   <tr style='text-align: center;' >
    
      <td  ><a href=?ids=asc>▴</a>
      <div>id</div><a href=?ids=desc>▾</a></td>  
      <td>Название</td>
      <td>Описание</td>
      <td>Категория</td>   
      <td>Бренд</td>   
      <td>Магазин</td>   
      <td class='center'>
      <a href=?date_added=asc>▴</a>
     <div> Дата добавления</div>
      <a  href=?date_added=desc>▾</a></td>   
      <td>Дата изменений</td>   
      <td class='center'><a  href=?price=asc>▴</a>
      <div>Цена</div><a  href=?price=desc>▾</a></td> </td> 

     <td class='center'><a href=?discount_price=asc>▴</a>
      <div>Цена скидки</div><a  href=?discount_price=desc>▾</a></td> 

      <td>Ссылка</td>   
      <td>Изображение</td>   
      <td>Номер модели</td>   
      <td>Атрибуты</td>   
   </tr>";


}

// connect to database
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'testphp');


echo $_SESSION['sort21'];
if (isset($_SESSION['sort21'])) {
 
    $results_per_page = $_SESSION['sort21'];

}else{
    $results_per_page = $_SESSION['sort21'];

}
// define how many results you want per page


// find out the number of results stored in database
$sql='SELECT * FROM dev_product';
$result = mysqli_query($con, $sql);
$number_of_results = mysqli_num_rows($result);

// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);

// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;
//print_r($number_of_pages);

// retrieve selected results from database and display them on page
$sql='SELECT * FROM dev_product LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($con, $sql);

// while($res = mysqli_fetch_array($result)) {
//   echo $res['id'] . ' ' . $res['name']. '<br>';
// }



   while($res = mysqli_fetch_array($result)) {     
      echo "<tr>";
      echo "<td bgcolor=''>".$res['id']."</td>";
       echo "<td>".$res['name']."</td>"; 

        $text_obrez = "<td style='text-align: center;'>".$res['name']."</td>"; 
         echo $texts = mb_strimwidth($text_obrez, 0, 150, "...");
         echo "<td>".$res['category']."</td>";
         echo "<td>".$res['manufacturer']."</td>";
         echo "<td>".$res['location']."</td>";
         echo "<td >".$res['date_added']."</td>";
         echo "<td>".$res['date_modified']."</td>";
         echo "<td>".$res['price']."</td>";
         echo "<td >".$res['discount_price']."</td>";
         echo "<td><a href =".$res['url'].">Ссылка</a></td>";
         $root = $_SERVER['DOCUMENT_ROOT'];
 // echo "<td style='width: 170px;
 //    height: 170px;'><img src=images/'".$res['image']."' ></td>";
         if (!empty($res['image'])) {
              echo "<td ><div class='im'><img src='".$res['image']."' ></div></td>";
         }elseif(!empty($res['image'])){
 echo "<td ><img src=images/'".$res['image']."' ></td>";
         }else{
            echo "<td ><div class='im'><img src='https://atehno.md/theme/images/no_image.png' ></div></td>";
};
    
      //echo "<td><img src=images/'".$res['images']."' ></td>";
     
      echo "<td>".$res['model']."</td>";  
      
      //echo "<td>".$res['main_category']."</td>";
    $text_obrez2 =   "<td>".$res['attributes']."</td>";  
       
       echo   mb_strimwidth($text_obrez2, 0, 250, "...");
     
   
       
echo "<td class = 'vibor' bgcolor='green' style='font-size: 9px;'><a href='ad.php?id=$res[id]'><font color='white'>Редактировать</a>";         
echo "<td class = 'vibor' bgcolor='green' style='font-size: 9px;'><a href='com.php?id=$res[id]'><font color='red'>удалить</a>";   
   echo "</tr>";
   }
    echo  "</table>";
 echo  "</div>";


  $prev = $page - 1;
  $prev5 = $page - 5;
  $next = $page + 1;
  $next5 = $page + 5;

echo 
'<nav aria-label="Page navigation example ">
  <ul class="pagination justify-content-end">
    <li class="page-item">
    
      <a class="page-link" href="?page=' . $prev .'" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>';

 
        $link = "";
        if (isset($_GET['page'])) {
          $page = $_GET['page'];
        }
  // your current page
 // $pages=20; // Total number of pages

  $limit=15  ; // May be what you are looking for

    if ($number_of_pages >=1 && $page <= $number_of_pages)
    {
        $counter = 1;
        $link = "";
        if ($page > ($limit/2))
           { $link .= "<a class='page-link ' href=\"?page=1\">1 </a> ... ";}
        for ($x=$page; $x<=$number_of_pages;$x++)
        {

            if($counter < $limit)
                $link .= "<a class='page-link'  href=\"?page=" .$x."\">".$x." </li>";

            $counter++;
        }
        if ($page < $number_of_pages - ($limit/2))
         { $link .= "... " . "<a class='page-link' href=\"?page=" .$number_of_pages."\">".$number_of_pages." </a>"; }
    }

    echo $link;

 
      echo '<a class="page-link" href="?page=' .$next.'" aria-label="Next">
 
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>';







}
}





 
 



class  CRUD extends SQl implements Avtoriz, insert{


function __construct(){
        $this->sql = mysqli_connect(self::HOST, self::LOGIN, self::PASS, self::N_TABLE);
}

  function conn2(){
        $this->sql2 = mysqli_connect(self::HOST, self::LOGIN, self::PASS, self::N_TABLE2);
    }

use Posts;

function Avtoriz(){
if (!empty($_POST['login']) and isset($_POST['pass'])) {
   $login = mysqli_real_escape_string($this->sql,$_POST['login']);
   $pass = mysqli_real_escape_string($this->sql,$_POST['pass']);
   $sql = mysqli_query($this->sql,"SELECT * FROM `login` WHERE `user_login` = '$login' AND `user_password` = '$pass' ");
   $row = mysqli_fetch_array($sql);
if (isset($row)) {
   session_start();
   $_SESSION['avtor'] = $row['user_login'];
    
   setcookie('avtorize', $row['user_login'], time()+60*60*24+10);
   //session_destroy();
    header("refresh: 0.5;");
   echo "OK OK OK";
   
}else{
       echo "NOOOOOOOOO";
}
}
}
 
function insert(){
    if (isset($_POST['insert'])) {
         $cat = mysqli_real_escape_string($this->sql,$_POST['cat']);
         $title = mysqli_real_escape_string($this->sql,$_POST['title']);
         $text = mysqli_real_escape_string($this->sql,$_POST['text']);
             $image = $_FILES['img']['name'];
  $target = "images/".basename($image);
  $sql = mysqli_query($this->sql,"INSERT INTO `practika`(`title`, `img`, `texts`, `catigory`) VALUES ('$title', '$image', '$text', '$cat')");
 if (move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
  }
}
}







function sort(){

}


}



$crud = new CRUD;
//$crud->conn2();
$crud->Avtoriz();
$crud->insert();

$crud->Posts();
$crud->sort();

 if (isset($_COOKIE['avtorize'])) { 
$db = mysqli_connect("localhost", "root", "", "testphp");
$afh = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `dev_product`")); 

echo '<p>';
echo "Количество записей в базе данных " . $afh; // выведет число строк
echo '<p>';

}




?>





</body>
<script>
jQuery(document).ready(function() {
jQuery("#target-content").load("pagination.php?page=1");
    jQuery("#pagination h3").live('click',function(e){
  e.preventDefault();
    jQuery("#target-content").html('loading...');
    jQuery("#pagination h3").removeClass('active');
    jQuery(this).addClass('active');
        var pageNum = this.id;
        jQuery("#target-content").load("pagination.php?page=" + pageNum);
    });
    });
</script>




</body>
</html>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>

<script>
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="";
    }
  }
  xmlhttp.open("GET","http://oop/search.php?query="+str,true);
  xmlhttp.send();
}
</script>


  <!-- Bootstrap CSS (Cloudflare CDN) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <!-- jQuery (Cloudflare CDN) -->
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Bootstrap Bundle JS (Cloudflare CDN) -->
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
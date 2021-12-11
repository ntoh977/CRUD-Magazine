<?php
    $link = mysqli_connect("localhost", "root", "","testphp") or die("Error connecting to database: ".mysqli_error($link));
 
    /*
        localhost - it's location of the mysql server, usually localhost
        root - your username
        third is your password
        
        if connection fails it will stop loading the page and display an error
    */
    
   
    /* tutorial_search is the name of database we've created */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href=""/>
</head>
<body>
<?php

 $start=0;
 $limit = 7; 

   

      $t=mysqli_query($link,"select * from `dev_product`");
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

    $query = $_GET['query']; 
    // gets value sent over search form
    
    $min_length = 1;
    // you can set minimum length of the query if you want
    
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
        
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
        
        $query = mysqli_real_escape_string($link, $query);
        // makes sure nobody uses SQL injection
        
        $raw_results = mysqli_query($link,"SELECT * FROM `dev_product` 
            WHERE (`price` LIKE '%".$query."%' ) OR (`category` LIKE '%".$query."%')OR (`name` LIKE '%".$query."%') OR  (`location` LIKE '%".$query."%') limit $start, $limit");
            
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our tabli
        
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
        
        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
            
            while($results = mysqli_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
            
                echo "<div class='search_post'><p><h7>id = ".$results['id']."</h7></p> <p><h8> имя: ".$results['name']."</h8></p><p> дата:".$results['date_added'] . "</p></h8><br>". "<img class='img_seach' src=".$results['image'].">"."</p></div>"; 
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
            
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
        
    }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }
?>
</body>
</html>
<?php 

$afh = mysqli_num_rows(mysqli_query($link, "SELECT * FROM `dev_product`")); 

echo '<p>';
echo "Количество записей в базе данных " . $afh; // выведет число строк
echo '<p>';

 if (isset($_COOKIE["avtorize"])) { 
include('paginator.php');






$pages = new Paginator(20,'id');






$pages->set_total($afh); //or a number of records


//display the records here

echo $pages->page_links();


} 
?>

<style type="text/css">
.search_post {
  border: 2px solid black;
    width: fit-content;
    line-height: 0.8;
    padding: 6px;
}
.img_seach{
    width: 50px;
    height: 50px;
}

</style>
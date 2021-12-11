<?php  


unset($_COOKIE['avtorize']);
setcookie('avtorize',null,-1,'/');
header("Location: /");
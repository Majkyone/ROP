<?php 
    $con = mysqli_connect('localhost', 'root', '', 'data');
    if(mysqli_connect_error()){
        echo 'not connected';
    } 

    function errors($value){
      global $errors;
      if(!empty($errors)){
        echo $errors[$value];
      }
    }
?>
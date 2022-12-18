<?php
    session_start();
        if(!isset($_SESSION['AdminLoginId'])){
        header("location: login.php");
    }
    include 'C:\xampp\htdocs\ROP\connect.php';

    $id = $_POST['id'] ?? NULL;

    if(!$id){
        header('Location: admin.php');
        exit;
    }   
    $sql = "DELETE FROM products WHERE id_product = '$id'";
    $query = mysqli_query($con, $sql);
    header("LOCATION: admin.php");
?>
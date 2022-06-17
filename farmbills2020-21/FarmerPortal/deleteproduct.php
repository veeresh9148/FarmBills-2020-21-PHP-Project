<?php
include("../Includes/db.php");
session_start();
$sessphonenumber = $_SESSION['phonenumber'];
if (isset($_GET['id'])) {
     $product_id = $_GET['id'];
     $getting_id = "select * from products where product_id = $product_id";
     $run = mysqli_query($con, $getting_id);
     $row = mysqli_fetch_array($run);
     $id = $row['product_id'];
     $delete_product = "delete from products where  product_id = '$product_id'";
     $run_delete = mysqli_query($con, $delete_product);
     if ($run_delete) {
         echo "<script>alert('Product has been deleted')</script>";
         echo "<script>window.open('MyProducts.php','_self')</script>";
     } else {
         echo "<script>alert('Error Deleting Data Please Check your Connections ')</script>";
     }
    }
?>
<?php
session_start();
if(isset($_POST['E_category']) && isset($_POST['E_brand']) && isset($_POST['E_model'])){
    if(!empty($_POST['E_category']) && !empty($_POST['E_brand']) && !empty($_POST['E_model'])){
        $id_update = $_POST['E_id'];
        $category = $_POST['E_category'];
        $brand = $_POST['E_brand'];
        $model = $_POST['E_model'];
        $quantity = $_POST['E_quantity'];
        $condition = $_POST['E_condition'];
        if(empty($_POST['E_details'])){
            $connection = mysqli_connect('localhost','root','','shop_inventory');
            $sql_update_data = "UPDATE devices SET category = '$category', brand = '$brand', model = '$model', quantity = '$quantity', condit = '$condition' WHERE devices.id = '$id_update'";
            $query_insert = mysqli_query($connection, $sql_update_data);
            $close = mysqli_close($connection);
            $_SESSION['alert_type'] = 0;
            $_SESSION['alert'] = "The device has been successfully edited";
        }else{
            $details = $_POST['E_details'];
            $connection = mysqli_connect('localhost','root','','shop_inventory');
            $sql_update = "UPDATE devices SET category = '$category', brand = '$brand', model = '$model', quantity = '$quantity', condit = '$condition', details = '$details' WHERE devices.id = '$id_update'";
            $query_insert = mysqli_query($connection, $sql_update);
            $close = mysqli_close($connection);
            $_SESSION['alert_type'] = 0;
            $_SESSION['alert'] = "The device has been successfully edited";
        };
    };
};
header("Location:index.php");
?>
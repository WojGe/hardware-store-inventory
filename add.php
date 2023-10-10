<?php
if(isset($_POST['category']) && isset($_POST['brand']) && isset($_POST['model'])){
    if(!empty($_POST['category']) && !empty($_POST['brand']) && !empty($_POST['model'])){
        $category = $_POST['category'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $quantity = $_POST['quantity'];
        $condition = $_POST['condition'];
        if(empty($_POST['details'])){
            $connection = mysqli_connect('localhost','root','','shop_inventory');
            $sql_add_data = "INSERT INTO devices (id, category, brand, model, quantity, condit) VALUES (NULL, '$category', '$brand', '$model', '$quantity', '$condition')";
            $query_insert = mysqli_query($connection, $sql_add_data);
            $close = mysqli_close($connection);
        }else{
            $details = $_POST['details'];
            $connection = mysqli_connect('localhost','root','','shop_inventory');
            $sql_add_data = "INSERT INTO devices (id, category, brand, model, quantity, condit, details) VALUES (NULL, '$category', '$brand', '$model', '$quantity', '$condition', '$details')";
            $query_insert = mysqli_query($connection, $sql_add_data);
            $close = mysqli_close($connection);
        };
    };
};
header("Location:index.php");
?>
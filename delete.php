<?php
if(isset($_POST['D_id']) && !empty($_POST['D_id']) && isset($_POST['D_confirm']) && !empty($_POST['D_confirm'])){
        if($_POST['D_confirm']==1){
            $id_detele = $_POST['D_id'];
            $connection = mysqli_connect('localhost','root','','shop_inventory');
            $sql_delete = "DELETE FROM devices WHERE devices.id = '$id_detele';";
            $query = mysqli_query($connection, $sql_delete);
            $close = mysqli_close($connection);
        };
    };
header("Location:index.php");
?>
<?php
session_start();
if(isset($_POST['D_id']) && !empty($_POST['D_id']) && isset($_POST['D_confirm']) && !empty($_POST['D_confirm'])){
        if($_POST['D_confirm']==1){
            $id_detele = $_POST['D_id'];
            $connection = mysqli_connect('localhost','root','','shop_inventory');
            $sql_img = "SELECT img FROM devices WHERE devices.id = '$id_detele';";
            $query_img = mysqli_query($connection, $sql_img);
            if(mysqli_num_rows($query_img) == 1){
                while($img = mysqli_fetch_assoc($query_img)){
                    $file = 'images/'.$img['img'];
                    if(file_exists($file)){
                        unlink($file);
                    };
                };
            };
            $sql_delete = "DELETE img FROM devices WHERE devices.id = '$id_detele';";
            $query_delete = mysqli_query($connection, $sql_delete);
            $close = mysqli_close($connection);
            $_SESSION['alert_type'] == 0;
            $_SESSION['alert'] = "The device has been successfully removed";
            header("Location:index.php");
        };
}else{
    header("Location:index.php");
};
?>
<?php
session_start();
if(isset($_POST['Dimg_id']) && !empty($_POST['Dimg_id']) && isset($_POST['Dimg_confirm']) && !empty($_POST['Dimg_confirm'])){
        if($_POST['Dimg_confirm']==1){
            $id_detele = $_POST['Dimg_id'];
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
            $sql_update = "UPDATE devices SET img = NULL WHERE devices.id = '$id_detele';";
            $query_update = mysqli_query($connection, $sql_update);
            $close = mysqli_close($connection);
            $_SESSION['alert_type'] == 0;
            $_SESSION['alert'] = "The image has been successfully deleted";
            header("Location:index.php");
        };
}else{
    header("Location:index.php");
};
?>
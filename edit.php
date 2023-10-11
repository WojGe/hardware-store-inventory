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
        if(empty($_POST['E_details']) && $_FILES['E_image']['size']>0){

            $file = $_FILES['E_image'];
            $fileName = $_FILES['E_image']['name'];
            $fileTmpName = $_FILES['E_image']['tmp_name'];
            $fileSize = $_FILES['E_image']['size'];
            $fileError = $_FILES['E_image']['error'];
            $fileType = $_FILES['E_image']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if($fileSize < 1000000){
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = "images/".$fileNameNew;
                        $connection = mysqli_connect('localhost','root','','shop_inventory');
                        $sql_img = "SELECT img FROM devices WHERE devices.id = '$id_update';";
                        $query_img = mysqli_query($connection, $sql_img);
                        if(mysqli_num_rows($query_img) == 1){
                            while($img = mysqli_fetch_assoc($query_img)){
                                $file = 'images/'.$img['img'];
                                if(file_exists($file)){
                                    unlink($file);
                                };
                            };
                        };
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $sql_edit_data = "UPDATE devices SET category = '$category', brand = '$brand', model = '$model', quantity = '$quantity', condit = '$condition', img = '$fileNameNew' WHERE devices.id = '$id_update'";
                        $query_update = mysqli_query($connection, $sql_edit_data);
                        $close = mysqli_close($connection);
                        $_SESSION['alert_type'] = 0;
                        $_SESSION['alert'] = "The device has been successfully edited";
                        header("Location:index.php");
                    }else{
                        $_SESSION['alert_type'] = 1;
                        $_SESSION['alert'] = "Your image file is too big! Try again with the smaller file.";
                        header("Location:index.php");
                    };
                }else{
                    $_SESSION['alert_type'] = 2;
                    $_SESSION['alert'] = "There was an error while uploading your file! Try again";
                    header("Location:index.php");
                };
            }else{
                $_SESSION['alert_type'] = 1;
                $_SESSION['alert'] = "You cannot upload an unsupported image file type! Try again with the other file.";
                header("Location:index.php");
            };
        }elseif(!empty($_POST['E_details']) && $_FILES['E_image']['size']<=0){
            $details = $_POST['E_details'];
            $connection = mysqli_connect('localhost','root','','shop_inventory');
            $sql_edit_data = "UPDATE devices SET category = '$category', brand = '$brand', model = '$model', quantity = '$quantity', condit = '$condition', details = '$details' WHERE devices.id = '$id_update'";
            $query_update = mysqli_query($connection, $sql_edit_data);
            $close = mysqli_close($connection);
            $_SESSION['alert_type'] = 0;
            $_SESSION['alert'] = "The device has been successfully edited";
            header("Location:index.php");
        }elseif(empty($_POST['E_details']) && $_FILES['E_image']['size']<=0){
            $connection = mysqli_connect('localhost','root','','shop_inventory');
            $sql_edit_data = "UPDATE devices SET category = '$category', brand = '$brand', model = '$model', quantity = '$quantity', condit = '$condition' WHERE devices.id = '$id_update'";
            $query_update = mysqli_query($connection, $sql_edit_data);
            $close = mysqli_close($connection);
            $_SESSION['alert_type'] = 0;
            $_SESSION['alert'] = "The device has been successfully edited";
            header("Location:index.php");
        }elseif(!empty($_POST['E_details']) && $_FILES['E_image']['size']>0){
            $details = $_POST['E_details'];
            $file = $_FILES['E_image'];
            $fileName = $_FILES['E_image']['name'];
            $fileTmpName = $_FILES['E_image']['tmp_name'];
            $fileSize = $_FILES['E_image']['size'];
            $fileError = $_FILES['E_image']['error'];
            $fileType = $_FILES['E_image']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if($fileSize < 1000000){
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = "images/".$fileNameNew;
                        $connection = mysqli_connect('localhost','root','','shop_inventory');
                        $sql_img = "SELECT img FROM devices WHERE devices.id = '$id_update';";
                        $query_img = mysqli_query($connection, $sql_img);
                        if(mysqli_num_rows($query_img) == 1){
                            while($img = mysqli_fetch_assoc($query_img)){
                                $file = 'images/'.$img['img'];
                                if(file_exists($file)){
                                    unlink($file);
                                };
                            };
                        };
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $sql_edit_data = "UPDATE devices SET category = '$category', brand = '$brand', model = '$model', quantity = '$quantity', condit = '$condition', details = '$details', img = '$fileNameNew' WHERE devices.id = '$id_update'";
                        $query_update = mysqli_query($connection, $sql_edit_data);
                        $close = mysqli_close($connection);
                        $_SESSION['alert_type'] = 0;
                        $_SESSION['alert'] = "The device has been successfully edited";
                        header("Location:index.php");
                    }else{
                        $_SESSION['alert_type'] = 1;
                        $_SESSION['alert'] = "Your image file is too big! Try again with the smaller file.";
                        header("Location:index.php");
                    };
                }else{
                    $_SESSION['alert_type'] = 2;
                    $_SESSION['alert'] = "There was an error while uploading your file! Try again";
                    header("Location:index.php");
                };
            }else{
                $_SESSION['alert_type'] = 1;
                $_SESSION['alert'] = "You cannot upload an unsupported image file type! Try again with the other file.";
                header("Location:index.php");
            };
        }else{
            $_SESSION['alert_type'] = 2;
            $_SESSION['alert'] = "An unexpected error occurred! Try again";
            header("Location:index.php");
        };
    };
}else{
    $_SESSION['alert_type'] = 2;
    $_SESSION['alert'] = "An unexpected error occurred! Try again";
    header("Location:index.php");
};
?>
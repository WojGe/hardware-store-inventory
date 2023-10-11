<?php
session_start();
if(isset($_POST['category']) && isset($_POST['brand']) && isset($_POST['model'])){
    if(!empty($_POST['category']) && !empty($_POST['brand']) && !empty($_POST['model'])){
        $category = $_POST['category'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $quantity = $_POST['quantity'];
        $condition = $_POST['condition'];
        if(empty($_POST['details']) && $_FILES['image']['size']>0){

            $file = $_FILES['image'];
            $fileName = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];
            $fileError = $_FILES['image']['error'];
            $fileType = $_FILES['image']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if($fileSize < 1000000){
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = "images/".$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $connection = mysqli_connect('localhost','root','','shop_inventory');
                        $sql_add_data = "INSERT INTO devices (id, category, brand, model, quantity, condit, details, img) VALUES (NULL, '$category', '$brand', '$model', '$quantity', '$condition', NULL, '$fileNameNew')";
                        $query_insert = mysqli_query($connection, $sql_add_data);
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
        }elseif(!empty($_POST['details']) && $_FILES['image']['size']<=0){
            $details = $_POST['details'];
            $connection = mysqli_connect('localhost','root','','shop_inventory');
            $sql_add_data = "INSERT INTO devices (id, category, brand, model, quantity, condit, details, img) VALUES (NULL, '$category', '$brand', '$model', '$quantity', '$condition', '$details', NULL)";
            $query_insert = mysqli_query($connection, $sql_add_data);
            $close = mysqli_close($connection);
            $_SESSION['alert_type'] = 0;
            $_SESSION['alert'] = "The device has been successfully added";
            header("Location:index.php");
        }elseif(empty($_POST['details']) && $_FILES['image']['size']<=0){
            $connection = mysqli_connect('localhost','root','','shop_inventory');
            $sql_add_data = "INSERT INTO devices (id, category, brand, model, quantity, condit, details, img) VALUES (NULL, '$category', '$brand', '$model', '$quantity', '$condition', NULL, NULL)";
            $query_insert = mysqli_query($connection, $sql_add_data);
            $close = mysqli_close($connection);
            $_SESSION['alert_type'] = 0;
            $_SESSION['alert'] = "The device has been successfully added";
            header("Location:index.php");
        }elseif(!empty($_POST['details']) && $_FILES['image']['size']>0){
            $details = $_POST['details'];
            $file = $_FILES['image'];
            $fileName = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];
            $fileError = $_FILES['image']['error'];
            $fileType = $_FILES['image']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if($fileSize < 1000000){
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = "images/".$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $connection = mysqli_connect('localhost','root','','shop_inventory');
                        $sql_add_data = "INSERT INTO devices (id, category, brand, model, quantity, condit, details, img) VALUES (NULL, '$category', '$brand', '$model', '$quantity', '$condition', '$details', '$fileNameNew')";
                        $query_insert = mysqli_query($connection, $sql_add_data);
                        $close = mysqli_close($connection);
                        $_SESSION['alert_type'] = 0;
                        $_SESSION['alert'] = "The device has been successfully added";
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
<?php
    header("Access-Control-Allow-Origin: *");
    $mysqli = new mysqli("localhost", "root", "", "80rent");
    $mysqli->set_charset("utf8mb4");
    if(isset($_POST['operation']) && isset($_POST['id'])){
        switch($_POST['operation']){
            case "activate":
                $sql = "UPDATE `users` SET active = 1 WHERE id = ".$_POST['id'];
                $result = $mysqli->query($sql);
                echo json_encode("ok");
                break;
            case "moderate":
                $sql = "UPDATE `users` SET `permissions` = 'moderator' WHERE id = ".$_POST['id'];
                $result = $mysqli->query($sql);
                echo json_encode("ok");
                break;
        }
    }
?>
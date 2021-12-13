<?php
    header("Access-Control-Allow-Origin: *");
    $mysqli = new mysqli("localhost", "root", "", "80rent");
    $mysqli->set_charset("utf8mb4");
    if(isset($_POST['operation']) && isset($_POST['id'])){
        switch($_POST['operation']){
            case "accept":
                $sql = "UPDATE `reservations` SET status_id = 1 WHERE id = ".$_POST['id'];
                $result = $mysqli->query($sql);
                echo json_encode("ok");
                break;
            case "update":
                if(isset($_POST['date_start']) && isset($_POST['date_end'])){
                    $sql = "UPDATE `reservations` SET date_start = '".$_POST['date_start']."', date_stop = '".$_POST['date_end']."' WHERE id = ".$_POST['id'];
                    $result = $mysqli->query($sql);
                    echo json_encode($sql);
                }
                break;
            case "cancel":
                $sql = "UPDATE `reservations` SET status_id = 2 WHERE id = ".$_POST['id'];
                $result = $mysqli->query($sql);
                echo json_encode("ok");
                break;
        }
    }
?>
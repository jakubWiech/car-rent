<?php
    header("Access-Control-Allow-Origin: *");
    $mysqli = new mysqli("localhost", "root", "", "80rent");
    if($mysqli->connect_error) {
        exit('Error connecting to database'); //Should be a message a typical user could understand in production
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli->set_charset("utf8mb4");
    $sql = "SELECT * FROM `users` WHERE `permissions` = 'user'";
    $result = $mysqli->query($sql);
    $res = array();
    while($row = mysqli_fetch_assoc($result)){
        $res[] = $row;
    }
    echo json_encode($res);
?>
<?php
    header("Access-Control-Allow-Origin: *");
    if(isset($_POST['start']) && isset($_POST['end']) && isset($_POST['car']) && isset($_POST['user']) && isset($_POST['price'])){
        $conn = new mysqli("localhost", "root", "", "80rent");
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "INSERT INTO reservations(`user_id`, `car_id`, `date_start`, `date_stop`, `status_id`, `price`) VALUES (".$_POST['user'].",".$_POST['car'].",".$_POST['start'].",".$_POST['end'].",2,".intval($_POST['price']).")";
        $result = $conn->query($sql);
        echo json_encode("ok");
    }
?>
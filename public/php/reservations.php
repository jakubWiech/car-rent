<?php
    header("Access-Control-Allow-Origin: *");
    if(isset($_POST['start']) && isset($_POST['end'])){
        $conn = new mysqli("localhost", "root", "", "80rent");
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM reservations WHERE date_start BETWEEN '".$_POST['start']."' AND '".$_POST['end']." AND date_end BEETWEEN ".$_POST['start']."' AND '".$_POST['end']."'";
        $result = $conn->query($sql);
        $array=array();
        while($row = mysqli_fetch_assoc($result)){
            $array[] = $row;
        }
        echo json_encode($array);
    }
?>
<?php
    header("Access-Control-Allow-Origin: *");
    if(isset($_POST['login']) && isset($_POST['pass'])){

        $mysqli = new mysqli("localhost", "root", "", "80rent");
        if($mysqli->connect_error) {
            exit('Error connecting to database'); //Should be a message a typical user could understand in production
        }
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $mysqli->set_charset("utf8mb4");
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->bind_param("s", $_POST['login']);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0){
            echo json_encode("incorrect");
        }else{
            $row = $result->fetch_assoc();
            if(password_verify($_POST['pass'], $row['password'])){
                $response['status'] = "success";
                $response['id'] = $row['id'];
                $response['permissions'] = $row['permissions'];
                if($row['active']){
                    echo json_encode($response);
                }else{
                    echo json_encode("not active");
                }
                
            }
        }
    }else{
        echo json_encode("error");
    }
?>
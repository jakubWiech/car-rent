<?php
    header("Access-Control-Allow-Origin: *");
    if(isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['reg'])){

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
            $stmt = $mysqli->prepare("INSERT INTO users (`login`, `password`, `permissions`) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $_POST['login'], $pass, $perm);
            $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $perm = "user";
            $stmt->execute();
            echo json_encode("success");
        }else{
            echo json_encode("user exists");
        }
    }else{
        echo json_encode("error");
    }
?>
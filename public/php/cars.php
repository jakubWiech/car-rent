<?php
        header("Access-Control-Allow-Origin: *");
        $conn = new mysqli("localhost", "root", "", "80rent");
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT cars.id, cars.price, cars.brand_id, cars.model_id, cars.engine_id, cars.mileage, cars.year, cars.image, cars.description, brands.brand, models.model, engines.capacity, engines.code, engines.power, fuel.type FROM cars INNER JOIN brands ON cars.brand_id = brands.id INNER JOIN models ON cars.model_id = models.id INNER JOIN engines ON cars.engine_id = engines.id INNER JOIN fuel ON engines.fuel_id = fuel.id";
        $result = $conn->query($sql);
        $array=array();
        while($row = mysqli_fetch_assoc($result)){
            $array[] = $row;
        }
        echo json_encode($array);
?>
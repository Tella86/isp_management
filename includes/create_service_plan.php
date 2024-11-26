<?php
include 'db.php';

try {
    $plan_name = $_POST['plan_name'];
    $plan_cost = $_POST['plan_cost'];
    $plan_speed = $_POST['plan_speed'];
    $data_limit = $_POST['data_limit'];

    $sql = "INSERT INTO service_plans (plan_name, plan_cost, plan_speed, data_limit) 
            VALUES ('$plan_name', '$plan_cost', '$plan_speed', '$data_limit')";

    if (!$conn->query($sql)) {
        throw new Exception("Insert failed: " . $conn->error);
    }

    echo "Service Plan added successfully.";
} catch (Exception $e) {
    http_response_code(500);
    echo $e->getMessage();
}
?>

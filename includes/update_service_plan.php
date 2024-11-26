<?php
include 'db.php';

try {
    $id = $_POST['id'];
    $plan_name = $_POST['plan_name'];
    $plan_cost = $_POST['plan_cost'];
    $plan_speed = $_POST['plan_speed'];
    $data_limit = $_POST['data_limit'];

    $sql = "UPDATE service_plans 
            SET plan_name = '$plan_name', plan_cost = '$plan_cost', 
                plan_speed = '$plan_speed', data_limit = '$data_limit'
            WHERE id = $id";

    if (!$conn->query($sql)) {
        throw new Exception("Update failed: " . $conn->error);
    }

    echo "Service Plan updated successfully.";
} catch (Exception $e) {
    http_response_code(500);
    echo $e->getMessage();
}
?>

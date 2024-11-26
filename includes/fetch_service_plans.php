<?php
include 'db.php';

try {
    // Fetch available service plans
    $sql = "SELECT id, plan_name, data_limit, data_limit, plan_cost, plan_speed FROM service_plans";
    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception('Database query failed: ' . $conn->error);
    }

    $servicePlans = [];
    while ($row = $result->fetch_assoc()) {
        $servicePlans[] = $row;
    }

    // Return as JSON
    header('Content-Type: application/json');
    echo json_encode($servicePlans);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>

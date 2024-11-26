<?php
include 'db.php';

// Debugging: Enable error reporting during development
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Fetch customer details with service plan info
    $sql = "SELECT 
                c.id, 
                c.name, 
                c.email, 
                c.phone, 
                c.address, 
                c.service_plan_id, 
                s.plan_name 
            FROM customers c
            LEFT JOIN service_plans s ON c.service_plan_id = s.id";

    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception('Query failed: ' . $conn->error);
    }

    $customers = [];
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($customers);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>

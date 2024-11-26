<?php
include 'db.php';

// Query to fetch customer details along with service plan names
$sql = "SELECT 
            c.id, 
            c.name, 
            c.email, 
            c.phone, 
            c.address, 
            c.created_at, 
            s.plan_name, 
            s.plan_cost, 
            s.plan_speed, 
            s.data_limit
        FROM customers c
        LEFT JOIN service_plans s ON c.service_plan_id = s.id";

$result = $conn->query($sql);

$customers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($customers);
?>

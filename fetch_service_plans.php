<?php
include 'db.php';

// Fetch all service plans
$sql = "SELECT id, plan_name FROM service_plans";
$result = $conn->query($sql);

$servicePlans = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $servicePlans[] = $row;
    }
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($servicePlans);
?>

<?php
include 'db.php';

$sql = "SELECT c.*, s.plan_name 
        FROM customers c 
        LEFT JOIN service_plans s ON c.service_plan_id = s.id";
$result = $conn->query($sql);

$customers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}

echo json_encode($customers);
?>

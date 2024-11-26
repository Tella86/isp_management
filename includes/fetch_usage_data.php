<?php
// fetch_usage_data.php
include 'db.php';

// Get the customer ID (or other parameters) from the request
$customerId = $_GET['customerId'] ?? 1;  // Default to 1 if no customer ID provided

// Fetch usage data from the database
$sql = "SELECT date, data_usage, speed FROM usage_data WHERE customer_id = ? ORDER BY date DESC LIMIT 7";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customerId);
$stmt->execute();
$result = $stmt->get_result();

$usageData = [];
while ($row = $result->fetch_assoc()) {
    $usageData[] = $row;
}

// Convert data to format compatible with the frontend
$labels = [];
$dataUsage = [];
$speed = [];

foreach ($usageData as $data) {
    $labels[] = $data['date'];
    $dataUsage[] = $data['data_usage'];  // Assuming data_usage is in MB
    $speed[] = $data['speed'];  // Assuming speed is in Mbps
}

// Return the data as JSON
echo json_encode([
    'labels' => $labels,
    'dataUsage' => $dataUsage,
    'speed' => $speed
]);
?>

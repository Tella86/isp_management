<?php
include 'db.php';

$sql = "SELECT id, name FROM customers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $servicePlans = [];
    while ($row = $result->fetch_assoc()) {
        $servicePlans[] = $row;
    }
    echo json_encode($servicePlans);
} else {
    echo json_encode([]);
}

$conn->close();
?>


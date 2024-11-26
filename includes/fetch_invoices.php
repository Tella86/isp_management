<?php
include 'db.php';

try {
    $sql = "SELECT i.id, i.invoice_date, i.due_date, i.total_amount, i.status, c.name AS customer_name 
            FROM invoices i
            JOIN customers c ON i.customer_id = c.id";
    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Query failed: " . $conn->error);
    }

    $invoices = [];
    while ($row = $result->fetch_assoc()) {
        $invoices[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($invoices);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>

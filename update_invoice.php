<?php
include 'db.php';

try {
    $invoice_id = $_POST['invoice_id'];
    $status = $_POST['status']; // 'Paid', 'Unpaid', 'Overdue'

    $sql = "UPDATE invoices SET status = '$status' WHERE id = '$invoice_id'";

    if (!$conn->query($sql)) {
        throw new Exception("Update failed: " . $conn->error);
    }

    echo "Invoice updated successfully.";
} catch (Exception $e) {
    http_response_code(500);
    echo $e->getMessage();
}
?>

<?php
include 'db.php';

try {
    $invoice_id = $_POST['invoice_id'];

    // Delete invoice items first to maintain integrity
    $sql = "DELETE FROM invoice_items WHERE invoice_id = '$invoice_id'";
    if (!$conn->query($sql)) {
        throw new Exception("Delete invoice items failed: " . $conn->error);
    }

    // Delete the invoice
    $sql = "DELETE FROM invoices WHERE id = '$invoice_id'";
    if (!$conn->query($sql)) {
        throw new Exception("Delete invoice failed: " . $conn->error);
    }

    echo "Invoice deleted successfully.";
} catch (Exception $e) {
    http_response_code(500);
    echo $e->getMessage();
}
?>

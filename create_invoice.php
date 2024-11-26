<?php
include 'db.php';

try {
    // Get POST data
    $customer_id = $_POST['customer_id'];
    $invoice_date = $_POST['invoice_date'];
    $due_date = $_POST['due_date'];
    $items = $_POST['items']; // Array of items (description, quantity, unit_price)

    // Insert invoice
    $sql = "INSERT INTO invoices (customer_id, invoice_date, due_date, total_amount, status) 
            VALUES ('$customer_id', '$invoice_date', '$due_date', 0, 'Unpaid')";
    if (!$conn->query($sql)) {
        throw new Exception("Insert invoice failed: " . $conn->error);
    }

    $invoice_id = $conn->insert_id;
    $total_amount = 0;

    // Insert invoice items and calculate total amount
    foreach ($items as $item) {
        $description = $item['description'];
        $quantity = $item['quantity'];
        $unit_price = $item['unit_price'];
        $amount = $quantity * $unit_price;

        $sql = "INSERT INTO invoice_items (invoice_id, description, quantity, unit_price, amount) 
                VALUES ('$invoice_id', '$description', '$quantity', '$unit_price', '$amount')";
        if (!$conn->query($sql)) {
            throw new Exception("Insert invoice item failed: " . $conn->error);
        }

        $total_amount += $amount;
    }

    // Update invoice total amount
    $sql = "UPDATE invoices SET total_amount = '$total_amount' WHERE id = '$invoice_id'";
    if (!$conn->query($sql)) {
        throw new Exception("Update invoice total failed: " . $conn->error);
    }

    echo "Invoice created successfully.";
} catch (Exception $e) {
    http_response_code(500);
    echo $e->getMessage();
}
?>

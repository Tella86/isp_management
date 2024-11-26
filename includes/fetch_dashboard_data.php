<?php
include 'db.php';

// Fetch total number of customers
$sql = "SELECT COUNT(*) AS total_customers FROM customers";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $totalCustomers = $row['total_customers'];
} else {
    $totalCustomers = 0;
}

// Fetch total payments
$sql = "SELECT SUM(amount) AS total_payments FROM payments";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $totalPayments = $row['total_payments'];
} else {
    $totalPayments = 0;
}

// Fetch total data usage
$sql = "SELECT SUM(data_usage) AS total_usage FROM usage_data";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $totalUsage = $row['total_usage'];
} else {
    $totalUsage = 0;
}

// Fetch total revenue
$sql = "SELECT SUM(amount) AS total_revenue FROM payments WHERE payment_status = 'completed'";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $totalRevenue = $row['total_revenue'];
} else {
    $totalRevenue = 0;
}

// Fetch overdue invoices
$sql = "SELECT COUNT(*) AS overdue_invoices FROM invoices WHERE due_date < CURDATE() AND status != 'paid'";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $overdueInvoices = $row['overdue_invoices'];
} else {
    $overdueInvoices = 0;
}

// Check for system issues (e.g., if any servers are down or other issues)
$systemIssue = false;
$sql = "SELECT * FROM system_status WHERE status = 'down'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $systemIssue = true;
}

// Return data as JSON
echo json_encode([
    'totalCustomers' => $totalCustomers,
    'totalPayments' => $totalPayments,
    'totalUsage' => $totalUsage,
    'totalRevenue' => $totalRevenue,
    'overdueInvoices' => $overdueInvoices,
    'systemIssue' => $systemIssue
]);

// Close the database connection
$conn->close();
?>

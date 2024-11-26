<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $issue_description = $_POST['issue_description'];

    $sql = "INSERT INTO tickets (customer_name, email, issue_description) VALUES ('$customer_name', '$email', '$issue_description')";

    if ($conn->query($sql) === TRUE) {
        echo "Ticket created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

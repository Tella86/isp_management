<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ticket_id = $_POST['ticket_id'];
    $status = $_POST['status'];

    $sql = "UPDATE tickets SET status='$status' WHERE id=$ticket_id";

    if ($conn->query($sql) === TRUE) {
        echo "Ticket status updated successfully!";
    } else {
        echo "Error updating ticket: " . $conn->error;
    }
}
?>

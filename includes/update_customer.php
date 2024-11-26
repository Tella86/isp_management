<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $service_plan_id = $_POST['service_plan_id'];

    $sql = "UPDATE customers 
            SET name = ?, email = ?, phone = ?, address = ?, service_plan_id = ?
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $name, $email, $phone, $address, $service_plan_id, $id);

    if ($stmt->execute()) {
        echo "Customer updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

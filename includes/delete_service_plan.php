<?php
include 'db.php';

try {
    $id = $_POST['id'];

    $sql = "DELETE FROM service_plans WHERE id = $id";
    if (!$conn->query($sql)) {
        throw new Exception("Delete failed: " . $conn->error);
    }

    echo "Service Plan deleted successfully.";
} catch (Exception $e) {
    http_response_code(500);
    echo $e->getMessage();
}
?>

<?php
// set_usage_limit.php
include 'db.php';

// Get the form data (limit values)
$dataLimit = $_POST['dataLimit'];
$speedLimit = $_POST['speedLimit'];

// You can save these limits to the database or handle them as needed
// For demonstration, we are just returning a success message

echo "Data limit set to: {$dataLimit} MB, Speed limit set to: {$speedLimit} Mbps";
?>

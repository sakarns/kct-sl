<?php

// Include the database connection file
require_once 'connection.php';

// Check if the ID parameter is provided
if (!isset($_GET['id'])) {
    echo "ID parameter is missing.";
    exit();
}

$personId = $_GET['id'];

// Delete the record for the given ID
$query = "DELETE FROM people WHERE people_id = $personId";
$deleteResult = mysqli_query($connection, $query);

if ($deleteResult) {
    header('location:index.php');
} else {
    echo "Error deleting record: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);

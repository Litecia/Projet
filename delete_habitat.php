<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../database/connectBD.php';

// Check if an ID was provided in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid habitat ID.");
}

$habitat_id = intval($_GET['id']);

// Delete associated data in the comporte table
$deleteComporteQuery = $connect->query("DELETE FROM comporte WHERE habitat_id = $habitat_id");

if (!$deleteComporteQuery) {
    die("Error deleting associated data in comporte table: " . $connect->error);
}

// Delete associated data in the detient table
$deleteDetientQuery = $connect->query("DELETE FROM detient WHERE habitat_id = $habitat_id");

if (!$deleteDetientQuery) {
    die("Error deleting associated data in detient table: " . $connect->error);
}

// Delete the habitat
$deleteHabitatQuery = $connect->query("DELETE FROM habitat WHERE habitat_id = $habitat_id");

if ($deleteHabitatQuery) {
    echo "Habitat deleted successfully.";
    // Optionally redirect to another page or the updated list
    header("Location: ../index.php"); // Change to the appropriate page
    exit;
} else {
    echo "Error deleting habitat: " . $connect->error;
}

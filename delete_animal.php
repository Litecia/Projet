<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../database/connectBD.php';

// Check if an ID was provided in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid animal ID.");
}

$animal_id = intval($_GET['id']);

// Delete associated data in the detient table
$deleteDetientQuery = $connect->query("DELETE FROM detient WHERE animal_id = $animal_id");

if (!$deleteDetientQuery) {
    die("Error deleting associated data in detient table: " . $connect->error);
}

// Delete the animal
$deleteAnimalQuery = $connect->query("DELETE FROM animal WHERE animal_id = $animal_id");

if ($deleteAnimalQuery) {
    echo "Animal deleted successfully.";
    // Optionally redirect to another page or the updated list
    header("Location: ../index.php"); // Change to the appropriate page
    exit;
} else {
    echo "Error deleting animal: " . $connect->error;
}
?>

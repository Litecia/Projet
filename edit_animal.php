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

// Fetch animal data
$animalQuery = $connect->query("
    SELECT a.animal_id, a.prenom, a.etat, img.image_data AS animal_image
    FROM animal a
    JOIN image img ON a.image_id = img.image_id
    WHERE a.animal_id = $animal_id
");

if ($animalQuery->num_rows === 0) {
    die("Animal not found.");
}

$animal = $animalQuery->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $prenom = $connect->real_escape_string($_POST['prenom']);
    $etat = $connect->real_escape_string($_POST['etat']);
    $animal_image = $animal['animal_image'];

    // Check if a new image file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $animal_image = basename($_FILES['image']['name']);
        $target_dir = "../assets/images/";
        $target_file = $target_dir . $animal_image;

        // Move uploaded file to target directory
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            die("Error uploading image file.");
        }
    }

    // Update animal data
    $updateQuery = $connect->query("
        UPDATE animal
        SET prenom = '$prenom', etat = '$etat'
        WHERE animal_id = $animal_id
    ");

    // Update image data
    $updateImageQuery = true; // default to true in case no new image was uploaded
    if ($animal_image !== $animal['animal_image']) {
        $updateImageQuery = $connect->query("
            UPDATE image
            SET image_data = '$animal_image'
            WHERE image_id = (
                SELECT image_id
                FROM animal
                WHERE animal_id = $animal_id
            )
        ");
    }

    if ($updateQuery && $updateImageQuery) {
        echo "Animal updated successfully.";
        // Optionally redirect to another page or the updated list
        header("Location: ../index.php"); // Change to the appropriate page
        exit;
    } else {
        echo "Error updating animal: " . $connect->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Animal</title>
</head>
<body>
    <h1>Edit Animal</h1>
    <form method="post" action="" enctype="multipart/form-data">
        <div>
            <label for="prenom">Name:</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($animal['prenom']); ?>" required>
        </div>
        <div>
            <label for="etat">State:</label>
            <textarea type="text" id="etat" name="etat" required><?php echo htmlspecialchars($animal['etat']); ?></textarea>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
            <p>Current image: <img src="../assets/images/<?php echo htmlspecialchars($animal['animal_image']); ?>" alt="animal image" width="100"></p>
        </div>
        <div>
            <button type="submit">>modifier l'animal</button>
        </div>
    </form>
</body>
</html>

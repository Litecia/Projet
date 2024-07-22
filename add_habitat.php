<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../database/connectBD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $nom = $connect->real_escape_string($_POST['nom']);
    $description = $connect->real_escape_string($_POST['description']);
    $commentaire_habitat = $connect->real_escape_string($_POST['commentaire_habitat']);
    
    // Check if a video file is uploaded
    if (isset($_FILES['video']) && $_FILES['video']['error'] == UPLOAD_ERR_OK) {
        $video_name = basename($_FILES['video']['name']);
        $target_dir = "../assets/videos/";
        $target_file = $target_dir . $video_name;

        // Move uploaded file to target directory
        if (!move_uploaded_file($_FILES['video']['tmp_name'], $target_file)) {
            die("Error uploading video file.");
        }
    } else {
        die("No video file uploaded.");
    }

    // Insert image data
    $insertImageQuery = $connect->query("
        INSERT INTO image (image_data)
        VALUES ('$video_name')
    ");

    if ($insertImageQuery) {
        $image_id = $connect->insert_id;

        // Insert habitat data
        $insertHabitatQuery = $connect->query("
            INSERT INTO habitat (nom, description, commentaire_habitat)
            VALUES ('$nom', '$description', '$commentaire_habitat')
        ");

        if ($insertHabitatQuery) {
            $habitat_id = $connect->insert_id;

            // Link habitat with image
            $insertComporteQuery = $connect->query("
                INSERT INTO comporte (habitat_id, image_id)
                VALUES ($habitat_id, $image_id)
            ");

            if ($insertComporteQuery) {
                echo "Habitat added successfully.";
                // Optionally redirect to another page or the updated list
                header("Location: ../index.php"); // Change to the appropriate page
                exit;
            } else {
                echo "Error linking habitat with image: " . $connect->error;
            }
        } else {
            echo "Error inserting habitat: " . $connect->error;
        }
    } else {
        echo "Error inserting image: " . $connect->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Habitat</title>
</head>
<body>
    <h1>Add Habitat</h1>
    <form method="post" action="" enctype="multipart/form-data">
        <div>
            <label for="nom">Name:</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div>
            <label for="commentaire_habitat">Comments:</label>
            <textarea id="commentaire_habitat" name="commentaire_habitat" required></textarea>
        </div>
        <div>
            <label for="video">Video:</label>
            <input type="file" id="video" name="video" required>
        </div>
        <div>
            <button type="submit">Ajouter l'Habitat</button>
        </div>
    </form>
</body>
</html>

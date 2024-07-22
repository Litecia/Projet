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

// Fetch habitat data
$habitatQuery = $connect->query("
    SELECT h.habitat_id, h.nom, h.description, h.commentaire_habitat, img.image_data AS video_name
    FROM habitat h
    JOIN comporte c ON h.habitat_id = c.habitat_id
    JOIN image img ON c.image_id = img.image_id
    WHERE h.habitat_id = $habitat_id
");

if ($habitatQuery->num_rows === 0) {
    die("Habitat not found.");
}

$habitat = $habitatQuery->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $nom = $connect->real_escape_string($_POST['nom']);
    $description = $connect->real_escape_string($_POST['description']);
    $commentaire_habitat = $connect->real_escape_string($_POST['commentaire_habitat']);
    $video_name = $habitat['video_name'];

    // Check if a new video file is uploaded
    if (isset($_FILES['video']) && $_FILES['video']['error'] == UPLOAD_ERR_OK) {
        $video_name = basename($_FILES['video']['name']);
        $target_dir = "../assets/videos/";
        $target_file = $target_dir . $video_name;

        // Move uploaded file to target directory
        if (!move_uploaded_file($_FILES['video']['tmp_name'], $target_file)) {
            die("Error uploading video file.");
        }
    }

    // Update habitat data
    $updateQuery = $connect->query("
        UPDATE habitat
        SET nom = '$nom', description = '$description', commentaire_habitat = '$commentaire_habitat'
        WHERE habitat_id = $habitat_id
    ");

    // Update image data
    $updateImageQuery = true; // default to true in case no new video was uploaded
    if ($video_name !== $habitat['video_name']) {
        $updateImageQuery = $connect->query("
            UPDATE image
            JOIN comporte c ON image.image_id = c.image_id
            SET image_data = '$video_name'
            WHERE c.habitat_id = $habitat_id
        ");
    }

    if ($updateQuery && $updateImageQuery) {
        echo "Habitat updated successfully.";
        // Optionally redirect to another page or the updated list
        header("Location: ../index.php"); // Change to the appropriate page
        exit;
    } else {
        echo "Error updating habitat: " . $connect->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Habitat</title>
</head>
<body>
    <h1>Edit Habitat</h1>
    <form method="post" action="" enctype="multipart/form-data">
        <div>
            <label for="nom">Name:</label>
            <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($habitat['nom']); ?>" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($habitat['description']); ?></textarea>
        </div>
        <div>
            <label for="commentaire_habitat">Comments:</label>
            <textarea id="commentaire_habitat" name="commentaire_habitat" required><?php echo htmlspecialchars($habitat['commentaire_habitat']); ?></textarea>
        </div>
        <div>
            <label for="video">Video:</label>
            <input type="file" id="video" name="video">
            <p>Current video: <?php echo htmlspecialchars($habitat['video_name']); ?></p>
        </div>
        <div>
            <button type="submit">modifier l'habitat</button>
        </div>
    </form>
</body>
</html>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../database/connectBD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $prenom = $connect->real_escape_string($_POST['prenom']);
    $etat = $connect->real_escape_string($_POST['etat']);
    $habitat_id = intval($_POST['habitat_id']);
    
    // Check if an image file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image_name = basename($_FILES['image']['name']);
        $target_dir = "../assets/images/";
        $target_file = $target_dir . $image_name;

        // Move uploaded file to target directory
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            die("Error uploading image file.");
        }
    } else {
        die("No image file uploaded.");
    }

    // Insert image data
    $insertImageQuery = $connect->query("
        INSERT INTO image (image_data)
        VALUES ('$image_name')
    ");

    if ($insertImageQuery) {
        $image_id = $connect->insert_id;

        // Insert animal data
        $insertAnimalQuery = $connect->query("
            INSERT INTO animal (prenom, etat, image_id)
            VALUES ('$prenom', '$etat', $image_id)
        ");

        if ($insertAnimalQuery) {
            $animal_id = $connect->insert_id;

            // Link animal with habitat
            $insertDetientQuery = $connect->query("
                INSERT INTO detient (animal_id, habitat_id)
                VALUES ($animal_id, $habitat_id)
            ");

            if ($insertDetientQuery) {
                echo "Animal added successfully.";
                // Optionally redirect to another page or the updated list
                header("Location: ../index.php"); // Change to the appropriate page
                exit;
            } else {
                echo "Error linking animal with habitat: " . $connect->error;
            }
        } else {
            echo "Error inserting animal: " . $connect->error;
        }
    } else {
        echo "Error inserting image: " . $connect->error;
    }
}
// Fetch all habitats for the dropdown
$habitatQuery = $connect->query("SELECT habitat_id, nom FROM habitat");
$habitats = [];
while ($row = $habitatQuery->fetch_assoc()) {
    $habitats[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Animal</title>
</head>
<body>
    <h1>Add Animal</h1>
    <form method="post" action="" enctype="multipart/form-data">
        <div>
            <label for="prenom">Name:</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div>
            <label for="etat">State:</label>
            <input type="text" id="etat" name="etat" required>
        </div>
        <div>
            <label for="habitat_id">Habitat:</label>
            <select id="habitat_id" name="habitat_id" required>
                <?php foreach ($habitats as $habitat): ?>
                    <option value="<?php echo htmlspecialchars($habitat['habitat_id']); ?>"><?php echo htmlspecialchars($habitat['nom']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" required>
        </div>
        <div>
            <button type="submit">Add Animal</button>
        </div>
    </form>
</body>
</html>

<?php
include './database/connectBD.php';

session_start();

// Check if the role exists in the session
if (isset($_SESSION['role'])) {
    $role_session = $_SESSION['role'];
} else {
    $role_session = 'Visiteur'; // Default role
}


// Fetch all habitats and their associated videos
$habitatQuery = $connect->query("
        SELECT h.habitat_id, h.nom AS habitat_nom, h.description, h.commentaire_habitat, img.image_data AS video_name
        FROM habitat h
        JOIN comporte c ON h.habitat_id = c.habitat_id
        JOIN image img ON c.image_id = img.image_id
    ");

// Initialize habitats array
$habitats = [];
while ($row = $habitatQuery->fetch_assoc()) {
    $habitats[$row['habitat_id']] = $row;
    $habitats[$row['habitat_id']]['animals'] = [];
};

// Fetch all animals associated with each habitat
$animalQuery = $connect->query("
        SELECT a.animal_id, a.prenom, a.etat, img.image_data AS animal_image, d.habitat_id
        FROM animal a
        JOIN image img ON a.image_id = img.image_id
        JOIN detient d ON a.animal_id = d.animal_id
    ");

while ($row = $animalQuery->fetch_assoc()) {
    $habitats[$row['habitat_id']]['animals'][] = $row;
};

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/CSS/index.css">
    <script src="./app/index.js" defer></script>
    <title>ARCADIA</title>
</head>

<body>
    <header>
    <?php if (isset($role_session)) { ?>
        <div class="session_value"><?php echo $role_session?></div>
    <?php } ?>
        <div class="container">
            <div class="logo"><img src="./assets/icons/logo.PNG" alt="logo fo ARCADIA zoo"></div>
            <div class="nav_bar">

                <a href="index.php">Acceuil</a>
                <a href="">Services</a>
                <a href="#habitat_page">Habitats</a>
                <a href="">Contact</a>
                <select name="login" id="login">
                    <option id="visiteur_btn" value="Visiteur" <?php echo ($role_session == 'Visiteur') ? 'selected' : ''; ?>>Visiteur</option>
                    <option id="veterinaire_btn" value="veterinaire" <?php echo ($role_session == 'veterinaire') ? 'selected' : ''; ?>>Vétérinaires</option>
                    <option id="employés_btn" value="employés" <?php echo ($role_session == 'employés') ? 'selected' : ''; ?>>Employés</option>
                    <option id="Admin_btn" value="Admin" <?php echo ($role_session == 'Admin') ? 'selected' : ''; ?>>Administrateurs</option>
                    <option id="logout" value="logout">deconnecter</option>
                </select>
                <span><img src="./assets/icons/stat_minus_1.svg" width="30" height="30" alt=""></span>

            </div>
        </div>

    </header>
    <section class="main_section">
        <div class="background">
            <video autoplay loop muted>
                <source src="./assets/videos/main_page_video.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <article>
            <div class="title">
                <h1>ARCADIA</h1>
            </div>
            <div class="parag">
                <p>
                    Bienvenue au zoo d’Arcadia ,un véritable havre de biodiversité et d’émerveillement situé en France près de la foret Brocéliande ,en bretagne .fondé en 1960,notre zoo abrite une diversité impressionnante d’animaux venus des quartes coins du monde, chaque habitat est conçu pour recréer au mieux les conditions adéquates de chaque animal ,garantissant leur bien être et leurs confort ,y compris la savane africaine vibrante , l’introspection dense de la jungle et les zoo tranquilles des marais.
                </p>
            </div>
        </article>
    </section>

    <section class="habitat_section" id="habitat_page">
        <div class="habitat_title">
            <h1>nos habitats</h1>
        </div>
        <?php foreach ($habitats as $habitat) : ?>
            <div class="habitat_content">
                <article>
                    <div class="img">
                        <video autoplay loop muted>
                            <source src="./assets/videos/<?php echo htmlspecialchars($habitat['video_name']); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="nom"><?php echo htmlspecialchars($habitat['habitat_nom']); ?></div>
                    <div class="description"><?php echo htmlspecialchars($habitat['description']); ?></div>
                    <div class="commentaire"><?php echo htmlspecialchars($habitat['commentaire_habitat']); ?></div>
                </article>
                <div class="list_animal">
                    <?php foreach ($habitat['animals'] as $animal) : ?>
                        <div class="animal_content">
                            <div class="img">
                                <img src="./assets/images/<?php echo htmlspecialchars($animal['animal_image']); ?>" alt="">
                            </div>
                            <div class="details">
                                <div class="prenom"><?php echo htmlspecialchars($animal['prenom']); ?></div>
                                <div class="etat"><?php echo htmlspecialchars($animal['etat']); ?></div>
                                <a href="admin/edit_animal.php?id=<?php echo htmlspecialchars($animal['animal_id']); ?>" class="modify_animal">modifier l'animal</a>
                                <a href="admin/add_animal.php" class="add_animal">ajouter l'animal</a>
                                <a href="admin/delete_animal.php?id=<?php echo htmlspecialchars($animal['animal_id']); ?>" class="delete_animal">suprimer l'animal</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="admin/edit_habitat.php?id=<?php echo htmlspecialchars($habitat['habitat_id']); ?>" class="modify_habitat">modifier l'habitat</a>
                <a href="admin/add_habitat.php" class="add_habitat">ajouter l'habitat</a>
                <a href="admin/delete_habitat.php?id=<?php echo htmlspecialchars($habitat['habitat_id']); ?>" class="delete_habitat">suprimer l'habitat</a>
            </div>
        <?php endforeach; ?>
    </section>

</body>

</html>
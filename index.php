<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Acceuil</title>
</head>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" type="text/css" href="Acceuil.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playwrite+PE:wght@100..400&display=swap" rel="stylesheet">

<body>


 <header>
 	<article>
 		<a href="index.php" id="logo"><img src="logo.png"></a>
 	
 	</article>
 	<nav>
 		<a href="index.php">ACCEUIL</a>
 		<a href="">SERVICES</a>
 		<a href="">HABITATS</a>
 		<a href="">CONTACT</a>
 		<a href="connexion.php">CONNEXION</a>
 		
 	</nav>
 </header>

 <main>
 	<img src="img4.png">
 	<h1>ARCADIA</h1>
 	<p>Bienvenue au zoo d’Arcadia ,un véritable havre de biodiversité et d’émerveillement situé en France près de la foret Brocéliande ,en bretagne .fondé en 1960,notre zoo abrite une diversité impressionnante d’animaux venus des quartes coins du monde, chaque habitat est conçu pour recréer au mieux les conditions adéquates de chaque animal ,garantissant leur bien être et leurs confort ,y compris la savane africaine vibrante , l’introspection dense de la jungle et les zoo tranquilles des marais.</p><br><br>
 	<article> <center>
 			<img src="img8.png">
 			<img src="img11.png">
 			<img src="meerkat.png">
 			</center>
 	</article>

    <p>Le zoo Arcadia s’engage a la protection des animaux et a leurs bien être , avec des équipes expertes qui ont un rôle crucial ,ils assurent non seulement la survie des animaux en captivité ,mais aussi a l’élaboration des régimes alimentaires adaptés aux besoins spécifiques de chaque animal ,garantissant un apport nutritionnel équilibré.<br><br>

    Nous avons hâte de vous accueillir pour une journée inoubliable parmi les merveilles de la nature !
   </p>
 </main>

	<center>
 <main>
 	<h2>
 		Habitats:
 	</h2>
 	<p>Amusez vous et complétez votre visite avec nos différents services!</p>
 
 	<div>

 		<article>
 			<h3>Savane:</h3>
 			<img src="savane.png">
 			<p>Dégustez nos recettes et nos délicieux plats. </p>
 		</article>
 		<article><h3>Jungle:</h3>
 			<img src="jungle.png">
 			<p>Profitez d'une meilleure visite avec un guide gratuit.</p>
 		</article>

 		<article>
 			<h3>Marais:</h3>
 			<img src="marais.png">
 			<p>Amusez vous et visitez tout nos habitats en petit train .</p>
 		</article>
 	</div>
 	
 	

 </main>
</center>


 	<center>
 <main>
 	<h2>
 		Nos services:
 	</h2>
 	<p>Amusez vous et complétez votre visite avec nos différents services!</p>
 
 	<div>
 		<article>
 			<h3>Restaurant:</h3>
 			<img src="plat.png">
 			<p>Dégustez nos recettes et nos délicieux plats. </p>
 		</article>
 		<article><h3>Guide de visite gratuit:</h3>
 			<img src="guide.png">
 			<p>Profitez d'une meilleure visite avec un guide gratuit.</p>
 		</article>
 		<article>
 			<h3>visit en train:</h3>
 			<img src="train.png">
 			<p>Amusez vous et visitez tout nos habitats en petit train .</p>
 		</article>
 	</div>
 	
 	

 </main>
</center>



	<center>
 <main>
 	<h3>
 		Lissez nous votre avis, nous sommes ravis de vous revoir sur notre platforme !
 	</h3>
 	<form action="" method="POST">
  <ul>
    <li>
      <label for="name"¨>Pseudo&nbsp;:</label>
      <input type="text" id="name" name="name" />
    </li>
    
    <li>
      <label for="avis">Avis&nbsp;:</label>
      <textarea id="avis" name="avis"></textarea>
    </li>
  </ul>
  <div class="button">
  <button type="submit">Valider</button>
</div>
</form><br>

 	
 </main>
</center>
 



<?php


try {

    $pdo = new PDO('mysql:host=localhost;dbname=users', 'root', 'root');

    foreach ($pdo->query('SELECT id, nom, avis FROM users', PDO::FETCH_ASSOC) as $user) {

        echo $user['nom'].' '.$user['avis'].'<br>';

    }
    

} catch (PDOException $e) {

    echo 'Impossible de récupérer la liste des utilisateurs';

}
$id=5;
$avis="avis";
$name="toi";


try {

    $pdo = new PDO('mysql:host=localhost;dbname=users', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $insertQuery="INSERT INTO users (id, nom, avis) VALUES (:id, :pseudo, :name)";
    $stmt = $pdo->prepare($insertQuery);

   
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':pseudo', $avis);

    $stmt->bindParam(':name', $name);

    $stmt->execute();

        

    
    

} catch (PDOException $e) {

    echo 'Impossible de récupérer la liste des utilisateurs';

}


?>

<footer>
 <main>
 	<div>
 		<article>
 			<h3></h3>
 			
 		</article>
 		<article><h3>Suivez nous sur les réseaux sociaux!</h3>
 			
 		</article>
 		<article>
 			<h3><a href="">Contactez nous!</a></h3>
 			
 		</article>
 	</div>
 </main>	
 </footer>	
 
</body>
</html>

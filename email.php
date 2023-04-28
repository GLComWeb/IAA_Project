<?php

//Informations de connexion à la base de données
$servername = "localhost";
$username = "*";
$password = "*";
$dbname = "*";

//Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Vérifier la connexion
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

//Requête SQL pour récupérer les données de l'utilisateur
$sql = "SELECT email, nom, prenom FROM utilisateurs WHERE id = '1'";
$result = mysqli_query($conn, $sqli);

if (mysqli_num_rows($result) > 0) {
	//Boucle à travers les résultats de la requête
	while($row = mysqli_fetch_assoc($result)) {
		$to = $row["email"];
		$nom = $row["nom"];
		$prenom = $row["prenom"];

		//Message de l'email
		$subject = "Bienvenue sur notre site!";
		$message = "Bonjour" . $prenom . "" . $nom . ",\n\nBienvenue sur notre site web!";
		
		//Envoi de l'email
		$headers = "From: webmaster@example.com";
		mail($to, $subject, $message, $headers);
	}
} else {
	echo "Aucun résultat trouvé.";
}

//Fermeture de la connexion à la base de données
mysqli_close($conn);

?>
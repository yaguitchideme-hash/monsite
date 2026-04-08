<?php
include("db.php");

// Choisis ton identifiant et mot de passe admin
$username = "Devadmin";
$password = "203500"; // tu peux changer
$role = "admin";

// Générer le hash du mot de passe
$hash = password_hash($password, PASSWORD_DEFAULT);

// Insérer dans la base
$sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hash', '$role')";
if ($conn->query($sql) === TRUE) {
    echo "✅ Compte admin créé avec succès.<br>";
    echo "Nom d'utilisateur : $username<br>";
    echo "Mot de passe : $password<br>";
} else {
    echo "Erreur: " . $conn->error;
}
?>
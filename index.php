<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Bienvenue</title>
    <style>
        .profil {
            width: 150px;
            height: 150px;
            border-radius: 50%; /* rend la photo ronde */
            object-fit: cover; /* ajuste bien l’image */
        }
    </style>
</head>
<body>
     <!-- Photo de profil -->
    <img src="image\profile.jpg" alt="Photo de profil" class="profil">

    <h1>Bienvenue! merci d'avoir visiter le bon site au bon moment</h1>
    <h5>Comment puis-je vous rendre service ?</h5>
    <p>nos services sont disponibles pour vous aider à atteindre vos objectifs, que ce soit pour une formation en développement, le lancement d'un business, des conseils pratiques ou d'autres services personnels. N'hésitez pas à nous contacter pour toute demande ou question.</p>
    <a href="register.php?service=email">formation en developpement ?</a><br>
    <a href="register.php?service=whatsapp">lancement d'un business ?</a><br>
    <a href="register.php?service=phone">besoin de conseil pratique ?</a><br>
    <a href="register.php?service=phone">autres services personels ?</a><br>
    <a href="admin-login.php">connexion de l'administrateur</a>
</body>
</html>
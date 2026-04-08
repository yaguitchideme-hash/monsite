<?php
include("db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')";
    if ($conn->query($sql) === TRUE) {
        echo "🎉 Félicitations " . htmlspecialchars($username) . ", votre inscription est réussie !";
        echo "<br><a href='login.php?service=" . $_GET['service'] . "'>Cliquez ici pour vous connecter</a>";
    } else {
        echo "Erreur : " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <style>
        .retour {
            display: inline-block;
            font-size: 18px;
            text-decoration: none;
            color: blue;
            margin-bottom: 15px;
        }
        .retour:hover {
            color: darkblue;
        }
    </style>
</head>
<body>
    <!-- Flèche de retour -->
    <a href="index.php" class="retour">← Retour</a>

    <h2>Inscription</h2>
    <form method="post">
        Nom d'utilisateur : <input type="text" name="username" required><br>
        Email : <input type="email" name="email" required><br>
        Mot de passe : <input type="password" name="password" required><br>
        <button type="submit">S'inscrire</button>
    </form>

    <p>Déjà inscrit ? <a href="login.php?service=<?php echo $_GET['service']; ?>">Se connecter</a></p>
</body>
</html>
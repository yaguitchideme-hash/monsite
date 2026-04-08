<?php
include("db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo "👋 Bienvenue " . htmlspecialchars($user['username']) . " !";
            header("refresh:2;url=contact.php?service=" . $_GET['service']); 
            exit;
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Utilisateur introuvable.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
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
    <a href="register.php?service=<?php echo $_GET['service']; ?>" class="retour">← Retour</a>

    <h2>Connexion</h2>
    <form method="post">
        Email : <input type="email" name="email" required><br>
        Mot de passe : <input type="password" name="password" required><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
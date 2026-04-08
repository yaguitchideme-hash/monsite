<?php
include("db.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$service = $_GET['service'];

// Envoi d'un nouveau message
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['envoyer'])) {
    $content = $_POST['message'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO messages (user_id, service, content, created_at) 
            VALUES ('$user_id','$service','$content', NOW())";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>✅ Message envoyé avec succès</p>";
        echo "<div style='border:1px solid #ccc; padding:10px; margin:10px 0; background:#f9f9f9;'>
                <strong>Votre message :</strong><br>".htmlspecialchars($content)."
                <br><small>📅 Envoyé le ".date("d/m/Y à H:i:s")."</small>
              </div>";
    } else {
        echo "<p style='color:red;'>❌ Erreur lors de l'envoi</p>";
    }
}

// Suppression
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $conn->query("DELETE FROM messages WHERE id='$delete_id' AND user_id=".$_SESSION['user_id']);
    echo "<p style='color:orange;'>Message supprimé</p>";
}

// Modification
if (isset($_POST['edit_id']) && isset($_POST['new_content'])) {
    $edit_id = $_POST['edit_id'];
    $new_content = $_POST['new_content'];
    $conn->query("UPDATE messages SET content='$new_content', updated_at=NOW() 
                  WHERE id='$edit_id' AND user_id=".$_SESSION['user_id']);
    echo "<p style='color:blue;'>Message modifié avec succès</p>";
}

// Récupération des messages triés par date
$result = $conn->query("SELECT * FROM messages WHERE user_id=".$_SESSION['user_id']." ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
    <style>
        .retour { display:inline-block; font-size:18px; text-decoration:none; color:blue; margin-bottom:15px; }
        .retour:hover { color:darkblue; }
        textarea { width:400px; height:150px; }
        .message-box { border:1px solid #ddd; padding:10px; margin:10px 0; background:#f1f1f1; }
    </style>
    <script>
        function confirmDelete() {
            return confirm("⚠️ Voulez-vous vraiment supprimer ce message ?");
        }
        function clearMessage() {
            document.getElementById("message").value = "";
        }
    </script>
</head>
<body>
    <a href="login.php?service=<?php echo $service; ?>" class="retour">← Retour</a>

    <h2>Bonjour <?php echo htmlspecialchars($_SESSION['username']); ?>, 
    envoyez votre message par <?php echo ucfirst($service); ?></h2>

    <!-- Formulaire d’envoi -->
    <form method="post">
        <textarea id="message" name="message" required></textarea><br>
        <button type="submit" name="envoyer">Envoyer</button>
        <button type="button" onclick="clearMessage()">Annuler</button>
    </form>

    <h3>Vos messages (du plus récent au plus ancien) :</h3>
    <?php while($row = $result->fetch_assoc()) { ?>
        <div class="message-box">
            <?php echo htmlspecialchars($row['content']); ?>
            <br><small>
            📅 Envoyé le <?php echo date("d/m/Y à H:i:s", strtotime($row['created_at'])); ?>
            <?php if (!empty($row['updated_at'])) { 
                echo " | ✏️ Modifié le ".date("d/m/Y à H:i:s", strtotime($row['updated_at'])); 
            } ?>
            </small>
        </div>
    <?php } ?>

    <!-- Suppression -->
    <h3>Supprimer un message :</h3>
    <form method="post" onsubmit="return confirmDelete();">
        <select name="delete_id" required>
            <option value="">-- Sélectionnez un message à supprimer --</option>
            <?php 
            $result2 = $conn->query("SELECT * FROM messages WHERE user_id=".$_SESSION['user_id']." ORDER BY created_at DESC");
            while($row = $result2->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>">
                    <?php echo htmlspecialchars($row['content'])." (".date("d/m/Y H:i:s", strtotime($row['created_at'])).")"; ?>
                </option>
            <?php } ?>
        </select>
        <button type="submit">Supprimer</button>
    </form>

    <!-- Modification -->
    <h3>Modifier un message :</h3>
    <form method="post">
        <select name="edit_id" required>
            <option value="">-- Sélectionnez un message à modifier --</option>
            <?php 
            $result3 = $conn->query("SELECT * FROM messages WHERE user_id=".$_SESSION['user_id']." ORDER BY created_at DESC");
            while($row = $result3->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>">
                    <?php echo htmlspecialchars($row['content'])." (".date("d/m/Y H:i:s", strtotime($row['created_at'])).")"; ?>
                </option>
            <?php } ?>
        </select><br><br>
        <textarea name="new_content" required placeholder="Écrivez la nouvelle version du message"></textarea><br>
        <button type="submit">Modifier</button>
    </form>
</body>
</html>
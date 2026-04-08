<?php
include("db.php");
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin-login.php");
    exit;
}

$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Erreur SQL: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Messages</title>
</head>
<body>
    <h2>Liste des messages</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['contenu']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
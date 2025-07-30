<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Visitor Log</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Visitor Log</h2>
    <a href="add.php">Add New Visitor</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Purpose</th>
            <th>Contact</th>
            <th>Check-in Time</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM visitors ORDER BY checkin_time DESC");
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['purpose']) ?></td>
            <td><?= htmlspecialchars($row['contact']) ?></td>
            <td><?= $row['checkin_time'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this visitor?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

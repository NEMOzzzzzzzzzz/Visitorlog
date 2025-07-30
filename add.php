<?php include 'config.php';

$nameErr = $contactErr = "";
$name = $purpose = $contact = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $purpose = trim($_POST["purpose"]);
    $contact = trim($_POST["contact"]);

    $isValid = true;
    if (empty($name)) {
        $nameErr = "Name is required";
        $isValid = false;
    }

    if (!empty($contact) && !preg_match("/^[0-9]{10}$/", $contact)) {
        $contactErr = "Enter valid 10-digit number";
        $isValid = false;
    }

    if ($isValid) {
        $stmt = $conn->prepare("INSERT INTO visitors (name, purpose, contact) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $purpose, $contact);
        $stmt->execute();
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Visitor</title>
</head>
<body>
    <h2>Add New Visitor</h2>
    <form method="POST" action="">
        Name: <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">
        <span style="color:red"><?= $nameErr ?></span><br><br>

        Purpose: <input type="text" name="purpose" value="<?= htmlspecialchars($purpose) ?>"><br><br>

        Contact: <input type="text" name="contact" value="<?= htmlspecialchars($contact) ?>">
        <span style="color:red"><?= $contactErr ?></span><br><br>

        <input type="submit" value="Add Visitor">
    </form>
    <br><a href="index.php">Back to Visitor Log</a>
</body>
</html>

<?php include 'config.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM visitors WHERE id=$id");
$data = $result->fetch_assoc();

$name = $data['name'];
$purpose = $data['purpose'];
$contact = $data['contact'];
$nameErr = $contactErr = "";

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
        $stmt = $conn->prepare("UPDATE visitors SET name=?, purpose=?, contact=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $purpose, $contact, $id);
        $stmt->execute();
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Visitor</title>
</head>
<body>
    <h2>Edit Visitor</h2>
    <form method="POST" action="">
        Name: <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">
        <span style="color:red"><?= $nameErr ?></span><br><br>

        Purpose: <input type="text" name="purpose" value="<?= htmlspecialchars($purpose) ?>"><br><br>

        Contact: <input type="text" name="contact" value="<?= htmlspecialchars($contact) ?>">
        <span style="color:red"><?= $contactErr ?></span><br><br>

        <input type="submit" value="Update Visitor">
    </form>
    <br><a href="index.php">Back to Visitor Log</a>
</body>
</html>

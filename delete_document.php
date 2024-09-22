<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Διαγραφή</title>
    <link rel="stylesheet" href="stylesss.css">
</head>
<body>
   <?php
$servername = "webpagesdb.it.auth.gr:3306";
$username = "kelly_admin";
$password = "123456kelly_admin";
$dbname = "student3961partB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM documents WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Το έγγραφο διαγράφηκε με επιτυχία.";
    } else {
        echo "Σφάλμα κατά τη διαγραφή του εγγράφου: " . $conn->error;
    }
} else {
    echo "Μη έγκυρο id εγγράφου.";
}

$conn->close();
?>


<a href="announcement.php">Πίσω</a>
</body>
</html>
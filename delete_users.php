<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Διαγραφή μαθητών</title>
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

if (isset($_GET['id']) ) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Ο μαθητής διαγράφηκε με επιτυχία.";
    } else {
        echo "Σφάλμα κατά τη διαγραφή του μαθητή: " . $conn->error;
    }
} else {
    echo "Μη έγκυρο id μαθητή.";
}

$conn->close();
?>
<a href="users.php">Πίσω</a>
</body>
</html>
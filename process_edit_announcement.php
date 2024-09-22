<?php
$servername = "webpagesdb.it.auth.gr:3306";
$username = "kelly_admin";
$password = "123456kelly_admin";
$dbname = "student3961partB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "Σφάλμα σύνδεσης στη βάση δεδομένων: " . $conn->connect_error;
    exit();
}

if (isset($_POST['id'], $_POST['topic'], $_POST['date'], $_POST['content'])) {
    $id = $_POST['id'];
    $topic = $_POST['topic'];
    $date = $_POST['date'];
    $content = $_POST['content'];

    $sql = "UPDATE announcements SET topic='$topic', date='$date', content='$content' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Οι αλλαγές αποθηκεύτηκαν με επιτυχία.";
    } else {
        echo "Σφάλμα κατά την αποθήκευση των αλλαγών: " . $conn->error;
    }
} else {
    echo "Λάθος παράμετροι περάστηκαν στη φόρμα επεξεργασίας.";
}

$conn->close();
?>

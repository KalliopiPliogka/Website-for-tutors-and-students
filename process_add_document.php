<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ανέβασμα</title>
    <link rel="stylesheet" href="stylesss.css">
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDirectory = 'uploads/';

    $title = $_POST['document_title'];
    $description = $_POST['document_description'];
    $fileName = basename($_FILES["file_path"]["name"]);
    $targetFilePath = $uploadDirectory . $fileName;

    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    if (in_array($fileType, ['doc', 'docx'])) {
        if (move_uploaded_file($_FILES["file_path"]["tmp_name"], $targetFilePath)) {
            $servername = "webpagesdb.it.auth.gr:3306";
            $username = "kelly_admin";
            $password = "123456kelly_admin";
            $dbname = "student3961partB";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                echo "Σφάλμα σύνδεσης στη βάση δεδομένων: " . $conn->connect_error;
                exit();
            }

            $sql = "INSERT INTO documents (document_title, document_description, file_path)
                    VALUES ('$title', '$description', '$targetFilePath')";

            if ($conn->query($sql) === TRUE) {
                echo "Το αρχείο $fileName ανέβηκε με επιτυχία.";
            } else {
                echo "Σφάλμα κατά την εισαγωγή στη βάση δεδομένων: " . $conn->error;
            }

            $conn->close();
        } else {
            echo "Σφάλμα κατά το ανέβασμα του αρχείου.";
        }
    } else {
        echo "Μη έγκυρος τύπος αρχείου. Επιτρέπονται μόνο αρχεία doc και docx.";
    }
} else {
    echo "Μη έγκυρο αίτημα.";
}
?>

<a href="documents.php">Πίσω</a>
</body>
</html>
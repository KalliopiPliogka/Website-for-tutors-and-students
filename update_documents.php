<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ενημέρωση</title>
    <link rel="stylesheet" href="stylesss.css">
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "webpagesdb.it.auth.gr:3306";
        $username = "kelly_admin";
        $password = "123456kelly_admin";
        $dbname = "student3961partB";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            echo "<script>alert('Σφάλμα σύνδεσης στη βάση δεδομένων: " . $conn->connect_error . "');</script>";
            exit();
        }

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $document_title = $_POST['document_title'];
            $document_description = $_POST['document_description'];

            if ($_FILES['new_file']['size'] > 0) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["new_file"]["name"]);
                move_uploaded_file($_FILES["new_file"]["tmp_name"], $target_file);

                $new_file_path = $target_file;
            } else {
                $new_file_path = $_POST['file_path'];
            }

            $sql = "UPDATE documents SET 
                    document_title = '$document_title',
                    document_description = '$document_description',
                    file_path = '$new_file_path'
                    WHERE id = $id";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Επιτυχής ενημέρωση εγγράφου'); window.location.href='documents.php';</script>";
            } else {
                echo "<script>alert('Σφάλμα ενημέρωσης εγγράφου: " . $conn->error . "'); window.location.href='documents.php';</script>";
            }
        } else {
            echo "<script>alert('Δεν παρελήφθη το ID για ενημέρωση.'); window.location.href='documents.php';</script>";
        }

        $conn->close();
    } else {
        echo "<script>alert('Μη έγκυρο αίτημα'); window.location.href='documents.php';</script>";
    }
    ?>
</body>
</html>

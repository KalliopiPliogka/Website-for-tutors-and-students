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
        $assignment_title = $_POST['assignment_title'];
        $assignment_goals = $_POST['assignment_goals'];
        $assignment_instructions = $_POST['assignment_instructions'];
        $deliverables = $_POST['deliverables'];
        $delivery_date = $_POST['delivery_date'];

        if (isset($_FILES['file_path']) && $_FILES['file_path']['error'] === UPLOAD_ERR_OK) {
            $file_name = basename($_FILES["file_path"]["name"]);
            $target_path = "uploads/" . $file_name;

            $allowed_extensions = ['doc', 'docx'];
            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if (in_array($file_extension, $allowed_extensions)) {
                if (move_uploaded_file($_FILES["file_path"]["tmp_name"], $target_path)) {
                    $file_path = $target_path;

                    $servername = "webpagesdb.it.auth.gr:3306";
                    $username = "kelly_admin";
                    $password = "123456kelly_admin";
                    $dbname = "student3961partB";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Σφάλμα σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
                    }

                    $sql = "INSERT INTO homework (assignment_title, assignment_goals, assignment_instructions, file_path, deliverables, delivery_date)
                            VALUES ('$assignment_title', '$assignment_goals', '$assignment_instructions', '$file_path', '$deliverables', '$delivery_date')";

                    if ($conn->query($sql) === TRUE) {
                        $assignment_id = $conn->insert_id;

                        $sql_announcement = "INSERT INTO announcements (date, topic, content)
                            VALUES (NOW(), 'Υποβλήθηκε η εργασία $assignment_title στην ιστοσελίδα <a href=\"homework.php\" style=\"color: blue;\">Εργασίες</a>' , 'Η ημερομηνία παράδοσης της εργασίας είναι $delivery_date')";

                        if ($conn->query($sql_announcement) === TRUE) {
                            echo "Επιτυχής υποβολή της εργασίας και δημιουργία ανακοίνωσης.";
                        } else {
                            echo "Σφάλμα κατά την εισαγωγή ανακοίνωσης: " . $conn->error;
                        }
                        
                    } else {
                        echo "Σφάλμα κατά την εισαγωγή της εργασίας: " . $conn->error;
                    }

                    $conn->close();
                } else {
                    echo "Σφάλμα κατά τη μεταφόρτωση του αρχείου.";
                }
            } else {
                echo "Μη έγκυρος τύπος αρχείου. Επιτρέπονται μόνο αρχεία doc και docx.";
            }
        } else {
            echo "Δεν επιλέξατε αρχείο.";
        }
    } else {
        header("Location: index1.php");
        exit();
    }
    ?>
    <a href="homework.php">Πίσω</a>
</body>
</html>
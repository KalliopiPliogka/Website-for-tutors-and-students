<?php
        $servername = "webpagesdb.it.auth.gr:3306";
        $username = "kelly_admin";
        $password = "123456kelly_admin";
        $dbname = "student3961partB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης στη βάση δεδομένων: " . $conn->connect_error);
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $select_sql = "SELECT document_title, document_description, file_path FROM documents WHERE id = $id";
    $result = $conn->query($select_sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $document_title = $row['document_title'];
        $document_description = $row['document_description'];
        $file_path = $row['file_path'];
    } else {
        echo "Δεν βρέθηκε εγγραφή με αυτό το αναγνωριστικό.";
        exit();
    }
} else {
    echo "Μη έγκυρο αίτημα επεξεργασίας.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Επεξεργασία Εγγράφου</title>
    <link rel="stylesheet" href="edit_documents1.css"/>
    <link rel="icon" href="html5.png"/>
    <style>
    label, input, textarea {
        display: block;
        width: 40%;
        padding: 10px;
        margin-top: 10px;
        box-sizing: border-box;
    }
    </style>
</head>
<body>
    <h1 style="background-color: burlywood;">Επεξεργασία Εγγράφου</h1>
    <div class="row">
        <div style="width: 30%; height: 800px; float: left;" class="btn-group" >
            <button type="button" onclick="location.href='index1.php'">Αρχική Σελίδα</button>
            <button type="button" onclick="location.href='announcement.php'">Ανακοινώσεις</button>
            <button type="button" onclick="location.href='communication.php'">Επικοινωνία</button>
            <button type="button" onclick="location.href='documents.php'">Έγγραφα Μαθήματος</button>
            <button type="button" onclick="location.href='homework.php'">Εργασίες</button>
            <button type="button" onclick="location.href='users.php'">Χρήστες</button>
            <button type="button" onclick="location.href='logout.php'">Αποσύνδεση</button>
        </div>
        <div style="width: 70%; height: 60px;float: left;" class="contents">
        <form action="update_documents.php" method="post" enctype="multipart/form-data">
            <label for="new_file">Νέο Αρχείο:</label>
            <input type="file" name="new_file"><br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="document_title">Τίτλος Εγγράφου:</label>
            <input type="text" id="document_title" name="document_title" value="<?php echo $document_title; ?>" required>
            <br>
            <label for="document_description">Περιγραφή Εγγράφου:</label>
            <textarea id="document_description" name="document_description" required><?php echo $document_description; ?></textarea>
            <br>
            <input type="hidden" name="file_path" value="<?php echo $row['file_path']; ?>">
            <br>
            <button type="submit" style="background-color: chocolate; color: #fff; padding: 10px; border: none; border-radius: 4px; cursor: pointer;">Ενημέρωση Εγγράφου</button>
        </form>
        </div>
    </div>
</body>
</html>
